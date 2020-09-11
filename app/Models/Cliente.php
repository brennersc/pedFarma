<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table    = 'clientes';
    
    public $primaryKey  = 'id';
    
    protected $keyType  = 'bigInteger';
    
    protected $casts = [
        'id'            => 'integer',
        'nome'          => 'string',
        'cpf'           => 'string',
        'email'         => 'string',        
        'telefone'      => 'string',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',        
    ];

    protected $fillable = [      
        'id',
        'nome',
        'cpf',
        'email',        
        'telefone',
    ];

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }
}
