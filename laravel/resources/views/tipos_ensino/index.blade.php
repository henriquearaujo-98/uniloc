@extends('tipos_ensino.layout')

<style>
    .uper {
        margin-top: 40px;
    }
</style>

<div class="container">
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
                    Tipos de Ensino
                    <a href="{{ route('tipos_ensino.create')}}" class="btn btn-primary">Criar</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Tipo</td>
                                <td colspan="2">Ações</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($tipos_ensino as $tipo_ensino)
                            <tr>
                                <td>{{$tipo_ensino->ID}}</td>
                                <td>{{$tipo_ensino->nome}}</td>
                                <td><a href="{{ route('tipos_ensino.edit', $tipo_ensino->ID)}}" class="btn btn-primary">Editar</a></td>
                                <td>
                                    <form action="{{ route('tipos_ensino.destroy', $tipo_ensino->ID)}}" method="post">
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
    </div>
{{--@endsection--}}
</div>

