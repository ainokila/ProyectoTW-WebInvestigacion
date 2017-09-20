# Proyecto Investigación - Tecnologías Web - Curso 16/17

# Manual
## Manual de Usuario

### Registro e Inicio de Sesión.
Para empezar, debe abrir la página web , y una vez abierta debe hacer clic encima de la opción Registrar, arriba a la derecha.

![](http://i68.tinypic.com/24qua9x.png)

Al hacer clic, nos llevará a la página `Registrar`, dónde rellenaremos el formulario para registrarnos.

Una vez registrados, hacemos clic en `Iniciar Sesión`, junto a `Registrar`.

Estando en `Iniciar Sesión`, introducimos nuestros credenciales y le damos a Login, y ya estaremos iniciados en la página.

### Creación de Proyectos y Publicaciones.

Haciendo clic en `Añadir Publicación` o `Añadir Proyecto` en el menú de la izquierda podremos añadir, editar o eliminar una de estas.

Para crear una Publicación, habrá que haber creado antes un Proyecto, ya que será necesario indicar el `Código` del proyecto a la Publicación y que este sea correcto, o si no, no se creará.

Para crear un nuevo Proyecto , vamos a `Añadir Proyecto` a la izquierda, y rellenamos el formulario de creación.
Finalmente, hacemos clic en `Crear`y el Proyecto se creará en la base de datos.

Crear una Publicación es igual, con la única excepción de que habrá que poner el código del Proyecto sobre el que vamos a hacer la Publicación.

De la misma forma, se podrá Actualizar o Eliminar una Publicación/Proyecto.

## Manual de Administrador
Para empezar, debe abrir la página web `https://void.ugr.es/~saytes1617/investiga/php/instalar.php`, y sólo por primera vez, podremos crear un administrador del sistema y la base de datos del mismo. Si ya se hizo con anterioridad, se deberá instalar todo de nuevo.

Una vez creado, se podrá iniciar sesión con él, y se obtendrá la  opción de editar a los miembros de la base de datos, ver el log del sistema y ver una backup de la base de datos, aparte de las opciones ya adquiridas al ser usuario.

El funcionamiento de la opción `Editar Usuarios` es igual que el de las opciones `Añadir Publicación` o `Añadir Proyecto`.

Si hacemos clic en la opción `Ver Log` o `Backup`podremos consultar el log del sistema o la backup de la base de datos, respectivamente, que en este último caso, se muestra por pantalla, al no tener permisos para poder restaurar una BBDD creada anteriormente.

# Diseño de la Web

En primer lugar, diseñamos el HTML y CSS de la página. Una vez hecho esto, seccionamos el HTML y el CSS, para generarlo dinámicamente a través de PHP, aparte de las diversas funciones en PHP usadas durante la práctica.

Después, creamos el modelo entidad-relación mencionado con anterioridad y ejecutamos las sentencias SQL para generar las tablas.

A continuación creamos las consultas de manera estática y comprobamos que funcionaban, y a posteri las incorporamos en las funciones de PHP para hacerlo de forma dinámica, siempre saneando las entradas del usuario.


# Explicaciones oportunas sobre el Proyecto
Antes de comenzar una instalación, debemos configurar el fichero credenciales.php en el cual se almacenan la IP de la base de datos, el nombre de esta, el nombre del usuario y la contraseña, los cuáles harán falta para realizar todas las peticiones a la BBDD.

En caso de que queramos hacer un backup deberíamos copiar lo que nos devuelve el apartado `Backup` , teniendo la sesión iniciada como administrador, y después pegándolo en PhpMyAdmin.

### Realizado por Jorge Gutiérrez Segovia y Cristian Vélez Ruiz

