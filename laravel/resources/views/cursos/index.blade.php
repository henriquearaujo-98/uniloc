@extends('cursos.layout')

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
            <div>
                <form action="/searchCurso" method="get">
                    <div class="input-group">
                        <input type="search" name="curso" id="curso" class="form-control" placeholder="Pesquisar curso...">
                        <span class="input-group-prepend pl-1">
                            <button type="submit" class="btn btn-primary"> Search </button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Cursos
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('cursos.create')}}" class="btn btn-success">Criar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>Nome</td>
                            <td>Área de Estudo</td>
                            <td colspan="2"></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cursos as $curso)
                            <tr>
                                <td>{{$curso->ID}}</td>
                                <td>{{$curso->nome}}</td>
                                <td>{{$curso->area_estudo->nome}}</td>
                                <td><a href="{{ route('cursos.edit', $curso->ID)}}" class="btn btn-warning">Editar</a></td>
                                <td>
                                    <form action="{{ route('cursos.destroy', $curso->ID)}}" method="post">
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
                        {{$cursos->links("pagination::bootstrap-4")}}
                    </span>
                </div>
            </div>
        </div>
    </div>
    {{--@endsection--}}
</div>
