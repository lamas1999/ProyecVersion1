<?php
include_once("clases/conexion.php");
include_once("clases/usuario.php");
//---------- USES DE LAS CLASES DE NAMESPACES ----
use \clases\conexion\Conexion;
use \clases\usuario\Usuario;
//-----------------------------------------------
$cnx = new Conexion();
$usuario = new Usuario($cnx);

$id = 0;
$nombre = "";
$apellido = "";
$email = "";
$login = "";
$password = "";
$telefono = "";
$imagen = "";

$op = 0;
$operacion = "";
$error = "";

//=================verificnado metodo post
//funciones
function procesarAdicionar()
{
       //print_r($_FILES);
    //se pone global para acceder a las variables globales desde una funcion
    global $usuario;

    global $nombre;
    global $apellido;
    global $email;
    global $login;
    global $password;
    global $telefono;
    global $error;
    global $imagen;



         $nombre = $_POST["txtNombre"];
         $apellido = $_POST["txtApellido"];
         $email = $_POST["txtEmail"];
         $login = filter_var(strtolower($_POST['txtLogin']), FILTER_SANITIZE_STRING);
         $password = $_POST["txtPassword"];
         $telefono = $_POST["txtTelefono"];
         $imagen = $_POST['foto'];


         

         $usuario->inicializar(0, $nombre, $apellido, $email, $login, $password, $telefono,$imagen );
         if ($usuario->guardar())
            { header("location:index.php?msg=cliente registrado correctamente!!! puede iniciar session");} 
         else 
        {
           $error = "Error al adicionar, revise los datos!!!";
         }
    
}

//------------------------------------------------------------------------------------
if (isset($_POST["btnAceptar"])) {
    $op = $_POST["txtOperacion"];
    switch ($op) {
        case 1:
            procesarAdicionar();
            break;
        case 2:
            // procesarModificar();
            break;
        case 3:
            //procesarEliminar();
            break;
        default:
            echo "no hay operacion";
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("incluir_estilos_encabezado.php"); ?>
    <title>Registarse</title>
</head>
    </style>

    <body>
    
                    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="container">
            <div class="row justify-content-center mt-5 pt-5">

                <div class="col-md-7 bg-white">
                    <h1 class="font-italic"><i class="fa fa-registered" aria-hidden="true"></i>egistro de Usuario</h1>
                    <hr class="border">
                    <!---------------------------------------------------------------->
                    <div id="form-container" style="margin: 60px">
                        <form name="form1" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="formulario" method="POST" enctype="multipart/form-data">

                            <div class="form-group">
                                <input type="hidden" class="form-control" id="txtOperacion" name="txtOperacion" value="1">
                            </div>

                            <div class="row form-group">
                                <label for="txtNombre" class="col-form-label col-md-4">Nombre </label>
                                <div class="col-md-8">
                                    <input type="text" name="txtNombre" value="<?php echo $nombre; ?>" id="txtNombre" class="form-control" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="txtDireccion" class="col-form-label col-md-4">Apellido</label>
                                <div class="col-md-8">
                                    <input type="text" name="txtApellido" value="<?php echo $apellido; ?>" id="txtApellido" class="form-control" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="txtEmail" class="col-form-label col-md-4">E-mail</label>
                                <div class="col-md-8">
                                    <input type="email" name="txtEmail" value="<?php echo $email; ?>" id="txtEmail" class="form-control" required>
                                </div>
                            </div>


                            <div class="row form-group">
                                <label for="txtLogin" class="col-form-label col-md-4">Login </label>
                                <div class="col-md-8">
                                    <input type="text" name="txtLogin" value="<?php echo $login; ?>" id="txtLogin" class="form-control" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="txtPassword" class="col-form-label col-md-4">Password </label>
                                <div class="col-md-8">
                                    <input type="password" name="txtPassword" value="<?php echo $password; ?>" id="txtPassword" class="form-control" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="txtTelefono" class="col-form-label col-md-4">Telefono</label>
                                <div class="col-md-8">
                                    <input type="text" name="txtTelefono" value="<?php echo $telefono; ?>" id="txtTelefono" class="form-control" >
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="imagen" class="col-form-label col-md-4">foto</label>
                                <div class="col-md-8">
                                       <input type="text" name="foto" id="foto" />
                                </div>
                            </div>

                            <button type="submit" class="btn  btn-dark" name="btnAceptar" value="Aceptar">Aceptar</button>
                            <button type="submit" class="btn  btn-dark" name="btnCancelar" value="Cancelar">Cancelar</button>

                        </form>
                        <hr class="bg-info">
                        <!--si la varible errores no esta vacia-->
                        <?php if (!empty($error)) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <!---------------------------------------------------------------->
                </div>
            </div>
        </div>

        <?php include("incluir_estilos_pie.php"); ?>
</body>

</html>