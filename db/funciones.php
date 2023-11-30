<?php
include("db.php");
// include ("modal.php");

session_start();

function conectaBase() {
  global $host, $usuario, $clave, $base;
  $conexion = mysqli_connect($host, $usuario, $clave, $base);

  if (!$conexion) {
    ("Error de conexión: " . mysqli_connect_error());
  }

  return $conexion;
}

function consultar($consulta){
  $conexion = conectaBase();

  if (!$conexion) {
    return false;
  }

  if (!$datos = mysqli_query($conexion, $consulta) or mysqli_num_rows($datos) < 1) {
    return false;
  } else {
    return $datos;
  }
}

function datosEjercicios() {
  $consulta_ejercicios = "SELECT * FROM ejercicios";
  $datos_ejercicios = consultar($consulta_ejercicios);

  if ($datos_ejercicios) {
    mostrarEjercicios($datos_ejercicios);
  } else {
    echo "<p>No se encontraron datos</p>";
  }
}

function datosTipoEjercicios() {
  $consulta_tipos = "SELECT * FROM tipo_ejercicios";
  $datos_tipos = consultar($consulta_tipos);

  if ($datos_tipos) {
    mostrarTipos($datos_tipos);
  } else {
    echo "<p>No se encontraron datos</p>";
  }
}

function datosEjercicioGrande() {
  if (isset($_GET['id'])) {
    $id = $_GET['id']; // Obtiene la id desde la URL
    $consulta_id = "SELECT * FROM ejercicios WHERE id_ejercicio = $id";
    $datos_id = consultar($consulta_id);

    if ($datos_id) {
      $ejercicio = mysqli_fetch_assoc($datos_id);
      mostrarEjercicioGrande($ejercicio);
    } else {
      echo "<p>No se encontraron datos</p>";
    }
  } else {
    echo "ID de ejercicio no proporcionado";
  }
}

function procesarFormulario() {
  $conexion = conectaBase();

  if ($conexion) {
    if (isset($_POST["nombre-ejercicio"],
        $_POST["tipo-ejercicio"],
        $_POST["duracion-ejercicio"],
        $_POST["descripcion-ejercicio"]) &&
        $_POST["nombre-ejercicio"] != "" &&
        $_POST["tipo-ejercicio"] != "" &&
        $_POST["duracion-ejercicio"] != "" &&
        $_POST["descripcion-ejercicio"] != ""
    ) {
        $nombre = $_POST["nombre-ejercicio"];
        $tipo = $_POST["tipo-ejercicio"];
        $duracion = $_POST["duracion-ejercicio"];
        $descripcion = $_POST["descripcion-ejercicio"];

        $ejercicio_nuevo = "INSERT INTO ejercicios (id_ejercicio, nombre_ejercicio, tipo_ejercicio, duracion, descripcion) VALUES ('', '$nombre', '$tipo', '$duracion', '$descripcion')";

        if (mysqli_query($conexion, $ejercicio_nuevo)) {
          echo "<span class='titulo-span'>Registro exitoso</span>";
         } else {
          echo "Error en la consulta: " . mysqli_error($conexion);
      }
    } else {
        echo "<span class='titulo-span'>Completa todos los campos</span>";
    }
  } else {
    echo "<p>Servicio interrumpido</p>";
  }
}

function inicioSesion() {
  $conexion = conectaBase();
  if ($conexion) {
    if (isset($_POST['user-name'], $_POST['user-pass']) && $_POST['user-name'] != '' && $_POST['user-pass'] != '') {
      $user_name = $_POST['user-name'];
      $user_pass = $_POST['user-pass'];

      // Construye la consulta SQL con parámetros seguros para evitar inyección SQL
      $consulta = "SELECT * FROM user WHERE user_name = ? AND user_pass = ?";
      
      // Prepara la consulta
      if ($usuarioExistente = mysqli_prepare($conexion, $consulta)) {
        // Vincula los parámetros
        mysqli_stmt_bind_param($usuarioExistente, "ss", $user_name, $user_pass);
        
        // Ejecuta la consulta
        if (mysqli_stmt_execute($usuarioExistente)) {
          // Obtiene el resultado
          $result = mysqli_stmt_get_result($usuarioExistente);
          
          // Comprueba si se encontraron resultados
          if ($row = mysqli_fetch_assoc($result)) {
            header('Location: main.php');
            exit;
          } else {
            echo '<span>Usuario inexistente</span>';
          }
        } else {
          echo 'Error en la ejecución de la consulta: ' . mysqli_error($conexion);
        }
        
        // Cierra la declaración
        mysqli_stmt_close($usuarioExistente);
      } else {
        echo 'Error en la preparación de la consulta: ' . mysqli_error($conexion);
      }
    } else {
      echo "<span class='titulo-span'>Completa todos los campos</span>";
    }
  } else {
    echo "<p>Servicio interrumpido</p>";
  }
}

