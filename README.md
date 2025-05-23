<p align="center"><a href="https://laravel.com" target="_blank"><img src="public/img/logo1.jpg" width="400" alt="InnClod"></a></p>

## Fundacion Prevrenal

Se realiza prueba tectnica CRUD de un proyecto de sistema de gestion de tareas en el  framework laravel 10, livewire 2, bootstrap y MySQL las instrucciones de despliegue son las siguientes:

- Clonar el repositorio (https://github.com/sebasbeltran95/Fundacion-Prevrenal-Prueba.git).
- Descomprimir los archivos vendor.rar y .rar.
- Realizar un composer update.
- Ejecutar la migracion (php artisan migrate).
- Entrar a base de datos en la tabla users puede crear el usuario con el que ingresara al aplicativo o puede ir a la siguiente  ruta dentro del proyecto (routes/web.php), dentro del archivo web encontrara la siguiente linea Auth::routes(['register' => false]);, lo que tiene que hacer es borrar lo quee sta dentro del parentesis Auth::routes(); y con esto se habilitara la ruta register, entrando a esta ruta puede crear los accesos para poder ingresar al aplicativo.
- Para poder inicializar el servidor hacemos lo siguiente: abre el proyecto con visual studio code, luego se procede a abrir la terminar, se ingresa el comando php artisan serve, este comando arrojara la siguiente url http://127.0.0.1:8000, esta url se copia y se pega en el navegador de su preferencia, este paso se realiza despues de haber echo la migracion o de haberse importado la base de datos que se encuentra en el proyecto.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).