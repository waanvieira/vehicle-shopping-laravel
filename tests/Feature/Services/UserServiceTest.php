<?php

namespace Tests\Feature\Services;

use App\Services\UserService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Service
     *
     * @return App\Http\Controllers\Play\PlayerConteudoController
     */
    public function service()
    {
        return app(UserService::class);
    }

    /**
     * A basic feature test example.
     *
     * @group user
     * @return void
     */
    public function testUserServiceStore()
    {
        $request = request();
        $request['name'] = 'user dev';
        $request['email'] = 'userdev@dev.com';
        $request['password'] = '123456';
        $response = $this->service()->store($request);
        $this->assertEquals($response->name, 'user dev');
    }
}
