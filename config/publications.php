<?php

/**
 * Op. Dr. Yücel Polat — Akademik yayınlar.
 *
 * Sıralama kuralı (hocanın isteği): yazar listesinde "Y Polat" ne kadar başta ise
 * yayın da listede o kadar yukarıda. Önce 1. isim olduğu yayınlar, sonra ortak
 * yazar olduğu yayınlar; eşit sırada olanlar yeni tarihten eskiye doğru dizilir.
 * Bu sıralama View'da otomatik yapılır — buraya eklerken sırayı düşünmeye gerek yok.
 *
 * Alanlar:
 *   title    — yayının tam başlığı (orijinal dilinde)
 *   authors  — yazarlar, yayındaki sırayla. "Y Polat" olduğu gibi yazılmalı (vurgu bundan bulunur)
 *   et_al    — yazar listesi kısaltıldıysa true ("ve ark." eklenir)
 *   journal  — dergi / kongre adı
 *   detail   — cilt, sayı, sayfa bilgisi
 *   year     — yayın yılı
 *   type     — 'article' (makale) | 'abstract' (kongre bildirisi)
 *   doi      — varsa DOI (Crossref'ten doğrulandı); yoksa null → link gösterilmez
 */

return [
    [
        'title'   => 'Effects of sevoflurane and fullerenol C60 on lower limb ischemia–reperfusion injury in streptozocin-induced diabetic mice',
        'authors' => ['Y Polat', 'N Şengel', 'A Küçük', 'Ç Özdemir', 'Z Yığman', 'AB Balcı', 'Aİ Ergörün'],
        'et_al'   => true,
        'journal' => 'Science Progress',
        'detail'  => '107(2), 00368504241239444',
        'year'    => 2024,
        'type'    => 'article',
        'doi'     => '10.1177/00368504241239444',
    ],
    [
        'title'   => 'Effects of Picroside II on Myocardial Ischemia-Reperfusion Injury in Streptozotocin-Induced Diabetic Rats',
        'authors' => ['Y Polat', 'A Dursun', 'A Küçük', 'A Özer', 'D Erer', 'M Arslan'],
        'et_al'   => false,
        'journal' => 'Gazi Medical Journal',
        'detail'  => '28(1)',
        'year'    => 2017,
        'type'    => 'article',
        'doi'     => '10.12996/gmj.2017.07',
    ],
    [
        'title'   => 'Effect of Irisin on Erythrocyte Deformability in Mice with Lower Limb Ischemia Reperfusion Injury',
        'authors' => ['Y Polat', 'F Comu', 'A Küçük', 'H Kartal', 'A Dursun', 'M Arslan'],
        'et_al'   => false,
        'journal' => 'Acta Physiologica',
        'detail'  => 'Cilt 221',
        'year'    => 2017,
        'type'    => 'abstract',
        'doi'     => null,
    ],
    [
        'title'   => 'The Effect of Picroside II on Ischemia Reperfusion Injury in Myocard Streptozotosin Induced Diabetic Rats',
        'authors' => ['Y Polat', 'D Erer', 'A Küçük', 'A Özer', 'M Arslan', 'A Dursun'],
        'et_al'   => false,
        'journal' => 'Transplant International',
        'detail'  => 'Cilt 29',
        'year'    => 2016,
        'type'    => 'abstract',
        'doi'     => null,
    ],
    [
        'title'   => 'Irisin Protects Against Hind Limb Ischemia Reperfusion Injury',
        'authors' => ['A Küçük', 'Y Polat', 'A Kılıçarslan', 'N Süngü', 'H Kartal', 'AD Dursun', 'M Arslan'],
        'et_al'   => false,
        'journal' => 'Drug Design, Development and Therapy',
        'detail'  => '361-368',
        'year'    => 2021,
        'type'    => 'article',
        'doi'     => '10.2147/DDDT.S279318',
    ],
    [
        'title'   => 'Effect of cerium oxide on erythrocyte deformability in rat lower extremity ischemia reperfusion injury',
        'authors' => ['T Tatar', 'Y Polat', 'FM Comu', 'H Kartal', 'M Arslan', 'A Küçük'],
        'et_al'   => false,
        'journal' => 'Bratislava Medical Journal',
        'detail'  => '119(7), 441-443',
        'year'    => 2018,
        'type'    => 'article',
        'doi'     => '10.4149/BLL_2018_080',
    ],
    [
        'title'   => 'The Effect of Sevoflurane and Fullerenol C60 on the Liver and Kidney in Lower Extremity Ischemia-Reperfusion Injury in Mice with Streptozocin-Induced Diabetes',
        'authors' => ['N Şengel', 'A Küçük', 'Ç Özdemir', 'Y Polat', 'ŞC Sezen', 'G Kip', 'F Er', 'AD Dursun'],
        'et_al'   => true,
        'journal' => 'International Journal of Nanomedicine',
        'detail'  => '7543-7557',
        'year'    => 2023,
        'type'    => 'article',
        'doi'     => '10.2147/IJN.S432924',
    ],
    [
        'title'   => 'The effect of fullerenol C60 on skeletal muscle after lower limb ischemia reperfusion injury in streptozotocin-induced diabetic rats',
        'authors' => ['H Kartal', 'A Küçük', 'A Kılıçarslan', 'Y Polat', 'N Süngü', 'G Kip', 'M Arslan'],
        'et_al'   => false,
        'journal' => 'Journal of Surgery and Medicine',
        'detail'  => '4(6), 451-455',
        'year'    => 2020,
        'type'    => 'article',
        'doi'     => '10.28982/josam.756665',
    ],
    [
        'title'   => 'Effect of apelin-13 on erythrocyte deformability during ischaemia–reperfusion injury of heart in diabetic rats',
        'authors' => ['H Kartal', 'FM Comu', 'A Küçük', 'Y Polat', 'AD Dursun', 'M Arslan'],
        'et_al'   => false,
        'journal' => 'Bratislava Medical Journal',
        'detail'  => '118(3), 133-136',
        'year'    => 2017,
        'type'    => 'article',
        'doi'     => '10.4149/BLL_2017_026',
    ],
    [
        'title'   => 'Effects of Sevoflurane and Fullerenol C60 on the Heart and Lung in Lower-Extremity Ischemia–Reperfusion Injury in Streptozotocin-Induced Diabetes Mice',
        'authors' => ['E Örnek', 'M Alkan', 'S Erel', 'Z Yığman', 'AD Dursun', 'A Dağlı', 'B Sarıkaya', 'Y Polat'],
        'et_al'   => true,
        'journal' => 'Medicina',
        'detail'  => '60(8), 1232',
        'year'    => 2024,
        'type'    => 'article',
        'doi'     => '10.3390/medicina60081232',
    ],
];
