<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informacoes_Municipio extends Model
{
    use HasFactory;

    protected $fillable = [
        'ID',
        'municipio_ID',
        'População residente',
        'Densidade populacional',
        'Mulheres (%)',
        'Homens (%)',
        'Jovens (%)',
        'População em idade activa (%)',
        'Idosos (%)',
        'Índice de envelhecimento',
        'Indivíduos em idade activa por idoso',
        'Solteiros (%)',
        'Casados (%)',
        'Divorciados (%)',
        'Viúvos (%)',
        'Famílias',
        'Famílias unipessoais (%)',
        'Famílias com 2 pessoas (%)',
        'Alojamentos',
        'Alojamentos familiares clássicos (%)',
        'Alojamentos colectivos (%)',
        'Alojamentos ocupados (%)',
        'Alojamentos próprios (%)',
        'Alojamentos próprios com encargos de compra (%)',
        'Alojamentos arrendados e outros casos (%)',
        'Renda mensal: <50€',
        'Renda mensal: 50€ - 99,99€',
        'Renda mensal: 100€ - 199,99€',
        'Renda mensal: 200€ - 399,99€',
        'Renda mensal: 400€ - 649,99€',
        'Renda mensal: 650€ - 999,99€',
        'Renda mensal: >=1000€',
        'Edificios',
    ];

    protected $table = 'informacoes_municipios';

    public function municipio(){
        return $this->belongsTo(Municipio::class, 'municipio_ID','ID');
    }
}
