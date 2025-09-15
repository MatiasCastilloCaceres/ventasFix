<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductosActualizadosSeeder extends Seeder
{
    public function run()
    {
        // Limpiar productos existentes
        Producto::truncate();

        // Crear productos con los nuevos campos
        $productos = [
            [
                'sku' => 'PROD001',
                'nombre' => 'Laptop DELL Inspiron 15',
                'descripcion_corta' => 'Laptop Dell Inspiron 15, Intel Core i5, 8GB RAM',
                'descripcion_larga' => 'Laptop Dell Inspiron 15 de alto rendimiento con procesador Intel Core i5 de 11va generación, 8GB de memoria RAM DDR4, disco SSD de 256GB, pantalla de 15.6 pulgadas Full HD, tarjeta gráfica integrada. Ideal para trabajo de oficina, estudios y entretenimiento.',
                'imagen' => 'https://i.dell.com/is/image/DellContent/content/dam/ss2/product-images/dell-client-products/notebooks/inspiron-notebooks/15-3520/media-gallery/in3520-bk-gallery-1.psd',
                'precio_neto' => 650000,
                'stock_actual' => 5,
                'stock_minimo' => 2,
                'stock_bajo' => 3,
                'stock_alto' => 20
            ],
            [
                'sku' => 'PROD002',
                'nombre' => 'Mouse Logitech MX Master 3',
                'descripcion_corta' => 'Mouse inalámbrico ergonómico de precisión',
                'descripcion_larga' => 'Mouse inalámbrico Logitech MX Master 3 con sensor de alta precisión, batería recargable de larga duración, conectividad Bluetooth y USB, diseño ergonómico para uso profesional, compatible con múltiples dispositivos.',
                'imagen' => 'https://resource.logitechg.com/w_692,c_lpad,ar_4:3,q_auto,f_auto,dpr_1.0/d_transparent.gif/content/dam/logitech/en/products/mice/mx-master-3/gallery/mx-master-3-mouse-top-view-graphite.png',
                'precio_neto' => 89990,
                'stock_actual' => 15,
                'stock_minimo' => 5,
                'stock_bajo' => 8,
                'stock_alto' => 50
            ],
            [
                'sku' => 'PROD003',
                'nombre' => 'Teclado Mecánico RGB',
                'descripcion_corta' => 'Teclado mecánico gaming con iluminación RGB',
                'descripcion_larga' => 'Teclado mecánico gaming con switches azules, iluminación RGB personalizable, teclas anti-ghosting, diseño resistente al agua, cable USB trenzado, compatible con Windows y Mac.',
                'imagen' => 'https://m.media-amazon.com/images/I/61K2B5K2-NL._AC_SL1500_.jpg',
                'precio_neto' => 59990,
                'stock_actual' => 8,
                'stock_minimo' => 3,
                'stock_bajo' => 5,
                'stock_alto' => 30
            ],
            [
                'sku' => 'PROD004',
                'nombre' => 'Monitor Samsung 24" Full HD',
                'descripcion_corta' => 'Monitor LED 24 pulgadas resolución Full HD',
                'descripcion_larga' => 'Monitor Samsung de 24 pulgadas con resolución Full HD 1920x1080, panel VA, frecuencia de actualización de 75Hz, tiempo de respuesta 4ms, conectividad HDMI y VGA, diseño sin bordes.',
                'imagen' => 'https://images.samsung.com/is/image/samsung/p6pim/cl/lf24t350fhlxzs/gallery/cl-f24t35-lf24t350fhlxzs-531853321',
                'precio_neto' => 149990,
                'stock_actual' => 12,
                'stock_minimo' => 4,
                'stock_bajo' => 6,
                'stock_alto' => 25
            ],
            [
                'sku' => 'PROD005',
                'nombre' => 'Smartphone Samsung Galaxy A54',
                'descripcion_corta' => 'Smartphone Samsung Galaxy A54 5G 128GB',
                'descripcion_larga' => 'Samsung Galaxy A54 5G con pantalla Super AMOLED de 6.4 pulgadas, procesador Exynos 1380, 6GB de RAM, 128GB de almacenamiento, cámara principal de 50MP, batería de 5000mAh, Android 13.',
                'imagen' => 'https://images.samsung.com/is/image/samsung/p6pim/cl/sm-a546ezkdltc/gallery/cl-galaxy-a54-5g-sm-a546e-446942-sm-a546ezkdltc-535567796',
                'precio_neto' => 299990,
                'stock_actual' => 7,
                'stock_minimo' => 3,
                'stock_bajo' => 5,
                'stock_alto' => 15
            ],
            [
                'sku' => 'PROD006',
                'nombre' => 'Tablet iPad 10.9"',
                'descripcion_corta' => 'Tablet Apple iPad 10.9 pulgadas 64GB WiFi',
                'descripcion_larga' => 'Apple iPad de 10.9 pulgadas con chip A14 Bionic, pantalla Liquid Retina, 64GB de almacenamiento, Wi-Fi, cámara de 12MP, compatible con Apple Pencil de 1ra generación, disponible en múltiples colores.',
                'imagen' => 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/ipad-finish-select-202210-blue-wifi',
                'precio_neto' => 389990,
                'stock_actual' => 4,
                'stock_minimo' => 2,
                'stock_bajo' => 3,
                'stock_alto' => 10
            ]
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
            echo "✅ Producto creado: {$producto['nombre']} - SKU: {$producto['sku']}\n";
        }

        echo "\n🎉 Productos actualizados creados exitosamente!\n";
        echo "📦 Total productos: " . count($productos) . "\n";
    }
}