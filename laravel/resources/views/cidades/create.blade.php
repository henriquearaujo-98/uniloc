@extends('cidades.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Criar Cidade
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
            <form method="post" action="{{ route('cidades.store') }}">
                @csrf
                <div class="form-group">
                    <label for="Nome_cidade">Cidade: </label>
                    <input type="text" class="form-control" name="nome"/>
                </div>
                <div class="form-group">
                    <label for="Nome_municipio">Município: </label>
                    {{--                    <input type="text" class="form-control" name="distritos_ID"/>--}}
                    <select class="select4 form-control" name="municipio_ID" id="municipio_ID">
                        <option value="">Seleciona um município..</option>
                        @foreach($municipios as $municipio)
                            <option value="{{$municipio->ID}}" {{$municipio->nome == $municipio->ID ? 'selected' : ''}}>
                                {{$municipio->nome}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Criar</button>
                <a href="/cidades" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
