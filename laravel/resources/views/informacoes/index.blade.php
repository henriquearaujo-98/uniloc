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
            <div>
                <form action="/searchInfo" method="get">
                    <div class="input-group">
                        <input type="search" name="info" id="info" class="form-control" placeholder="Pesquisar municipio...">
                        <span class="input-group-prepend pl-1">
                            <button type="submit" class="btn btn-primary"> Search </button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                    Informações Municípios
                        </div>
                        <div class="col-md-6 text-right">
                    <a href="{{ route('informacoes.create')}}" class="btn btn-success">Criar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>Município</td>
                            <td>População Residente</td>
                            <td>Densidade populacional</td>
                            <td>Mulheres (%)</td>
                            <td>Homens (%)</td>
                            <td>Jovens (%)</td>
                            <td>População em idade activa (%)</td>
                            <td>Idosos (%)</td>
                            <td>Índice de envelhecimento</td>
                            <td>Indivíduos em idade activa por idoso</td>
                            <td>Solteiros (%)</td>
                            <td>Casados (%)</td>
                            <td>Divorciados (%)</td>
                            <td>Viúvos (%)</td>
                            <td>Famílias222</td>
                            <td>Famílias unipessoais (%)</td>
                            <td>Famílias com 2 pessoas (%)</td>
                            <td>Alojamentos</td>
                            <td>Alojamentos familiares clássicos (%)</td>
                            <td>Alojamentos colectivos (%)</td>
                            <td>Alojamentos ocupados (%)</td>
                            <td>Alojamentos próprios (%)</td>
                            <td>Alojamentos próprios com encargos de compra (%)</td>
                            <td>Alojamentos arrendados e outros casos (%)</td>
                            <td>Renda mensal: <50€</td>
                            <td>Renda mensal: 50€ - 99,99€</td>
                            <td>Renda mensal: 100€ - 199,99€</td>
                            <td>Renda mensal: 200€ - 399,99€</td>
                            <td>Renda mensal: 400€ - 649,99€</td>
                            <td>Renda mensal: 650€ - 999,99€</td>
                            <td>Renda mensal: >=1000€</td>
                            <td>Edificios</td>
                            <td colspan="2"></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($informacoes as $informacao)
                            <tr>
                                <td>{{$informacao->ID}}</td>
                                <td>{{$informacao->municipio->nome}}</td>
                                <td>{{$informacao['População residente']}}</td>
                                <td>{{$informacao['Densidade populacional']}}</td>
                                <td>{{$informacao['Mulheres (%)']}}</td>
                                <td>{{$informacao['Homens (%)']}}</td>
                                <td>{{$informacao['Jovens (%)']}}</td>
                                <td>{{$informacao['População em idade activa (%)']}}</td>
                                <td>{{$informacao['Idosos (%)']}}</td>
                                <td>{{$informacao['Índice de envelhecimento']}}</td>
                                <td>{{$informacao['Indivíduos em idade activa por idoso']}}</td>
                                <td>{{$informacao['Solteiros (%)']}}</td>
                                <td>{{$informacao['Casados (%)']}}</td>
                                <td>{{$informacao['Divorciados (%)']}}</td>
                                <td>{{$informacao['Viúvos (%)']}}</td>
                                <td>{{$informacao['Famílias']}}</td>
                                <td>{{$informacao['Famílias unipessoais (%)']}}</td>
                                <td>{{$informacao['Famílias com 2 pessoas (%)']}}</td>
                                <td>{{$informacao['Alojamentos']}}</td>
                                <td>{{$informacao['Alojamentos familiares clássicos (%)']}}</td>
                                <td>{{$informacao['Alojamentos colectivos (%)']}}</td>
                                <td>{{$informacao['Alojamentos ocupados (%)']}}</td>
                                <td>{{$informacao['Alojamentos próprios (%)']}}</td>
                                <td>{{$informacao['Alojamentos próprios com encargos de compra (%)']}}</td>
                                <td>{{$informacao['Alojamentos arrendados e outros casos (%)']}}</td>
                                <td>{{$informacao['Renda mensal: <50€']}}</td>
                                <td>{{$informacao['Renda mensal: 50€ - 99,99€']}}</td>
                                <td>{{$informacao['Renda mensal: 100€ - 199,99€']}}</td>
                                <td>{{$informacao['Renda mensal: 200€ - 399,99€']}}</td>
                                <td>{{$informacao['Renda mensal: 400€ - 649,99€']}}</td>
                                <td>{{$informacao['Renda mensal: 650€ - 999,99€']}}</td>
                                <td>{{$informacao['Renda mensal: >=1000€']}}</td>
                                <td>{{$informacao['Edificios']}}</td>
                                <td><a href="{{ route('informacoes.edit', $informacao->ID)}}" class="btn btn-warning">Editar</a></td>
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
