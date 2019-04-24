<?php

namespace Jplarar\ZeroBounceBundle\Services;

/**
 * Class ZeroBounceClient
 * @package Jplarar\ZeroBounceBundle\Services
 */
class ZeroBounceClient
{
    protected $apiKey;

    const SERVER_URL = "https://api.zerobounce.net";
    const VALIDATE_PATH = "/v2/validate";

    const STATUS_VALID = "valid";
    const STATUS_CATCH_ALL = "catch-all";

    /**
     * ZeroBounceClient constructor.
     * @param string $zero_bounce_api_key
     */
    public function __construct($zero_bounce_api_key = "")
    {
        $this->apiKey = $zero_bounce_api_key;
    }

    /**
     * @param $email
     * @param $ip
     * @return bool
     */
    public function validateEmail($email, $ip)
    {
        $url = self::SERVER_URL . self::VALIDATE_PATH;
        $queryString = '?api_key=' . $this->apiKey.'&email=' . urlencode($email) . '&ip_address=' . urlencode($ip);
        $ch = curl_init($url.$queryString);
        curl_setopt($ch, CURLOPT_SSLVERSION, 6);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
        curl_setopt($ch, CURLOPT_TIMEOUT, 150);
        $response = curl_exec($ch);
        curl_close($ch);

        //decode the json response
        $response = json_decode($response, true);

        // Validate status
        if (!array_key_exists('status', $response)) return false;
        if ($response['status'] != self::STATUS_VALID && $response['status'] != self::STATUS_CATCH_ALL) return false;

        // TODO validate Sub Status
        // https://www.zerobounce.net/docs/#status-codes-v2

        return true;
    }

}