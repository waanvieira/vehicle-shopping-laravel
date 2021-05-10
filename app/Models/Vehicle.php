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
            'brand_id',
            'model_id',
            'version_id',
            'regdate_id',
            'gearbox_id',
            'fuel_id',
            'steering_id',
            'motor_power_id',
            'doors_id',
            'color_id',
            'cubic_cms_id',
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
        'brand_id'   => 'required',
        'model_id'   => 'required',
        'version_id' => 'required',
        'regdate_id' => 'required',
        'fuel_id'    => 'required',        
        'price'   => 'required',        
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
        return $this->hasOne(Brand::class, 'value', 'brand_id');
    }
    
    public function model()
    {
        return VehicleModel::where('value', $this->model_id)
                            ->where('brand_id', $this->brand_id)
                            ->first();                                
    }

    public function version()
    {
        return VehicleVersion::where('value', $this->version_id)
                                ->where('brand_id', $this->brand_id)
                                ->where('model_id', $this->model_id)
                                ->first();
    }

    public function color()
    {
        return $this->hasOne(Color::class, 'value', 'color_id');
    }

    public function fuel()
    {
        return $this->hasOne(Fuel::class, 'value', 'fuel_id');
    }

    public function gearBox()
    {
        return $this->hasOne(GearBox::class, 'value', 'bearbox_id');
    }
}
