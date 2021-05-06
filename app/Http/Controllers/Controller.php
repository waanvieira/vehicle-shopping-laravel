<?php

namespace App\Http\Controllers;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Return default json for success
     *
     * @param string $msg
     * @param integer $time
     * @return void
     */
    public function success($msg ='Registro cadastrado com sucesso', $time = 1200)
    {
        return response()->json(['status' => 200, 'success' => $msg, 'time' => $time]);
    }

    /**
     * Return default json for error
     *
     * @param string $msg
     * @param integer $time
     * @return void
     */
    public function error($msg ='Erro para cadastrar' , $time = 1200)
    {
        return response()->json(['status' => 400, 'error' => $msg, 'time' => $time]);
    }

        /**
     * Return default json for error
     *
     * @param string $msg
     * @param integer $time
     * @return void
     */
    public function internalError($msg ='Erro interno, tente mais tarde' , $time = 1200)
    {
        return response()->json(['status' => 500, 'error' => $msg, 'time' => $time]);
    }
    
}
