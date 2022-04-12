@extends('users.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Criar Utilizador
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
            <form method="post" action="{{ route('users.store') }}">
                @csrf
                <div class="form-group">
                    @csrf
                    <label for="name_user">Nome: </label>
                    <input type="text" class="form-control" name="name"/>
                </div>
                <div class="form-group">
                    @csrf
                    <label for="mail_user">E-mail: </label>
                    <input type="email" class="form-control" name="email"/>
                </div>
                <div class="form-group">
                    @csrf
                    <label for="pass_user">Password: </label>
                    <input type="password" class="form-control" name="password"/>
                </div>
                <button type="submit" class="btn btn-primary">Criar</button>
                <a href="/users" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
