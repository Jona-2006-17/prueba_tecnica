# Prueba Técnica - Gestión de Usuarios

Este proyecto consiste en un sistema de gestión de usuarios desarrollado en Laravel.  
Incluye funcionalidades para crear, importar y eliminar usuarios de forma masiva, además de las operaciones básicas de CRUD.

##  Funcionalidades implementadas

- Creación de usuarios de manera individual.  
- Creación masiva de usuarios a partir de archivos CSV/XLSX.  
- Vista previa antes de importar usuarios.  
- Eliminación masiva de usuarios mediante selección con checkboxes.  
- Validación de datos al importar (nombre, email, etc.).  


## Instalación y Configuración

### Clonar el repositorio
```bash
git clone https://github.com/Jona-2006-17/prueba_tecnica.git
cd prueba_tecnica
```

### 2. Instalar dependencias
```bash
composer install
```
### 3. Instalar la librería para importar/exportar archivos CSV/XLSX:
```bash
composer require maatwebsite/excel
```


### 4. Configurar el entorno
```bash
# Copiar el archivo de configuraci�n
cp .env.example .env

```

### 5. Configurar la base de datos
Edita el archivo `.env` con tu configuración de base de datos, utilizar mysql:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=prueba_usuarios
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```


### 6. Ejecutar seeders
```bash
php artisan db:seed
```

### 7. Levantar el servidor de desarrollo
```bash
php artisan serve
```

La aplicación estará disponible en: `http://localhost:8000`

---

