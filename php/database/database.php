<?php 

// Carga la información de la conexión con la base de datos
require_once 'config/db.php';

// Crea una nueva conexión a la base de datos
$database = new Database();
$db = $database->connect();

// Genera las tablas en la base de datos si no están creadas
function db_construct($conexion){
    $sql = "CREATE TABLE IF NOT EXISTS usuarios (
        id INT(10) AUTO_INCREMENT NOT NULL,
        user VARCHAR(100) NOT NULL,
        nombre VARCHAR(100) NOT NULL,
        apellidos VARCHAR(100),
        email VARCHAR(100) NOT NULL,
        password VARCHAR(100) NOT NULL,
        telefono INT(20),
        rango VARCHAR(100) NOT NULL,
        CONSTRAINT pk_usuarios PRIMARY KEY(id),
        CONSTRAINT uq_email UNIQUE(email)
        ) ENGINE=InnoDb DEFAULT CHARSET=utf8;";
    mysqli_query($conexion, $sql);

    $sql = "CREATE TABLE IF NOT EXISTS noticias (
        id INT(10) AUTO_INCREMENT NOT NULL,
        autor INT(10) NOT NULL,
        nombre VARCHAR(100) NOT NULL,
        short TEXT NOT NULL,
        texto MEDIUMTEXT NOT NULL,
        imagen VARCHAR(255),
        CONSTRAINT pk_noticias PRIMARY KEY(id),
        CONSTRAINT fk_noticia_usuario FOREIGN KEY(autor) REFERENCES usuarios(id)
        ) ENGINE=InnoDb DEFAULT CHARSET=utf8;";
    mysqli_query($conexion, $sql);

    $sql = "CREATE TABLE IF NOT EXISTS clientes (
        id INT(10) AUTO_INCREMENT NOT NULL,
        nombre VARCHAR(100) NOT NULL,
        apellidos VARCHAR(255),
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(100),
        CONSTRAINT pk_clientes PRIMARY KEY(id),
        CONSTRAINT uq_email UNIQUE(email),
        CONSTRAINT uq_phone UNIQUE(phone)
        ) ENGINE=InnoDb DEFAULT CHARSET=utf8;";
    mysqli_query($conexion, $sql);

    $sql = "CREATE TABLE IF NOT EXISTS proyectos (
        id INT(10) AUTO_INCREMENT NOT NULL,
        nombre VARCHAR(100) NOT NULL,
        imagen VARCHAR(255),
        tecnologia VARCHAR(100) NOT NULL,
        descripcion TEXT,
        link VARCHAR(255),
        CONSTRAINT pk_proyectos PRIMARY KEY(id),
        CONSTRAINT uq_nombre UNIQUE(nombre)
        ) ENGINE=InnoDb DEFAULT CHARSET=utf8;";
    mysqli_query($conexion, $sql);

    $sql = "CREATE TABLE IF NOT EXISTS citas (
        id INT(10) AUTO_INCREMENT NOT NULL,
        cliente_id INT(10) NOT NULL,
        fecha DATETIME NOT NULL,
        motivo MEDIUMTEXT NOT NULL,
        CONSTRAINT pk_citas PRIMARY KEY(id),
        CONSTRAINT fk_cita_cliente FOREIGN KEY(cliente_id) REFERENCES clientes(id)
        ) ENGINE=InnoDb DEFAULT CHARSET=utf8;";
    mysqli_query($conexion, $sql);

    return true;
}

db_construct($db);

// Comprueba si la tabla usuarios está vacía
function check_usuarios($conexion){
    $sql = "SELECT * FROM usuarios";
    $usuarios = mysqli_query($conexion, $sql);
    if ($usuarios -> num_rows == 0) {
        return true;
    }else {
        return false;
    }
}

