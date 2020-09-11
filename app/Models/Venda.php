<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{

    protected $table = 'vendas';

    public $primaryKey = 'id';

    protected $keyType = 'bigInteger';

    protected $casts = [ 
        'id'                => 'integer',
        'cliente_id'        => 'integer',
        'forma_pagamento'   => 'string',
        'vendedor'          => 'string',
        'parcelas'          => 'integer',
        'acrescimo'         => 'double',
        'desconto'          => 'double',
        'total'             => 'double',
        'observacao'        => 'string',
        'status'            => 'string',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime', 
    ];

    protected $fillable = [ 
        'id' ,
        'cliente_id',
        'forma_pagamento',
        'vendedor',
        'parcelas',
        'acrescimo',
        'desconto',
        'total',
        'observacao',
        'status',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
