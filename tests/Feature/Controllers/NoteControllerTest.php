<?php

namespace Tests\Feature\Controllers;

use App\Http\Controllers\Api\NoteController;
use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NoteControllerTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * Service
     *     
     */
    public function service()
    {
        return app(NoteController::class);
    }
    
     /**
     * Teste create method
     *
     * @group note
     * @return void
     */
    public function testNoteControllerStore()
    {
        $user = User::first();
        auth()->login($user);        
        $request = request();        
        $request['content'] = 'Meu conteudo da nota';
        $response = $this->service()->store($request);
        $response = json_encode($response);
        $response = json_decode($response);
        $this->assertEquals($response->original->status, 200);
    }

     /**
     * Teste show method
     *
     * @group note
     * @return void
     */
    public function testNoteControllerShow()
    {
        $user = User::first();
        auth()->login($user);
        $note = Note::first();
        $response = $this->service()->show($note->uuid);
        $response = json_encode($response);
        $response = json_decode($response);
        $this->assertEquals($response->original->status, 200);
    }

     /**
     * Teste update method
     *
     * @group note
     * @return void
     */
    public function testNoteControllerUpdate()
    {
        $user = User::first();
        auth()->login($user);
        $request = request();
        $note = Note::first();
        $request['content'] = 'Meu conteudo da nota';
        $response = $this->service()->update($request, $note->uuid);
        $response = json_encode($response);
        $response = json_decode($response);
        $this->assertEquals($response->original->status, 200);
    }

     /**
     * Teste destroy method
     *
     * @group note
     * @return void
     */
    public function testNoteControllerDestroy()
    {
        $user = User::first();
        auth()->login($user);        
        $note = Note::first();        
        $response = $this->service()->destroy($note->uuid);
        $response = json_encode($response);
        $response = json_decode($response);
        $this->assertEquals($response->original->status, 200);
    }
}
