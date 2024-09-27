# Instalación del proyecto

## Requerimientos
- node
- composer
- mysql (para base de datos)

## Pasos de instalación

Clone el proyecto y luego vaya a la carpeta del proyecto.
``` 
git clone https://github.com/bmiguelbc16/aguadeliciosa_app.git
``` 
Ejemplo:
``` 
cd aguadeliciosa_app
``` 
Instale las dependencias de Composer:
``` 
composer install
``` 
Instale las dependencias de NPM:
``` 
npm install
``` 
Copie .env.examplele archivo y cree un duplicado. Utilice cp comando para usuarios de Linux o Mac.
``` 
cp .env.example .env
``` 
Si está utilizando Windows, utilice copyen lugar de cp.
``` 
copy .env.example .env
``` 
Genere la clave de cifrado de su aplicación:
``` 
php artisan key:generate
``` 

Inicie el servidor localhost:
``` 
npm run start
``` 
