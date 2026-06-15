@extends('layouts.app')

@section('title', $service['title'] . ' — Op. Dr. Yücel Polat | Liv Hospital İstanbul')
@section('description', $service['lead'])
@section('keywords', $service['title'] . ', ' . $service['title'] . ' İstanbul, ' . $service['title'] . ' fiyat, ' . $service['title'] . ' uzmanı, Op. Dr. Yücel Polat, Liv Hospital, kalp damar cerrahisi, ücretsiz konsültasyon')
@section('og_title', $service['title'] . ' — Op. Dr. Yücel Polat')
@section('og_description', $service['lead'])
@php
    $servicePhotoPathSeo = public_path('img/services/' . $service['slug'] . '.jpg');
    $hasServicePhotoSeo = file_exists($servicePhotoPathSeo);
@endphp
@section('og_image', $hasServicePhotoSeo ? asset('img/services/' . $service['slug'] . '.jpg') : asset('img/doktor.webp'))
@section('og_image_alt', $service['title'] . ' — Op. Dr. Yücel Polat')
@section('og_type', 'article')

@section('structured_data')
@php
    $breadcrumbLd = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Anasayfa', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Hizmetler', 'item' => route('services.index')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $service['title'], 'item' => url()->current()],
        ],
    ];
    $procedureLd = [
        '@context' => 'https://schema.org',
        '@type' => 'MedicalProcedure',
        '@id' => url()->current() . '#procedure',
        'name' => $service['title'],
        'description' => $service['lead'],
        'url' => url()->current(),
        'image' => $hasServicePhotoSeo ? asset('img/services/' . $service['slug'] . '.jpg') : asset('img/doktor.webp'),
        'performer' => ['@id' => url('/') . '#person'],
        'procedureType' => 'https://schema.org/SurgicalProcedure',
        'bodyLocation' => 'Kalp ve damar sistemi',
        'preparation' => 'Konsültasyon, gerekli tetkikler (Doppler USG, kan tahlilleri) ve hekim değerlendirmesi.',
        'followup' => 'Düzenli kontrol muayeneleri, gerektiğinde görüntüleme tetkikleri ve yaşam tarzı önerileri.',
    ];
    $webPageLd = [
        '@context' => 'https://schema.org',
        '@type' => 'MedicalWebPage',
        '@id' => url()->current() . '#webpage',
        'url' => url()->current(),
        'name' => $service['title'] . ' — Op. Dr. Yücel Polat',
        'description' => $service['lead'],
        'isPartOf' => ['@id' => url('/') . '#website'],
        'mainEntity' => ['@id' => url()->current() . '#procedure'],
        'about' => ['@id' => url('/') . '#person'],
        'medicalAudience' => [
            '@type' => 'MedicalAudience',
            'audienceType' => 'Patient',
        ],
        'inLanguage' => 'tr-TR',
    ];
    $faqItems = [
        ['q' => 'Tedavi sırasında ağrı hisseder miyim?',  'a' => 'Lokal anestezi kullanıldığı için işlem süresince ağrı hissetmezsiniz; basınç hissi olabilir. Sonrasındaki hafif gerginlik birkaç gün içinde geçer.'],
        ['q' => 'Sonuçlar ne kadar sürede ortaya çıkar?', 'a' => 'İlk iyileşme belirtileri birkaç gün içinde başlar. Tam sonuç, vakaya bağlı olarak 2-6 hafta arasında ortaya çıkar.'],
        ['q' => 'Tekrarlama riski var mı?',                'a' => 'Doğru endikasyon ve uygun tekniğin seçimi ile tekrarlama oranı düşüktür. Düzenli takip ve yaşam tarzı önerileri uzun vadeli başarıyı artırır.'],
        ['q' => 'İşe ne zaman dönerim?',                   'a' => 'Çoğu hasta aynı gün ya da ertesi gün hafif aktiviteye dönebilir. Ağır egzersiz ve uzun yolculuklar için 1-2 hafta önerilir.'],
        ['q' => 'Sigorta kapsamında mı?',                   'a' => 'Tedavinin türüne ve sigorta poliçenize bağlıdır. Konsültasyonda detaylı bilgi sağlanır ve belgeler hazırlanır.'],
    ];
    $faqLd = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        '@id' => url()->current() . '#faq',
        'mainEntity' => array_map(fn ($f) => [
            '@type' => 'Question',
            'name' => $f['q'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
        ], $faqItems),
    ];
