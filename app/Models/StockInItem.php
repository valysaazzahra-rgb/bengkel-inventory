<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockInItem extends Model
{
protected $fillable = ['stock_in_id','sparepart_id','qty','price','subtotal'];

public function stockIn(){ return $this->belongsTo(StockIn::class); }
public function sparepart(){ return $this->belongsTo(Sparepart::class); }
}
