<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );die ("<h2>Access Denied!</h2> This file is protected and not available to public.");}
if (!defined('APP_NAME'))                       define('APP_NAME', 'RanROM Project');
if (!defined('APP_ORGANIZATION'))               define('APP_ORGANIZATION', 'KLiK');
if (!defined('APP_OWNER'))                      define('APP_OWNER', 'msaad1999');
if (!defined('APP_DESCRIPTION'))                define('APP_DESCRIPTION', 'Embeddable PHP Login System');

if (!defined('ALLOWED_INACTIVITY_TIME'))        define('ALLOWED_INACTIVITY_TIME', time()+10*60);

if (!defined('DB1_DATABASE'))                   define('DB1_DATABASE', 'klik_loginsystem');
if (!defined('DB2_DATABASE'))                   define('DB2_DATABASE', '');
if (!defined('DB_HOST'))                        define('DB_HOST','');
if (!defined('DB_USERNAME'))                    define('DB_USERNAME','');
if (!defined('DB_PASSWORD'))                    define('DB_PASSWORD' ,'');
if (!defined('DB_PORT'))                        define('DB_PORT' ,'');


if (!defined('MAIL_HOST'))                      define('MAIL_HOST', '');
if (!defined('MAIL_USERNAME'))                  define('MAIL_USERNAME', '');
if (!defined('MAIL_PASSWORD'))                  define('MAIL_PASSWORD', '');
if (!defined('MAIL_ENCRYPTION'))                define('MAIL_ENCRYPTION', 'ssl');
if (!defined('MAIL_PORT'))                      define('MAIL_PORT', 25);
