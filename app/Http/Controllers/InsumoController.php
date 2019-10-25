<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Insumo;
use App\CategoriaInsumo;
use Illuminate\Support\Facades\Auth;
use App\UnidadeMedida;
use DB;

class InsumoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $unidades = UnidadeMedida::all();
        $categorias = CategoriaInsumo::where('user_id', Auth::id())->get();
        $insumos = Insumo::where('user_id', Auth::id())->get();
        return view('insumo.categoria.index', compact('categorias', 'unidades', 'insumos'));
    }

    public function store(Request $req){
        DB::beginTransaction();
        try{
            Insumo::create(
                [
                    'nome' => $req->nome,
                    'custo' => $req->custo,
                    'categoria_id' => $req->categoria_id,
                    'unidade_id' => $req->unidade_id,
                    'user_id' => Auth::id()
                ]
            );
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            return back()->with('error', 'Ops, algo deu errado');
        }
        return back()->with('success', 'Insumo cadastrado com sucesso!');
    }

    public function update(Request $req, $id){
        DB::beginTransaction();
        try{
            $insumo = Insumo::findOrFail($id);
            if($insumo->user_id == Auth::id()){
                $insumo->nome = $req->nome;
                $insumo->custo = $req->custo;
                $insumo->update();
                DB::commit();
                return back()->with('success', 'Insumo alterado com sucesso!');
            }
        }catch(Exception $e){
            DB::rollback();
            return back()->with('error', 'Ops, algo deu errado');
        }
    }

    public function destroy($id){
        $insumo = Insumo::findOrFail($id);
        if($insumo->user_id == Auth::id()){
            $insumo->delete();
            return back()->with('success', 'Insumo removido com sucesso!');
        }
    }
}
