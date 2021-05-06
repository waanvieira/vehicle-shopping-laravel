<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStore;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {   
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }


    function addNewElement ($array, $position){
        return array_push($array,  $position);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStore $request)
    {
        try {
            
            $response = $this->service->store($request);
            
            if (!$response) {
                return response()
                    ->json([
                      'result'  => true,
                      'message' => 'Erro para cadastrar usuário',
                      400
                    ]);
            }

            return response()
                        ->json([
                            'access_token'  => $response->createToken('auth-api')->accessToken,
                            200
                        ]);
  
        } catch (Exception $e) {
            logger()->error('Log', [
              'erro' => $e,
              'exception' => $e->getMessage()
            ]);
                
          return response()
                        ->json([
                          'result' => false,
                          'message'  => $e->getMessage(),
                          500
                        ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
