<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcN2 extends Model
{
    use HasFactory;

    protected $table = 'ac_n2';  // Tabela no banco de dados

    protected $fillable = [
        'id', 'nome', 'cnpj', 'tipo', 'situacao', 'credenciamento', 'telefone', 'ac_id'
    ];

    public function ac()
    {
        return $this->belongsTo(Ac::class);
    }

    public function ars()
    {
        return $this->hasMany(Ar::class);
    }
}
