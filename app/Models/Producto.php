<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

     // Relación One To Many / de uno a muchos
	public function ventaDetalle(){
		return $this->hasMany(ventaDetalle::class);
	}

    // Relación de Muchos a Uno
	/*
	public function user(){
		return $this->belongsTo(user::class, 'user_id');
	}*/
}
