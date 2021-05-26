<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Services\NoteService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    /**
     * service
     *     
     */
    private $service;

    /**
     * Injector
     *
     * @param NoteService $service
     */
    public function __construct(NoteService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $notes = $this->service->getAll(true, null, null)
                                ->where('type', $request->type)
                                ->where('uid', $request->uid)
                                ->with('user')
                                ->orderBy('id', 'DESC')
                                ->paginate(env('APP_PAGINATE'));

        return compact('notes');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), Note::$rules);

            if ($validator->fails()) {
                return $this->error($validator->errors());
            }

            $this->service->store($request);

            return $this->success('Nota criada com sucesso');

        } catch (Exception $e) {
            logger()->error('Log', [
                'erro' => $e,
                'exception' => $e->getMessage()
            ]);

            return $this->error('Não foi possível fazer o upload da imagem, tente mais tarde');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  uuid $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        try {
            return $this->service->findByUUID($uuid);
        } catch (Exception $e) {
            logger()->error('Log', [
                'erro' => $e,
                'exception' => $e->getMessage()
            ]);

            return $this->error('Não foi encontrar nota, tente mais tarde');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        try {

            $validator = Validator::make($request->all(), Note::$rules);

            if ($validator->fails()) {
                return $this->error($validator->errors());
            }

            $this->service->update($request, $uuid);

            return $this->success('Nota atualizada com sucesso');

        } catch (Exception $e) {
            logger()->error('Log', [
                'erro' => $e,
                'exception' => $e->getMessage()
            ]);

            return $this->error('Não foi possível atualizar a nota, tente mais tarde');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        try {

            $this->service->destroy($uuid);            
            return $this->success('Nota deletada com sucesso');

        } catch (Exception $e) {
            logger()->error('Log', [
                'erro' => $e,
                'exception' => $e->getMessage()
            ]);

            return $this->error('Não foi possível apagar essa nota, tente mais tarde');
        }
    }
}
