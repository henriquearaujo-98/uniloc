@extends('codigos_postais.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Editar Código Postal
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
            <form method="post" action="{{ route('codigos_postais.update', $codigo_postal->cod_postal ) }}">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="id">Código Postal:</label>
                    <input type="text" class="form-control" name="cod_postal" value="{{ $codigo_postal->cod_postal }}"/>
                </div>
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="nome">Cidade:</label>
                    {{--                    <input type="text" class="form-control" name="distritos_ID" value="{{ $municipio->distrito->nome }}"/>--}}
                    <select class="select4 form-control" name="cidade_ID" id="cidade_ID">
                        <option value="{{ $codigo_postal->cidade_ID }}">{{$codigo_postal->cidade->nome}}</option>
                        @foreach($cidades as $cidade)
                            <option value="{{$cidade->ID}}" {{$cidade->nome == $cidade->ID ? 'selected' : ''}}>
                                {{$cidade->nome}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="/codigos_postais" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
