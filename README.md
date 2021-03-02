## Aplicación simple de inventario

---

Para la aplicación se usó el framework Slim V4 y su complemento Slim/php-view, donde el primero se usa para generar rutas de una manera ordenada y el segundo para renderizar las vistas de la aplicación.

Para instalar las dependencias se requiere **composer**, y correr el comando `composer install`, sin embargo, al ser una aplicación pequeña adjunto la carpeta **vendor** para evitar este paso; por lo que lo único que se requiere para correr la aplicación es tener instalado algún servidor de php.

Se hace uso de una libreria propia llamada DB.php en la carpeta Helpers, la cual es una simplificación de los métodos básicos de MySql bajo la instancia de PDO.

La aplicación está dividida en una carpeta Models que contiene la lógica de la base de datos, mientras que la carpeta controller solo se encarga de llamar las funciones del modelo según las peticiones obtenidas de las Vistas, las cuales se encuentran en la carpeta Views.

El archivo base de la aplicación es index.php, ubicado en la carpeta raíz.

Especificación base de datos.

Para guardar la información se usa MySQL, la base de datos se llama **inventario** y la tabla donde se hacen todas las operaciones se llama **productos**.

Para la configuración local de la base de datos, se hace en el archivo DB.php en la carpeta Helpers

Adjunto query para la creación de la tabla:
~~~mysql
CREATE TABLE `productos` (
`ID` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`nombre` VARCHAR(50) NOT NULL COLLATE 'utf8_spanish_ci',
`referencia` VARCHAR(50) NOT NULL COLLATE 'utf8_spanish_ci',
`categoria` VARCHAR(50) NOT NULL COLLATE 'utf8_spanish_ci',
`stock` INT(11) NOT NULL,
`fechaCreacion` DATE NOT NULL,
`UltimaVenta` DATETIME NULL DEFAULT NULL,
PRIMARY KEY (`ID`)
)
COLLATE='utf8_spanish_ci'
ENGINE=InnoDB
;
