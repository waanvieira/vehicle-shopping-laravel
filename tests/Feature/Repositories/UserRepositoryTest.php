<?php

namespace Tests\Feature\Repositories;

use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Service
     *
     * @return App\Http\Controllers\Play\PlayerConteudoController
     */
    public function service()
    {
        return app(UserRepository::class);
    }

    /**
     * A basic feature test example.
     *
     * @group user
     * @return void
     */
    public function testUserRepositoryStore()
    {
        $request = request();
        $request['name'] = 'user dev';
        $request['email'] = 'userdev@dev.com';
        $request['password'] = '123456';
        $response = $this->service()->store($request);        
        $this->assertEquals($response->name, 'user dev');
    }
}
