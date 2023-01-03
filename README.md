

# Proyecto Xentral

Recomendación

Para una mejor estabilidad en cuanto al uso del docker y las consultar, es necesario tener una sistema operativo linux
e instalar Docker. 

Se ha configurado el siguiente proyecto:

1) Un contenedor de back-end con la imagen oficial de dockerhub php: 7.4-fpm PHP versión 7.4 y Supervisor con el comando php artisan queue: trabajo.

2) Un contenedor front-end para el cliente con la imagen de node oficial de dockerhub: CLI más reciente y angular.

3) Un contenedor front-end para el administrador con la imagen de node oficial de dockerhub: CLI más reciente y angular.

4) Un contenedor mysql con mysql oficial: 5.7 imagen de dockerhub.

6) Un contenedor de servidor web con la imagen oficial de dockerhub nginx: alpine

## Inicializar el Docker


El archivo /docker/app-backend/supervisor/supervisord.conf está vinculado en el contenedor de backend. La edición de ese archivo se replica instantáneamente en el contenedor.

Primera instalación

Hacer una copia del archivo .env.example para configurar el proyecto y el nombre de usuario que se creará para DB mysql

`cp .env.example .env`

Después:

`docker-compose build`

Esperar a que todo esté configurado

Después:

`docker-compose up -d`

Una vez que se inicializan todos los contenedores, debe conectarse al contenedor backend:

`docker exec -t -i backend / bin / bash`

ya nos encontraremos en la carpeta / var / www / app-backend

Continúe con la copia del archivo .env.example (cambie solo el nombre, el usuario y la contraseña de mysql db con la misma instancia de .env docker)

`cp .env.example .env`

Instalamos todas las dependencias del laravel:

`composer install`

Para el backend no es necesario ejecutar el comando php artisan porque el contenedor nginx está vinculado en la carpeta pública laraver

En cuanto a la interfaz (Angular), me aseguré de exponer el 4100 para el administrador y el 4200 para el cliente, de esta manera edita el archivo localmente pero lo vincula en la ventana acoplable al instante y angular cli hace el resto en la ventana acoplable.

Así que aquí están los enlaces actualmente configurados:

Backend: `localhost:8080`

Cliente: `localhost:4100`

Landlord: `localhost:4200`

# Proyecto Xentral

Ambiente Local - Backend con Docker

Para ejecutar solo el backend con docker y docker-compose se ha creado un dockerfile y un docker-compose.

1) Un contenedor de back-end con la imagen oficial de dockerhub php: 7.4-fpm PHP versión 7.4.

2) Un contenedor mysql con mysql oficial: 5.7 imagen de dockerhub.

Backend: `localhost:8080`

Ambiente Local - Frontend

Para ejecutar el frontend tanto del cliente como el administador es necesario tener instalado npm versión 14 y angular cli. 

Inicializar con el comando
`npm run star o ng serve`






