<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );die ("<h2>Access Denied!</h2> This file is protected and not available to public.");}
if (!defined('APP_NAME'))                       define('APP_NAME', 'RanROM Project');
if (!defined('APP_ORGANIZATION'))               define('APP_ORGANIZATION', 'KLiK');
if (!defined('APP_OWNER'))                      define('APP_OWNER', 'msaad1999');
if (!defined('APP_DESCRIPTION'))                define('APP_DESCRIPTION', 'Embeddable PHP Login System');

if (!defined('ALLOWED_INACTIVITY_TIME'))        define('ALLOWED_INACTIVITY_TIME', time()+ 10*60);

if (!defined('DB1_DATABASE'))                   define('DB1_DATABASE', 'klik_loginsystem');
if (!defined('DB_HOST'))                        define('DB_HOST','127.0.0.1:3306');
if (!defined('DB_USERNAME'))                    define('DB_USERNAME','root');
if (!defined('DB_PASSWORD'))                    define('DB_PASSWORD' ,'RaspberryClientAsServerDevice0273@MySQLForRaspberryServer2.2');
if (!defined('DB_PORT'))                        define('DB_PORT' ,'3306');


if (!defined('MAIL_HOST'))                      define('MAIL_HOST', 'smtp.gmail.com');
if (!defined('MAIL_USERNAME'))                  define('MAIL_USERNAME', 'unfatalbot@gmail.com');
if (!defined('MAIL_FROM'))			define('MAIL_FROM', 'no-reply@ranrom.xyz');
if (!defined('MAIL_PASSWORD'))                  define('MAIL_PASSWORD', 'xwqkxxwolefwlqdu');
// --- DKIM ---
if (!defined('MAIL_DKIM_DOMAIN'))		define('MAIL_DKIM_DOMAIN', 'ranrom.xyz');
if (!defined('MAIL_DKIM_FILE'))			define('MAIL_DKIM_FILE', '');
if (!defined('MAIL_DKIM_SELECTOR'))		define('MAIL_DKIM_SELECTOR', '');
if (!defined('MAIL_DKIM_PASS'))			define('MAIL_DKIM_PASS','');
// --- END ---
if (!defined('MAIL_ENCRYPTION'))                define('MAIL_ENCRYPTION', 'tls');
if (!defined('MAIL_PORT'))                      define('MAIL_PORT', 587);
