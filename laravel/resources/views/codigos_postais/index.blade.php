@extends('codigos_postais.layout')

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
                    Códigos Postais
                    <a href="{{ route('codigos_postais.create')}}" class="btn btn-primary">Criar</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <td>Código Postal</td>
                            <td>Cidade</td>
                            <td colspan="2"></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($codigos_postais as $codigo_postal)
                            <tr>
                                <td>{{$codigo_postal->cod_postal}}</td>
                                <td>{{$codigo_postal->cidade->nome}}</td>
                                <td><a href="{{ route('codigos_postais.edit', $codigo_postal->cod_postal)}}" class="btn btn-primary">Editar</a></td>
                                <td>
                                    <form action="{{ route('codigos_postais.destroy', $codigo_postal->cod_postal)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <span>
                        {{$codigos_postais->links("pagination::bootstrap-4")}}
                    </span>
                </div>
            </div>
        </div>
    </div>
    {{--@endsection--}}
</div>
