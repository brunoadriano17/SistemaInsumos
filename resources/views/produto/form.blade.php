@extends('layouts.app')
@section('content')

<div class="container">
    <div class="col-12">
        <div class="card">
            <div class="card-header">Cadastro de Produto</div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-lg-5 col-sm-12">
                        <input type="text" max="45" name="nome" placeholder="Insira o nome do produto" class="form-control">
                    </div>
                    <div class="form-group col-lg-5 col-sm-12">
                        <select id="insumo" name="insumo_id" class="form-control">
                            @foreach($insumos as $insumo)
                                <option value="{{$insumo->id}}">{{$insumo->nome}} - {{$insumo->unidade->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 col-sm-12 text-right">
                    <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#cadastroInsumo"
                            onClick="document.getElementById('quantidade').value = '';"
                            >Adicionar</button>
                    </div>
                </div>

                <div class="table-responsive mt-3 align-items-center ">
                    <table class="table table-striped justify-content-between">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Qtd</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="tabelaInsumos">

                        </tbody>
                    </table>
                </div>
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
        <div class="form-group col-12">
            <label for="quantidade">Quantidade</label>
            <input type="text" name="quantidade" required id="quantidade" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button id="btnCadInsumo" type="button" class="btn btn-primary" onclick="adicionarInsumo();" data-dismiss="modal">Cadastrar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

@endsection

<script>
const insumos = [];

function adicionarInsumo(){
    var insumo = document.getElementById('insumo');
    var qtd = document.getElementById('quantidade');
    if(qtd.value == '')
        alert('A quantidade não pode ser vazia');
    else{
        insumos.push([insumo.value, insumo.options[insumo.selectedIndex].text,qtd.value.replace(',', '.'), ])
        preencherTabela();
    }
}

function remover(val){
    insumos.splice(val, 1);
    preencherTabela();
}

function preencherTabela(){
    var table = document.getElementById('tabelaInsumos');
    table.innerHTML = "";
        for(var i = 0; i < insumos.length; i++ ){
        var row = document.createElement('tr');
        row.insertCell(0).innerHTML = i;
        row.insertCell(1).innerHTML = insumos[i][1];
        row.insertCell(2).innerHTML = insumos[i][2];
        row.insertCell(3).innerHTML = "<button class='btn btn-danger btn-sm' onClick='remover("+i+");'>Remover</button>";
        document.getElementById('tabelaInsumos').appendChild(row);
    }
}
</script>