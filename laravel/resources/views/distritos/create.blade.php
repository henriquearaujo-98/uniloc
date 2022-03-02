@extends('distritos.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Criar Distrito
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
            <form method="post" action="{{ route('distritos.store') }}">
                <div class="form-group">
                    @csrf
                    <label for="id_distrito">ID: </label>
                    <input type="text" class="form-control" name="ID"/>
                </div>
                <div class="form-group">
                    <label for="Nome_distrito">Nome: </label>
                    <input type="text" class="form-control" name="Nome"/>
                </div>
                <button type="submit" class="btn btn-primary">Criar</button>
                <a href="/distritos" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
