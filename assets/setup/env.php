<?php
if (!defined('APP_NAME'))                       define('APP_NAME', 'RanROM Project');
if (!defined('APP_ORGANIZATION'))               define('APP_ORGANIZATION', 'KLiK');
if (!defined('APP_OWNER'))                      define('APP_OWNER', 'msaad1999');
if (!defined('APP_DESCRIPTION'))                define('APP_DESCRIPTION', 'Embeddable PHP Login System');

if (!defined('ALLOWED_INACTIVITY_TIME'))        define('ALLOWED_INACTIVITY_TIME', time()+ 10*60);

if (!defined('DB1_DATABASE'))                   define('DB1_DATABASE', 'klik_loginsystem');
if (!defined('DB2_DATABASE'))                   define('DB2_DATABASE', 'sessions');
if (!defined('DB_HOST'))                        define('DB_HOST','');
if (!defined('DB_USERNAME'))                    define('DB_USERNAME','');
if (!defined('DB_PASSWORD'))                    define('DB_PASSWORD' ,'');
if (!defined('DB_PORT'))                        define('DB_PORT' ,'');


if (!defined('MAIL_HOST'))                      define('MAIL_HOST', '');
if (!defined('MAIL_USERNAME'))                  define('MAIL_USERNAME', '');
if (!defined('MAIL_FROM'))			define('MAIL_FROM', '');
if (!defined('MAIL_PASSWORD'))                  define('MAIL_PASSWORD', '');
// --- DKIM ---
if (!defined('MAIL_DKIM_DOMAIN'))		define('MAIL_DKIM_DOMAIN', 'ranrom.xyz');
if (!defined('MAIL_DKIM_FILE'))			define('MAIL_DKIM_FILE', '');
if (!defined('MAIL_DKIM_SELECTOR'))		define('MAIL_DKIM_SELECTOR', '');
if (!defined('MAIL_DKIM_PASS'))			define('MAIL_DKIM_PASS','');
// --- END ---
if (!defined('MAIL_ENCRYPTION'))                define('MAIL_ENCRYPTION', 'tls');
if (!defined('MAIL_PORT'))                      define('MAIL_PORT', 587);
