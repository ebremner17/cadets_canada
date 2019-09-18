<?php

/**
 * @file
 * Settings common to all sites.
 */

// Show all errors on most servers. On live, these are turned off in
// host_settings.php.
$conf['error_level'] = 2;

foreach (['db', 'host', 'network', 'cache', 'password'] as $file) {
  $file_path = DRUPAL_ROOT . '/config/' . $file . '_settings.php';
  if (file_exists($file_path)) {
    require_once $file_path;
  }
}
unset($file);
unset($file_path);

$update_free_access = FALSE;

$base_url = 'https://' . $UWhost . ($UWpref ? '/' . $UWpref : '');

// File system.
if (!isset($UW_file_path)) {
  $UW_file_path = $UWpref;
}
if ($UW_file_path === '') {
  $UW_file_path = 'uwaterloo.ca';
}
else {
  $UW_file_path = 'ca.' . str_replace('/', '.', $UW_file_path);
}
$conf['file_default_scheme'] = 'public';
$conf['file_private_path'] = '/wmsfiles/private/' . $UW_file_path;
$conf['file_public_path'] = 'sites/' . $UW_file_path . '/files';
$conf['file_temporary_path'] = '/wmsfiles/temp/' . $UW_file_path;
$conf['file_chmod_directory'] = 02775;
$conf['file_chmod_file'] = 0664;
unset($UW_file_path);

// Themes.
$conf['admin_theme'] = 'uw_adminimal_theme';
$conf['node_admin_theme'] = '1';
$conf['admin_language_default'] = 'en';

// Set date-related variables.
$conf['date_first_day'] = 0;
$conf['date_api_use_iso8601'] = FALSE;
$conf['date_api_version'] = 7.2;
$conf['date_default_timezone'] = 'America/Toronto';
$conf['user_default_timezone'] = 0;
$conf['date_format_long'] = 'l, F j, Y - H:i';
$conf['date_format_short'] = 'Y-m-d H:i';
$conf['date_format_event_full'] = 'l, F j, Y - g:ia';
$conf['date_format_event_short'] = 'M j Y - g:ia';
$conf['date_format_long_date_only'] = 'l, F j';
$conf['date_format_medium'] = 'D, Y-m-d H:i';
$conf['date_format_news_short'] = 'M j Y';
$conf['date_format_time_only'] = 'g:ia';

// Disable user picture support and set the default to a square
// thumbnail option in case it is enabled later.
$conf['user_pictures'] = '0';
$conf['user_picture_dimensions'] = '1024x1024';
$conf['user_picture_file_size'] = '800';
$conf['user_picture_style'] = 'thumbnail';

// Other.
$conf['shortcut_max_slots'] = 12;
// Same value as constant USER_REGISTER_ADMINISTRATORS_ONLY. Constant
// not yet defined.
$conf['user_register'] = 0;
$conf['scheduler_publisher_user'] = 'specific_user';
$conf['scheduler_date_popup_minute_increment'] = 15;
$conf['update_check_disabled'] = TRUE;
$conf['update_notify_emails'] = NULL;
$conf['cas_domain'] = 'uwaterloo.ca';
$conf['site_403'] = 'customerror/403';
$conf['site_404'] = 'customerror/404';
$conf['locale'] = 'CA';
$conf['site_mail'] = 'wcmsadmin@uwaterloo.ca';
$conf['syslog_facility'] = 160;
$conf['syslog_format'] = '!base_url|!timestamp|!type|!ip|!request_uri|!referer|!uid|!link|!message';
$conf['syslog_identity'] = 'drupal';
// @see _uw_auth_wcms_admins_user_is_admin().
$conf['uw_auth_wcms_admins_ldap_group_admin'] = 'CN=ist-WCMS Admins,OU=Info Systems & Technology,OU=Academic Support,OU=Security Groups,DC=NEXUS,DC=UWATERLOO,DC=CA';

// XPath query that defines which tables will be made responsive by the
// responsive_tables_filter module.
$conf['responsive_tables_filter_table_xpath'] = "//table[not(contains(concat(' ',normalize-space(@class),' '),' no-responsive '))]";

$databases = [];
// Primary database server.
$databases['default']['default'] = [
  'driver' => 'mysql',
  'database' => $UWdb,
  'username' => $UWuser,
  'password' => $UWpass,
  'host' => $UWpri,
  'port' => '',
  'prefix' => '',
];
// Secondary database server, if configured.
if (isset($UWsec)) {
  $databases['default']['slave'] = [
    'driver' => 'mysql',
    'database' => $UWdb,
    'username' => $UWuser,
    'password' => $UWpass,
    'host' => $UWsec,
    'port' => '',
    'prefix' => '',
  ];
}
