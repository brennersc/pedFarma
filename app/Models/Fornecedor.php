<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table    = 'fornecedores';
    
    public $primaryKey  = 'id';
    
    protected $keyType  = 'bigInteger';
    
    protected $casts = [
        'id'            => 'integer',
        'nome_fantasia' => 'string',
        'razao_social'  => 'string',
        'cnpj'          => 'string',
        'email'         => 'string',        
        'telefone'      => 'string',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',        
    ];

    protected $fillable = [      
        'id',
        'nome_fantasia',
        'razao_social',
        'cnpj',
        'email',        
        'telefone',
    ];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
