<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ClientAuthenticator
{
    public static function getToken() {
        global $automedsys;

        $devApiBaseUrl = $automedsys->cfgReadChar("auxpro.dev_api_base_url");
        $username = $automedsys->cfgReadChar("client_credentials.username");
        $password = $automedsys->cfgReadChar("client_credentials.password");

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "{$devApiBaseUrl}/emrapi/v1/identity/connect/otoken");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Media-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['grant_type' => 'client_credentials']));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result, true);

        return $result['Data']['Token'];
    }
}
