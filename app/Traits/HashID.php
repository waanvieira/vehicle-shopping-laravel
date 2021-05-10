<?php
namespace App\Traits;

use Illuminate\Foundation\Console\KeyGenerateCommand;

trait HashID
{
   	/**
	 * Adiciona hash uuid para o id
	 *
	 * @param String $tableName
	 * @return id
	 */
    public static function bootHashID()
    {
        static::creating(function ($model) {
            $id = self::createHash($model);
            $model->id = $id;
            if (auth()->check()) {
                $model->user_id = auth()->user() ? auth()->user()->id : null;
            }            
        });
    }

    /**
     * Create hash
     *
     * @param  $model
     * @return void
     */
    protected static function createHash($model)
    {
        $id = self::generateHashId();
                
        while ($model->whereId($id)->count() > 0) {
            $id = self::generateHashId();
        }
        
        return $id;
    }
    
    /**
     * Create hash for id
     *     
     * @return int
     */
    protected static function generateHashId()
    {
        $min = 0;
        $max = 999999999;
        return rand($min, $max);
    }
}
