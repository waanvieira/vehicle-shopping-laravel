<?php

namespace Tests\Feature\Controllers;

use App\Http\Controllers\Api\PhotoController;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PhotoControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Service
     *
     * @return App\Http\Controllers\Api\PhotoController;
     */
    public function service()
    {
        return app(PhotoController::class);
    }

    /**
     * Teste create method
     *
     * @group photo
     * @return void
     */
    public function testPhotoControllerStore()
    {
        $user = User::first();
        auth()->login($user);        
        $request = request();        
        // $request['zipcode'] = 01310010;
        // $request['city'] = '' ;
        // $request['city_url'] = '' ;
        // $request['uf'] = '' ;
        // $request['uf_url'] = '' ;
        // $request['type'] = 200;
        // $request['brand'] = 1;
        // $request['model'] = 12;
        // $request['version'] = 10;
        // $request['regdate'] = 2010;
        // $request['gearbox'] = 12;
        // $request['fuel'] = 100;
        // $request['steering'] = 1500;
        // $request['motor_power'] = 20;
        // $request['doors'] = 1;
        // $request['color'] = 2;
        // $request['cubic_cms'] = 4;
        // $request['owner'] = 12;
        // $request['mileage'] = 10000;
        // $request['price'] = 50000;
        // $request['title'] = 'Meu carro novo';
        // $request['description'] = 'Description of vechicle';
        
        $response = $this->service()->store($request);
        dd($response);
        $this->assertEquals($response->title, 'Meu carro novo');
    }

     /**
     * Teste update method
     *
     * @group photo
     * @return void
     */
    public function testPhotoControllerUpdate()
    {
        $request = request();
        $request['price'] = 280000;
        $request['title'] = 'Meu update car';
        $request['description'] = 'Description of vechicle update';
        $uuid = Vehicle::first()->uuid;
        $response = $this->service()->update($request, $uuid);
        $this->assertEquals($response->title, 'Meu update car');
    }

     /**
     * Teste delete method
     *
     * @group photo
     * @return void
     */
    public function testPhotoControllerDestroy()
    {
        // $uuid = Photo::first()->uuid;
        $uuid = Photo::where('uuid', '8337b761-c3d6-4c2d-ae15-916c49359350')->first();        
        $user = User::first();
        auth()->login($user);        
        $response = $this->service()->destroy($uuid->uuid);
        dd($response);
        $this->assertTrue($response);
    }

    /**
     * Teste update method
     *
     * @group photo
     * @return void
     */
    public function testGetData()
    {
        $user = User::find(637474661);
        auth()->login($user);
        $response = $this->service()->getData();
        $this->assertNotNull($response);
    }

}
