@extends('exames.layout')
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
            <form action="/searchExame" method="get">
                <div class="input-group">
                    <input type="search" name="exame" id="exame" class="form-control mb-md-2" placeholder="Pesquisar exame...">
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
                        Exames
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('exames.create')}}" class="btn btn-success">Criar</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover table-condensed">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>Nome</td>
                        <td colspan="2"></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($exames as $exame)
                        <tr>
                            <td>{{$exame->ID}}</td>
                            <td>{{$exame->nome}}</td>
                            <td><a href="{{ route('exames.edit', $exame->ID)}}" class="btn btn-warning">Editar</a></td>
                            <td>
                                <form action="{{ route('exames.destroy', $exame->ID)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{--@endsection--}}
</div>