@endphp
<script type="application/ld+json">{!! json_encode($breadcrumbLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
<script type="application/ld+json">{!! json_encode($webPageLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
<script type="application/ld+json">{!! json_encode($procedureLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
<script type="application/ld+json">{!! json_encode($faqLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endsection

@section('content')

@include('partials.subheader', [
    'title'   => $service['title'],
    'current' => $service['title'],
    'parent'  => ['label' => 'Hizmetler', 'route' => 'services.index'],
])

{{-- 1. INTRO — Renkli profesyonel editorial, pembe CTA --}}
<section class="relative bg-white py-16 lg:py-24 overflow-hidden">
    {{-- Yumuşak dekoratif orb'lar — mavi atmosfer (pembe kaldırıldı) --}}
    <div class="absolute -top-32 -right-32 w-[480px] h-[480px] bg-deep-100/45 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/4 -left-32 w-80 h-80 bg-deep-50/60 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 left-1/3 w-72 h-72 bg-deep-200/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

            {{-- Sol: İçerik --}}
            <div class="lg:col-span-7 order-2 lg:order-1">

                {{-- SEO H2 — ana + alt başlık (H1 zaten subheader'da) --}}
                <h2 class="font-display mb-7">
                    <span class="block text-3xl lg:text-[40px] font-extrabold text-deep-700 leading-[1.05] tracking-[-0.01em]">
                        {{ $service['title'] }}
                    </span>
                    <span class="block text-lg lg:text-2xl font-light text-deep-500 leading-snug mt-2">
                        @if ($service['slug'] === 'varis-tedavisi')
                            Nedir? Belirtileri, Nedenleri ve Tedavi Yöntemleri
                        @else
                            Nedir? Belirtileri, Süreç ve Tedavi Detayları
                        @endif
                    </span>
                </h2>

                {{-- Lead — iki paragraf, orta boy --}}
                <div class="text-ink-500 text-[15px] lg:text-[16px] leading-[1.7] font-light max-w-xl mb-9 space-y-3">
                    <p>{{ $service['lead'] }}</p>
                    <p>
                        @if ($service['slug'] === 'varis-tedavisi')
                            Doppler ultrason ile haritalama sonrası lokal anestezi altında uygulanan minimal invaziv yöntemler <span class="text-deep-700 font-semibold">günübirlik bakım</span> ile sonuçlanır; hastaların çoğu 1-3 gün içinde günlük yaşamına döner.
                        @elseif ($service['slug'] === 'shockwave-ivl')
                            Kalsifik plakları ses dalgalarıyla parçalayan intravasküler litotripsi ile <span class="text-deep-700 font-semibold">klasik anjiyoplastinin yetersiz kaldığı vakalar</span> da güvenle tedavi edilir.
                        @elseif ($service['slug'] === 'lenfodem-lipodem')
                            Manuel lenf drenajı, kompresyon ve gerektiğinde cerrahi yönlendirme ile <span class="text-deep-700 font-semibold">multidisipliner</span> ve sürdürülebilir bir tedavi yaklaşımı sunulur.
                        @elseif ($service['slug'] === 'diyabetik-yara')
                            Damar açıklığını yeniden sağlayarak yara bakımını birlikte yürütüyor; <span class="text-deep-700 font-semibold">amputasyon riskini en aza</span> indirgiyoruz.
                        @elseif ($service['slug'] === 'dvt-tromboz')
                            Doppler ile hızlı tanı ve gerektiğinde kateterle trombüs aspirasyonu — <span class="text-deep-700 font-semibold">tromboz sonrası sendromu</span> önlemek için planlı uzun dönem takip.
                        @elseif ($service['slug'] === 'pelvik-konjesyon')
                            Anjiyografik haritalama ve embolizasyon ile <span class="text-deep-700 font-semibold">kalıcı sonuç</span> sağlanır; jinekoloji ve üroloji ile multidisipliner değerlendirme yürütülür.
                        @elseif ($service['slug'] === 'kalp-damar-cerrahisi')
                            20+ yıllık deneyim ve modern protokoller ile mümkün olan her vakada <span class="text-deep-700 font-semibold">atan-kalp ve minimal invaziv</span> yaklaşımlar tercih edilir.
                        @elseif ($service['slug'] === 'konsultasyon')
                            Eldeki anjiyografi, EKO, BT ve Doppler raporlarının detaylı değerlendirmesi ile <span class="text-deep-700 font-semibold">cerrahi - endovasküler seçimde</span> şeffaf yönlendirme.
                        @else
                            Her hastanın klinik tablosu farklıdır — tedavi planı <span class="text-deep-700 font-semibold">kanıta dayalı protokoller</span> ile bireyselleştirilir.
                        @endif
                    </p>
                </div>

                {{-- CTA satırı — eşit boyutlu, title case, normal tracking --}}
                <div class="flex flex-wrap items-stretch gap-3 mb-12">
                    <a href="#randevu-form"
                       class="group inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white px-6 py-3.5 text-sm font-semibold rounded-lg shadow-[0_8px_20px_rgba(230,57,70,0.28)] hover:shadow-[0_10px_26px_rgba(230,57,70,0.38)] hover:-translate-y-0.5 transition-all">
                        <i class="fas fa-calendar-check text-[13px]"></i>
                        Ücretsiz Konsültasyon
                    </a>
                    <a href="https://wa.me/900000000000" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 bg-[#1FA950] hover:bg-[#168F47] text-white px-6 py-3.5 text-sm font-semibold rounded-lg shadow-[0_8px_20px_rgba(31,169,80,0.28)] hover:shadow-[0_10px_26px_rgba(22,143,71,0.38)] hover:-translate-y-0.5 transition-all">
                        <i class="fab fa-whatsapp text-[15px]"></i>
                        Whatsapp İletişim
                    </a>
                </div>

                {{-- Premium stat şeridi — kompakt fontlar, single-line label --}}
                <div class="relative">
                    {{-- Üst yatay çizgi — kenarlarda fade --}}
                    <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-ink-200 to-transparent"></div>
                    {{-- Alt yatay çizgi — simetrik --}}
                    <div class="absolute inset-x-0 bottom-0 h-px bg-gradient-to-r from-transparent via-ink-200 to-transparent"></div>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-x-2 sm:gap-x-8 gap-y-5 sm:gap-y-0 py-5 sm:py-6">
                        @foreach ([
                            ['icon' => 'fa-syringe',       'label' => 'Anestezi',  'value' => 'Lokal'],
                            ['icon' => 'fa-clock',         'label' => 'Süre',      'value' => '45-90 dk'],
                            ['icon' => 'fa-house-medical', 'label' => 'Hastane',   'value' => 'Günübirlik'],
                            ['icon' => 'fa-person-walking','label' => 'İşe Dönüş', 'value' => '1-3 gün'],
                        ] as $i => $info)
                            <div class="relative flex flex-col items-center text-center sm:flex-row sm:items-center sm:text-left gap-2 sm:gap-3 min-w-0">
                                {{-- Dikey ayraç — sm+ üzeri, hücreler arası gap ortasında --}}
                                @if (! $loop->last)
                                    <span class="hidden sm:block absolute -right-4 top-1/2 -translate-y-1/2 w-px h-9
                                                 bg-gradient-to-b from-transparent via-ink-200 to-transparent"></span>
                                @endif
                                {{-- Mobilde dikey ayraç — sağdaki kolonu sol kolondan ayır (ilk ve üçüncü item'in sağında) --}}
                                @if ($i % 2 === 0)
                                    <span class="sm:hidden absolute top-1 bottom-1 -right-1 w-px
                                                 bg-gradient-to-b from-transparent via-ink-200/70 to-transparent"></span>
                                @endif
                                {{-- Mobilde 1. satırın altına yatay ayraç --}}
                                @if ($i < 2)
                                    <span class="sm:hidden absolute -bottom-2.5 left-2 right-2 h-px
                                                 bg-gradient-to-r from-transparent via-ink-200/70 to-transparent"></span>
                                @endif

                                <span class="w-9 h-9 sm:w-9 sm:h-9 rounded-lg bg-gradient-to-br from-deep-50 to-white border border-deep-100/60 text-deep-500 inline-flex items-center justify-center text-xs shrink-0 shadow-[0_2px_5px_rgba(15,61,90,0.06)]">
                                    <i class="fas {{ $info['icon'] }}"></i>
                                </span>
                                <div class="min-w-0 w-full sm:flex-1">
                                    <p class="text-[8.5px] uppercase tracking-[0.14em] font-bold text-deep-500/85 mb-0.5 leading-none truncate">{{ $info['label'] }}</p>
                                    <p class="font-display text-[13.5px] font-extrabold text-deep-700 leading-tight tracking-tight truncate">{{ $info['value'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Sağ: Foto alanı (lg col-5) --}}
            <div class="lg:col-span-5 order-1 lg:order-2">
                <div class="relative">
                    {{-- Yumuşak gradient halo --}}
                    <div class="absolute -inset-4 bg-gradient-to-br from-brand-500/10 via-leaf-500/10 to-deep-500/10 rounded-3xl blur-2xl pointer-events-none"></div>

                    {{-- Foto / placeholder — kompakt portre --}}
                    <div class="relative aspect-[16/10] sm:aspect-[4/4] lg:aspect-[5/5.5] max-h-[60vh] sm:max-h-none rounded-2xl overflow-hidden shadow-2xl ring-1 ring-ink-100">
                        @php
                            $servicePhoto = public_path('img/services/' . $service['slug'] . '.jpg');
                            $servicePhotoExists = file_exists($servicePhoto);
                        @endphp

                        @if ($servicePhotoExists)
                            <img src="{{ asset('img/services/' . $service['slug'] . '.jpg') }}"
                                 alt="{{ $service['title'] }}"
                                 class="w-full h-full object-cover"
                                 loading="eager">
                        @else
                            {{-- Placeholder: dolu görsel beklenirken --}}
                            <div class="absolute inset-0 bg-gradient-to-br from-deep-100 via-white to-ink-100 flex items-center justify-center">
                                <div class="text-center p-6">
                                    <span class="w-20 h-20 rounded-2xl bg-white shadow-lg text-brand-500 inline-flex items-center justify-center text-4xl mb-3">
                                        <i class="fas {{ $service['icon'] }}"></i>
                                    </span>
                                    <p class="text-[10px] uppercase tracking-[0.22em] font-bold text-ink-400">Görsel yakında</p>
                                    <p class="text-[10px] text-ink-300 mt-1 font-mono">img/services/{{ $service['slug'] }}.jpg</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 2. ANA MAKALE + STICKY SIDEBAR — beyaz arkaplan --}}
<section class="bg-white py-14 lg:py-20 border-t border-ink-100">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12">

        {{-- SOL: Makale — kutusuz, akan içerik --}}
        <article class="lg:col-span-8 prose-medical">

            @if ($service['slug'] === 'varis-tedavisi')
                <p class="lead">
                    Bacaklarda mor-mavi kıvrımlar, akşamları artan dolgunluk hissi, uzun süre ayakta kalınca
                    kramplar… <strong>Varis</strong>, toplumun yaklaşık dörtte birini etkileyen, görünür olduğu
                    kadar konfor da bozan bir damar hastalığıdır. İyi haber şu: bugün varis tedavisinde
                    kullanılan modern yöntemler büyük çoğunluk için <em>kesisiz, lokal anestezi altında ve
                    günübirlik bakım</em> ile tamamlanan girişimlerden oluşuyor.
                </p>

                <h2>Varis Nedir?</h2>
                <p>
                    Varis, toplardamarlardaki <strong>tek yönlü kapakçıkların</strong> işlevini yitirmesi
                    sonucu kanın bacaklardan kalbe yeterince geri dönememesi, damarın içinde kanın
                    göllenmesi ve damar duvarının zamanla genişleyip kıvrımlı bir hale gelmesidir. Sağlıklı
                    bir toplardamarda kapakçıklar yerçekimine karşı kanın yukarı doğru ilerlemesini sağlar.
                    Bu kapakçıklar yetersiz çalışmaya başladığında damar içinde basınç artar; damar duvarı
                    gerilir, kıvrımlanır ve cilt yüzeyinden mor-mavi çizgiler ya da kabarık yumrular
                    biçiminde görünür hale gelir. Hastalık yalnızca estetik bir sorun değildir: tedavi
                    edilmediğinde bacakta ödem, cilt renk değişiklikleri, egzama, hatta açık yaralara
                    (venöz ülser) ilerleyebilir.
                </p>

                <h2>Varis Neden Oluşur?</h2>
                <p>
                    Varis çok faktörlü bir hastalıktır; yatkınlık ile çevresel-mesleki etkenler bir araya
                    gelir. <strong>Genetik aktarım</strong> en güçlü risk faktörlerinden biridir: anne veya
                    babasında varis bulunan bireylerde görülme sıklığı belirgin biçimde artar. Buna ek
                    olarak:
                </p>
                <ul>
                    <li><strong>Cinsiyet ve hormonal değişiklikler:</strong> Kadınlarda erkeklere göre 2-3 kat daha sık görülür; gebelik ve hormonal tedaviler riski artırır.</li>
                    <li><strong>Yaşın ilerlemesi:</strong> Damar duvarının ve kapakçıkların elastikiyeti zamanla azalır.</li>
                    <li><strong>Uzun süre ayakta veya oturarak çalışma:</strong> Öğretmenler, sağlık çalışanları, kuaförler, ofis çalışanlarında daha sık karşılaşılır.</li>
                    <li><strong>Obezite:</strong> Karın içi basıncını artırarak bacak venlerine yük bindirir.</li>
                    <li><strong>Gebelik:</strong> Dolaşan kan hacmindeki artış ve hormonal değişiklikler kapakçıkları zorlar.</li>
                    <li><strong>Hareketsiz yaşam, sigara, dar giysiler, sıcağa uzun süre maruz kalma:</strong> Önemli ama önlenebilir faktörlerdir.</li>
                </ul>

                <h2>Belirtiler ve Klinik Aşamalar</h2>
                <p>
                    Varisin belirtileri kişiden kişiye, hastalığın evresine göre farklılık gösterir. Erken
                    dönemde yalnızca estetik bir rahatsızlık gibi görünebilir; ileri evrede ise yaşam
                    kalitesini bozan bulgular ortaya çıkar. Sık karşılaşılan belirtiler şunlardır:
                </p>
                <ul>
                    <li>Bacaklarda gün sonu ortaya çıkan <strong>ağırlık, dolgunluk ve yanma hissi</strong></li>
                    <li>Ayak bileği çevresinde akşamları belirginleşen <strong>şişlik (ödem)</strong></li>
                    <li>Geceleri özellikle baldırda <strong>kramplar</strong> ve <strong>huzursuz bacak</strong> hissi</li>
                    <li>Cilt yüzeyinde belirginleşen <strong>kıvrımlı mor-mavi damarlar</strong> veya yumrular</li>
                    <li>İleri evrede <strong>renk değişikliği</strong> (kahverengileşme), egzama, kuru cilt, kaşıntı</li>
                    <li>En ileri evrede <strong>açık yara (venöz ülser)</strong> — özellikle ayak bileği iç tarafında</li>
                </ul>
                <p>
                    Damar cerrahisinde klinik tabloyu sınıflandırmak için <strong>CEAP sınıflaması</strong>
                    kullanılır: C0 (görünür hastalık yok) ile başlar, C1 (kılcal damarlar), C2 (büyük varisler),
                    C3 (ödem), C4 (cilt değişiklikleri), C5 (iyileşmiş ülser) üzerinden C6'ya (aktif ülser)
                    kadar ilerler. Bu sınıflama, tedavi planlamasının temel yol göstericisidir.
                </p>

                <h2>Varis Çeşitleri</h2>
                <p>
                    Tüm "mor damarlar" aynı değildir. Doğru tedavi, doğru tipin ayırt edilmesiyle başlar.
                    Klinik pratikte üç ana grup öne çıkar:
                </p>
                <h3>1. Telenjiektaziler (Kılcal Damarlar)</h3>
                <p>
                    Cilt yüzeyine çok yakın, 1 mm'den ince, kırmızı-mor-mavi tonlarda ağ benzeri damarlardır.
                    Genellikle estetik kaygı oluşturur; ancak altında daha büyük bir kaynak damar
                    bulunabileceğinden değerlendirme önemlidir.
                </p>
                <h3>2. Retiküler Varisler</h3>
                <p>
                    1-3 mm çapında, cilt altında düzleşmiş mavi-mor damarlardır. Telenjiektazilerle birlikte
                    görülebilir. Çoğunlukla skleroterapi ile tedavi edilir.
                </p>
                <h3>3. Büyük Varisler (Trunk Variköz Venler)</h3>
                <p>
                    Vena Safena Magna veya Parva gibi ana yüzeyel toplardamarların yetmezliğine bağlı
                    olarak gelişen, cilt yüzeyinden belirgin biçimde kabaran, kıvrımlı damarlardır. Doppler
                    ultrasonda <strong>reflü</strong> (kanın geri kaçışı) gösterilir; tedavi genellikle
                    kaynak damarın endovenöz yöntemlerle kapatılmasıyla yapılır.
                </p>

                <h2>Tanı: Doppler Ultrasonografi</h2>
                <p>
                    Varis tanısında en değerli araç <strong>renkli Doppler ultrason</strong>'dur. Ağrısız ve
                    radyasyonsuz bu inceleme; toplardamarların akış yönünü, kapakçık yetmezliğini, varis
                    kaynağını ve hastalığın yaygınlığını ortaya koyar. Hangi damarın yetmezlik gösterdiği,
                    hangi seviyede ne kadar geriye kaçış olduğu net biçimde haritalanır. Tedavi planı
                    bu haritaya göre kişiselleştirilir — bu nedenle Doppler değerlendirmesi yapılmadan
                    tedaviye başlanması doğru bir yaklaşım değildir.
                </p>

                <h2>Varis Tedavi Yöntemleri</h2>
                <p>
                    Bugünkü varis tedavisi, "tek tip operasyon" mantığından çoktan ayrılmış durumda. Hastanın
                    kliniği, varis tipi, kaynak damarın çapı ve eşlik eden bulgulara göre bir veya birkaç
                    yöntemin kombinasyonu kullanılır. Aşağıda kanıt düzeyi yüksek başlıca seçenekler yer
                    almakta:
                </p>

                <h3>Skleroterapi</h3>
                <p>
                    Tedavi edilecek damara ince bir iğneyle <strong>sklerozan ajan</strong> enjekte edilir.
                    İlaç damar duvarını tahriş eder, damar kapanır ve vücut tarafından zamanla emilir.
                    Telenjiektazi ve retiküler varislerde altın standart sayılan, ofis koşullarında
                    uygulanan kısa bir işlemdir. Ortalama 20-30 dakika sürer; sonrasında hasta yürür ve
                    günlük hayatına devam eder.
                </p>

                <h3>Köpük Skleroterapi (Foam Sclerotherapy)</h3>
                <p>
                    Sklerozan ajanın hava ile karıştırılarak köpük formuna getirilip enjekte edildiği
                    gelişmiş bir tekniktir. Köpük damar içinde daha uzun süre kalır ve daha geniş damarları
                    kapatabilir. Orta boy ve büyük varislerde, klasik skleroterapinin yetersiz kaldığı
                    vakalarda etkilidir.
                </p>

                <h3>Endovenöz Lazer Ablasyon (EVLA)</h3>
                <p>
                    Yetmezlik gösteren ana toplardamarın içine ince bir kateter yerleştirilir ve lazer
                    enerjisi ile damar içeriden ısıtılarak kapatılır. <strong>Kesi yapılmaz</strong>;
                    sadece iğne ucu büyüklüğünde giriş yeri kullanılır. Klasik cerrahiye kıyasla iyileşme
                    süresi çok daha kısadır, ağrı ve morarma azdır. Hastanın aynı gün taburcu olması ve
                    ertesi gün hafif aktiviteye dönmesi mümkündür.
                </p>

                <h3>Radyofrekans Ablasyon (RFA)</h3>
                <p>
                    EVLA ile benzer prensiple çalışır; ancak ısı kaynağı olarak radyofrekans dalgaları
                    kullanılır. İşlem sonrası rahatlığı yüksek, başarı oranı yüksek bir yöntemdir. Lazerle
                    RFA arasındaki seçim büyük ölçüde damarın anatomisi ve cerrahın deneyimine göre yapılır.
                </p>

                <h3>Flebektomi (Ambulatuvar)</h3>
                <p>
                    Cilde yakın seyreden, paket halindeki varisli damarların 1-2 mm'lik mikro kesilerden
                    özel kancalarla çıkarıldığı minimal invaziv bir tekniktir. Genellikle EVLA veya RFA
                    ile aynı seansta tamamlayıcı olarak uygulanır.
                </p>

                <h3>Klasik Cerrahi: Ligasyon ve Stripping</h3>
                <p>
                    Endovenöz tekniklerin uygun olmadığı seçili vakalarda, klasik cerrahi ile yetmezlikli
                    damar çıkarılır. Günümüzde endovenöz yöntemlerin yaygınlaşmasıyla klasik strippingin
                    kullanım sıklığı azalmış, modern tekniklerin <strong>tamamlayıcısı</strong> haline gelmiştir.
                </p>

                <h3>Kompresyon Tedavisi</h3>
                <p>
                    Tıbbi varis çorabı; cerrahi/endovasküler işlem öncesinde ve sonrasında destek sağlar.
                    Hafif evre varislerde semptomları rahatlatır, ödemi azaltır ve hastalığın ilerlemesini
                    yavaşlatır. Doğru basınç sınıfı (genelde 2. sınıf) damar cerrahı tarafından belirlenmelidir.
                </p>

                <h2>Tedavi Sonrası: İyileşme ve Bakım</h2>
                <p>
                    Modern endovasküler işlemlerden sonra hastaların büyük kısmı aynı gün <em>yürüyerek</em>
                    taburcu olur ve ertesi gün hafif aktivitelerine döner. İyileşme sürecinde dikkat
                    edilmesi gerekenler:
                </p>
                <ul>
                    <li>İşlem günü dahil <strong>tıbbi varis çorabı</strong> önerilen sürede ve gün boyu kullanılmalıdır.</li>
                    <li>İlk 2 hafta <strong>uzun süreli ayakta durma, çok sıcak ortamlar (sauna, hamam) ve ağır egzersiz</strong> sınırlandırılır.</li>
                    <li>Bol su tüketimi, lifli beslenme ve düzenli yürüyüş iyileşmeyi destekler.</li>
                    <li>Hafif morarma, gerginlik hissi ve damar boyunca sertlik birkaç hafta sürebilir; bu beklenen bir süreçtir.</li>
                    <li>Kontrol Doppler ultrason ile damarın kapanıp kapanmadığı doğrulanır; gerekli durumlarda ek küçük seans yapılabilir.</li>
                </ul>

                <h2>Varisten Korunma ve Yaşam Tarzı Önerileri</h2>
                <p>
                    Varis genetik yatkınlıkla gelse de günlük alışkanlıklarla hastalığın seyri belirgin
                    ölçüde etkilenebilir. Önerilen pratikler:
                </p>
                <ul>
                    <li><strong>Düzenli yürüyüş ve baldır pompası egzersizleri</strong> (parmak ucunda kalkma, ayak bileği çevirme) dolaşımı destekler.</li>
                    <li>Uzun süre ayakta veya oturma gereken durumlarda <strong>her 30-45 dakikada bir hareket molası</strong> verin.</li>
                    <li>Gün boyu <strong>tıbbi destek çorabı</strong> riskli mesleklerde koruyucudur.</li>
                    <li>Bacakları <strong>kalp seviyesi üzerine</strong> kaldırarak dinlendirmek (akşam 15-20 dakika) yararlıdır.</li>
                    <li><strong>İdeal kiloyu korumak</strong> ve sigara/aşırı sıcak banyodan kaçınmak hastalığın seyrini yavaşlatır.</li>
                    <li>Bol sıvı tüketimi ve lif içeren beslenme, kabızlığı önleyerek karın içi basınç artışını azaltır.</li>
                </ul>

                <h2>Ne Zaman Bir Damar Cerrahına Başvurmalısınız?</h2>
                <p>
                    Bacaklarda görünür mor-mavi damarlar, sürekli ağırlık hissi, akşamları belirginleşen
                    şişlik, kramplar veya cilt renk değişiklikleri varsa zaman kaybetmeden bir
                    <strong>kalp ve damar cerrahisi uzmanı</strong> tarafından değerlendirilmek doğru olur.
                    Erken evrede minimal invaziv yöntemlerle başarı şansı çok yüksektir; ileri evrede
                    tedavi daha geniş kapsamlı olur ve yaşam kalitesi olumsuz etkilenir.
                </p>
                <p>
                    Doppler ultrason değerlendirmesi, doğru tanının ve doğru tedavi planının temelidir.
                    Modern varis tedavisi bugün; <em>kesisiz, ofis koşullarında, lokal anestezi altında ve
                    aynı gün taburcu</em> mantığıyla tasarlanmıştır. Önemli olan hastalığın hangi evrede
                    olduğunu, hangi damarın kaynak olduğunu ve hastanın günlük yaşam tarzına en uygun
                    yöntemi belirlemektir.
                </p>

            @else
                {{-- Diğer hizmetler için varsayılan içerik (config'ten beslenir) --}}
                <p class="lead">{{ $service['lead'] }}</p>

                <h2>Tedavi Hakkında</h2>
                <p>
                    Tedavinin başarısı; doğru endikasyon konulması, ileri görüntüleme tetkikleriyle
                    planlamanın yapılması ve hastanın bireysel risk profiline uygun protokol
                    seçilmesine bağlıdır. Modern endovasküler teknikler ve klasik cerrahi yöntemlerin
                    uygun kombinasyonu, en iyi sonuçları sağlar.
                </p>

                @if (! empty($service['points']))
                    <h2>Öne Çıkan Yaklaşımlar</h2>
                    <ul>
                        @foreach ($service['points'] as $point)
                            <li>{{ $point }}</li>
                        @endforeach
                    </ul>
                @endif

                <h2>Süreç</h2>
                <p>
                    Konsültasyon ve detaylı muayene ile başlayan süreç; tanı testleri, kişiselleştirilmiş
                    tedavi planı, uygulama ve düzenli takip aşamalarıyla tamamlanır. Her hastanın klinik
                    tablosu farklıdır ve bu fark planlamaya yansıtılır.
                </p>

                <h2>Ne Zaman Başvurmalısınız?</h2>
                <p>
                    Şikayetiniz veya mevcut tetkikleriniz varsa konsültasyon için iletişime geçebilirsiniz.
                    Erken değerlendirme tedavi seçeneklerini genişletir, sonuçları olumlu yönde etkiler.
                </p>
            @endif

            {{-- FAQ — makalenin doğal sonu --}}
            <div class="not-prose mt-14">
                {{-- Sola yaslı başlık + desc --}}
                <div class="mb-6">
                    <div class="inline-flex items-center gap-2.5 mb-2.5">
                        <span class="h-px w-7 bg-gradient-to-r from-transparent to-leaf-500"></span>
                        <p class="text-leaf-600 font-bold text-[10px] tracking-[0.24em] uppercase">SSS</p>
                    </div>
                    <h2 class="font-display text-[34px] font-bold text-brand-500 leading-[1.15] tracking-tight m-0 mb-3">
                        Sıkça Sorulan Sorular
                    </h2>
                    <p class="text-ink-400 text-[14px] leading-[1.65] font-light m-0 max-w-2xl">
                        Tedavi süreciyle ilgili en sık sorulan sorulara hızlı yanıtlar.
                        Aradığınızı bulamazsanız iletişim formundan bize ulaşabilirsiniz.
                    </p>
                </div>

                {{-- Tam genişlik liste — ferah padding, pro chevron --}}
                <div class="rounded-xl border border-ink-100 bg-white overflow-hidden divide-y divide-ink-100 shadow-[0_2px_8px_rgba(15,61,90,0.04)]">
                    @foreach ([
                        ['q' => 'Tedavi sırasında ağrı hisseder miyim?',  'a' => 'Lokal anestezi kullanıldığı için işlem süresince ağrı hissetmezsiniz; basınç hissi olabilir. Sonrasındaki hafif gerginlik birkaç gün içinde geçer.'],
                        ['q' => 'Sonuçlar ne kadar sürede ortaya çıkar?', 'a' => 'İlk iyileşme belirtileri birkaç gün içinde başlar. Tam sonuç, vakaya bağlı olarak 2-6 hafta arasında ortaya çıkar.'],
                        ['q' => 'Tekrarlama riski var mı?',                'a' => 'Doğru endikasyon ve uygun tekniğin seçimi ile tekrarlama oranı düşüktür. Düzenli takip ve yaşam tarzı önerileri uzun vadeli başarıyı artırır.'],
                        ['q' => 'İşe ne zaman dönerim?',                   'a' => 'Çoğu hasta aynı gün ya da ertesi gün hafif aktiviteye dönebilir. Ağır egzersiz ve uzun yolculuklar için 1-2 hafta önerilir.'],
                        ['q' => 'Sigorta kapsamında mı?',                   'a' => 'Tedavinin türüne ve sigorta poliçenize bağlıdır. Konsültasyonda detaylı bilgi sağlanır ve belgeler hazırlanır.'],
                    ] as $i => $faq)
                        <div x-data="{ open: {{ $i === 0 ? 'true' : 'false' }} }"
                             class="transition-colors"
                             :class="open ? 'bg-deep-50/[0.2]' : 'hover:bg-ink-50/50'">

                            <button @click="open = !open" type="button"
                                    class="group w-full flex items-center gap-3.5 px-5 py-3.5 text-left cursor-pointer">
                                <span class="font-display text-[15px] font-extrabold text-leaf-500 tabular-nums leading-none w-6 text-center shrink-0">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <h3 class="flex-1 font-display text-[16px] font-medium text-deep-700 leading-snug m-0">{{ $faq['q'] }}</h3>
                                <span class="w-7 h-7 rounded-lg inline-flex items-center justify-center shrink-0 transition-colors duration-200"
                                      :class="open
                                          ? 'bg-gradient-to-br from-brand-500 to-brand-600 text-white shadow-[0_4px_10px_rgba(230,57,70,0.25)] ring-1 ring-brand-500/30'
                                          : 'bg-white text-brand-500 ring-1 ring-brand-500/15 group-hover:ring-brand-500/40 group-hover:bg-brand-500/[0.04] group-hover:shadow-[0_2px_6px_rgba(230,57,70,0.12)]'">
                                    <i x-show="!open" class="fas fa-plus text-[10px]"></i>
                                    <i x-show="open" x-cloak class="fas fa-minus text-[10px]"></i>
                                </span>
                            </button>
                            <div x-show="open" x-cloak
                                 @click="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 -translate-y-1"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 class="pl-[2.85rem] pr-14 pb-4 text-ink-500 text-[15px] leading-[1.65] font-light cursor-pointer">
                                {{ $faq['a'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </article>

        {{-- SAĞ: Sticky sidebar — sadece form --}}
        <aside class="lg:col-span-4">
            <div class="lg:sticky lg:top-40">
                <div id="randevu-form" class="bg-white rounded-2xl p-6 shadow-xl border border-ink-100 scroll-mt-40">
                    <livewire:ui.forms.service-quick-form
                        :page-title="'service-' . $service['slug']"
                        :service-slug="$service['slug']"
                        :service-title="$service['title']" />
                </div>
            </div>
        </aside>
    </div>
</section>

@endsection
