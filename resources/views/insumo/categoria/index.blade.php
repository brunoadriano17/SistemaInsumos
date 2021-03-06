@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-sm-12">
            <div class="card">
                <div class="card-header">Categoria de Insumos</div>
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#cadastroCategoria"
                                onClick="document.getElementById('nomeCategoria').value = '';
                                document.getElementById('btnCadCategoria').firstChild.data = 'Cadastrar';
                                document.getElementById('formCategoria').action = '{{url('/insumo/categoria/')}}';
                                document.getElementById('formMethod').value = 'POST';
                                document.getElementById('exampleModalLabel').firstChild.data = 'Cadastrar Categoria';
                                "
                                >Cadastrar</button>
                            </div>
                        </div>
                        <div class="row mt-3">
                        @if(count($categorias) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Editar</th>
                                    <th scope="col">Remover</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categorias as $categoria)
                                        <tr>
                                            <th scope="row">{{$categoria->id}}</th>
                                            <td>{{$categoria->nome}}</td>
                                            <td><button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#cadastroCategoria"
                                            onClick="document.getElementById('nomeCategoria').value = '{{$categoria->nome}}';
                                            document.getElementById('btnCadCategoria').firstChild.data = 'Salvar';
                                            document.getElementById('formCategoria').action = '{{url('/insumo/categoria/'.$categoria->id)}}';
                                            document.getElementById('formMethod').value = 'PUT';
                                            document.getElementById('exampleModalLabel').firstChild.data = 'Editar Categoria';
                                            "
                                            >Editar</button>
                                            <td>
                                                <form action="{{url('/insumo/categoria/'.$categoria->id)}}" method="POST">
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
                            <div class="col-12 text-center">
                                <h4>Não há categorias cadastradas</h4>
                            </div>
                        @endif
                        </div>
                        </div>

                    </div>
            </div>
            </div>
        <div class="col-lg-6 col-sm-12">
            <div class="card">
                <div class="card-header">Insumos</div>
                <div class="card-body">
                <div class="row">
                        <div class="col-12 text-right">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#cadastroInsumo"
                            onClick="document.getElementById('nomeInsumo').value = '';
                                    document.getElementById('custo').value = '';
                                    document.getElementById('formInsumo').action = '{{url('/insumo')}}';
                                    document.getElementById('formInsumoMethod').value = 'POST';
                                    document.getElementById('modalInsumo').firstChild.data = 'Cadastrar Insumo';"
                            >Cadastrar</button>
                        </div>
                </div>
                <div class="row mt-3 text-center">
                    @if(count($insumos) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Unidade</th>
                                <th scope="col">Preço de Custo</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Remover</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($insumos as $insumo)
                                    <tr>
                                        <td>{{$insumo->nome}}</td>
                                        <td>{{$insumo->unidade->nome}}</td>
                                        <td>R${{$insumo->custo}}</td>
                                        <td><button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#cadastroInsumo"
                                        onClick="document.getElementById('nomeInsumo').value = '{{$insumo->nome}}';
                                        document.getElementById('custo').value = '{{$insumo->custo}}';
                                        document.getElementById('btnCadInsumo').firstChild.data = 'Salvar';
                                        document.getElementById('formInsumo').action = '{{url('/insumo/'.$insumo->id)}}';
                                        document.getElementById('formInsumoMethod').value = 'PUT';
                                        document.getElementById('modalInsumo').firstChild.data = 'Editar Categoria';
                                        "
                                        >Editar</button>
                                        <td>
                                            <form action="{{url('/insumo/'.$insumo->id)}}" method="POST">
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
                    <div class="col-12 text-center">
                                <h4>Não há insumos cadastradas</h4>
                            </div>
                    @endif
                </div>
                </div>
                
        </div>
    </div>
</div>

<div class="modal fade" id="cadastroCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formCategoria" method="POST" action="{{url('/insumo/categoria')}}">
        @csrf
        <input id="formMethod" type="hidden" name="_method" value="POST">
            <div class="row">
                <div class="form-group col-12">
                    <label for="nome">Nome</label>
                    <input id="nomeCategoria" type="text" max="45" name="nome" required placeholder="Insira o nome da categoria" class="form-control">
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="btnCadCategoria" type="button" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('formCategoria').submit();">Cadastrar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="cadastroInsumo" tabindex="-1" role="dialog" aria-labelledby="modalInsumo" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalInsumo">Cadastrar Insumo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formInsumo" method="POST" action="{{url('/insumo')}}">
        @csrf
        <input id="formInsumoMethod" type="hidden" name="_method" value="POST">
            <div class="row">
                <div class="form-group col-12">
                    <label for="nome">Nome</label>
                    <input id="nomeInsumo" type="text" max="45" name="nome" required placeholder="Insira o nome da categoria" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <label for="categoria_id">Categoria</label>
                    <select name="categoria_id" class="form-control">
                        @foreach($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                    <label for="unidade_id">Unidade de Medida</label>
                    <select name="unidade_id" class="form-control">
                        @foreach($unidades as $unidade)
                            <option value="{{$unidade->id}}">{{$unidade->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                    <label for="custo">Custo</label>
                    <input id="custo" type="text" placeholder="R$0.00" name="custo" class="form-control">
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="btnCadInsumo" type="button" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('formInsumo').submit();">Cadastrar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

@endsection