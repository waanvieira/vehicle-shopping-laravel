<?php

namespace Tests\Feature\Model;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Register user
     *
     * @group user
     * @return void
     */
    public function testRegisterUser()
    {
        $response = User::create([
            'name' => 'Meu usuário teste',
            'email' => 'usuarioteste@dev.com.br',
            'password' => '123456'
        ]);
        
        $this->assertEquals($response->name, 'Meu usuário teste');        
    }

    /**
     * Register find
     *
     * @group user
     * @return void
     */
    public function testFindUser()
    {
        $response = User::first();        
        $this->assertNotNull($response);
    }
}
