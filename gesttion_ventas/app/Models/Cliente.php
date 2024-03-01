<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $primaryKey = 'ID_CLIENTE';

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'direccion',
    ];

    // Define relaciones si es necesario
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'id_cliente');
    }
    public $timestamps = false;

}
