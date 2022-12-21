<?php
/*
  Plugin Name: RD Station CRM Agência Onzii
  Plugin URI: #
	description: Plugin de integração com a plataforam RD STATION CRM.
  Version: 1.0.0
  Author: Onzii
  Author URI: #
  ---------------------------------------------------------------------------
*/


// OBTER DADOS DO PLUGIN
require_once(ABSPATH.'wp-admin/includes/plugin.php');
$hotwpbr_plugin_data = get_plugin_data( __FILE__ );


// FUNÇÕES GERAIS E SHORTCODE
require_once("admin/campos-painel-adm.php");
require_once("admin/funcoes.php");
require_once("admin/Controllers/RdStationCrmplugin.php");
