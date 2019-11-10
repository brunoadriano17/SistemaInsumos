<?php

namespace App\Http\Controllers;

use App\Produto;
use App\Insumo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ProdutoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return redirect('/');
    }

    public function create(){
        $insumos = Insumo::where('user_id', Auth::id())->get();
        return view('produto.form', compact('insumos'));
    }

    public function store(Request $req){
        DB::beginTransaction();
        try{
            // $produto = new Produto([
            //     'nome' => 'teste',
            //     'user_id' => Auth::id()
            // ]);
    
            // $produto->save();
            $produto = Produto::findOrFail(14);
            $produto->insumos()->sync(
                [
                    2 => ['quantidade' => 300]
                ]
            );
            DB::commit();
            return $produto;
        }catch(Exception $e){
            DB::rollback();
        }
    }
}
