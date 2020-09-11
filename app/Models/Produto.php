<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table    = 'produtos';

    public $primaryKey  = 'id';

    protected $keyType  = 'bigInteger';

    protected $casts = [ 
        'id'                => 'integer',
        'fornecedor_id'     => 'integer',
        'nome'              => 'string',
        'descricao'         => 'string',
        'quantidade'        => 'string',
        'valor'             => 'double',
        'custo'             => 'double',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime', 
    ];

    protected $fillable = [ 
        'id',
        'fornecedor_id',
        'nome',
        'descricao',
        'quantidade',
        'valor',
        'custo',
    ];
    
    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }
}
