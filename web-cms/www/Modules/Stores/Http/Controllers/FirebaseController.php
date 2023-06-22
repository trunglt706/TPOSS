<?php

namespace Modules\Stores\Http\Controllers;

use Illuminate\Routing\Controller;

class FirebaseController extends Controller
{
    protected $API_URL;
    protected $API_SERVER_KEY;
    protected $API_DATA;

    function __construct()
    {
        $this->API_URL = get_option('admin-url-firebase');
        $this->API_SERVER_KEY = get_option('admin-key-firebase');
        $this->API_DATA = [
            "apns" => [
                'headers' => [
                    'apns-priority' => '10',
                ],
                "payload" => [
                    "aps" => [
                        "badge" => 1,
                        "sound" => "default",
                    ]
                ]
            ],
            'android' => [
                'ttl' => '3600s',
                'priority' => 'normal',
                'notification' => [
                    "sound" => "default",
                ],
            ],
        ];
    }

    public static function send_notify($client_tokens = [], $notification = [], $data = [])
    {
        $cfm = new FireBaseController();
        $_data = $cfm->API_DATA;
        $_data['registration_ids'] = $client_tokens;
        $notification['sound'] = 'default';
        $_data['notification'] = $notification;
        $data['domain'] = env('APP_URL');
        $_data['data'] = $data;

        $headers = [
            'Authorization:key=' . $cfm->API_SERVER_KEY,
            'Content-Type: application/json',
        ];
        $result = $cfm->makeRequest($cfm->API_URL, $_data, 'POST', $headers);
        $response = json_decode($result, 1);
        // check and delete token failed
        if (isset($response['failure']) && $response['failure'] > 0) {
            foreach ($response['results'] as $key => $value) {
                if (isset($value['error'])) {
                    // delete token
                    // StoreToken::ofToken($client_tokens[$key])->delete();
                }
            }
        }
        return $response;
    }

    public function makeRequest($url, $params, $method = 'POST', $header = ['Content-Type: application/json'])
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60); // Time out 60s
        curl_setopt($ch, CURLOPT_TIMEOUT, 60); // connect time out 60s
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($ch);
        // close curl
        curl_close($ch);

        return $result;
    }
}
