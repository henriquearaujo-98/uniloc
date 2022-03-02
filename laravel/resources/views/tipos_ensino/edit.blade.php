@extends('tipos_ensino.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Editar Tipos de Ensino
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
            <form method="post" action="{{ route('tipos_ensino.update', $tipo_ensino->ID ) }}">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="country_name">ID:</label>
                    <input type="text" class="form-control" name="ID" value="{{ $tipo_ensino->ID }}"/>
                </div>
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="country_name">Nome:</label>
                    <input type="text" class="form-control" name="nome" value="{{ $tipo_ensino->nome }}"/>
                </div>
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="/tipos_ensino" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
