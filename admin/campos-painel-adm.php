<?php

function rdcrmplugin_register_settings() {
    register_setting( 'rdcrmplugin_plugin_options', 'rdcrmplugin_plugin_options' );
    add_settings_section( 'api_settings', 'Configurações do plugin', 'rdcrmplugin_plugin_section_text', 'rdcrmplugin_sections' );

    add_settings_field( 'rdcrmplugin_plugin_setting_token', 'Token da instancia<em>*</em><br><small>[token]</small>', 'rdcrmplugin_plugin_setting_token', 'rdcrmplugin_sections', 'api_settings' );

}
add_action( 'admin_init', 'rdcrmplugin_register_settings' );

function rdcrmplugin_plugin_section_text() {
  // Texto ou HTML
}

function rdcrmplugin_plugin_setting_token() {
    $options = get_option( 'rdcrmplugin_plugin_options' )['token'] ?:"";
    echo "<label><input name='rdcrmplugin_plugin_options[token]' type='text' value='".esc_attr( $options )."' /></label>";
    echo "<p> <a href='https://plugcrm.net/app#/settings/profile' target='_blank'>Acesse sua conta para obter o token no site da RD CRM</a> </p>";
    echo "<hr>";
}
