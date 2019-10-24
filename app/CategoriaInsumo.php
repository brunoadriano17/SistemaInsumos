<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CategoriaInsumo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaInsumo extends Model
{
    use softDeletes;

    protected $fillable = [
        'nome', 'user_id'
    ];

    public function Usuario(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
