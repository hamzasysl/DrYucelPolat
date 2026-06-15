@once
    @push('scripts')
        <script>
            (() => {
                const UTILS = "https://cdn.jsdelivr.net/npm/intl-tel-input@19.5.6/build/js/utils.js";
                const BOUND = new WeakSet();

                function getITI(input) {
                    try { return window.intlTelInputGlobals?.getInstance?.(input) || null; }
                    catch { return null; }
                }

                function enforceE164(value) {
                    let v = String(value || "").replace(/[^\d+]/g, "");
                    if (!v.startsWith("+")) v = "+" + v.replace(/\+/g, "");
                    const digits = v.replace(/\D/g, "").slice(0, 15);
                    return "+" + digits;
                }

                function isVisible(el) {
                    return !!(el && (el.offsetWidth || el.offsetHeight || el.getClientRects().length));
                }

                function initOne(input, { force = false } = {}) {
                    if (!window.intlTelInput) return;
                    if (!input || input.type !== "tel") return;
                    if (!input.id) return;

                    const hidden = document.getElementById(input.id + "_hidden");
                    if (!hidden) return;

                    const wrapper = input.closest("[data-iti]");
                    if (!wrapper) return;

                    if (!isVisible(input)) {
                        requestAnimationFrame(() => setTimeout(() => initOne(input, { force }), 80));
                        return;
                    }

                    const existing = getITI(input);
                    if (force && existing) { try { existing.destroy(); } catch {} }

                    const stillThere = getITI(input);
                    if (!force && input.dataset.itiMounted === "1" && stillThere) return;
                    if (input.dataset.itiMounted === "1" && !stillThere) delete input.dataset.itiMounted;

                    if (getComputedStyle(wrapper).position === "static") wrapper.style.position = "relative";
                    wrapper.style.overflow = "visible";

                    const iti = window.intlTelInput(input, {
                        initialCountry: "auto",
                        geoIpLookup: (cb) => {
                            fetch("https://ipapi.co/json/")
                                .then(r => r.json())
                                .then(d => cb(String(d?.country_code || "gb").toLowerCase()))
                                .catch(() => cb("gb"));
                        },
                        nationalMode: false,
                        separateDialCode: false,
                        autoHideDialCode: false,
                        formatOnDisplay: true,
                        autoPlaceholder: "polite",
                        utilsScript: UTILS,
                    });

                    input.dataset.itiMounted = "1";
                    let prevDial = iti.getSelectedCountryData()?.dialCode || "";

                    function syncHidden() {
                        let e164 = "";
                        try { e164 = iti.getNumber(); } catch {}
                        if (!e164 || !String(e164).startsWith("+")) e164 = enforceE164(input.value);
                        hidden.value = e164;
                        hidden.dispatchEvent(new Event("input", { bubbles: true }));
                        hidden.dispatchEvent(new Event("change", { bubbles: true }));
                    }

                    function applyPrefixIfEmpty() {
                        if (String(input.value || "").trim()) return;
                        const cd = iti.getSelectedCountryData();
                        if (!cd?.dialCode) return;
                        input.value = "+" + cd.dialCode;
                        prevDial = String(cd.dialCode || "");
                        syncHidden();
                    }

                    function replacePrefixOnCountryChange() {
                        const cd = iti.getSelectedCountryData();
                        const newDial = String(cd.dialCode || "");
                        const newPrefix = "+" + newDial;
                        let val = String(input.value || "").trim();
                        if (!val) { input.value = newPrefix; prevDial = newDial; syncHidden(); return; }
                        if (!val.startsWith("+")) { prevDial = newDial; return; }
                        const oldPrefix = prevDial ? ("+" + prevDial) : null;
                        if (oldPrefix && val.startsWith(oldPrefix)) {
                            const rest = val.slice(oldPrefix.length).replace(/\D/g, "");
                            input.value = newPrefix + rest;
                            prevDial = newDial;
                            syncHidden();
                        } else { prevDial = newDial; }
                    }

                    const t0 = Date.now();
                    const timer = setInterval(() => {
                        applyPrefixIfEmpty();
                        if (String(input.value || "").trim() || Date.now() - t0 > 8000) clearInterval(timer);
                    }, 100);

                    if (!BOUND.has(input)) {
                        input.addEventListener("input", syncHidden);
                        input.addEventListener("blur", () => { applyPrefixIfEmpty(); syncHidden(); });
                        input.addEventListener("countrychange", () => {
                            if (!String(input.value || "").trim()) applyPrefixIfEmpty();
                            else replacePrefixOnCountryChange();
                        });
                        BOUND.add(input);
                    }

                    applyPrefixIfEmpty();
                    syncHidden();
                }

                function initAll({ force = false } = {}) {
                    document.querySelectorAll('[data-iti] input[type="tel"]').forEach(input => initOne(input, { force }));
                }

                let raf = 0;
                function scheduleInit(force = false) {
                    cancelAnimationFrame(raf);
                    raf = requestAnimationFrame(() => setTimeout(() => initAll({ force }), 0));
                }

                document.addEventListener("DOMContentLoaded", () => scheduleInit(false));
                document.addEventListener("livewire:navigated", () => scheduleInit(true));
                document.addEventListener("livewire:init", () => {
                    scheduleInit(false);
                    window.Livewire?.hook?.("morph.updated", () => scheduleInit(false));
                });
                window.addEventListener("pageshow", () => scheduleInit(true));
            })();
        </script>
    @endpush
@endonce
