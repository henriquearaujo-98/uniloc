@extends('prova_ingresso.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Editar Município
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
            <form method="post" action="{{ route('prova_ingresso.update', $prova_ingresso->ID ) }}">
                @csrf

                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="nome">Curso:</label>
                    <select class="select4 form-control" name="cursoID" id="cursoID">
                        <option value="{{ $prova_ingresso->cursoID }}">{{$prova_ingresso->cursos->nome_curso->nome}}</option>
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
                        <option value="{{ $prova_ingresso->instituicoes_ID }}">{{$prova_ingresso->insts->nome_inst->nome}}</option>
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
                    <label for="nome">Exames:</label>
                    <input type="text" class="form-control" name="exames_ID" value="{{ $prova_ingresso->exames_id }}"/>
                </div>
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="/prova_ingresso" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
