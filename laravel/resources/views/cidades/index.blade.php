@extends('cidades.layout')

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
                    Cidades
                    <a href="{{ route('cidades.create')}}" class="btn btn-primary">Criar</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>Cidade</td>
                            <td>Município</td>
                            <td colspan="2"></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cidades as $cidade)
                            <tr>
                                <td>{{$cidade->ID}}</td>
                                <td>{{$cidade->nome}}</td>
                                <td>{{$cidade->municipio->nome}}</td>
                                <td><a href="{{ route('cidades.edit', $cidade->ID)}}" class="btn btn-primary">Editar</a></td>
                                <td>
                                    <form action="{{ route('cidades.destroy', $cidade->ID)}}" method="post">
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
                        {{$cidades->links("pagination::bootstrap-4")}}
                    </span>
                </div>
            </div>
        </div>
    </div>
    {{--@endsection--}}
</div>
