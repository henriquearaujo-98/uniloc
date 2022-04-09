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

    <div style="margin-top: 20px">
        <h6>Número total de registos na base de dados: {{$total}}</h6>
        <div class="card">
            <ul class="list-group">
                <li class="list-group-item">Distritos: {{$distritos}}</li>
                <li class="list-group-item">Municípios: {{$municipios}}</li>
                <li class="list-group-item">Informações Muniípios: {{$info_mun}}</li>
                <li class="list-group-item">Cidades: {{$cidades}}</li>
                <li class="list-group-item">Códigos Postais: {{$cod_pos}}</li>
                <li class="list-group-item">Instituições: {{$inst}}</li>
                <li class="list-group-item">Tipos de Ensino: {{$tipos_ensino}}</li>
                <li class="list-group-item">Cursos por Instituições: {{$cursos_inst}}</li>
                <li class="list-group-item">Provas de Ingresso: {{$provas}}</li>
                <li class="list-group-item">Exames: {{$exames}}</li>
                <li class="list-group-item">Cursos: {{$cursos}}</li>
                <li class="list-group-item">Áreas de Estudo: {{$areas}}</li>
                <li class="list-group-item">Utilizadores: {{$users}}</li>
            </ul>
        </div>
    </div>
</div>

