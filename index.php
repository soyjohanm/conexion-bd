<?php

  date_default_timezone_set('America/Caracas');

  function conectar() {
    $controlador = 'mysql';
    $bd_nombre = 'crud';
    $bd_usuario = 'root';
    $bd_clave = '';
    $bd_host = 'localhost';
    try {
      $conexion = new PDO("$controlador:host=$bd_host;dbname=$bd_nombre", $bd_usuario, $bd_clave);
      $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conexion;
    } catch (PDOException $e) {
      echo $e->getMessage();
      die();
    }
  }

  function query($sql, $datos=array(), $todo=true, $uno=false) {
    $conexion = conectar();
    try {
      $query = $conexion->prepare($sql);
      $query->execute($datos);
    } catch (Exception $e) { return $e; }
    if ($todo) {
      if ($uno) { $resultado = $query->fetch(PDO::FETCH_OBJ); }
      else { $resultado = $query->fetchALL(PDO::FETCH_ASSOC); }
      $conexion = NULL;
      return $resultado;
    } else {
      $resultado = NULL;
      return true;
    }
  }

  if (conectar()) {
    echo "Se ha establecido la conexión con la base de datos.<br>";
    $sql = "SELECT * FROM productos";
    
  }
?>
