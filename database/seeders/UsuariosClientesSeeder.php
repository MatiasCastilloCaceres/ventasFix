<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;

class UsuariosClientesSeeder extends Seeder
{
    public function run()
    {
        // Verificar si el usuario ya existe
        $existingUser = User::where('email', 'admin@ventasfix.cl')->first();

        if (!$existingUser) {
            // Crear usuario admin
            $user = User::create([
                'rut' => '12345678-9',
                'nombre' => 'Admin',
                'apellido' => 'Sistema',
                'email' => 'admin@ventasfix.cl',
                'password' => Hash::make('password')
            ]);
            echo "✅ Usuario creado: {$user->email}\n";
        } else {
            echo "ℹ️ Usuario ya existe: {$existingUser->email}\n";
        }

        // Crear clientes empresa de ejemplo
        $clientes = [
            [
                'rut_empresa' => '96543210-K',
                'rubro' => 'Tecnología y Desarrollo de Software',
                'razon_social' => 'Innovación Digital SpA',
                'telefono' => '+56912345678',
                'direccion' => 'Av. Apoquindo 4501, Piso 15, Las Condes, Santiago',
                'nombre_contacto' => 'Carlos Eduardo Mendoza',
                'email_contacto' => 'carlos.mendoza@innovaciondigital.cl'
            ],
            [
                'rut_empresa' => '81234567-8',
                'rubro' => 'Retail y Comercio',
                'razon_social' => 'Supermercados del Sur S.A.',
                'telefono' => '+56223456789',
                'direccion' => 'Av. Libertador Bernardo O\'Higgins 1234, Santiago Centro',
                'nombre_contacto' => 'Ana Patricia Rodríguez',
                'email_contacto' => 'ana.rodriguez@supermercadosdelsur.cl'
            ],
            [
                'rut_empresa' => '78901234-5',
                'rubro' => 'Servicios Profesionales',
                'razon_social' => 'Consultora Business Solutions Ltda.',
                'telefono' => '+56234567890',
                'direccion' => 'Av. Providencia 2020, Oficina 802, Providencia',
                'nombre_contacto' => 'Roberto Antonio Silva',
                'email_contacto' => 'roberto.silva@businesssolutions.cl'
            ],
            [
                'rut_empresa' => '89012345-6',
                'rubro' => 'Construcción e Inmobiliaria',
                'razon_social' => 'Constructora Moderna S.A.',
                'telefono' => '+56945678901',
                'direccion' => 'Av. Las Condes 9876, Las Condes, Santiago',
                'nombre_contacto' => 'María Fernanda González',
                'email_contacto' => 'maria.gonzalez@constructoramoderna.cl'
            ],
            [
                'rut_empresa' => '90123456-7',
                'rubro' => 'Salud y Medicina',
                'razon_social' => 'Clínica Integral de Salud Ltda.',
                'telefono' => '+56256789012',
                'direccion' => 'Av. Salvador 3456, Providencia, Santiago',
                'nombre_contacto' => 'Dr. Juan Carlos Martínez',
                'email_contacto' => 'juan.martinez@clinicaintegral.cl'
            ]
        ];

        foreach ($clientes as $clienteData) {
            $existingClient = Cliente::where('rut_empresa', $clienteData['rut_empresa'])->first();

            if (!$existingClient) {
                $cliente = Cliente::create($clienteData);
                echo "✅ Cliente creado: {$cliente->razon_social} - {$cliente->rut_empresa}\n";
            } else {
                echo "ℹ️ Cliente ya existe: {$existingClient->razon_social}\n";
            }
        }

        echo "\n🎉 Usuarios y clientes creados exitosamente!\n";
        echo "📧 Email: admin@ventasfix.cl\n";
        echo "🔑 Password: password\n";
        echo "🏢 Clientes creados: " . count($clientes) . "\n";
    }
}