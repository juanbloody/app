<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ventaDetalle extends Model
{
    use HasFactory;
	public $timestamps = false;

    // Relación de Muchos a Uno
	public function venta(){
		return $this->belongsTo(venta::class, 'venta_id');
	}

    // Relación de Muchos a Uno
	public function producto(){
		return $this->belongsTo(producto::class, 'producto_id');
	}
}
