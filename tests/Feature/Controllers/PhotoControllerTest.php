<?php

namespace Tests\Feature\Controllers;

use App\Http\Controllers\Api\PhotoController;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
        Storage::fake('vehicles');

        $response = $this->json('POST', '/vehicles/photo', [
            'img' => UploadedFile::fake()->image('avatar.jpg')
        ]);
        
        // Assert the file was stored...
        Storage::disk('vehicles')->assertExists('avatar.jpg');

        // Assert a file does not exist...
        Storage::disk('vehicles')->assertMissing('missing.jpg');
        
        $response = $this->service()->store($request);        
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
