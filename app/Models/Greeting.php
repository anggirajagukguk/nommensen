<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Greeting extends Model
{
    protected $fillable = [
        'content',
        'image',
    ];
    
    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();
        
        static::saving(function ($greeting) {
            // Always update timestamp when saving
            if ($greeting->exists) {
                $greeting->updated_at = now();
            }
        });
    }
}