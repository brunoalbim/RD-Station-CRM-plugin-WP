<?php
error_reporting(0); ini_set("display_errors", 0);

function rdcrmplugin_add_settings_page() {
    add_options_page( 'RD Station CRM Agência plugin', 'RD Station CRM Agência plugin', 'manage_options', 'rd-station-crm-plugin-wp', 'rdcrmplugin_render_plugin_settings_page' );
}
add_action( 'admin_menu', 'rdcrmplugin_add_settings_page' );


function rdcrmplugin_render_plugin_settings_page() {
  require_once("configuracao.php");
}

function rdcrmplugin_retornarInformacoesPlugin($value) {
  if ( ! function_exists( 'get_plugins' ) ) {
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
  }
  return get_plugins()['rd-station-crm-plugin-wp/rd-station-crm-plugin-wp.php'][$value];
}

function rdcrmplugin_dir_plugin() {
  return plugin_dir_url( __FILE__ );
}

function rdcrmplugin_shortcode_echo($attrs) {
  return get_option( 'rdcrmplugin_plugin_options' )[$attrs['campo']];
}
add_shortcode("rdcrmplugin_shortcode_echo", "rdcrmplugin_shortcode_echo");


function rdcrmplugin_rest_routes_init() {
  $rdStationCrmplugin = new \Controllers\RdStationCrmplugin();

  register_rest_route('/rdcrmplugin/v1', '/' . 'init', array(
      array(
          'methods' => 'POST',
          'callback' => array($rdStationCrmplugin, "init"),
      ),
  ));
}
add_action('rest_api_init', 'rdcrmplugin_rest_routes_init');
