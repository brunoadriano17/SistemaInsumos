<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Insumo;
use Illuminate\Database\Eloquent\SoftDeletes;
class Produto extends Model
{
    protected $table = 'produto';
    protected $fillable = [
        'nome', 'user_id'
    ];

    function insumos(){
        return $this->belongsToMany('App\Insumo', 'insumo_produto')->withPivot('quantidade');
    }
}
