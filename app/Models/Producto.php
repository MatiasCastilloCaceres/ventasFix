<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'sku',
        'nombre',
        'descripcion_corta',
        'descripcion_larga',
        'imagen',
        'precio_neto',
        'precio_venta',
        'stock_actual',
        'stock_minimo',
        'stock_bajo',
        'stock_alto'
    ];

    protected $casts = [
        'precio_neto' => 'decimal:2',
        'precio_venta' => 'decimal:2',
        'stock_actual' => 'integer',
        'stock_minimo' => 'integer',
        'stock_bajo' => 'integer',
        'stock_alto' => 'integer'
    ];

    // Calculamos automáticamente el precio de venta (IVA incluido)
    public function setPrecioNetoAttribute($value)
    {
        $this->attributes['precio_neto'] = $value;
        $this->attributes['precio_venta'] = $value * 1.19; // 19% IVA
    }

    /**
     * Verificar si el producto está bajo en stock
     */
    public function esBajoStock()
    {
        return $this->stock_actual <= $this->stock_bajo;
    }

    /**
     * Verificar si el producto está fuera de stock
     */
    public function sinStock()
    {
        return $this->stock_actual <= 0;
    }

    /**
     * Scope para productos con stock
     */
    public function scopeConStock($query)
    {
        return $query->where('stock_actual', '>', 0);
    }

    /**
     * Scope para productos con stock bajo
     */
    public function scopeStockBajo($query)
    {
        return $query->whereColumn('stock_actual', '<=', 'stock_bajo');
    }
}
