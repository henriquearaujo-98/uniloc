@extends('prova_ingresso.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Criar Município
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
            <form method="post" action="{{ route('prova_ingresso.store') }}">
                @csrf
                <div class="form-group">
                    <label for="cursos">Cursos: </label>
                    <select class="select4 form-control" name="cursoID" id="cursoID">
                        <option value="">Seleciona um curso...</option>
                        @foreach($cursos as $curso)
                            <option value="{{$curso->ID}}" {{$curso->nome == $curso->ID ? 'selected' : ''}}>
                                {{$curso->nome}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="inst">Instituição: </label>
                    <select class="select4 form-control" name="instituicoes_ID" id="instituicoes_ID">
                        <option value="">Seleciona uma instituição..</option>
                        @foreach($instituicoes as $instituicao)
                            <option value="{{$instituicao->ID}}" {{$instituicao->nome == $instituicao->ID ? 'selected' : ''}}>
                                {{$instituicao->nome}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="Nome_exames">Exames: </label>
                    <input type="text" class="form-control" name="exames_ID"/>
                </div>
                <button type="submit" class="btn btn-primary">Criar</button>
                <a href="/prova_ingresso" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
