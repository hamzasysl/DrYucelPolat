<?php

/**
 * Op. Dr. Yücel Polat — Tedavi kataloğu.
 * Anasayfa "Uzmanlık Alanları" + Hizmetler sayfası burayı baz alır.
 * Sıralama IG'de baskınlıktan derlenmiştir (varis + endovasküler en önde).
 */

return [
    [
        'slug'  => 'varis-tedavisi',
        'icon'  => 'fa-syringe',
        'title' => 'Varis Tedavisi',
        'short' => 'Köpük skleroterapi, kılcal damar tedavisi ve endovenöz teknikler ile estetik ve güvenli sonuçlar.',
        'lead'  => 'Telenjiektazi (kılcal damar), retiküler varisler ve venöz yetmezlikte skleroterapi, köpük skleroterapi, endovenöz lazer (EVLA) ve radyofrekans (RFA) ile kişiye özel modern tedavi planlanır.',
        'has_page' => true,
        'badges'=> ['Kesisiz seçenekler', 'Günübirlik bakım', 'Estetik sonuç'],
        'points'=> [
            'Köpük skleroterapi (foam) — küçük ve orta varis',
            'Kılcal damar mikro-skleroterapisi',
            'Endovenöz lazer / radyofrekans ablasyon',
            'Klasik varis ameliyatı (gerektiğinde)',
        ],
    ],
    [
        'slug'  => 'shockwave-ivl',
        'icon'  => 'fa-bolt-lightning',
        'title' => 'Damar Tıkanıklığı',
        'short' => 'Bacak atardamarında kireçlenmiş tıkanıklıkları intravasküler litotripsi ile kesisiz aç.',
        'lead'  => 'Periferik arter hastalığında, kalsifik plakları yüksek frekanslı ses dalgalarıyla parçalayan minimal invaziv teknik. Klasik anjiyoplastiye uygun olmayan vakalarda da etkili.',
        'badges'=> ['Kesisiz', 'Aynı gün taburcu', 'Lokal anestezi'],
        'points'=> [
            'Kalsifik (kireçli) plakların parçalanması',
            'Ardından balon / stent ile akışın açılması',
            'Diyabetik damar hastalığı hastalarında etkin',
            'Kısa süreli — genelde 45-60 dk',
        ],
    ],
    [
        'slug'  => 'lenfodem-lipodem',
        'icon'  => 'fa-hand-holding-droplet',
        'title' => 'Lenfödem & Lipödem',
        'short' => 'Bacak şişliği, ağırlık hissi ve orantısız yağ birikiminde kombine tedavi.',
        'lead'  => 'Lenf drenajı + kompresyon + cerrahi (gerektiğinde) ile lenfödem ve lipödem yönetimi. Yaşam kalitesi odaklı uzun vadeli takip.',
        'badges'=> ['Konservatif', 'Multidisipliner', 'Yaşam boyu takip'],
        'points'=> [
            'Manuel lenfatik drenaj (MLD)',
            'Kompresyon bandajı ve özel çorap eşleştirme',
            'İleri vakada cerrahi (LVA, lipo) yönlendirmesi',
            'Diyet + egzersiz planı entegrasyonu',
        ],
    ],
    [
        'slug'  => 'diyabetik-yara',
        'icon'  => 'fa-band-aid',
        'title' => 'Diyabetik Yara & Ayak',
        'short' => 'Diyabetik ayak yaralarında dolaşım değerlendirmesi + uzman yara bakımı.',
        'lead'  => 'Diyabete bağlı kronik yaralar ve amputasyon riski olan vakalarda damar açıklığını yeniden sağlama, yara bakımı ve sistemik takip.',
        'badges'=> ['Erken müdahale', 'Damar + yara birlikte', 'Amputasyon önleme'],
        'points'=> [
            'Periferik damar değerlendirmesi (Doppler, anjiyo)',
            'Endovasküler / bypass ile dolaşımın sağlanması',
            'Yara debridmanı ve modern pansumanlar',
            'Diyabet ekibi ile koordineli plan',
        ],
    ],
    [
        'slug'  => 'dvt-tromboz',
        'icon'  => 'fa-heart-circle-bolt',
        'title' => 'DVT / Tromboz & Emboli',
        'short' => 'Derin ven trombozu ve pulmoner emboli tanı + tedavi yönetimi.',
        'lead'  => 'Aniden gelişen bacak şişliği, ağrı ve nefes darlığında derin ven trombozu (DVT) ve emboli tanısı, antikoagulan tedavi ve gerektiğinde girişimsel uygulamalar.',
        'badges'=> ['Acil değerlendirme', '24/7 hat', 'Uzun dönem takip'],
        'points'=> [
            'Doppler USG ile hızlı tanı',
            'Antikoagulan tedavi (heparin, oral)',
            'Kateter ile trombüs aspirasyonu (seçili vakada)',
            'Tromboz sonrası sendrom (PTS) takibi',
        ],
    ],
    [
        'slug'  => 'pelvik-konjesyon',
        'icon'  => 'fa-venus',
        'title' => 'Pelvik Konjesyon Sendromu',
        'short' => 'Kadınlarda kronik pelvik ağrının damar kaynaklı sebebi — embolizasyon ile çözüm.',
        'lead'  => 'Genişlemiş pelvik venlere bağlı kronik kasık/kalça/bel ağrısı, ayakta uzun durmakla artan rahatsızlık ve atipik varis vakalarında endovasküler embolizasyon.',
        'badges'=> ['Kadın sağlığı', 'Minimal invaziv', 'Kalıcı sonuç'],
        'points'=> [
            'Anjiyografik tanı ve haritalama',
            'Coil / sıvı ajan ile embolizasyon',
            'Ofis prosedürü — kısa nekahat',
            'Jinekoloji + üroloji ile multidisipliner değerlendirme',
        ],
    ],
    [
        'slug'  => 'kalp-damar-cerrahisi',
        'icon'  => 'fa-heart-pulse',
        'title' => 'Kalp & Damar Cerrahisi',
        'short' => 'Koroner bypass, kalp kapak, aort ve karotis cerrahisinde modern protokoller.',
        'lead'  => 'Açık kalp ameliyatlarında uzun yıllık deneyim. Mümkün olan her vakada minimal invaziv veya atan-kalp tekniği ile hızlı iyileşme.',
        'badges'=> ['20+ yıl deneyim', 'Atan-kalp tekniği', 'Hızlı iyileşme'],
        'points'=> [
            'Koroner bypass (CABG) — off-pump dahil',
            'Mitral / aort kapak tamir ve protez',
            'Aort anevrizması (torakal + abdominal)',
            'Karotis (şah damarı) endarterektomi',
        ],
    ],
    [
        'slug'  => 'konsultasyon',
        'icon'  => 'fa-user-doctor',
        'title' => 'Konsültasyon & İkinci Görüş',
        'short' => 'Mevcut tetkiklerin değerlendirmesi, tedavi seçeneklerinin karşılaştırılması.',
        'lead'  => 'Eldeki anjiyografi, EKO, BT ve Doppler raporlarının detaylı incelemesi; cerrahi-endovasküler seçimde şeffaf yönlendirme.',
        'badges'=> ['Tetkik değerlendirme', 'Risk analizi', 'Açık iletişim'],
        'points'=> [
            'Anjiyo / EKO / BT / Doppler raporları',
            'Cerrahi vs endovasküler kararlar',
            'Risk profili ve alternatif planlar',
            'Hasta ve yakınlarına net bilgilendirme',
        ],
    ],
];
