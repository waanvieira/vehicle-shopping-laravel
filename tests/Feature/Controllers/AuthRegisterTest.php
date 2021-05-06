<?php

namespace Tests\Feature\Controllers;

use App\Http\Controllers\API\Auth\AuthController;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthRegisterTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Service
     *
     * @return AuthController
     */
    public function service()
    {
        return app(AuthController::class);
    }

    /**
     * A basic feature test example.
     *
     * @group user
     * @return void
     */
    public function testAuthControllerStore()
    {
        $request = request();
        $request['name'] = 'user dev';
        $request['email'] = 'userdev@dev.com';
        $request['password'] = '123456';
        $response = $this->service()->store($request);
        dd($response);
        $response->assertStatus(200);
    }
}
