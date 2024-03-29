@extends('prova_ingresso.layout')
@include('dashboard')

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

    <div style="margin-top: 10px">
        <div>
            <form action="/searchProvas" method="get">
                <div class="input-group">
                    <input type="search" name="provas" id="provas" class="form-control mb-md-2" placeholder="Pesquisar instituição ou curso...">
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
                        Provas de Ingresso</div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('prova_ingresso.create')}}" class="btn btn-success">Criar</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover table-condensed">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>Curso</td>
                        <td>Instituição</td>
                        <td>Código dos Exames</td>
                        <td colspan="2"></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($provas_ingresso as $prova_ingresso)
                        <tr>
                            <td>{{$prova_ingresso->ID}}</td>
                            <td>{{$prova_ingresso->cursos->nome_curso->nome}}</td>
                            <td>{{$prova_ingresso->insts->nome_inst->nome}}</td>
                            <td>{{$prova_ingresso->exames_id}}</td>
                            <td><a href="{{ route('prova_ingresso.edit', $prova_ingresso->ID)}}" class="btn btn-warning">Editar</a></td>
                            <td>
                                <form action="{{ route('prova_ingresso.destroy', $prova_ingresso->ID)}}" method="post">
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
                    {{$provas_ingresso->withQueryString()->links("pagination::bootstrap-4")}}
                </span>
            </div>
        </div>
    </div>
    {{--@endsection--}}
</div>
