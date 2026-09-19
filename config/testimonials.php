<?php

/**
 * Hasta yorumları — anasayfadaki "İyileşme hikâyeleri" slider'ını besler.
 *
 * Alanlar:
 *   name   — yorumu yazan kişi. Boş bırakılırsa "Hastamız" görünür.
 *   label  — kısa etiket (tedavi adı / ilişki). Kartın üstünde rozet olarak çıkar.
 *   text   — yorum metni (paragraf paragraf, dizi olarak).
 *   result — opsiyonel sonuç rozeti (örn. kilo değişimi). Yoksa gösterilmez.
 *   lang   — yorum Türkçe değilse ['code' => 'bg', 'name' => 'Bulgarca'] gibi verilir.
 *   translation — ['code', 'name', 'text'] — kartta "çeviriyi göster" ile açılır.
 *   photos — public/img/testimonials/ içindeki dosya adları. Birden fazla dosya
 *            verilirse kartın içindeki fotoğraf alanı kaydırmalı galeriye döner.
 *            Dosya yoksa kart otomatik olarak fotoğrafsız görünüme düşer.
 */

return [
    [
        'name'  => null,
        'label' => 'Varis ameliyatı',
        'photos' => ['yorum-1.webp'],
        // Yorum hastanın kendi dilinde (Bulgarca) yazılmıştır; Türkçesi çeviri olarak açılır.
        'lang'  => ['code' => 'bg', 'name' => 'Bulgarca'],
        'text'  => [
            'Уважаеми д-р Полат, искам от сърце да Ви благодаря за професионализма, вниманието и грижите, които положихте за мен. Благодарение на Вашите умения и отношение операцията на разширените ми вени мина успешно и днес се чувствам много по-добре.',
            'Благодаря Ви, че сте не само отличен лекар, но и човек, който вдъхва спокойствие и доверие на своите пациенти. Бъдете здрав и продължавайте да помагате на хората със същата отдаденост!',
        ],
        'translation' => [
            'code' => 'tr',
            'name' => 'Türkçe',
            'text' => [
                'Sayın Doktor Polat, gösterdiğiniz profesyonellik, ilgi ve özen için size yürekten teşekkür etmek istiyorum. Becerileriniz ve yaklaşımınız sayesinde varis ameliyatım başarılı geçti ve bugün kendimi çok daha iyi hissediyorum.',
                'Sadece mükemmel bir doktor olmakla kalmayıp, hastalarına huzur ve güven aşılayan bir insan olduğunuz için de teşekkür ederim. Sağlıklı kalın ve aynı özveriyle insanlara yardım etmeye devam edin!',
            ],
        ],
    ],
    [
        'name'  => null,
        'label' => 'Pelvik konjesyon',
        'photos' => ['yorum-2a.webp', 'yorum-2b.webp', 'yorum-2c.webp'],
        'text'  => [
            'Merhabalar, 2 yıl önce sevgili doktorumuz Yücel Polat ile bir rahatsızlık nedeniyle tanıştım. Doktorum ameliyat olmam gerektiğini, dilersem başka meslektaşlarıyla da görüşebileceğimi söyledi. Görüştüm ama bana son derece güven veren Dr. Yücel Polat\'tı ve kendisinde ameliyat olmaya karar verdim.',
            'Ameliyatım harika geçti, çok memnunum. Kendisine binlerce teşekkür ederim, herkese tavsiye ederim. 🙏🏻❤️',
        ],
    ],
    [
        'name'  => 'Züleyha Akay',
        'label' => 'Lipödem tedavisi',
        'photos' => ['yorum-3.webp'],
        'result' => '79 kg → 63 kg · 9 ayda 16 kg',
        'text'  => [
            'Merhaba, ben Züleyha Akay. Nisan 2025 tarihinde bacaklarda şişkinlik, ağrı ve morarma belirtileri ile değerli hocam Yücel Polat\'a tedavi için ilk ziyaretimi gerçekleştirdim. Yapılan tetkikler ve radyoloji bölümünden alınan sonuçlara göre lipödem teşhisi konuldu ve Yücel hocamla yolculuğumuz başladı.',
            'Venöz yetmezlik için dolaşım düzenleyici ilaçlar, dolaşımı hızlandırmak için tavsiye etmiş olduğu çorap ve korselerle tedavi sürecimize başladık. Tedavilerin yanı sıra sağlıklı beslenme programı, gerekli egzersizler ve yürüyüşlerle bir ayda 8 kilo vererek benim için bir mucizeyi gerçekleştirdik.',
            'Bacaklarımda fark edilir şekilde incelme yaşandı; 45 yaşındayım ve yaklaşık 15 yıldan beri diyetle incelmeye çalışan bir bireyim. Yücel hocam sayesinde ilk kez iki beden küçüldüm. Sıra artık bacaklarımdaki portakal kabuğu görünümünde, onu da yine hocamla birlikte tedaviye devam ederek düzelteceğiz.',
            'Yücel hocama doğru teşhis ve doğru tedavi yöntemleri için çok teşekkür ederim.',
        ],
    ],
    [
        'name'  => 'Hasta yakını — İngiltere',
        'label' => 'Varis / kronik venöz ülser',
        'photos' => ['yorum-4.webp'],
        'text'  => [
            'İngiltere\'den araştırıp bulduğum, annemin tedavisini güvenle emanet ettiğim kıymetli Yücel Hocamıza ilgi, emeği ve başarılı tedavisi için gönülden çok teşekkür ederim. İyi ki yollarımız kesişmiş. Ellerinize, emeğinize sağlık hocam.',
        ],
    ],
];
