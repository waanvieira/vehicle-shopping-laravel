<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PhotoService;
use App\Services\VehicleService;
use App\Traits\UploadTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    use UploadTrait;
    private $service;
    private $vehicleService;

    /**
     * Construct method
     *
     * @param PhotoService $service
     */
    public function __construct(PhotoService $service, VehicleService $vehicleService)
    {
        $this->service = $service;
        $this->vehicleService = $vehicleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            
            $file = $request->file('file');            
            $vehicle = $this->vehicleService->findByUUID($request->uuid);
            
            if (!$vehicle) {
                return response()->json(['error' => 'Veículo não encontrado']);
            }

            if ($request->hasFile('file') && $file->isValid()) {
                $upload = $this->put($request->file, 'vehicles');
                
                if ($upload) {

                    $request['img'] = $upload;
                    $photo = $vehicle->photos()->create($request->all());

                    if ($photo) {
                        return $photo;
                    }
                }

                return $this->error('Não foi possível fazer o upload da imagem, tente mais tarde');
            }
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $uuid)
    {        
        $response = $this->service->findByUUID($uuid);
        $photo = $this->get($response->img, $request->width, $request->height);
        return $photo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        foreach ($request->order as $order => $id) {            
            $position = $this->service->getAll(true, null, null)->where('user_id', auth()->user()->id)->find($id);
            $position->order = $order;
            $position->save();
        }

        return response()->json(['msg'  => 'Posições atualizadas com sucesso', 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            
            $photo = $this->service->findByUUID($id);
            
            if (!$photo) {
                return response()->json(['error'  => 'Imagem não encontrada']);
            }
            
            $upload = $this->delete($photo->img);
            
            if ($upload) {
                $photo = $this->service->destroy($id);
                return response()->json(['success'  => 'Imagem deletada com sucesso']);
            }

            return response()->json(['error'  => 'Erro apra deletar a imagem']);
        } catch (Exception $e) {
            logger()->error('Log', [
                'erro' => $e,
                'exception' => $e->getMessage()
            ]);

            return response()->json(['error'  => $e->getMessage(), 500]);
        }
    }
}
