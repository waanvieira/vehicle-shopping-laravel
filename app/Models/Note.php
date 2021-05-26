<?php

namespace App\Models;

use App\Traits\HashID;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use UuidTrait;
    use HashID;

    public $table = 'notes';

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = ['type', 'uuid', 'tag_id', 'content'];

    static $rules = [
        'content' => 'required'
    ];

    /**
     * Relaption
     *
     * @return void
     */
    public function user()
    {
        return $this->hasOne(User::class)->select('id', 'name');
    }
}
