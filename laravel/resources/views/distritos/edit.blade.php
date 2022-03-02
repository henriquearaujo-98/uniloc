@extends('distritos.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Editar Distritos
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
            <form method="post" action="{{ route('distritos.update', $distrito->ID ) }}">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="id">ID:</label>
                    <input type="text" class="form-control" name="ID" value="{{ $distrito->ID }}"/>
                </div>
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" name="Nome" value="{{ $distrito->nome }}"/>
                </div>
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="/distritos" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
