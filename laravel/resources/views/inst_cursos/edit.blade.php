@extends('inst_cursos.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Editar Curso da Instituição
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
            <form method="post" action="{{ route('inst_cursos.update', $inst_curso->cursos_ID, $inst_curso->instituicoes_ID)}}">
                @csrf
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="nome">Curso:</label>
                    <select class="select4 form-control" name="cursos_ID" id="cursos_ID">
                        <option value="{{ $inst_curso->cursos_ID }}">{{$inst_curso->nome_curso->nome}}</option>
                        @foreach($cursos as $curso)
                            <option value="{{$curso->ID}}" {{$curso->nome == $curso->ID ? 'selected' : ''}}>
                                {{$curso->nome}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="nome">Instituição:</label>
                    <select class="select4 form-control" name="instituicoes_ID" id="instituicoes_ID">
                        <option value="{{ $inst_curso->instituicoes_ID }}">{{$inst_curso->nome_inst->nome}}</option>
                        @foreach($instituicoes as $instituicao)
                            <option value="{{$instituicao->ID}}" {{$instituicao->nome == $instituicao->ID ? 'selected' : ''}}>
                                {{$instituicao->nome}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="nome">Nota 1ª Fase:</label>
                    <input type="number" class="form-control" step=".1" min="0" max="200.0" name="nota_ult_1fase" value="{{ $inst_curso->nota_ult_1fase }}"/>
                </div>

                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="nome">Nota 2ª Fase:</label>
                    <input type="number" class="form-control" step=".1" min="0" max="200.0" name="nota_ult_2fase" value="{{ $inst_curso->nota_ult_2fase }}"/>
                </div>

                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="nome">Plano de Estudo:</label>
                    <input type="text" class="form-control" name="plano_curso" value="{{ $inst_curso->plano_curso }}"/>
                </div>

                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="/inst_cursos" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
