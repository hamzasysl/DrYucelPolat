<?php

/**
 * Op. Dr. Yücel Polat — Tedavi kataloğu.
 * Tüm görünür metinler (short, lead, seo_desc) hocanın yazdığı docx dosyalarından BİREBİR alınmıştır.
 * seo_keywords sadece arama terimlerinden oluşur (cümle yok).
 * Detaylı makale içerikleri resources/views/partials/services/{slug}.blade.php dosyalarında.
 */

return [
    [
        'slug'  => 'varis-tedavisi',
        'icon'  => 'fa-syringe',
        'title' => 'Varis Tedavisi',
        'short' => 'Varis, yer çekimine karşı toplardamarların görevini tam yapamaması sonucu genişlemesi ve şekil değiştirmesidir.',
        'lead'  => 'Varis, yer çekimine karşı toplardamarların görevini tam yapamaması sonucu genişlemesi ve şekil değiştirmesidir. Kalp seviyesinin altındaki toplardamarlarda görülebilir.',
        'intro' => [
            'Varis, yer çekimine karşı toplardamarların görevini tam yapamaması sonucu genişlemesi ve şekil değiştirmesidir. Kalp seviyesinin altındaki toplardamarlarda görülebilir.',
            'Varis yıllar içinde oluşan ve hastalığın her döneminde çeşitli belirtiler gösteren, çoğunlukta önemsenmeyen bir hastalıktır.',
        ],
        'has_page' => true,
        'seo_desc' => 'Varis, yer çekimine karşı toplardamarların görevini tam yapamaması sonucu genişlemesi ve şekil değiştirmesidir. Kalp seviyesinin altındaki toplardamarlarda görülebilir.',
        'seo_keywords' => 'varis, varis tedavisi, varis nedir, varis belirtileri, kılcal varis, telenjiektazi, retiküler varis, trunkal varis, örümcek varis, skleroterapi, köpük skleroterapi, EVLA, endovenöz lazer ablasyon, RFA, radyofrekans ablasyon, VenaSeal, siyanoakrilat ablasyon, transkütan lazer, KlaKs, kriyo skleroterapi, flebektomi, stripping, varis çorabı, kompresyon tedavisi, doppler ultrasonografi, venöz ülser, Op. Dr. Yücel Polat, Liv Hospital İstanbul',
        // Skleroterapi / köpük / EVLA / RFA / VenaSeal — docx: "aynı gün normal günlük yaşam"
        'stats' => [
            ['icon' => 'fa-syringe',        'label' => 'ANESTEZİ',   'value' => 'Lokal'],
            ['icon' => 'fa-clock',          'label' => 'SÜRE',       'value' => '30-90 dk'],
            ['icon' => 'fa-house-medical',  'label' => 'HASTANE',    'value' => 'Günübirlik'],
            ['icon' => 'fa-person-walking', 'label' => 'İŞE DÖNÜŞ',  'value' => 'Aynı gün'],
        ],
    ],
    [
        'slug'  => 'periferik-damar-hastaligi',
        'icon'  => 'fa-heart-pulse',
        'title' => 'Periferik Damar Hastalığı',
        'short' => 'Genellikle damar sertliği (ateroskleroz) nedeniyle oluşan, kalp dışındaki organlara özellikle kollara ve bacaklara kan taşıyan damarların daralması veya tıkanmasıdır.',
        'lead'  => 'Genellikle damar sertliği (ateroskleroz) nedeniyle oluşan, kalp dışındaki organlara özellikle kollara ve bacaklara kan taşıyan damarların daralması veya tıkanmasıdır. Sigara ve tütün ürünleri kullanımı en önemli risk faktörüdür.',
        'intro' => [
            'Genellikle damar sertliği (ateroskleroz) nedeniyle oluşan, kalp dışındaki organlara özellikle kollara ve bacaklara kan taşıyan damarların daralması veya tıkanmasıdır. Sigara ve tütün ürünleri kullanımı en önemli risk faktörüdür.',
        ],
        'has_page' => true,
        'seo_desc' => 'Genellikle damar sertliği (ateroskleroz) nedeniyle oluşan, kalp dışındaki organlara özellikle kollara ve bacaklara kan taşıyan damarların daralması veya tıkanmasıdır. Sigara ve tütün ürünleri kullanımı en önemli risk faktörüdür.',
        'seo_keywords' => 'periferik damar hastalığı, damar tıkanıklığı, ateroskleroz, damar sertliği, kladikasyo, aralıklı topallama, istirahat ağrısı, akut arteriyel emboli, akut ekstremite iskemisi, Leriche sendromu, ankle brachial indeks, ABI, doppler ultrasonografi, BT anjiyografi, MR anjiyografi, DSA, PTA, perkütan translüminal anjiyoplasti, stent, PTS, aterektomi, rotasyonel aterektomi, Turbo Elite lazer, IVL, intravasküler litotripsi, shockwave, CERAB, bypass, endarterektomi, hibrit cerrahi, Op. Dr. Yücel Polat',
        // Endovasküler (PTA/IVL/stent) ağırlıklı; "6-12 ay takip önemli" — docx'ten
        'stats' => [
            ['icon' => 'fa-syringe',        'label' => 'ANESTEZİ',   'value' => 'Lokal'],
            ['icon' => 'fa-clock',          'label' => 'SÜRE',       'value' => '60-120 dk'],
            ['icon' => 'fa-house-medical',  'label' => 'HASTANE',    'value' => '1-2 gün'],
            ['icon' => 'fa-person-walking', 'label' => 'İŞE DÖNÜŞ',  'value' => '1-2 hafta'],
        ],
    ],
    [
        'slug'  => 'lenfodem',
        'icon'  => 'fa-hand-holding-droplet',
        'title' => 'Lenfödem',
        'short' => 'Lenfödem genellikle kol veya bacaklarda biriken lenf sıvısının neden olduğu şişliktir. Halk arasında fil hastalığı olarak da bilinir.',
        'lead'  => 'Lenfödem genellikle kol veya bacaklarda biriken lenf sıvısının neden olduğu şişliktir. Halk arasında fil hastalığı olarak da bilinir. Lenfödem, birincil lenfödem (Kalıtımsal, Prekoks) veya geçirilmiş ameliyat, radyoterapi, travma gibi nedenlere bağlı olarak ikincil lenfödem olarak gelişebilir.',
        'intro' => [
            'Lenfödem genellikle kol veya bacaklarda biriken lenf sıvısının neden olduğu şişliktir. Halk arasında fil hastalığı olarak da bilinir.',
            'Lenfödem, birincil lenfödem (Kalıtımsal, Prekoks) veya geçirilmiş ameliyat, radyoterapi, travma gibi nedenlere bağlı olarak ikincil lenfödem olarak gelişebilir.',
        ],
        'has_page' => true,
        'seo_desc' => 'Lenfödem genellikle kol veya bacaklarda biriken lenf sıvısının neden olduğu şişliktir. Halk arasında fil hastalığı olarak da bilinir. Birincil (Kalıtımsal, Prekoks) veya ikincil olarak gelişebilir.',
        'seo_keywords' => 'lenfödem, lenfödem tedavisi, fil hastalığı, birincil lenfödem, kalıtımsal lenfödem, prekoks lenfödem, ikincil lenfödem, sekonder lenfödem, kompleks dekonjestif tedavi, KDT, manuel lenfatik drenaj, MLD, kompresyon giysisi, kompresyon çorabı, medikal cihaz destekli tedavi, doppler ultrasonografi, kol lenfödemi, bacak lenfödemi, radyoterapi sonrası lenfödem, Op. Dr. Yücel Polat',
        // Kompleks Dekonjestif Tedavi — cerrahi değil, seans bazlı; docx: "kronik hastalık, belirli aralıkla kontrol"
        'stats' => [
            ['icon' => 'fa-syringe',        'label' => 'ANESTEZİ',   'value' => 'Gerekmiyor'],
            ['icon' => 'fa-clock',          'label' => 'SÜRE',       'value' => '45-60 dk / seans'],
            ['icon' => 'fa-house-medical',  'label' => 'HASTANE',    'value' => 'Ayaktan'],
            ['icon' => 'fa-person-walking', 'label' => 'İŞE DÖNÜŞ',  'value' => 'Aynı gün'],
        ],
    ],
    [
        'slug'  => 'lipodem',
        'icon'  => 'fa-scale-balanced',
        'title' => 'Lipödem',
        'short' => 'Genellikle kalça, bacaklar ile bazen de kollarda görülen orantısız, simetrik anormal yağ doku birikimidir.',
        'lead'  => 'Genellikle kalça, bacaklar ile bazen de kollarda görülen orantısız, simetrik anormal yağ doku birikimidir. Hastalar kolayca "obez" olarak damgalanır fakat zayıf hastalarda da lipödem gözükebilir.',
        'intro' => [
            'Genellikle kalça, bacaklar ile bazen de kollarda görülen orantısız, simetrik anormal yağ doku birikimidir. Hastalar kolayca "obez" olarak damgalanır fakat zayıf hastalarda da lipödem gözükebilir.',
            'Lipödem hastaları obezitenin aksine düşük kalorili diyet ile neredeyse cevap alamaz.',
            'Lipödem hastaları etkilenen bölgede ağrı hissedebilir. Hafifçe dokunmayla bile hassasiyet gösterebilir, kolayca morarabilir.',
            'Hastalığın temelinde genetik ve hormonal faktörler etkindir. Mikroanjiopati (kılcal damar hasarı) ve inflamasyon ile seyreden süreçler ile anormal yağ doku birikiminin olduğu kronik ilerleyici bir tablo ortaya çıkar.',
        ],
        'has_page' => true,
        'seo_desc' => 'Genellikle kalça, bacaklar ile bazen de kollarda görülen orantısız, simetrik anormal yağ doku birikimidir. Hastalar kolayca "obez" olarak damgalanır fakat zayıf hastalarda da lipödem gözükebilir.',
        'seo_keywords' => 'lipödem, lipödem nedir, lipödem tedavisi, orantısız yağ birikimi, simetrik yağ birikimi, kalıtımsal lipödem, hormonal lipödem, mikroanjiyopati, kılcal damar hasarı, kompleks dekonjestif terapi, liposuction, özel liposuction, transkütan lazer, transdermal radyofrekans, kompresyon çorabı, manuel lenfatik masaj, segmental vücut ölçümü, obezite ayırıcı tanı, Op. Dr. Yücel Polat',
        // Kombine tedavi — non-cerrahi seanslar + gerektiğinde özel liposuction (docx)
        'stats' => [
            ['icon' => 'fa-syringe',        'label' => 'ANESTEZİ',   'value' => 'Vakaya özel'],
            ['icon' => 'fa-clock',          'label' => 'SÜRE',       'value' => '60-120 dk'],
            ['icon' => 'fa-house-medical',  'label' => 'HASTANE',    'value' => 'Günübirlik'],
            ['icon' => 'fa-person-walking', 'label' => 'İŞE DÖNÜŞ',  'value' => '1-3 gün'],
        ],
    ],
    [
        'slug'  => 'diyabetik-ayak',
        'icon'  => 'fa-band-aid',
        'title' => 'Diyabetik Ayak',
        'short' => 'Diyabetik ayak, şeker hastalarında sinir hasarı (nöropati) ve dolaşım bozukluğu ile ortaya çıkan iyileşmesi güç yaralardır.',
        'lead'  => 'Diyabetik ayak, şeker hastalarında sinir hasarı (nöropati) ve dolaşım bozukluğu ile ortaya çıkan iyileşmesi güç yaralardır. Etkin ve doğru bir yaklaşım ile tedavi edilmediği takdirde uzuv kayıplarının yaşanması olasıdır.',
        'intro' => [
            'Diyabetik ayak, şeker hastalarında sinir hasarı (nöropati) ve dolaşım bozukluğu ile ortaya çıkan iyileşmesi güç yaralardır.',
            'Etkin ve doğru bir yaklaşım ile tedavi edilmediği takdirde uzuv kayıplarının yaşanması olasıdır.',
            'Doğru ve günlük yapılan ayak bakımı büyük oranda diyabetik ayak yarasının oluşmasını engeller.',
        ],
        'has_page' => true,
        'seo_desc' => 'Diyabetik ayak, şeker hastalarında sinir hasarı (nöropati) ve dolaşım bozukluğu ile ortaya çıkan iyileşmesi güç yaralardır. Etkin ve doğru bir yaklaşım ile tedavi edilmediği takdirde uzuv kayıplarının yaşanması olasıdır.',
        'seo_keywords' => 'diyabetik ayak, diyabetik ayak yarası, diyabetik ayak tedavisi, şeker hastalığı ayak, nöropati, diyabetik nöropati, dolaşım bozukluğu, revaskülarizasyon, mikrovasküler dolaşım, ayak bileği kol indeksi, ABI, doppler ultrasonografi, BT MR anjiyografi, intravasküler litotripsi, IVL, PTA, aterektomi, distal bypass, bacak damarı bypass, diyabetik ayak ülseri, venöz ülser, kronik yara, amputasyon önleme, ayak bakımı, Op. Dr. Yücel Polat',
        // IVL/PTA/Aterektomi + distal bypass revaskülarizasyon (docx)
        'stats' => [
            ['icon' => 'fa-syringe',        'label' => 'ANESTEZİ',   'value' => 'Lokal'],
            ['icon' => 'fa-clock',          'label' => 'SÜRE',       'value' => '60-120 dk'],
            ['icon' => 'fa-house-medical',  'label' => 'HASTANE',    'value' => '1-3 gün'],
            ['icon' => 'fa-person-walking', 'label' => 'İŞE DÖNÜŞ',  'value' => '1-4 hafta'],
        ],
    ],
    [
        'slug'  => 'dvt-tromboz',
        'icon'  => 'fa-heart-circle-bolt',
        'title' => 'Derin Ven Trombozu (DVT)',
        'short' => 'Tromboz, kanın damar içinde pıhtılaşması ve kan akışını engellemesidir.',
        'lead'  => 'Tromboz, kanın damar içinde pıhtılaşması ve kan akışını engellemesidir. Derin Ven Trombozu (DVT), kirli kanı taşıyan ana damarlarda meydana gelen pıhtıdır. Sıklıkla bacak toplardamarlarında gözükür.',
        'intro' => [
            'Tromboz, kanın damar içinde pıhtılaşması ve kan akışını engellemesidir.',
            'Derin Ven Trombozu (DVT), kirli kanı taşıyan ana damarlarda meydana gelen pıhtıdır. Sıklıkla bacak toplardamarlarında gözükür.',
            'Tedavi edilmeyen proksimal DVT\'li (diz seviyesi üzeri) hastaların yarısında 3 ay içinde semptomatik Pulmoner Emboli (Akciğer Embolisi) gelişebilir. Acil müdahale gerektirir.',
        ],
        'has_page' => true,
        'seo_desc' => 'Tromboz, kanın damar içinde pıhtılaşması ve kan akışını engellemesidir. Derin Ven Trombozu (DVT), kirli kanı taşıyan ana damarlarda meydana gelen pıhtıdır. Sıklıkla bacak toplardamarlarında gözükür.',
        'seo_keywords' => 'DVT, derin ven trombozu, tromboz, pıhtı, kan pıhtılaşması, bacak pıhtısı, pulmoner emboli, akciğer embolisi, tromboflebit, posttrombotik sendrom, PTS, venöz ülser, Flegmasia Alba, Cerulea Dolens, akut ekstremite iskemisi, heparin, antikoagulan, kan sulandırıcı, oral antikoagulan, kateter trombolitik, EKOS, ultrason hızlandırılmış trombolitik, Anjiojet, farmako-mekanik trombektomi, venöz stentleme, renkli doppler ultrasonografi, D-dimer, BT pulmoner anjiyografi, IV kateter tromboflebit, Op. Dr. Yücel Polat',
        // Girişimsel (EKOS/Anjiojet) — docx: "acil ve tıbbi bir süreç", "ilk 14 günde başarı yüksek"
        'stats' => [
            ['icon' => 'fa-syringe',        'label' => 'ANESTEZİ',   'value' => 'Lokal'],
            ['icon' => 'fa-clock',          'label' => 'SÜRE',       'value' => '60-120 dk'],
            ['icon' => 'fa-house-medical',  'label' => 'HASTANE',    'value' => '3-7 gün'],
            ['icon' => 'fa-person-walking', 'label' => 'İŞE DÖNÜŞ',  'value' => '2-4 hafta'],
        ],
    ],
    [
        'slug'  => 'pelvik-konjesyon',
        'icon'  => 'fa-venus',
        'title' => 'Pelvik Konjesyon Sendromu',
        'short' => 'Kadınlarda gonadal (overian) toplardamarların genişlemesi yani varisleşmesi "Pelvik Konjesyon Sendromu / Yumurtalık varisleri" adını alır.',
        'lead'  => 'Bacaklarda toplardamarların genişlemesi "varis", makat bölgesindeki toplardamarlar genişlemesi "hemoroid", erkeklerde gonadal (testiküler) toplardamarların genişlemesi "varikosel" adını alırken kadınlarda gonadal (overian) toplardamarların genişlemesi yani varisleşmesi "Pelvik Konjesyon Sendromu / Yumurtalık varisleri" adını alır. Sıklıkla sol tarafta gözükür.',
        'intro' => [
            'Bacaklarda toplardamarların genişlemesi "varis", makat bölgesindeki toplardamarlar genişlemesi "hemoroid", erkeklerde gonadal (testiküler) toplardamarların genişlemesi "varikosel" adını alırken kadınlarda gonadal (overian) toplardamarların genişlemesi yani varisleşmesi "Pelvik Konjesyon Sendromu / Yumurtalık varisleri" adını alır. Sıklıkla sol tarafta gözükür.',
            'Pelvik konjesyon sendromu (Yumurtalık Varisleri) genetik, ailesel, hormonal etkenler (Östrojen), birden fazla gebelik, Nutcracker veya May Thurner Sendromları gibi toplardamarların sıkışmasında görülebilir.',
        ],
        'has_page' => true,
        'seo_desc' => 'Kadınlarda gonadal (overian) toplardamarların genişlemesi yani varisleşmesi "Pelvik Konjesyon Sendromu / Yumurtalık varisleri" adını alır. Sıklıkla sol tarafta gözükür.',
        'seo_keywords' => 'pelvik konjesyon sendromu, yumurtalık varisleri, overian ven varisi, gonadal ven, kronik pelvik ağrı, kadın kasık ağrısı, disparoni, cinsel ilişki ağrısı, disorgazmi, anorgazmi, PGAD, dismenore, adet ağrısı, dizüri, pollaküri, urgency, stres inkontinans, amenore, menorji, Nutcracker sendromu, May Thurner sendromu, pelvik venöz embolizasyon, tanısal venografi, laparoskopik ven ligasyonu, MR venografi, BT venografi, hemoroid, vulva varisi, Op. Dr. Yücel Polat',
        // Pelvik Venöz Embolizasyon — docx: "aynı gün ağır efordan uzak normal fiziksel yaşamına döner"
        'stats' => [
            ['icon' => 'fa-syringe',        'label' => 'ANESTEZİ',   'value' => 'Lokal'],
            ['icon' => 'fa-clock',          'label' => 'SÜRE',       'value' => '60-90 dk'],
            ['icon' => 'fa-house-medical',  'label' => 'HASTANE',    'value' => 'Günübirlik'],
            ['icon' => 'fa-person-walking', 'label' => 'İŞE DÖNÜŞ',  'value' => 'Aynı gün'],
        ],
    ],
    [
        'slug'  => 'cardisiography',
        'icon'  => 'fa-wave-square',
        'title' => 'Cardisiography (Yapay Zeka EKG)',
        'short' => 'Kalp hastalıklarında erken tanı hayat kurtarır ve kalıcı kalp hasarını önler.',
        'lead'  => 'Kalp hastalıklarında erken tanı hayat kurtarır ve kalıcı kalp hasarını önler. Günümüzde Yapay zeka EKG (Cardisiography) kullanımı hayatı tehdit eden kalp krizi gibi kalp sağlığı problemlerinin erken dönemde açığa çıkmasında önemli bir yardımcıdır.',
        'intro' => [
            'Kalp hastalıklarında erken tanı hayat kurtarır ve kalıcı kalp hasarını önler.',
            'Günümüzde Yapay zeka EKG (Cardisiography) kullanımı hayatı tehdit eden kalp krizi gibi kalp sağlığı problemlerinin erken dönemde açığa çıkmasında önemli bir yardımcıdır.',
            'Cardisiography (CSG) kalbin elektriksel faaliyetini üç boyutlu olarak inceleyen yapay zeka destekli, girişimsel olmayan bir kalp tarama ve erken tanı yöntemidir.',
        ],
        'has_page' => true,
        'seo_desc' => 'Cardisiography (CSG) kalbin elektriksel faaliyetini üç boyutlu olarak inceleyen yapay zeka destekli, girişimsel olmayan bir kalp tarama ve erken tanı yöntemidir.',
        'seo_keywords' => 'Cardisiography, CSG, yapay zeka EKG, AI EKG, 3D EKG, kalp tarama, kalp tarama testi, kalp krizi riski, kalp krizi taraması, erken tanı, iskemi, kanlanma bozukluğu, ritm bozukluğu, aritmi, yapısal kalp anomalisi, girişimsel olmayan test, kalp muayenesi, kardiyovasküler tarama, koroner risk, Op. Dr. Yücel Polat',
        // Tarama testi — girişimsel değil, hazırlık yok
        'stats' => [
            ['icon' => 'fa-syringe',        'label' => 'ANESTEZİ',   'value' => 'Gerekmiyor'],
            ['icon' => 'fa-clock',          'label' => 'SÜRE',       'value' => '5-10 dk'],
            ['icon' => 'fa-house-medical',  'label' => 'HASTANE',    'value' => 'Ayaktan'],
            ['icon' => 'fa-person-walking', 'label' => 'İŞE DÖNÜŞ',  'value' => 'Aynı anda'],
        ],
    ],
];
