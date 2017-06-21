# Proyecto Investigación - Tecnologías Web - Curso 16/17
### Realizado por Jorge Gutiérrez Segovia y Cristian Vélez Ruiz

Usuarios Creados por defecto:

Usuario - Contraseña

saytes - 12345 - Permisos de Administrador

ainokila - 12345 - Permisos de Usuario

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


# Creación de la BBDD

![](http://i66.tinypic.com/xoh3j7.jpg)

Miembros( __usuario__ , password, categoria, direccion, telefono, email)

Proyectos( __codpro__ , titulo, descripcion, comienzo, fin, colaboradores, cuantia, inves_prin, inves_sec, url)

Publicacion( __doi__ , titulo, autores, fecha, resumen, palabras-clave, url)

Compone( __codpro , usuario__)

Publicacion_tiene( __doi__ , titulo, autores, fecha, resumen, palabras-clave, url,codpro)

		CREATE TABLE IF NOT EXISTS miembros(
		    usuario varchar(30) not null PRIMARY KEY,
		    password varchar(100) not null ,
		    nombre varchar(30) not null,
		    categoria varchar(30) not null,
		    direccion varchar(30) not null,
		    tel varchar(12) not null,
		    email varchar(30) not null,
		    privilegios int not null default 2
		);

		CREATE TABLE IF NOT EXISTS proyectos(
		    codigo varchar(30) not null PRIMARY KEY,
		    titulo varchar(30) not null ,
		    descripcion varchar(500) not null,
		    comienzo date not null,
		    fin date not null,
		    entidades varchar(100),
		    cuantia int not null,
		    inv_principal varchar(200) not null,
		    inv_secundarios varchar(400) not null,
		    url varchar(100) not null
		);

		CREATE TABLE IF NOT EXISTS publicacion(
		    doi varchar(30) not null PRIMARY KEY,
		    titulo varchar(30) not null ,
		    autores varchar(200) not null,
		    fechapub date not null,
		    resumen varchar(500) not null,
		    palabras_clave varchar(100),
		    url varchar(100) not null,
		    proyecto_vin varchar(30) not null,
		    FOREIGN KEY (proyecto_vin) REFERENCES proyectos(codigo)
		);

		CREATE TABLE IF NOT EXISTS realizapub(
		    doi_pub varchar(30) not null,
		    usuario_miembro varchar(30) not null,
		    CONSTRAINT FK_DOI_ERROR FOREIGN KEY (doi_pub) REFERENCES publicacion(doi),
		    CONSTRAINT FK_NOMBRE_ERROR FOREIGN KEY (usuario_miembro) REFERENCES miembros(usuario),
		    PRIMARY KEY(doi_pub,usuario_miembro)
		);

		CREATE TABLE IF NOT EXISTS compone(
		    codigo_pro varchar(30) not null,
		    usuario_miembro varchar(30) not null,
		    CONSTRAINT FK_CODIGO_ERROR FOREIGN KEY (codigo_pro) REFERENCES proyectos(codigo),
		    CONSTRAINT FK_USUARIO_ERROR FOREIGN KEY (usuario_miembro) REFERENCES miembros(usuario),
		    PRIMARY KEY(codigo_pro,usuario_miembro)
		);

# Diseño de la Web

En primer lugar, diseñamos el HTML y CSS de la página. Una vez hecho esto, seccionamos el HTML y el CSS, para generarlo dinámicamente a través de PHP, aparte de las diversas funciones en PHP usadas durante la práctica.

Después, creamos el modelo entidad-relación mencionado con anterioridad y ejecutamos las sentencias SQL para generar las tablas.

A continuación creamos las consultas de manera estática y comprobamos que funcionaban, y a posteri las incorporamos en las funciones de PHP para hacerlo de forma dinámica, siempre saneando las entradas del usuario.


# Explicaciones oportunas sobre el Proyecto
Antes de comenzar una instalación, debemos configurar el fichero credenciales.php en el cual se almacenan la IP de la base de datos, el nombre de esta, el nombre del usuario y la contraseña, los cuáles harán falta para realizar todas las peticiones a la BBDD.

En caso de que queramos hacer un backup deberíamos copiar lo que nos devuelve el apartado `Backup` , teniendo la sesión iniciada como administrador, y después pegándolo en PhpMyAdmin.
