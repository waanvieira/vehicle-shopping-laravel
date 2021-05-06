<?php

namespace App\Traits;
use Ramsey\Uuid\Uuid;

trait UuidTrait
{
    public static function bootUuidTrait()
    {
        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4();
        });
    }
}