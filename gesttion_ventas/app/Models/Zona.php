<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    protected $table = 'zonas';

    protected $primaryKey = 'ID_ZONA';

    protected $fillable = [
        'nombre_zona',
        'descripcion',
    ];

    // Define relaciones si es necesario
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'id_zona');
    }
    public $timestamps = false;

}
