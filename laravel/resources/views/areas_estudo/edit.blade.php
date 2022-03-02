@extends('areas_estudo.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Editar Áreas de Estudo
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
            <form method="post" action="{{ route('areas_estudo.update', $area_estudo->ID ) }}">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="id_area">ID:</label>
                    <input type="text" class="form-control" name="ID" value="{{ $area_estudo->ID }}"/>
                </div>
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="area_nome">Nome:</label>
                    <input type="text" class="form-control" name="nome" value="{{ $area_estudo->nome }}"/>
                </div>
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="/areas_estudo" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
