<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Curl;

class WebServiceController extends Controller
{
    /**
     * Search cep in external API
     *
     * @param Request $request
     * @return json
     */
    public function cep(Request $request)
    {
        $cep = str_replace('-', '', $request->cep);
        $response = Curl::to("viacep.com.br/ws/$cep/json")->get();
        $response = json_decode($response);
    
        $data = (object) [
            'city' => $response->localidade ?? '',
            'zipcode' => $response->cep ?? '',
            'uf' => $response->uf ?? ''
        ];
        
        return json_encode($data);
    }
}
