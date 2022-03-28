@extends('informacoes.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Editar Informação do Município
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
            <form method="post" action="{{ route('informacoes.update', $informacao->ID) }}">
                @csrf
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="Nome_Municipio">Município: </label>
                    <select class="select4 form-control" name="municipio_ID" id="municipio_ID">
                        <option value="{{ $informacao->municipio_ID }}">{{$informacao->municipio->nome}}</option>
                        @foreach($municipios as $municipio)
                            <option value="{{$municipio->ID}}" {{$municipio->nome == $municipio->ID ? 'selected' : ''}}>
                                {{$municipio->nome}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="mun">População Residente: </label>
                    <input type="text" class="form-control" name="item['População residente']" value="{{ $informacao['População residente'] }}"/>
                </div>

                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="mun">Famílias: </label>
                    <input type="text" class="form-control" name="Famílias" value="{{ $informacao['Famílias'] }}"/>
                </div>

                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="/informacoes" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
