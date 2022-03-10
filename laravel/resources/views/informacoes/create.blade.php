@extends('informacoes.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Criar Informação do Município
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
            <form method="post" action="{{ route('informacoes.store') }}">
                    @csrf
                <div class="form-group">
                    <label for="Nome_Municipio">Município: </label>
                    <select class="select4 form-control" name="municipio_ID" id="municipio_ID">
                        <option value="">Seleciona um município..</option>
                        @foreach($municipios as $municipio)
                            <option value="{{$municipio->ID}}" {{$municipio->nome == $municipio->ID ? 'selected' : ''}}>
                                {{$municipio->nome}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="mun">População Residente: </label>
                    <input type="text" class="form-control" name="['População residente']"/>
                </div>
                <button type="submit" class="btn btn-primary">Criar</button>
                <a href="/instituicoes" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
