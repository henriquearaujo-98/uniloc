@extends('instituicoes.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Editar Instituição
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
            <form method="post" action="{{ route('instituicoes.update', $instituicao->ID ) }}">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="id">ID:</label>
                    <input type="text" class="form-control" name="ID" value="{{ $instituicao->ID }}"/>
                </div>
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" name="nome" value="{{ $instituicao->nome }}"/>
                </div>
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="nome">Tipo de Ensino:</label>
                    <select class="select4 form-control" name="tipos_ensino_ID" id="tipos_ensino_ID">
                        <option value="{{ $instituicao->tipos_ensino_ID }}">{{$instituicao->tipo_ensino->nome}}</option>
                        @foreach($tipos_ensino as $tipo_ensino)
                            <option value="{{$tipo_ensino->ID}}" {{$tipo_ensino->nome == $tipo_ensino->ID ? 'selected' : ''}}>
                                {{$tipo_ensino->nome}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="nome">Código Postal:</label>
                    <select class="select4 form-control" name="cod_postal" id="cod_postal">
                        <option value="{{ $instituicao->cod_postal }}">{{$instituicao->cod_postal}} - {{ $instituicao->codigo_postal->cidade->nome}}</option>
                        @foreach($codigos_postais as $codigo_postal)
                            <option value="{{$codigo_postal->cod_postal}}" {{$codigo_postal->cod_postal == $codigo_postal->cod_postal ? 'selected' : ''}}>
                                {{$codigo_postal->cod_postal }} - {{ $codigo_postal->cidade->nome}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="nome">Latitude:</label>
                    <input type="text" class="form-control" name="latitude" value="{{ $instituicao->latitude }}"/>
                </div>
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="nome">Longitude:</label>
                    <input type="text" class="form-control" name="longitude" value="{{ $instituicao->longitude }}"/>
                </div>
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="nome">Rank:</label>
                    <input type="text" class="form-control" name="rank" value="{{ $instituicao->rank }}"/>
                </div>
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="/instituicoes" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
