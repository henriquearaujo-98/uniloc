@extends('municipios.layout')

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
                <form action="/searchMunicipio" method="get">
                    <div class="input-group">
                        <input type="search" name="municipio" id="municipio" class="form-control" placeholder="Pesquisar municipio...">
                        <span class="input-group-prepend pl-1">
                            <button type="submit" class="btn btn-primary"> Search </button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header">
                    Municípios
                    <a href="{{ route('municipios.create')}}" class="btn btn-primary">Criar</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>Município</td>
                            <td>Distrito</td>
                            <td colspan="2"></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($municipios as $municipio)
                            <tr>
                                <td>{{$municipio->ID}}</td>
                                <td>{{$municipio->nome}}</td>
                                <td>{{$municipio->distrito->nome}}</td>
                                <td><a href="{{ route('municipios.edit', $municipio->ID)}}" class="btn btn-primary">Editar</a></td>
                                <td>
                                    <form action="{{ route('municipios.destroy', $municipio->ID)}}" method="post">
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
                        {{$municipios->links("pagination::bootstrap-4")}}
                    </span>
                </div>
            </div>
        </div>
    </div>
    {{--@endsection--}}
</div>
