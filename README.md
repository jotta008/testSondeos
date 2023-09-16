# Test Sondeos


## Configuración Inicial

Sigue estos pasos para configurar y ejecutar el proyecto.

### Clonar Repositorio

Primero, clona el repositorio en tu máquina local utilizando el siguiente comando:

```bash
git clone https://github.com/jotta008/testSondeos.git
```

### Ejecutar 
```bash
composer install
```
### Luego desde consola de linux o WSL
```bash
./vendor/bin/sail up
```
### Desde consola de docker
```bash
php artisan migrate
php artisan db:seed
php artisan db:seed --class=UsersTableSeeder
php artisan db:seed --class=Gender

```
## Ya puedes ingresar en el navegador a la url http://localhost



### Comandos CLI
```bash
php artisan genders getAll
php artisan genders getById 2
php artisan genders create
php artisan genders update 2
php artisan genders delete 2

php artisan books getAll
php artisan books getById 2
php artisan books create
php artisan books update 2
php artisan books delete 2

```   

### Para consultas por api importar el archivo Sondeos.postman_collection.json en postman
### Generar token de autenticación
```bash
http://localhost/api/v1/login
```
### URLs de libros
```bash
http://localhost/api/v1/get-books/
http://localhost/api/v1/get-book/
http://localhost/api/v1/create-book/
http://localhost/api/v1/update-book/
http://localhost/api/v1/delete-book/
```
### URLs de géneros
```bash
http://localhost/api/v1/get-genders/
http://localhost/api/v1/get-gender/
http://localhost/api/v1/create-gender/
http://localhost/api/v1/update-gender/
http://localhost/api/v1/delete-gender/
```

