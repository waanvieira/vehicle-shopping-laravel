<?php

namespace Tests\Feature\Services;

use App\Models\User;
use App\Services\NoteService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NoteServiceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Service
     *     
     */
    public function service()
    {
        return app(NoteService::class);
    }

    /**
     * A basic feature test example.
     *
     * @group note
     * @return void
     */
    public function testNoteServiceStore()
    {
        $request = request();
        $user = User::first();
        auth()->login($user);

        $response = $this->service()->store($request);        
        $this->assertEquals($response->user_id, $user->id);
    }
}
