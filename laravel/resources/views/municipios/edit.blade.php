@extends('municipios.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Editar Município
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
            <form method="post" action="{{ route('municipios.update', $municipio->ID ) }}">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="id">ID:</label>
                    <input type="text" class="form-control" name="ID" value="{{ $municipio->ID }}"/>
                </div>
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="nome">Município:</label>
                    <input type="text" class="form-control" name="nome" value="{{ $municipio->nome }}"/>
                </div>
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="nome">Distrito:</label>
                    <input type="text" class="form-control" name="distritos_ID" value="{{ $municipio->distritos_ID }}"/>
                </div>
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="/municipios" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
