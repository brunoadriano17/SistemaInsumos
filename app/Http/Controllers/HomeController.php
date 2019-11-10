<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Insumo;
use App\Produto;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $insumos = Insumo::where('user_id', Auth::id())->get();
        $produtos = Produto::where('user_id', Auth::id())->get();
        return view('home', compact('insumos', 'produtos'));
    }
}
