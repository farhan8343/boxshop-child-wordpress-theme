<?php
// Template Name: Test Database Query
echo 'fafafa<pre>'; print_r($query); echo '</pre>';
global $wpdb;
$table_name = $wpdb->prefix . 'options'; 
$query = $wpdb->query($wpdb->prepare('Delete from '.$table_name.' where option_name in ("epkb_version","epkb_show_upgrade_message","epkb_config_1","asea_version","asea_show_upgrade_message")'));
echo 'fafafa<pre>'; print_r($query); echo '</pre>';