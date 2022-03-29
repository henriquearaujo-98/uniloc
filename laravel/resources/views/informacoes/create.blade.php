@extends('informacoes.layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Criar Informação do Município
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('informacoes.store') }}">
                    @csrf
                <div class="form-group">
                    <label for="Nome_Municipio">Município: </label>
                    <select class="select4 form-control" name="municipio_ID" id="municipio_ID">
                        <option value="">Seleciona um município..</option>
                        @foreach($municipios as $municipio)
                            <option value="{{$municipio->ID}}" {{$municipio->nome == $municipio->ID ? 'selected' : ''}}>
                                {{$municipio->nome}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="mun">População Residente: </label>
                    <input type="text" class="form-control" name="População residente"/>
                </div>

                <div class="form-group">
                    <label for="mun">Densidade Populacional: </label>
                    <input type="text" class="form-control" name="Densidade populacional"/>
                </div>

                <div class="form-group">
                    <label for="mun">Mulheres (%): </label>
                    <input type="text" class="form-control" name="Mulheres (%)"/>
                </div>

                <div class="form-group">
                    <label for="mun">Homens (%): </label>
                    <input type="text" class="form-control" name="Homens (%)"/>
                </div>

                <div class="form-group">
                    <label for="mun">Jovens (%): </label>
                    <input type="text" class="form-control" name="Jovens (%)"/>
                </div>

                <div class="form-group">
                    <label for="mun">População em idade activa (%): </label>
                    <input type="text" class="form-control" name="População em idade activa (%)"/>
                </div>

                <div class="form-group">
                    <label for="mun">Idosos (%): </label>
                    <input type="text" class="form-control" name="Idosos (%)"/>
                </div>

                <div class="form-group">
                    <label for="mun">Índice de Envelhecimento: </label>
                    <input type="text" class="form-control" name="Índice de envelhecimento"/>
                </div>

                <div class="form-group">
                    <label for="mun">Indivíduos em idade activa por idoso: </label>
                    <input type="text" class="form-control" name="Indivíduos em idade activa por idoso"/>
                </div>

                <div class="form-group">
                    <label for="mun">Solteiros (%): </label>
                    <input type="text" class="form-control" name="Solteiros (%)"/>
                </div>

                <div class="form-group">
                    <label for="mun">Casados (%): </label>
                    <input type="text" class="form-control" name="Casados (%)"/>
                </div>

                <div class="form-group">
                    <label for="mun">Divorciados (%): </label>
                    <input type="text" class="form-control" name="Casados (%)"/>
                </div>

                <div class="form-group">
                    <label for="mun">Viúvos (%): </label>
                    <input type="text" class="form-control" name="Viúvos (%)"/>
                </div>

                <div class="form-group">
                    <label for="mun">Famílias: </label>
                    <input type="text" class="form-control" name="Famílias"/>
                </div>

                <div class="form-group">
                    <label for="mun">Famílias unipessoais (%): </label>
                    <input type="text" class="form-control" name="Famílias unipessoais (%)"/>
                </div>

                <div class="form-group">
                    <label for="mun">Famílias com 2 pessoas (%): </label>
                    <input type="text" class="form-control" name="Famílias com 2 pessoas (%)"/>
                </div>

                <div class="form-group">
                    <label for="mun">Alojamentos: </label>
                    <input type="text" class="form-control" name="Alojamentos"/>
                </div>

                <div class="form-group">
                    <label for="mun">Alojamentos familiares clássicos (%): </label>
                    <input type="text" class="form-control" name="Alojamentos familiares clássicos (%)"/>
                </div>

                <div class="form-group">
                    <label for="mun">Alojamentos colectivos (%): </label>
                    <input type="text" class="form-control" name="Alojamentos colectivos (%)"/>
                </div>

                <div class="form-group">
                    <label for="mun">Alojamentos ocupados (%): </label>
                    <input type="text" class="form-control" name="Alojamentos ocupados (%)"/>
                </div>

                <div class="form-group">
                    <label for="mun">Alojamentos próprios (%): </label>
                    <input type="text" class="form-control" name="Alojamentos próprios (%)"/>
                </div>

                <div class="form-group">
                    <label for="mun">Alojamentos próprios com encargos de compra (%): </label>
                    <input type="text" class="form-control" name="Alojamentos próprios com encargos de compra (%)"/>
                </div>

                <div class="form-group">
                    <label for="mun">Alojamentos arrendados e outros casos (%): </label>
                    <input type="text" class="form-control" name="Alojamentos arrendados e outros casos (%)"/>
                </div>

                <div class="form-group">
                    <label for="mun">Renda mensal: <50€: </label>
                    <input type="text" class="form-control" name="Renda mensal: <50€"/>
                </div>

                <div class="form-group">
                    <label for="mun">Renda mensal: 50€ - 99,99€: </label>
                    <input type="text" class="form-control" name="Renda mensal: 50€ - 99,99€"/>
                </div>

                <div class="form-group">
                    <label for="mun">Renda mensal: 100€ - 199,99€: </label>
                    <input type="text" class="form-control" name="Renda mensal: 100€ - 199,99€"/>
                </div>

                <div class="form-group">
                    <label for="mun">Renda mensal: 200€ - 399,99€: </label>
                    <input type="text" class="form-control" name="Renda mensal: 200€ - 399,99€"/>
                </div>

                <div class="form-group">
                    <label for="mun">Renda mensal: 400€ - 649,99€: </label>
                    <input type="text" class="form-control" name="Renda mensal: 400€ - 649,99€"/>
                </div>

                <div class="form-group">
                    <label for="mun">Renda mensal: 650€ - 999,99€: </label>
                    <input type="text" class="form-control" name="Renda mensal: 650€ - 999,99€"/>
                </div>

                <div class="form-group">
                    <label for="mun">Renda mensal: >=1000€: </label>
                    <input type="text" class="form-control" name="Renda mensal: >=1000€"/>
                </div>

                <div class="form-group">
                    <label for="mun">Edificios: </label>
                    <input type="text" class="form-control" name="Edificios"/>
                </div>

                <button type="submit" class="btn btn-primary">Criar</button>
                <a href="/informacoes" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
