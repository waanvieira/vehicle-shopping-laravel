<?php

namespace Tests\Feature\Services;

use App\Models\User;
use App\Services\VechileService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VechicleServiceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Service
     *     
     */
    public function service()
    {
        return app(VechileService::class);
    }

    /**
     * A basic feature test example.
     *
     * @group vehicle
     * @return void
     */
    public function testVehicleServiceStore()
    {
        $request = request();
        $user = User::first();
        auth()->login($user);
        $response = $this->service()->store($request);        
        $this->assertEquals($response->user_id, $user->id);
    }
}
