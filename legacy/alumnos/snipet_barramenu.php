<?

// **************** BARRA DE MENÚS *************** -->

  if ($_SESSION['valor']==1) { //menu completo
    include 'menuppal2.php';
    }
  if ($_SESSION['valor']==0) { // archivo no existe
    include 'menuppal.php';
    }
  if ($_SESSION['valor']==3) { //sólo Listados/Horarios/Asistencia (preceptores)
    include 'menuppal3.php';
    }
  if ($_SESSION['valor']==4) { // archivo no existe
    include 'menuppal4.php';
    }
  if ($_SESSION['valor']==5) {
    include 'menuppal5.php';
    }

// **************** FIN BARRA DE MENÚS *************** -->

?>