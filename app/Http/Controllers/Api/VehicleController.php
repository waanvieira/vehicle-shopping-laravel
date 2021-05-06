<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleUpdate;
use App\Models\Brand;
use App\Models\Color;
use App\Models\CubicCms;
use App\Models\Door;
use App\Models\Exchange;
use App\Models\Feature;
use App\Models\Financial;
use App\Models\Fuel;
use App\Models\GearBox;
use App\Models\MotorPower;
use App\Models\Photo;
use App\Models\RegDate;
use App\Models\Steerings;
use App\Models\Type;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use App\Models\Version;
use App\Services\VehicleService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    /**
     * Service
     *
     * @var [type]
     */
    private $service;

    public function __construct(VehicleService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
                  
            $vehicles = $this->service->getAll(true, env(env('APP_PAGINATE')), null)
                                        ->with('cover', 
                                                // 'brand', 
                                                // 'model'
                                                //'version'
                                                 'color',
                                                'fuel',
                                                'gearBox'
                                                )
                                        // ->where('user_id', auth()->user()->id)
                                        ->where('status', 1)
                                        ->paginate(env(env('APP_PAGINATE')));
            
            if (!$vehicles) {
                return $this->error('Veículos não encontrados');
            }

            return $vehicles;                        
  
        } catch (Exception $e) {
            logger()->error('Log', [
              'erro' => $e,
              'exception' => $e->getMessage()
            ]);
            return $e;
            return $this->internalError('Erro para listar registros, tente mais tarde');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
            
            $response = $this->service->store($request);            
            $photos = $response->photos ?? [];
            
            if (!$response) {
                return response()->json([400]);
            }

            return array_merge(['vehicle' => $response, 'photos' => $photos], $this->getData());
  
        } catch (Exception $e) {
            logger()->error('Log', [
              'erro' => $e,
              'exception' => $e->getMessage()
            ]);
                
            return $this->internalError('Erro para cadastrar cadastrar, tente mais tarde');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            
            $validator = Validator::make($request->all(), Vehicle::$rules);

            if($validator->fails()) {
                return response()->json(['error' => $validator->errors()] , 200);
            }
            
            $vehicle = $this->service->findByUUID($id);
            
            if (!$vehicle) {
                return $this->error('Veículo não encontrado');
            }

            $request['status'] = 1;
            $response = $this->service->update($request, $id);
            
            if ($response) {
                return $this->success('veículo cadastrado com sucesso');
            }
            
            return $this->error('Erro para cadastrar veículo');

        } catch (Exception $e) {
            logger()->error('Log', [
              'erro' => $e,
              'exception' => $e->getMessage()
            ]);
                
          return $this->internalError($e->getMessage());
        }          
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
            return $this->service->destroy($id);
        } catch (Exception $e) {
            logger()->error('Log', [
              'erro' => $e,
              'exception' => $e->getMessage()
            ]);
                
            return $this->internalError('Erro para deletar, tente mais tarde');
        }
    }

    /**
     * Return all brands
     *
     * @return void
     */
    public function getData()
    {
        return [
            'types' => Type::all(),
            'brands' => Brand::all(),
            'models' => VehicleModel::all(),
            'regdate' => RegDate::all(),
            'gearbox' => GearBox::all(),
            'fuel' => Fuel::all(),
            'car_streering' => Steerings::all(),
            'motorpower' => MotorPower::all(),
            'doors' => Door::all(),
            'features' => Feature::all(),
            'colors' => Color::all(),
            'exchange' => Exchange::all(),
            'financial' => Financial::all(),
            'cubiccms' => CubicCms::all()            
        ];
    }

    /**
     * Return brands by type
     *
     * @param int $type
     * @return \Illuminate\Http\Response
     */
    public function brand($typeId)
    {
        $brand = Brand::where('type_id', $typeId)->get();
        return compact('brand');
    }


    /**
     * Return models by type and brand
     *
     * @param int $type
     * @param int $brand
     * @return void
     */
    public function model($typeId, $brandId)
    {
        $model = VehicleModel::where('type_id', $typeId)
                                ->where('brand_id', $brandId)
                                ->orderBy('name')->get();
        return compact('model');
    }

    /**
     * Return versions
     *
     * @param int $brandId
     * @param int $modelId
     * @return void
     */
    public function version($brandId, $modelId)
    {
        $version = Version::where([['brand_id', $brandId], ['model_id', $modelId]])->orderBy('name')->get();
        return compact('version');
    }
}
