@extends('users.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Editar Utilizador
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
            <form method="post" action="{{ route('users.update', $user->id ) }}">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="nome_user">Nome:</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}"/>
                </div>
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="mail_user">E-mail:</label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}"/>
                </div>
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="/users" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
