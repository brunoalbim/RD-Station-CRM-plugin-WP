<?php

namespace Controllers;

use WP_Error;
use WP_REST_Request;
class RdStationCrmplugin {

    public function __construct() {
        $this->options = get_option('rdcrmplugin_plugin_options');
        $this->url_api = "https://plugcrm.net/api/v1";
    }

    public function authorization_status_code() {
        $status = 401;

        if (is_user_logged_in()) {
            $status = 403;
        }

        return $status;
    }

    public function init($request) {
        if (!($request instanceof WP_REST_Request)) {
            return new WP_Error('rest_forbidden', esc_html__('Bad Request'), array('status' => 502));
        }

        $obj = [];
        $obj_get_params = $request->get_params();

        if ($obj_get_params) {

          $organizacao = json_decode($this->criar_organizacao($obj_get_params), true);

          if ($organizacao['errors']['name'][0] === "Valor já existente.") {
            foreach(json_decode($this->buscar_organizacao($obj_get_params['organizacao']), true)['organizations'] as $organizacao_pesquisada) {
              if($organizacao_pesquisada['name'] === $obj_get_params['organizacao']." (".$obj_get_params['your-name'].")") {
                $organizacao = [];
                $organizacao['_id'] = $organizacao_pesquisada['id'];
              }
            }
          }

          $this->criar_oportunidade($organizacao['_id'], $obj_get_params);

        } else {
          status_header(502);
        }


    }

    public function criar_organizacao($obj_get_params) {
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->url_api.'/organizations?token='.$this->options['token'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>
          json_encode([
            "token" => $this->options['token'],
            "organization" => [
                "name" => $obj_get_params['organizacao']." (".$obj_get_params['your-name'].")"
              ]
          ]),
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json'
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      return $response;
    }


    public function criar_oportunidade($id_organizacao, $obj_get_params) {
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->url_api.'/deals?token='.$this->options['token'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>
        json_encode([
          "token" => $this->options['token'],
          "deal" => [
            "name" => $obj_get_params['oportunidade']
          ],
          "organization" => [
            "_id" => $id_organizacao
          ],
          "contacts" => [
            [
              "name" => $obj_get_params['your-name'],
              "emails" => [
                [
                  "email" => $obj_get_params['your-email']
                ]
              ],
              "phones" => [
                [
                  "phone" => $obj_get_params['telefone'],
                  "type" => "cellphone"
                ]
              ]
            ]
          ]
        ]),
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json'
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      return $response;
    }

    public function buscar_organizacao($obj_get_params) {
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->url_api.'/organizations?token='.$this->options['token'].'&limit=200&q='.$obj_get_params['organizacao'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      return $response;
    }


}
