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
            <input type="text" name="searchfor" id="" class="form-control mb-md-2">
            <div class="card">
                <div class="card-header">
                    Cursos
                    <a href="{{ route('cursos.create')}}" class="btn btn-primary">Criar</a>
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
                                <td><a href="{{ route('cursos.edit', $curso->ID)}}" class="btn btn-primary">Editar</a></td>
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
