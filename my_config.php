<?php
$local = true;
if ($local) {
    define('DB_HOST', 'localhost');
    define('DB_DATABASE', 'e-jewel');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('BASE_URL', 'http://localhost/ejewel/');
    define('SMTP_MAIL', true);
} else {
    define('DB_HOST', 'localhost');
    define('DB_DATABASE', 'shrincro_ejewel');
    define('DB_USER', 'shrincro_hotelbs');
    define('DB_PASS', 'shrincro_hotelbs');
    define('BASE_URL', 'http://www.shrinathjibombaywala.in/dev/ejewel/');
    define('SMTP_MAIL', false);
}
