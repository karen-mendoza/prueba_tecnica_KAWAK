# Sistema de Gestión de Documentos

## Instalación Rápida en XAMPP

### 1. Copiar el proyecto
Coloca la carpeta del proyecto en:
```
C:\xampp\htdocs\prueba_tecnica_KAWAK\
```

### 2. Importar la base de datos
1. Inicia XAMPP y arranca **Apache** y **MySQL**
2. Abre el navegador y ve a: `http://localhost/phpmyadmin`
3. Crea una nueva base de datos llamada: `kawak_db`
4. Importa el archivo SQL proporcionado

### 3. Configurar la conexión
Abre el archivo `config/config.php` y verifica:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'kawak_db');
define('DB_USER', 'root');
define('DB_PASS', '');  // Contraseña vacía por defecto en XAMPP
```

### 4. Acceder a la aplicación
Abre el navegador y ve a:
```
http://localhost/prueba_tecnica_KAWAK/public/
```

## Rutas de la Aplicación

- **Inicio**: `http://localhost/prueba_tecnica_KAWAK/public/`
- **Documentos**: `http://localhost/prueba_tecnica_KAWAK/public/documentos`

## Funcionalidades

✅ Subir documentos (PDF, DOCX, XLSX, JPG, PNG)  
✅ Ver listado de documentos  
✅ Editar nombre de documentos  
✅ Eliminar documentos

## ¿Problemas?

**Página en blanco**: Verifica que Apache y MySQL estén iniciados en XAMPP

**Error de conexión**: Revisa que la base de datos `kawak_db` exista y las credenciales en `config/config.php` sean correctas

**No sube archivos**: Verifica que el tamaño del archivo sea menor a 10 MB