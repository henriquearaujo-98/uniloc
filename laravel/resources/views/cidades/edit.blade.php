@extends('cidades.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Editar Cidade
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
            <form method="post" action="{{ route('cidades.update', $cidade->ID ) }}">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="id">ID:</label>
                    <input type="text" class="form-control" name="ID" value="{{ $cidade->ID }}"/>
                </div>
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="nome">Cidade:</label>
                    <input type="text" class="form-control" name="nome" value="{{ $cidade->nome }}"/>
                </div>
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="nome">Municipio:</label>
                    {{--                    <input type="text" class="form-control" name="distritos_ID" value="{{ $municipio->distrito->nome }}"/>--}}
                    <select class="select4 form-control" name="municipio_ID" id="municipio_ID">
                        <option value="{{ $cidade->municipio_ID }}">{{$cidade->municipio->nome}}</option>
                        @foreach($municipios as $municipio)
                            <option value="{{$municipio->ID}}" {{$municipio->nome == $municipio->ID ? 'selected' : ''}}>
                                {{$municipio->nome}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="/cidades" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
