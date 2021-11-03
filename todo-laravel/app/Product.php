<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['user_id', 'title'];

    protected $hidden = [ 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
