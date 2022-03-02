@extends('tipos_ensino.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Criar Tipo de Ensino
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
            <form method="post" action="{{ route('tipos_ensino.store') }}">
                <div class="form-group">
                    @csrf
                    <label for="id_tipo">ID: </label>
                    <input type="text" class="form-control" name="ID"/>
                </div>
                <div class="form-group">
                    <label for="nome_tipo">Nome: </label>
                    <input type="text" class="form-control" name="nome"/>
                </div>
                <button type="submit" class="btn btn-primary">Criar</button>
                <a href="/tipos_ensino" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
