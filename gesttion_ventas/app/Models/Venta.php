<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';

    protected $primaryKey = 'ID_VENTA';

    protected $fillable = [
        'id_cliente',
        'id_vendedor',
        'id_zona',
        'fecha',
        'monto_total',
    ];

    // Define relaciones si es necesario
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function zona()
    {
        return $this->belongsTo(Zona::class, 'id_zona');
    }

    public function detallesVenta()
    {
        return $this->hasMany(DetalleVenta::class, 'id_venta');
    }
    public $timestamps = false;

}
