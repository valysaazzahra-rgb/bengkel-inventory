<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
protected $fillable = ['trx_no','date','type','customer_name','total','note','created_by'];

public function items(){ return $this->hasMany(StockOutItem::class); }
public function creator(){ return $this->belongsTo(\App\Models\User::class,'created_by'); }
}
