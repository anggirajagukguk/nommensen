<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cooperation extends Model
{
    protected $fillable = [
        'content',
        'image',
    ];
    
    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();
        
        static::saving(function ($cooperation) {
            // Always update timestamp when saving
            if ($cooperation->exists) {
                $cooperation->updated_at = now();
            }
        });
    }
}