<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ac extends Model
{
    use HasFactory;

    protected $table = 'ac';  

    protected $fillable = [
        'id', 'nome', 'cnpj', 'tipo', 'situacao', 'credenciamento', 'telefone'
    ];

    public function acN2()
    {
        return $this->hasMany(AcN2::class);
    }
}
