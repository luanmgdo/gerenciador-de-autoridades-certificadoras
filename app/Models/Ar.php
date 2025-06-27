<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ar extends Model
{
    use HasFactory;

    protected $table = 'ar';  // Tabela no banco de dados
    protected $fillable = [
        'id', 'nome', 'cnpj', 'tipo', 'situacao', 'credenciamento', 'telefone', 'ac_n2_id'
    ];

    public function acN2()
    {
        return $this->belongsTo(AcN2::class);
    }
}
