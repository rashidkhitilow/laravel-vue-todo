<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LUnit extends Model
{
    protected $table = 'l_units';
    protected $fillable = ['title'];

    public function user()
    {
        return $this->belongsTo(LUnit::class);
    }
}
