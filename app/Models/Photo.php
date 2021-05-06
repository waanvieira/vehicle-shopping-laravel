<?php

namespace App\Models;

use App\Traits\HashID;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use UuidTrait;    
    use HashID;

    public $table = 'photos';

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = ['img', 'uuid'];

    /**
     * Get the owning photograveable model.
    */
    public function photograveable()
    {
        return $this->morphTo();
    }
}
