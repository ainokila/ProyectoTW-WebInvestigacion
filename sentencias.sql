 CREATE DATABASE proyectoinvestigacion;

 USE proyectoinvestigacion;


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

INSERT INTO miembros( usuario, password, nombre, categoria,direccion, tel, email,privilegios)
VALUES("admin", "8cb2237d0679ca88db6464eac60da96345513964", "Administrador", "Administrador", "C/Administrativa Nº1", "666666666", "admin@local.es","0");

INSERT INTO proyectos(codigo,titulo,descripcion,comienzo,fin,entidades,cuantia,inv_principal,inv_secundarios,url)
VALUES("1111", "Proyecto 1", "Un proyecto muy bonito.", "2017-06-19", "2017-06-19","Caixa","12345", "Saytes","Compis de Saytes", "http://www.publicacion.com");

INSERT INTO publicacion(doi,titulo,autores,fechapub,resumen,palabras_clave,url,proyecto_vin)
 VALUES("11111", "Proyecto 1", "Cristian y Jorge.", "2017-06-19","Una publicación extensa.","Mogollón de Palabras clave", "http://www.proyecto.com","1111");
