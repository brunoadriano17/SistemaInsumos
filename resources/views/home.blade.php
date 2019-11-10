@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header"><b>Pratos Cadastrados</b></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-right">
                            <a href="{{url('/produto/create')}}"><button class="btn btn-primary btn-md">Cadastrar</button></a>
                        </div>
                    </div>

                    @if(count($produtos) > 0)
                        <div class="table-responsive text-center mt-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Preço Total</th>
                                    <th scope="col">Editar</th>
                                    <th scope="col">Remover</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($produtos as $produto)
                                        <tr>
                                            <td>{{$produto->nome}}</td>
                                            <td></td>
                                            <td><button class="btn btn-sm btn-warning">Editar</button>
                                            <td>
                                                <form action="{{url('/produto/'.$produto->id)}}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <h4>Não há produtos cadastrados</h4>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
