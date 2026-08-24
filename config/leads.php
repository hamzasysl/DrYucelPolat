<?php

/**
 * Lead form gönderim yönlendirme.
 * Her form kaydı `To` adresine + burada tanımlı CC/BCC listelerine gider.
 * To adresi: config/mail.php (MAIL_FROM_ADDRESS / MAIL_USERNAME)
 */

return [
    'mail_cc' => array_filter(explode(',', env('LEADS_MAIL_CC', ''))),
    'mail_bcc' => array_filter(explode(',', env('LEADS_MAIL_BCC', 'mail@mezbilisim.com'))),
];
