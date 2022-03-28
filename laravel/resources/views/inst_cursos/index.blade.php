@extends('inst_cursos.layout')
@include('menu')

<style>
    .uper {
        margin-top: 40px;
    }
</style>

<div class="container mb-5">
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if (session()->get('danger'))
        <div class="alert alert-danger">
            {{ session()->get('danger') }}
        </div>
    @endif

    <div style="margin-top: 45px">
        <div class="col">
            <div class="col-md-12">
                <div>
                    <form action="/searchInst_Curso" method="get">
                        <div class="input-group">
                            <input type="search" name="inst_curso" id="inst_curso" class="form-control mb-md-2" placeholder="Pesquisar Instituição ou Curso...">
                            <span class="input-group-prepend pl-1">
                                <button type="submit" class="btn btn-primary mb-md-2"> Search </button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                Instituições e Cursos
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('inst_cursos.create')}}" class="btn btn-success">Criar</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-condensed">
                            <thead>
                            <tr>
                                <td>Curso</td>
                                <td>Instituição</td>
                                <td>Nota 1ª Fase</td>
                                <td>Nota 2ª Fase</td>
                                <td>Plano Estudo</td>
                                <td colspan="2"></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($inst_cursos as $inst_curso)
                                <tr>
                                    <td>{{$inst_curso->nome_curso->nome}}</td>
                                    <td>{{$inst_curso->nome_inst->nome}}</td>
                                    <td>{{$inst_curso->nota_ult_1fase}}</td>
                                    <td>{{$inst_curso->nota_ult_2fase}}</td>
                                    <td>{{$inst_curso->plano_curso}}</td>
                                    <td><a href="{{ route('inst_cursos.edit', ['cursoID'=>$inst_curso->cursos_ID, 'instID'=>$inst_curso->instituicoes_ID])}}"
                                           method="get" class="btn btn-primary">Editar</a></td>
{{--                                    <td><a class="btn btn-warning" href="{{route('inst_cursos.edit',['cursoID'=>$inst_curso->cursos_ID,'instID'=>$inst_curso->instituicoes_ID])}}">Show</a></td>--}}
                                    <td>
                                        <form action="{{ route('inst_cursos.destroy', ['cursoID'=>$inst_curso->cursos_ID, 'instID'=>$inst_curso->instituicoes_ID])}}"
                                              method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <span class="pagination justify-content-center">
                            {{$inst_cursos->withQueryString()->links("pagination::bootstrap-4")}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--@endsection--}}
</div>
