<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $primaryKey = 'ID_PRODUCTO';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'categoria',
    ];

    // Define relaciones si es necesario
    public function detallesVenta()
    {
        return $this->hasMany(DetalleVenta::class, 'id_producto');
    }
    public $timestamps = false;

}
