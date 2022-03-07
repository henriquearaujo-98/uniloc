@extends('cursos.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Criar Curso
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
            <form method="post" action="{{ route('cursos.store') }}">
                <div class="form-group">
                    @csrf
                    <label for="id">ID: </label>
                    <input type="text" class="form-control" name="ID"/>
                </div>
                <div class="form-group">
                    <label for="Nome">Nome: </label>
                    <input type="text" class="form-control" name="nome"/>
                </div>
                <div class="form-group">
                    <label for="area_Estudo">Área de Estudo: </label>
                    <select class="select4 form-control" name="area_curso_ID" id="area_curso_ID">
                        <option value="">Seleciona um distrito..</option>
                        @foreach($areas_estudo as $area_estudo)
                            <option value="{{$area_estudo->ID}}" {{$area_estudo->nome == $area_estudo->ID ? 'selected' : ''}}>
                                {{$area_estudo->nome}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Criar</button>
                <a href="/cursos" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
