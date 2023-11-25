
# Practica 2

Este proyecto consiste en la creación de una API para Dumbo utilizando Laravel y consumiendola con Angular, utilizando Laravel para el backend y Angular para el frontend. La página WEB consume una API y utiliza autenticación JWT para los permisos.


## Requisitos Previos

 - Instala [Composer](https://getcomposer.org/download/).
 - Instala [PHP](https://www.php.net/manual/es/install.php).
 - Instala [Node.js](https://nodejs.org/en).
 - Instala [Angular CLI](https://angular.io/guide/setup-local).
 - Instala [XAMPP](https://www.apachefriends.org/es/download.html).
 - Instala [Postman](https://www.postman.com/downloads/).

## Frameworks utilizados

- Backend: Laravel 10.10
- Frontend: Angular 16.2.8
- Base de datos: XAMPP


## Configuración de la base de datos (XAMPP)

1. Inicia XAMPP y asegúrate de que Apache y MySQL estén en ejecución.

2. Abre phpMyAdmin [http://localhost/phpmyadmin](http://localhost/phpmyadmin).

3. Crea una nueva base de datos y configura la información en el archivo `.env` del backend.



## Configuración del Backend (Laravel)

1. Clona el repositorio: `git clone https://github.com/xfunktastic/dumbo-api-restful.git`.

2. Abre el proyecto en tu editor de código.

3. Navega al directorio del backend: `cd backend`.
    
4. Instala las dependencias de Composer: `composer install`.
    
5. Copia el archivo de configuración: `cp .env.example .env`.
    
6. Genera la clave de la aplicación: `php artisan key:generate`.

7. Genera la clave secreta de JWT: `php artisan jwt:secret`.
    
8. Configura la base de datos en el archivo con tus datos `.env`.
    
9. Ejecuta las migraciones y los seeders: `php artisan migrate --seed`.
    
10. Inicia el servidor: `php artisan serve`.

El backend será ejecutado en [http://localhost:8000/api/](http://localhost:8000/api/).
## Configuración del Frontend (Angular)

1. Navega al directorio del frontend: `cd frontend`.

2. Instala las dependencias de Node: `npm install`.

3. Inicia la aplicación Angular: `ng serve -o`.

El frontend estará disponible en [http://localhost:4200/login](http://localhost:4200/login).

## Autor

- [@funktastic](https://www.github.com/xfunktastic)

