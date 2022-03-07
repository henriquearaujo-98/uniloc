@extends('exames.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Editar Exame
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
            <form method="post" action="{{ route('exames.update', $exame->Codigo ) }}">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="id_exame">Código:</label>
                    <input type="text" class="form-control" name="Codigo" value="{{ $exame->Codigo }}"/>
                </div>
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="exame_nome">Nome:</label>
                    <input type="text" class="form-control" name="Nome" value="{{ $exame->Nome }}"/>
                </div>
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="/exames" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
