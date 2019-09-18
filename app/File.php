<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'name', 'type', 'path', 'mime'
    ];

    public function registrants()
    {
        return $this->belongsToMany('App\Registrant');
    }
}
