<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['base_url']	= SecretConst::getBaseUrl();
$config['index_page'] = '';
$config['uri_protocol']	= 'REQUEST_URI';

$config['url_suffix'] = '';
$config['language']	= 'english';
$config['charset'] = 'UTF-8';
$config['enable_hooks'] = TRUE;

$config['subclass_prefix'] = 'MY_';
// $config['composer_autoload'] = './vendor/autoload.php';
$config['composer_autoload'] = '';
$config['permitted_uri_chars'] = '+=\a-z 0-9~%.:_-';

$config['allow_get_array']		= TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger']	= 'c';
$config['function_trigger']		= 'm';
$config['directory_trigger']	= 'd'; 
$config['log_threshold'] = 0;
$config['log_path'] = '';
$config['log_date_format'] = 'Y-m-d H:i:s';
$config['cache_path'] = '';

$config['encryption_key'] = '4fyweSKndu';
$config['sess_driver'] = SecretConst::SESS_DRIVER;
$config['sess_cookie_name'] = SecretConst::SESS_COOKIE_NAME;
$config['sess_expiration'] = SecretConst::SESS_EXPIRATION;
$config['sess_save_path'] = SecretConst::getSessionDir();
$config['sess_match_ip'] = SecretConst::SESS_MATCH_IP;
$config['sess_time_to_update'] = SecretConst::SESS_TIME_TO_UPDATE;
$config['sess_regenerate_destroy'] = SecretConst::SESS_REGENERATE_DESTROY;
$config['sess_table_name'] = SecretConst::SESS_TABLE_NAME;
$config['cookie_prefix']	= "";
$config['cookie_domain']	= "";
$config['cookie_path']		= "/";
$config['cookie_secure']	= FALSE;
$config['global_xss_filtering'] = FALSE;
$config['csrf_protection'] = SecretConst::CSRF_PROTECTION;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;
$config['csrf_exclude_uris'] = [
    'api/ckeditor_upload'
];

$config['compress_output'] = FALSE;
$config['time_reference'] = 'local';

$config['rewrite_short_tags'] = FALSE;

$config['proxy_ips'] = '';

