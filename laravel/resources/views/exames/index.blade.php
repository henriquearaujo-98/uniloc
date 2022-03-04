@extends('exames.layout')

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
                    Exames
                    <a href="{{ route('exames.create')}}" class="btn btn-primary">Criar</a>
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
                                <td>{{$exame->Codigo}}</td>
                                <td>{{$exame->Nome}}</td>
                                <td><a href="{{ route('exames.edit', $exame->Codigo)}}" class="btn btn-primary">Editar</a></td>
                                <td>
                                    <form action="{{ route('exames.destroy', $exame->Codigo)}}" method="post">
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
