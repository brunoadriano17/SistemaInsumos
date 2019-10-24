<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoriaInsumo;
use Illuminate\Support\Facades\Auth;
use DB;

class CategoriaInsumoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $categorias = CategoriaInsumo::where('user_id', Auth::id())->get();
        return view('insumo.categoria.index', compact('categorias'));
    }

    public function list(){
        return json_encode(CategoriaInsumo::where('user_id', Auth::id())->get());
    }

    public function show($id){
        return $this->list();
        return json_encode(CategoriaInsumo::where('user_id', Auth::id())->where('id', $id)->get());
    }

    public function store(Request $req){
        DB::beginTransaction();
        try{
            CategoriaInsumo::create(
                [
                    'nome' => $req->nome,
                    'user_id' => Auth::id()
                ]
            );
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            return back()->with('error', 'Ops, algo deu errado');
        }
        return back()->with('success', 'Categoria cadastrada com sucesso!');
    }

    public function update(Request $req, $id){
        DB::beginTransaction();
        try{
            $cat = CategoriaInsumo::findOrFail($id);
            if($cat->user_id == Auth::id()){
                $cat->nome = $req->nome;
                $cat->update();
                DB::commit();
                return back()->with('success', 'Categoria alterada com sucesso!');
            }
        }catch(Exception $e){
            DB::rollback();
            return back()->with('error', 'Ops, algo deu errado');
        }
    }

    public function destroy($id){
        $cat = CategoriaInsumo::findOrFail($id);
        if($cat->user_id == Auth::id()){
            $cat->delete();
            return back()->with('success', 'Categoria removida com sucesso!');
        }
    }

    public function restore($id){

    }
}
