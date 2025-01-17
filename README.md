es# Proyecto Laravel + Vue



---

### General Info
***
Este proyecto es una aplicación desarrollada con **Laravel** en el backend y **Vue.js** en el frontend. La aplicación permite realizar operaciones de autenticación de usuarios, gestionar perfiles y mostrar datos en una interfaz moderna y eficiente.

- **Estado del proyecto**: En desarrollo.
- **Objetivo**: Crear una plataforma donde los usuarios puedan registrarse, iniciar sesión y visualizar sus perfiles.


## Technologies
***
A continuación se muestra una lista de las tecnologías utilizadas en este proyecto:

* [Laravel](https://laravel.com): Version 11.x
* [Vue.js](https://vuejs.org/): Version 3.x
* [Tailwind CSS](https://tailwindcss.com/): Version 3.x
* [Axios](https://axios-http.com/): Version 1.x (para peticiones HTTP)
* [SQLite](https://www.sqlite.org/): Base de datos local

---

## Installation
***
Sigue estos pasos para configurar y ejecutar el proyecto localmente:

1. **Clonar el repositorio**:
   ```bash
   git clone https://github.com/frankylua/login-vue-laravel
   cd proyecto-vue-laravel

2. **Instalar dependencias de PHP**:

    cd laravel
    composer install

3. **Configurar la base de datos**:

    Asegúrate de que la carpeta database/ existe en el directorio de tu proyecto.
    Crea el archivo de base de datos SQLite: database.sqlite dentro de la carpeta database/

4. **Generar la clave de la aplicación**:

    php artisan key:generate

5. **Ejecutar Migraciones**:

    php artisan migrate

6. **Instalar dependencias de Javascript**

    cd ..
    cd vue-proyect
    npm install

7. **Iniciar servidor Laravel**  

    php artisan serve

8. **Iniciar servidor de Vue.js** 

    npm run serve