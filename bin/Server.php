<?php
/**
 *
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * @2019-08-09 17:47:00
 */
require_once __DIR__ . '/../bin/Dotenv.php';
try {
    Dotenv::load(__DIR__ . "/../");
    $dbname = getenv("mysql_database");

    $dbhost = getenv("mysql_host");
    $dbport = getenv("mysql_port");
    $dbuser = getenv("mysql_user");
    $dbpass = getenv("mysql_password");
    $dsn = 'mysql:dbname=' . $dbname . ';host=' . $dbhost . ';port=' . $dbport;
} catch (Exception $e) {
    exit;
}


// Autoloading (composer is preferred, but for this example let's just do this)
require_once(__DIR__ . '/../bin/OAuth2/Autoloader.php');
OAuth2\Autoloader::register();

// $dsn is the Data Source Name for your database, for exmaple "mysql:dbname=my_oauth2_db;host=localhost"
$storage = new OAuth2\Storage\Pdo(array('dsn' => $dsn, 'username' => $dbuser, 'password' => $dbpass));

// Pass a storage object or array of storage objects to the OAuth2 server class
$server = new OAuth2\Server($storage);
$server->setConfig("require_exact_redirect_uri", false);
$server->setConfig("id_lifetime", 17600000);
$server->setConfig("access_lifetime", 17600000);
$server->setConfig("token_param_name", 'payload');

// Add the "Client Credentials" grant type (it is the simplest of the grant types)
$server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));

// Add the "Authorization Code" grant type (this is where the oauth magic happens)
$server->addGrantType(new OAuth2\GrantType\AuthorizationCode($storage));
