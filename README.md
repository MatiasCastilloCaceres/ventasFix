# VentasFix - Sistema de Gestión de Ventas

## 📋 Descripción

VentasFix es un sistema de gestión de ventas desarrollado con Laravel 11 que permite administrar usuarios, productos y clientes. Incluye un backoffice completo con interfaz web y API REST para integración con aplicaciones de terceros.

## 🚀 Características

- **CRUD Completo**: Gestión de usuarios, productos y clientes
- **Dashboard**: Panel de control con estadísticas del sistema
- **API REST**: Endpoints completos con autenticación Laravel Sanctum
- **Autenticación**: Sistema de login seguro con middleware
- **Template Vuexy**: Interfaz moderna con Bootstrap 5.3.3
- **Base de Datos**: MySQL con migraciones y seeders

## 🛠️ Tecnologías

- **Backend**: Laravel 11
- **Frontend**: Vuexy Bootstrap Template
- **Base de Datos**: MySQL
- **API**: Laravel Sanctum
- **Autenticación**: Laravel Breeze

## 📦 Instalación

1. Clonar el repositorio:
```bash
git clone https://github.com/MatiasCastilloCaceres/ventasFix.git
cd ventasFix
```

2. Instalar dependencias:
```bash
composer install
```

3. Configurar variables de entorno:
```bash
cp .env.example .env
php artisan key:generate
```

4. Configurar base de datos en `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ventasfix
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. Ejecutar migraciones y seeders:
```bash
php artisan migrate --seed
```

6. Iniciar servidor:
```bash
php artisan serve
```

## 📚 Estructura del Proyecto

### Modelos
- **User**: Gestión de usuarios del sistema
- **Producto**: Catálogo de productos con stock y precios
- **Cliente**: Base de datos de clientes empresariales

### Controladores
- **UsuarioController**: CRUD de usuarios (Web)
- **ProductController**: CRUD de productos (Web)  
- **ClienteController**: CRUD de clientes (Web)
- **DashboardController**: Panel de control
- **API Controllers**: Endpoints REST para cada módulo

### Rutas
- **Web**: `/usuarios`, `/productos`, `/clientes`, `/dashboard`
- **API**: `/api/v1/usuarios`, `/api/v1/productos`, `/api/v1/clientes`

## 🔐 Autenticación

### Web
Acceso mediante login con email y contraseña.

### API
```bash
# Login API
POST /api/v1/login
{
    "email": "usuario@ventasfix.cl",
    "password": "password"
}

# Uso con token
Authorization: Bearer {token}
```

## 📊 Funcionalidades

### Dashboard
- Contador de usuarios registrados
- Contador de productos en catálogo  
- Contador de clientes empresariales
- Estadísticas de uso de API

### Gestión de Usuarios
- Crear, editar, eliminar usuarios
- Validación de email @ventasfix.cl
- Cifrado de contraseñas

### Gestión de Productos
- CRUD completo con validaciones
- Control de stock (actual, mínimo, bajo, alto)
- Precios con IVA incluido (19%)
- Imágenes de productos

### Gestión de Clientes
- Empresas con RUT, razón social, rubro
- Información de contacto
- Direcciones y teléfonos

## 🏗️ Arquitectura

El proyecto sigue el patrón MVC de Laravel:

```
app/
├── Http/
│   ├── Controllers/           # Controladores web
│   │   ├── Api/              # Controladores API
│   │   ├── Auth/             # Autenticación
│   │   └── ...
│   └── Requests/             # Form Requests con validaciones
├── Models/                   # Modelos Eloquent
└── ...

resources/
├── views/
│   ├── layouts/              # Layouts principales
│   ├── auth/                 # Vistas de autenticación
│   ├── usuarios/             # CRUD usuarios
│   ├── productos/            # CRUD productos
│   └── clientes/             # CRUD clientes
└── ...

routes/
├── web.php                   # Rutas web
├── api.php                   # Rutas API
└── auth.php                  # Rutas autenticación
```

## 🔧 Configuración

### Base de Datos
Las migraciones incluyen:
- Tabla `users` con campos requeridos
- Tabla `productos` con stock y precios
- Tabla `clientes` con datos empresariales

### Seeders
- `UsuariosClientesSeeder`: Datos de prueba

## 🤝 Contribución

1. Fork el proyecto
2. Crear rama feature (`git checkout -b feature/nueva-funcionalidad`)
3. Commit cambios (`git commit -am 'Agregar nueva funcionalidad'`)
4. Push a la rama (`git push origin feature/nueva-funcionalidad`)
5. Crear Pull Request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT.

## 👨‍💻 Autor

**Matías Castillo Cáceres**
- Email: matias.castillo.caceres@ciisa.cl
- GitHub: [@MatiasCastilloCaceres](https://github.com/MatiasCastilloCaceres)

---

⭐ Si te gusta este proyecto, ¡dale una estrella en GitHub!
