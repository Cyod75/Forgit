<?php 
session_start();
$mysql = new mysqli("localhost", "root", "garrapata", "fitforge");
if (isset($_SESSION['usuario'])) {
  header('Location:../APP/inicio.php');
  exit;
}

if ($mysql->connect_error) {
  die("Conexión fallida: " . $mysql->connect_error);
}

// Definir el mensaje de error si existe
$error = '';
if (isset($_GET['error']) && $_GET['error'] == 1) {
  $error = "Los datos ingresados no son válidos.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Iniciar Sesión - FitForge</title>
  <link href="../CSS/bootstrap.css" rel="stylesheet">
  <link href="../CSS/style.css" rel="stylesheet">
</head>
<body>

  <div class="glass-card">
    <img src="../IMG/logo.png" alt="FitForge Logo" class="logo">
    <h2 class="text-center mb-4">Bienvenido de Nuevo</h2>

    <!-- Mostrar mensaje de error si existe -->
    <?php if (!empty($error)): ?>
      <div class="alert-error"><?= $error ?></div>
    <?php endif; ?>

    <form action="checkLogin.php" method="POST">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required value="<?php echo $_POST['usuario'] ?? '' ?>">
        <label for="usuario">Usuario</label>
      </div>
      <div class="form-floating mb-4">
        <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña" required>
        <label for="contraseña">Contraseña</label>
      </div>
      <button type="submit" class="btn btn-custom text-white">Entrar</button>
    </form>
    
    <p class="text-center mb-0">
      ¿No tienes cuenta?
      <a href="../AUTH/registro.php" class="text-link" style="color: #ff7f32;">Regístrate</a>
    </p>
  </div>

</body>
</html>
