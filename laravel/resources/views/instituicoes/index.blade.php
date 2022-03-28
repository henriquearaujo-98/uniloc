@extends('instituicoes.layout')
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
                    <form action="/searchInst" method="get">
                        <div class="input-group">
                            <input type="search" name="inst" id="inst" class="form-control mb-md-2" placeholder="Pesquisar instituição ou ensino...">
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
                                Instituições
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('instituicoes.create')}}" class="btn btn-success">Criar</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-condensed">
                            <thead>
                            <tr>
                                <td>#</td>
                                <td>Nome</td>
                                <td>Tipo de Ensino</td>
                                <td>Código Postal</td>
                                <td>Latitude</td>
                                <td>Longitude</td>
                                <td>Rank</td>
                                <td colspan="2"></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($instituicoes as $instituicao)
                                <tr>
                                    <td>{{$instituicao->ID}}</td>
                                    <td>{{$instituicao->nome}}</td>
                                    <td>{{$instituicao->tipo_ensino->nome}}</td>
                                    <td>{{$instituicao->codigo_postal->cod_postal}} - {{$instituicao->codigo_postal->cidade->nome}}</td>
                                    <td>{{$instituicao->latitude}}</td>
                                    <td>{{$instituicao->longitude}}</td>
                                    <td>{{$instituicao->rank}}</td>
                                    <td><a href="{{ route('instituicoes.edit', $instituicao->ID)}}" class="btn btn-warning">Editar</a></td>
                                    <td>
                                        <form action="{{ route('instituicoes.destroy', $instituicao->ID)}}" method="post">
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
                            {{$instituicoes->withQueryString()->links("pagination::bootstrap-4")}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--@endsection--}}
</div>
