<?php

namespace Modules\Stock\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Stock\Entities\Stock;
use Modules\Stock\Entities\StockTransaction;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Stock\Database\factories\StockFactory::new();
    }

    public function details(){
        return $this->hasMany("Modules\Stock\Entities\StockTransaction");
    }
}
