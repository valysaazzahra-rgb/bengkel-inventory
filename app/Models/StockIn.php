<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
protected $fillable = ['invoice_no','supplier_id','date','total','note','created_by'];

public function supplier(){ return $this->belongsTo(Supplier::class); }
public function items(){ return $this->hasMany(StockInItem::class); }
public function creator(){ return $this->belongsTo(\App\Models\User::class,'created_by'); }
}
