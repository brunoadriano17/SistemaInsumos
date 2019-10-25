<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $fillable = [
        'nome', 'custo', 'categoria_id', 'unidade_id', 'user_id'
    ];

    public function Usuario(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function Categoria(){
        return $this->belongsTo('App\CategoriaInsumo', 'categoria_id');
    }

    public function Unidade(){
        return $this->belongsTo('App\UnidadeMedida', 'unidade_id');
    }
}
