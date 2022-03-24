@extends('inst_cursos.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Criar Curso de uma Instituição
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
            <form method="post" action="{{ route('inst_cursos.store') }}">
                @csrf
                <div class="form-group">
                    <label for="cursos">Cursos: </label>
                    <select class="select4 form-control" name="cursos_ID" id="cursos_ID">
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
                    <label for="nota1">Nota 1ª Fase: </label>
                    <input type="number" class="form-control" step=".1" min="0" max="200.0" name="nota_ult_1fase"/>
                </div>
                <div class="form-group">
                    <label for="nota2">Nota 2ª Fase: </label>
                    <input type="number" class="form-control" step=".1" min="0" max="200.0" name="nota_ult_2fase"/>
                </div>
                <div class="form-group">
                    <label for="plano">Plano de Estudo: </label>
                    <input type="text" class="form-control" name="plano_curso"/>
                </div>
                <button type="submit" class="btn btn-primary">Criar</button>
                <a href="/inst_cursos" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
