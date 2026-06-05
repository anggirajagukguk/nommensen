<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = [
        'content',
        'image',
    ];
    
    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();
        
        static::saving(function ($facility) {
            // Always update timestamp when saving
            if ($facility->exists) {
                $facility->updated_at = now();
            }
        });
    }
}