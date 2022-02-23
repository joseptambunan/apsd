<?php

namespace Modules\Stock\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockTransaction extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Stock\Database\factories\StockTransactionFactory::new();
    }

    public function barang(){
        return $this->belongsTo("Modules\Stock\Entities\Stock","stock_id");
    }

    public function user(){
        return $this->belongsTo("Modules\User\Entities\User","user_id");
    }
}
