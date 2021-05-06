<?php

namespace App\Models;

use App\Casts\Json;
use App\Traits\HashID;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{    
    use UuidTrait;
    use SoftDeletes;
    use HashID;

    public $table = 'vehicles';

    public $incrementing = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'features' => Json::class,
        'financials' => Json::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
            'tag_id',
            'zipcode',
            'city',
            'city_url',
            'uf',
            'uf_url',
            'type',
            'brand',
            'model',
            'version',
            'regdate',
            'gearbox',
            'fuel',
            'steering',
            'motor_power',
            'doors',
            'color',
            'cubic_cms',
            'owner',
            'mileage',
            'features',
            'moto_features',
            'financials',
            'price',
            'title',
            'description',
            'status'
    ];

    static  $rules = [
        'zipcode' => 'required',
        'city'    => 'required',
        'uf'      => 'required',
        'type'    => 'required',
        'brand'   => 'required',
        'model'   => 'required',
        'version' => 'required',
        'regdate' => 'required',
        'fuel'    => 'required',
        'price'   => 'required'
    ];

    /**
     * Set zipcode.
     *
     * @param  string  $value
     * @return void
     */
    public function setZipCodeAttribute($value)
    {
        $value = str_replace('-', '', $value);
        $value = (int)$value;
        $this->attributes['zipcode'] = $value;
    }

    /**
     *  Get all of the photos.
     *     
     */
    public function photos()
    {
        return $this->morphMany(Photo::class, 'photograveable');
    }

    public function cover()
    {
        return $this->morphOne(Photo::class, 'photograveable')->orderBy('order', 'asc');
    }

    public function brand()
    {
        return $this->hasOne(Brand::class, 'id');
    }
    
    public function model()
    {
        return VehicleModel::where('model', $this->model)
                                ->where('brand', $this->brand)
                                ->first();
    }

    public function version()
    {
        return VehicleModel::where('value', $this->version)
                                ->where('brand_id', $this->brand)
                                ->where('model_id', $this->model->value)
                                ->first();
    }

    public function color()
    {
        return $this->hasOne(Color::class, 'id', 'color');
    }

    public function fuel()
    {
        return $this->hasOne(Fuel::class, 'id', 'fuel');
    }

    public function gearBox()
    {
        return $this->hasOne(GearBox::class, 'id', 'bearbox');
    }
}
