<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function get($url)
    {
        $client = new GuzzleHttp\Client();
        $response = $client->get($url);
        return $response;
    }


    public function post($url,$body) {
        $client = new GuzzleHttp\Client();
        $response = $client->post($url, ['form_params' => $body]);
        return $response;
    }
}
