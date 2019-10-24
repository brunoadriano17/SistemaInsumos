<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Insumo;
use App\CategoriaInsumo;

class InsumoController extends Controller
{
    public function index(){
        return "oi";
    }

    public function store(Request $req){
        $cat = CategoriaInsumo::create($req);
        return $cat;
    }
}
