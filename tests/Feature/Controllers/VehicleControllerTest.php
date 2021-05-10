<?php

namespace Tests\Feature\Controllers;

use App\Http\Controllers\Api\VehicleController;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VehicleControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Service
     *     
     */
    public function service()
    {
        return app(VehicleController::class);
    }

   /**
     * Teste create method
     *
     * @group vehicle
     * @return void
     */
    public function testVehicleControllerIndex()
    {
        $user = User::latest()->first();
        auth()->login($user);
        // $response = $this->json('GET', '/api/vehicles');
        $response = $this->service()->index();
        dd($response);
        // $response->assertStatus(200);
            // ->assertJsonFragment([
            //     'name' => 'Anakin Skywalker',
            // ]);

        // 
        // $this->assertNotNull($response);
    }
    
    /**
     * Teste create method
     *
     * @group vehicle
     * @return void
     */
    public function testVehicleControllerStore()
    {
        $user = User::first();
        auth()->login($user);
        $request = request();        
        $response = $this->service()->store($request);        
        $this->assertNotNull($response);
    }

     /**
     * Teste update method
     *
     * @group vehicle
     * @return void
     */
    public function testVehicleControllerUpdate()
    {
        $request = request();
        $request['price'] = 280000;
        $request['title'] = 'Meu update car';
        $request['zipCode'] = '04441900';
        $request['city'] = 'São Paulo';
        $request['uf'] = 'SP';
        $request['type'] = 2200;
        $request['brand'] = 60;
        $request['description'] = 'Description of vechicle update';
        $request['tag_id'] = 5;
        $request['version'] = 5;
        $request['regdate'] = 5;
        $request['fuel'] = 5;
        $request['model'] = 5;
        $uuid = Vehicle::first()->uuid;
        $response = $this->service()->update($request, $uuid);        
        $this->assertNotNull($response);
    }

     /**
     * Teste delete method
     *
     * @group vehicle
     * @return void
     */
    public function testVehicleControllerDestroy()
    {
        $uuid = Vehicle::first()->uuid;
        $response = $this->service()->destroy($uuid);        
        $this->assertTrue($response);
    }

    /**
     * Teste update method
     *
     * @group vehicle
     * @return void
     */
    public function testGetData()
    {
        $user = User::find(637474661);
        auth()->login($user);
        $response = $this->service()->getData();
        $this->assertNotNull($response);
    }

    /**
     * Teste show method
     *
     * @group vehicle
     * @return void
     */
    public function testVehicleControllerShow()
    {        
        $uuid = Vehicle::latest()->first()->uuid;        
        $response = $this->service()->show($uuid);        
        dd($response);
        $this->assertTrue($response);
    }

}