function registroUsuario() {
    $conexion = conectaBase();

    if ($conexion) {
        if (
            isset($_POST["nombre-form"], $_POST["apellido-form"], $_POST["email-form"], $_POST["user-form"], $_POST["pass-form"]) &&
            $_POST["nombre-form"] != "" &&
            $_POST["apellido-form"] != "" &&
            $_POST["email-form"] != "" &&
            $_POST["user-form"] != "" &&
            $_POST["pass-form"] != ""
        ) {
            $nombre = $_POST["nombre-form"];
            $apellido = $_POST["apellido-form"];
            $email = $_POST["email-form"];
            $usuario = $_POST["user-form"];
            $password = $_POST["pass-form"];

            // Comprobar si el nombre de usuario ya existe en la base de datos
            $consulta = "SELECT id_user FROM user WHERE user_name = '$usuario'";
            $nombreExistente = consultar($consulta);

            if ($nombreExistente && mysqli_num_rows($nombreExistente) > 0) {
                // Muestra un mensaje de error en el HTML que será visible para JavaScript
                echo '<script>var errorMessage = "El nombre de usuario ya está en uso. Por favor, elige otro."; showModal("Error", errorMessage);</script>';
            } else {
                // Insertar el nuevo usuario en la base de datos
                $usuario_nuevo = "INSERT INTO user (id_user, nombre, apellido, user_email, user_name, user_pass) VALUES ('', '$nombre', '$apellido', '$email', '$usuario', '$password')";

                if (mysqli_query($conexion, $usuario_nuevo)) {
                    // Muestra un mensaje de éxito en el HTML que será visible para JavaScript
                    echo '<script>var successMessage = "Usuario registrado correctamente"; showModal("Registro exitoso", successMessage);</script>';
                } else {
                    // Muestra un mensaje de error en el HTML que será visible para JavaScript
                    echo '<script>var errorMessage = "Error en la consulta: ' . mysqli_error($conexion) . '"; showModal("Error", errorMessage);</script>';
                }
            }
        } else {
            // Muestra un mensaje de error en el HTML que será visible para JavaScript
            echo '<script>var errorMessage = "Completa todos los campos"; showModal("Error", errorMessage);</script>';
        }
    } else {
        // Muestra un mensaje de error en el HTML que será visible para JavaScript
        echo '<script>var errorMessage = "Servicio interrumpido"; showModal("Error", errorMessage);</script>';
    }
}




?>


<?php
function mostrarTipos ($datos_tipo) {  ?>
  <select name="tipo-ejercicio" class="select-tipo input-general">
  <?php while ($fila = mysqli_fetch_assoc($datos_tipo)): ?>
  <option value="<?php echo $fila['id_tipo']; ?>"><?php echo $fila['nombre_tipo']; ?></option>
<?php endwhile; ?>
</select> 
<?php } ?>


<?php
function mostrarEjercicios ($consulta_ejercicios) { ?>
    <h2 class="frase-mitica">Frase mitica</h2>
    <section class="grid-fluid">
        <?php while ($fila = mysqli_fetch_assoc($consulta_ejercicios)): ?>
          <a class="a-ejercicio" href="ejercicio.php?id=<?php echo $fila['id_ejercicio']; ?>">
            <div class="container-ejercicio">
              <?php
                    if ($fila['img_ejercicio']) {
                        $imagenBase64 = base64_encode($fila['img_ejercicio']);
                        echo '<img src="data:image/jpeg;base64,' . $imagenBase64 . '" alt="imagen ejercicio" class="img-ejercicio">';
                    } else {
                        echo '<img src="./assets/imagen-defecto.jpg" alt="imagen predeterminada" class="img-ejercicio">';
                    }
                    ?>
              
              <div class="nombre-ejercicio">
                  <figcaption><?php echo $fila['nombre_ejercicio']; ?></figcaption>   
              </div>
              <div class="tipo-ejercicio">
                      <span><?php echo $fila['tipo_ejercicio']; ?></span>
              </div> 
            </div>
          </a>
        <?php endwhile; ?>
    </section>
<?php } ?>


<?php
function mostrarEjercicioGrande ($datos_id) { ?>
  <h2 id="nombre-ejercicio" class="nombre-ejercicio-grande" contenteditable="false" ><?php echo $datos_id['nombre_ejercicio']; ?></h2>
      
    <?php if (isset($datos_id)): ?>
        <div id="ejercicio-grande" class="ejercicio-grande" data-id="<?php echo $_GET['id']; ?>">

            <div class="img-ejercicio-grande">
                <?php if ($datos_id['img_ejercicio']): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($datos_id['img_ejercicio']); ?>" alt="imagen ejercicio" class="img-ejercicio">
                    <?php else: ?>
                        <img src="./assets/imagen-defecto.jpg" alt="imagen predeterminada" class="img-ejercicio">
                    <?php endif; ?>
            </div>


            <div class="info-ejercicio-grande" id="info-ejercicio-grande">
                <span class="titulo-span">TIPO EJERCICIO</span>
                <span class="titulo-span">DURACION</span>
                <span id="tipo-ejercicio"><?php echo $datos_id['tipo_ejercicio']; ?></span>
                <span id="duracion-ejercicio" contenteditable="false"><?php echo $datos_id['duracion']; ?></span>
                <p id="descripcion-ejercicio" contenteditable="false"><?php echo $datos_id['descripcion']; ?></p>
                <button id="btn-editar" class="btn-general btn-amarillo">Editar</button>
                <button id="btn-borrar" class="btn-general btn-cancelar">Borrar ejercicio</button>
                <button id="guardar-cambios" style="display: none" class="btn-general btn-guardar">Guardar Cambios</button>
                <button id="cancelar-cambios" style="display: none" class="btn-general btn-cancelar">Cancelar</button>
            </div>       
        </div>
    <?php endif; 
 } ?>