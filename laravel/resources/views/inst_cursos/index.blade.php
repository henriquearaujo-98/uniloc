@extends('inst_cursos.layout')

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

    <div class="row" style="margin-top: 45px">
        <div class="col-md-12">
            <input type="text" name="searchfor" id="" class="form-control mb-md-2">
            <div class="card">
                <div class="card-header">
                    Instituições e Cursos
                    <a href="{{ route('inst_cursos.create')}}" class="btn btn-primary">Criar</a>
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
{{--                                <td><a href="{{ route('inst_cursos.edit', ['curso'=>$inst_curso->cursos_ID, 'inst'=>$inst_curso->instituicoes_ID])}}"--}}
{{--                                       class="btn btn-primary">Editar</a></td>--}}
                                <td><a class="btn btn-success" href="{{route('inst_cursos.edit',['cursoID'=>$inst_curso->cursos_ID,'instID'=>$inst_curso->instituicoes_ID])}}">Show</a></td>
{{--                                <td>--}}
{{--                                    <form action="{{ route('inst_cursos.destroy', ['curso'=>$inst_curso->cursos_ID, 'isnt'=>$inst_curso->instituicoes_ID])}}"--}}
{{--                                          method="post">--}}
{{--                                        @csrf--}}
{{--                                        @method('DELETE')--}}
{{--                                        <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Eliminar</button>--}}
{{--                                    </form>--}}
{{--                                </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <span class="pagination justify-content-center">
                        {{$inst_cursos->links("pagination::bootstrap-4")}}
                    </span>
                </div>
            </div>
        </div>
    </div>
    {{--@endsection--}}
</div>