// Si se ha ejecutado correctamente la creación de tablas, se crea el usuario admin
if (db_construct($db) && check_usuarios($db)) {
    // Cifrar la contraseña
    $password_admin = password_hash('1234', PASSWORD_BCRYPT, ['cost' => 4]);

    $sql = "INSERT INTO usuarios VALUES(null, 'admin', 'Víctor', 'León', 'victor@admin.com', '$password_admin', null, 'admin');";
     $crear_admin = mysqli_query($db, $sql);
}

// Añadir noticias asociadas a admin

// Comprueba si la tabla proyectos está vacía
function check_proyectos($conexion){
    $sql = "SELECT * FROM proyectos";
    $proyectos = mysqli_query($conexion, $sql);
    if ($proyectos -> num_rows == 0) {
        return true;
    }else {
        return false;
    }
}
check_proyectos($db);

// Añadir proyectos ya realizados
if (db_construct($db) && check_proyectos($db)) {
    $sql = "INSERT INTO proyectos VALUES
        (null, 'Al Agua Patos', 'http://justbecauseyes.com/img-webs/alaguapatos.png', 'Prestashop', 'Tienda online con Prestashop', 'https://www.alaguapatos.es/'),
        (null, 'Alcalá Deportes', 'http://justbecauseyes.com/img-webs/alcala.png', 'Prestashop', 'Tienda online con Prestashop', 'https://alcaladeporte.com/'),
        (null, 'Altonadock', 'http://justbecauseyes.com/img-webs/altona.png', 'Prestashop', 'Tienda online con Prestashop', 'https://www.atonadock.com/'),
        (null, 'Aventure Zapaterías', 'http://justbecauseyes.com/img-webs/aventure.png', 'Prestashop', 'Tienda online con Prestashop', 'http://aventurezapaterias.com/'),
        (null, 'Barei', 'http://justbecauseyes.com/img-webs/barei.png', 'Prestashop', 'Tienda online con Prestashop', 'https://bareishop.com'),
        (null, 'Deportes Blanes', 'http://justbecauseyes.com/img-webs/blanes.png', 'Prestashop', 'Tienda online con Prestashop', 'https://www.deportesblanes.com/'),
        (null, 'Bo3', 'http://justbecauseyes.com/img-webs/bo3.png', 'Prestashop', 'Tienda online con Prestashop', 'http://bo3.es/'),
        (null, 'Casa Joven', 'http://justbecauseyes.com/img-webs/casajoven.png', 'Prestashop', 'Tienda online con Prestashop', 'https://casajovenonline.com/'),
        (null, 'Enrique Pellejero Moda', 'http://justbecauseyes.com/img-webs/enrique.png', 'Prestashop', 'Tienda online con Prestashop', 'https://enriquepellejeromoda.com/'),
        (null, 'Farrutx', 'http://justbecauseyes.com/img-webs/farrutx.png', 'Prestashop', 'Tienda online con Prestashop', 'https://www.farrutx.com/'),
        (null, 'La Folie Santander', 'http://justbecauseyes.com/img-webs/folie-700x500_c.png', 'Prestashop', 'Tienda online con Prestashop', 'https://lafoliesantander.com/'),
        (null, 'Gamo Sport', 'http://justbecauseyes.com/img-webs/gamo.png', 'Prestashop', 'Tienda online con Prestashop', 'http://gamosport.com/')
    ;";
     mysqli_query($db, $sql);
}

// Comprueba si la tabla noticias está vacía
function check_noticias($conexion){
    $sql = "SELECT * FROM noticias";
    $noticias = mysqli_query($conexion, $sql);
    if ($noticias -> num_rows == 0) {
        return true;
    }else {
        return false;
    }
}
check_noticias($db);

