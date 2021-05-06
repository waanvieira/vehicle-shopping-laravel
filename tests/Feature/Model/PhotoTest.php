<?php

namespace Tests\Feature\Model;

use App\Models\Photo;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PhotoTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Teste create method
     *
     * @group photo
     * @return void
    */
    public function testStorePhotos()
    {
        $request = request();
        $vehicle = Vehicle::first();
        $response = $vehicle->photos()->create([
            'img' => 'jdioejdioejode'
        ]);                
        
        $this->assertNotNull($response);
    }
}
