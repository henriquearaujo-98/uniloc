@extends('informacoes.layout')

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
                    Informações Municípios
                    <a href="{{ route('informacoes.create')}}" class="btn btn-primary">Criar</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>Município</td>
                            <td>População Residente</td>
                            <td colspan="2"></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($informacoes as $informacao)
                            <tr>
                                <td>{{$informacao->ID}}</td>
                                <td>{{$informacao->municipio->nome}}</td>
                                <td>{{$informacao->Edificios}}</td>
                                <td><a href="{{ route('informacoes.edit', $informacao->ID)}}" class="btn btn-primary">Editar</a></td>
                                <td>
                                    <form action="{{ route('informacoes.destroy', $informacao->ID)}}" method="post">
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
                        {{$informacoes->links("pagination::bootstrap-4")}}
                    </span>
                </div>
            </div>
        </div>
    </div>
    {{--@endsection--}}
</div>
