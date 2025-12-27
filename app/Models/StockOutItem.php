<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockOutItem extends Model
{
protected $fillable = ['stock_out_id','sparepart_id','qty','price','subtotal'];

public function stockOut(){ return $this->belongsTo(StockOut::class); }
public function sparepart(){ return $this->belongsTo(Sparepart::class); }
}
