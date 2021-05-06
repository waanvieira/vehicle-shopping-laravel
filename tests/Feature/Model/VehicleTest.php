<?php

namespace Tests\Feature\Model;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VehicleTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Register vehicle
     *
     * @group vehicle
     * @return void
     */
    public function testStoreVehicle()
    {
        $user = User::first();
        auth()->login($user);
        $json = json_decode('');
        $response = Vehicle::create([
            'tag_id'=> 12,
            'zipcode'=> 01310010,
            'city'=> '' ,
            'city_url'=> '' ,
            'uf'=> '' ,
            'uf_url'=> '' ,
            'type'=> 200,
            'brand'=> 1,
            'model'=> 12,
            'version'=> 10,
            'regdate'=> 2010,
            'gearbox'=> 12,
            'fuel'=> 100,
            'steering'=> 1500,
            'motor_power'=> 20,
            'doors'=> 1,
            'color'=> 2,
            'cubic_cms'=> 4,
            'owner'=> 12,
            'mileage'=> 10000,            
            'price'=> 50000,
            'title'=> 'Meu carro novo',
            'description'=> 'Description of vechicle',
        ]);
        
        $this->assertEquals($response->title, 'Meu carro novo');
    }

     /**
     * Find vehicle
     *
     * @group vehicle
     * @return void
     */
    public function testFindVehicle()
    {
        $response = Vehicle::first();
        $this->assertNotNull($response);
    }

       /**
     * Teste create method
     *
     * @group photo
     * @return void
    */
    public function testStorePhotos()
    {
        $vehicle = Vehicle::first();
        $user = User::first();
        auth()->login($user);
        $response = $vehicle->photos()->create([
            'img' => 'minhaimagemteste.jpg'
        ]);
        
        $this->assertEquals($response->img, 'minhaimagemteste.jpg');
    }
}
