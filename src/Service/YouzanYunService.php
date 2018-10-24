<?php

namespace Service;

use Exception;
use Youzan\Open\Token;

class YouzanYunService
{
    protected $config = [];

    public function __construct()
    {
        $this->config = [
            'type' => 'self',
            'kdtId' => '0000',
            'clientId' => '204ee183bb55c5a37f',
            'clientSecret' => '6eec60761ace5557f295ef0c0509c1fb',
            'api' => [
                'version' => '3.0.0',
                'getTrade' => 'youzan.trade.get',
                'createPayQRCode' => 'youzan.pay.qrcode.create',
            ],
        ];
    }

    protected function getAccessToken()
    {
        $clientId = $this->config['clientId'];
        $clientSecret = $this->config['clientSecret'];
        $type = $this->config['type'];
        $keys = [
            'kdt_id' => $this->config['kdtId']
        ];

        $accessToken = (new Token($clientId, $clientSecret))->getToken($type, $keys);
        if (!isset($accessToken['access_token'])) throw new Exception('wrong server pay config');
        return $accessToken['access_token'];
    }
}