// Añadir noticias 
if (db_construct($db) && check_noticias($db)) {
    $sql = "INSERT INTO noticias VALUES
        (null, 1, 'HTML5', 'Lenguaje de estructura básica de páginas web.', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse lobortis sapien in justo rutrum, eget fringilla nibh iaculis. Nullam id dolor id libero venenatis commodo sit amet eget dui. Morbi lobortis accumsan diam, in egestas quam aliquam efficitur. Mauris hendrerit ornare dui a ornare. In felis urna, sodales et semper ac, semper pharetra magna. Integer elementum, arcu et molestie porttitor, mauris nunc porta velit, gravida commodo lorem risus non orci. Nam efficitur vehicula purus eu aliquam. Praesent vitae ex est. Morbi auctor nunc nulla, sit amet venenatis risus dignissim nec. Aenean viverra purus vel pretium maximus. Aliquam molestie diam at elit finibus, non ultricies massa pharetra. Phasellus sollicitudin volutpat libero nec mattis. Suspendisse id dui ac erat malesuada volutpat. Proin sit amet ornare ligula, non posuere justo. Suspendisse feugiat magna suscipit lacinia interdum.

Morbi eu mattis augue, nec elementum ipsum. Etiam pulvinar nisl et iaculis ornare. Aliquam lacinia ante quis neque porttitor ultrices. In ullamcorper dolor purus, quis mollis nibh lacinia eu. Morbi efficitur felis in justo tristique, sit amet euismod orci interdum. Sed sagittis est lorem, at ultrices sapien tristique ullamcorper. Nulla nibh libero, dapibus a volutpat eget, porttitor porttitor ligula. Fusce ut urna sed diam cursus gravida. Maecenas a suscipit diam. Ut consequat velit ut felis scelerisque vestibulum sed non dolor. Vivamus eleifend ante nec lectus cursus, sed blandit tellus vehicula. Proin vel libero at magna ultrices vestibulum ut et augue. Fusce risus nulla, dapibus eget risus a, scelerisque pretium leo.

Curabitur rutrum nibh quis ligula aliquet consectetur. Morbi felis nibh, vestibulum sed arcu quis, varius tempor mauris. Proin ac erat tortor. Aliquam odio nibh, sollicitudin nec dui sed, mollis tempor ipsum. Nunc aliquet sem eget urna tempus semper tristique nec metus. Pellentesque finibus tristique consectetur. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras ac erat a nisl feugiat rutrum id in massa. Integer scelerisque velit non magna placerat aliquam. In molestie cursus nulla, ut fermentum mauris pellentesque et. Pellentesque id scelerisque ipsum. Proin ac justo nec felis vulputate gravida. ', 'http://localhost/php/assets/images/html.jpg'),
        (null, 1, 'CSS3', 'Hojas de estilos para páginas web visualmente agradables.', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse lobortis sapien in justo rutrum, eget fringilla nibh iaculis. Nullam id dolor id libero venenatis commodo sit amet eget dui. Morbi lobortis accumsan diam, in egestas quam aliquam efficitur. Mauris hendrerit ornare dui a ornare. In felis urna, sodales et semper ac, semper pharetra magna. Integer elementum, arcu et molestie porttitor, mauris nunc porta velit, gravida commodo lorem risus non orci. Nam efficitur vehicula purus eu aliquam. Praesent vitae ex est. Morbi auctor nunc nulla, sit amet venenatis risus dignissim nec. Aenean viverra purus vel pretium maximus. Aliquam molestie diam at elit finibus, non ultricies massa pharetra. Phasellus sollicitudin volutpat libero nec mattis. Suspendisse id dui ac erat malesuada volutpat. Proin sit amet ornare ligula, non posuere justo. Suspendisse feugiat magna suscipit lacinia interdum.

Morbi eu mattis augue, nec elementum ipsum. Etiam pulvinar nisl et iaculis ornare. Aliquam lacinia ante quis neque porttitor ultrices. In ullamcorper dolor purus, quis mollis nibh lacinia eu. Morbi efficitur felis in justo tristique, sit amet euismod orci interdum. Sed sagittis est lorem, at ultrices sapien tristique ullamcorper. Nulla nibh libero, dapibus a volutpat eget, porttitor porttitor ligula. Fusce ut urna sed diam cursus gravida. Maecenas a suscipit diam. Ut consequat velit ut felis scelerisque vestibulum sed non dolor. Vivamus eleifend ante nec lectus cursus, sed blandit tellus vehicula. Proin vel libero at magna ultrices vestibulum ut et augue. Fusce risus nulla, dapibus eget risus a, scelerisque pretium leo.

Curabitur rutrum nibh quis ligula aliquet consectetur. Morbi felis nibh, vestibulum sed arcu quis, varius tempor mauris. Proin ac erat tortor. Aliquam odio nibh, sollicitudin nec dui sed, mollis tempor ipsum. Nunc aliquet sem eget urna tempus semper tristique nec metus. Pellentesque finibus tristique consectetur. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras ac erat a nisl feugiat rutrum id in massa. Integer scelerisque velit non magna placerat aliquam. In molestie cursus nulla, ut fermentum mauris pellentesque et. Pellentesque id scelerisque ipsum. Proin ac justo nec felis vulputate gravida. ', 'http://localhost/php/assets/images/css.png'),
        (null, 1, 'Bootstrap', 'Biblioteca de estilos para maquetar de forma rápida.', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse lobortis sapien in justo rutrum, eget fringilla nibh iaculis. Nullam id dolor id libero venenatis commodo sit amet eget dui. Morbi lobortis accumsan diam, in egestas quam aliquam efficitur. Mauris hendrerit ornare dui a ornare. In felis urna, sodales et semper ac, semper pharetra magna. Integer elementum, arcu et molestie porttitor, mauris nunc porta velit, gravida commodo lorem risus non orci. Nam efficitur vehicula purus eu aliquam. Praesent vitae ex est. Morbi auctor nunc nulla, sit amet venenatis risus dignissim nec. Aenean viverra purus vel pretium maximus. Aliquam molestie diam at elit finibus, non ultricies massa pharetra. Phasellus sollicitudin volutpat libero nec mattis. Suspendisse id dui ac erat malesuada volutpat. Proin sit amet ornare ligula, non posuere justo. Suspendisse feugiat magna suscipit lacinia interdum.

Morbi eu mattis augue, nec elementum ipsum. Etiam pulvinar nisl et iaculis ornare. Aliquam lacinia ante quis neque porttitor ultrices. In ullamcorper dolor purus, quis mollis nibh lacinia eu. Morbi efficitur felis in justo tristique, sit amet euismod orci interdum. Sed sagittis est lorem, at ultrices sapien tristique ullamcorper. Nulla nibh libero, dapibus a volutpat eget, porttitor porttitor ligula. Fusce ut urna sed diam cursus gravida. Maecenas a suscipit diam. Ut consequat velit ut felis scelerisque vestibulum sed non dolor. Vivamus eleifend ante nec lectus cursus, sed blandit tellus vehicula. Proin vel libero at magna ultrices vestibulum ut et augue. Fusce risus nulla, dapibus eget risus a, scelerisque pretium leo.

Curabitur rutrum nibh quis ligula aliquet consectetur. Morbi felis nibh, vestibulum sed arcu quis, varius tempor mauris. Proin ac erat tortor. Aliquam odio nibh, sollicitudin nec dui sed, mollis tempor ipsum. Nunc aliquet sem eget urna tempus semper tristique nec metus. Pellentesque finibus tristique consectetur. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras ac erat a nisl feugiat rutrum id in massa. Integer scelerisque velit non magna placerat aliquam. In molestie cursus nulla, ut fermentum mauris pellentesque et. Pellentesque id scelerisque ipsum. Proin ac justo nec felis vulputate gravida. ', 'http://localhost/php/assets/images/bootstrap.png'),
        (null, 1, 'JavaScript', 'Programación para proveer de dinamismo a nuestros diseños.', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse lobortis sapien in justo rutrum, eget fringilla nibh iaculis. Nullam id dolor id libero venenatis commodo sit amet eget dui. Morbi lobortis accumsan diam, in egestas quam aliquam efficitur. Mauris hendrerit ornare dui a ornare. In felis urna, sodales et semper ac, semper pharetra magna. Integer elementum, arcu et molestie porttitor, mauris nunc porta velit, gravida commodo lorem risus non orci. Nam efficitur vehicula purus eu aliquam. Praesent vitae ex est. Morbi auctor nunc nulla, sit amet venenatis risus dignissim nec. Aenean viverra purus vel pretium maximus. Aliquam molestie diam at elit finibus, non ultricies massa pharetra. Phasellus sollicitudin volutpat libero nec mattis. Suspendisse id dui ac erat malesuada volutpat. Proin sit amet ornare ligula, non posuere justo. Suspendisse feugiat magna suscipit lacinia interdum.

Morbi eu mattis augue, nec elementum ipsum. Etiam pulvinar nisl et iaculis ornare. Aliquam lacinia ante quis neque porttitor ultrices. In ullamcorper dolor purus, quis mollis nibh lacinia eu. Morbi efficitur felis in justo tristique, sit amet euismod orci interdum. Sed sagittis est lorem, at ultrices sapien tristique ullamcorper. Nulla nibh libero, dapibus a volutpat eget, porttitor porttitor ligula. Fusce ut urna sed diam cursus gravida. Maecenas a suscipit diam. Ut consequat velit ut felis scelerisque vestibulum sed non dolor. Vivamus eleifend ante nec lectus cursus, sed blandit tellus vehicula. Proin vel libero at magna ultrices vestibulum ut et augue. Fusce risus nulla, dapibus eget risus a, scelerisque pretium leo.

Curabitur rutrum nibh quis ligula aliquet consectetur. Morbi felis nibh, vestibulum sed arcu quis, varius tempor mauris. Proin ac erat tortor. Aliquam odio nibh, sollicitudin nec dui sed, mollis tempor ipsum. Nunc aliquet sem eget urna tempus semper tristique nec metus. Pellentesque finibus tristique consectetur. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras ac erat a nisl feugiat rutrum id in massa. Integer scelerisque velit non magna placerat aliquam. In molestie cursus nulla, ut fermentum mauris pellentesque et. Pellentesque id scelerisque ipsum. Proin ac justo nec felis vulputate gravida. ', 'http://localhost/php/assets/images/javascript.png'),
        (null, 1, 'jQuery', 'Funciones avanzadas de interacción con el usuario.', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse lobortis sapien in justo rutrum, eget fringilla nibh iaculis. Nullam id dolor id libero venenatis commodo sit amet eget dui. Morbi lobortis accumsan diam, in egestas quam aliquam efficitur. Mauris hendrerit ornare dui a ornare. In felis urna, sodales et semper ac, semper pharetra magna. Integer elementum, arcu et molestie porttitor, mauris nunc porta velit, gravida commodo lorem risus non orci. Nam efficitur vehicula purus eu aliquam. Praesent vitae ex est. Morbi auctor nunc nulla, sit amet venenatis risus dignissim nec. Aenean viverra purus vel pretium maximus. Aliquam molestie diam at elit finibus, non ultricies massa pharetra. Phasellus sollicitudin volutpat libero nec mattis. Suspendisse id dui ac erat malesuada volutpat. Proin sit amet ornare ligula, non posuere justo. Suspendisse feugiat magna suscipit lacinia interdum.

Morbi eu mattis augue, nec elementum ipsum. Etiam pulvinar nisl et iaculis ornare. Aliquam lacinia ante quis neque porttitor ultrices. In ullamcorper dolor purus, quis mollis nibh lacinia eu. Morbi efficitur felis in justo tristique, sit amet euismod orci interdum. Sed sagittis est lorem, at ultrices sapien tristique ullamcorper. Nulla nibh libero, dapibus a volutpat eget, porttitor porttitor ligula. Fusce ut urna sed diam cursus gravida. Maecenas a suscipit diam. Ut consequat velit ut felis scelerisque vestibulum sed non dolor. Vivamus eleifend ante nec lectus cursus, sed blandit tellus vehicula. Proin vel libero at magna ultrices vestibulum ut et augue. Fusce risus nulla, dapibus eget risus a, scelerisque pretium leo.

Curabitur rutrum nibh quis ligula aliquet consectetur. Morbi felis nibh, vestibulum sed arcu quis, varius tempor mauris. Proin ac erat tortor. Aliquam odio nibh, sollicitudin nec dui sed, mollis tempor ipsum. Nunc aliquet sem eget urna tempus semper tristique nec metus. Pellentesque finibus tristique consectetur. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras ac erat a nisl feugiat rutrum id in massa. Integer scelerisque velit non magna placerat aliquam. In molestie cursus nulla, ut fermentum mauris pellentesque et. Pellentesque id scelerisque ipsum. Proin ac justo nec felis vulputate gravida. ', 'http://localhost/php/assets/images/jquery.png'),
        (null, 1, 'PHP 7', 'Recopila datos y devuelve resultados a tus visitantes.', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse lobortis sapien in justo rutrum, eget fringilla nibh iaculis. Nullam id dolor id libero venenatis commodo sit amet eget dui. Morbi lobortis accumsan diam, in egestas quam aliquam efficitur. Mauris hendrerit ornare dui a ornare. In felis urna, sodales et semper ac, semper pharetra magna. Integer elementum, arcu et molestie porttitor, mauris nunc porta velit, gravida commodo lorem risus non orci. Nam efficitur vehicula purus eu aliquam. Praesent vitae ex est. Morbi auctor nunc nulla, sit amet venenatis risus dignissim nec. Aenean viverra purus vel pretium maximus. Aliquam molestie diam at elit finibus, non ultricies massa pharetra. Phasellus sollicitudin volutpat libero nec mattis. Suspendisse id dui ac erat malesuada volutpat. Proin sit amet ornare ligula, non posuere justo. Suspendisse feugiat magna suscipit lacinia interdum.

Morbi eu mattis augue, nec elementum ipsum. Etiam pulvinar nisl et iaculis ornare. Aliquam lacinia ante quis neque porttitor ultrices. In ullamcorper dolor purus, quis mollis nibh lacinia eu. Morbi efficitur felis in justo tristique, sit amet euismod orci interdum. Sed sagittis est lorem, at ultrices sapien tristique ullamcorper. Nulla nibh libero, dapibus a volutpat eget, porttitor porttitor ligula. Fusce ut urna sed diam cursus gravida. Maecenas a suscipit diam. Ut consequat velit ut felis scelerisque vestibulum sed non dolor. Vivamus eleifend ante nec lectus cursus, sed blandit tellus vehicula. Proin vel libero at magna ultrices vestibulum ut et augue. Fusce risus nulla, dapibus eget risus a, scelerisque pretium leo.

Curabitur rutrum nibh quis ligula aliquet consectetur. Morbi felis nibh, vestibulum sed arcu quis, varius tempor mauris. Proin ac erat tortor. Aliquam odio nibh, sollicitudin nec dui sed, mollis tempor ipsum. Nunc aliquet sem eget urna tempus semper tristique nec metus. Pellentesque finibus tristique consectetur. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras ac erat a nisl feugiat rutrum id in massa. Integer scelerisque velit non magna placerat aliquam. In molestie cursus nulla, ut fermentum mauris pellentesque et. Pellentesque id scelerisque ipsum. Proin ac justo nec felis vulputate gravida. ', 'http://localhost/php/assets/images/php.png')
    ;";
     mysqli_query($db, $sql);
}

