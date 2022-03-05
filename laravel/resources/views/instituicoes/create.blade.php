@extends('instituicoes.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Criar Município
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('instituicoes.store') }}">
                <div class="form-group">
                    @csrf
                    <label for="id_inst">ID: </label>
                    <input type="text" class="form-control" name="ID"/>
                </div>
                <div class="form-group">
                    <label for="Nome_inst">Nome: </label>
                    <input type="text" class="form-control" name="nome"/>
                </div>
                <div class="form-group">
                    <label for="Nome_tipo_ensino">Tipo de Ensino: </label>
                    <select class="select4 form-control" name="tipos_ensino_ID" id="tipos_ensino_ID">
                        <option value="">Seleciona um ensino..</option>
                        @foreach($tipos_ensino as $tipo_ensino)
                            <option value="{{$tipo_ensino->ID}}" {{$tipo_ensino->nome == $tipo_ensino->ID ? 'selected' : ''}}>
                                {{$tipo_ensino->nome}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="cod_postal">Código Postal: </label>
                    <select class="select4 form-control" name="cod_postal" id="cod_postal">
                        <option value="">Seleciona um código postal..</option>
                        @foreach($codigos_postais as $codigo_postal)
                            <option value="{{$codigo_postal->cod_postal}}" {{$codigo_postal->cod_postal ? 'selected' : ''}}>
                                {{$codigo_postal->cod_postal }} - {{ $codigo_postal->cidade->nome}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="rank_inst">Rank: </label>
                    <input type="text" class="form-control" name="rank"/>
                </div>
                <button type="submit" class="btn btn-primary">Criar</button>
                <a href="/instituicoes" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
