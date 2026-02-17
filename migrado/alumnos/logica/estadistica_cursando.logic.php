<?PHP
session_start();

if (!isset($_SESSION['valor'])) { ?>
	 <!-- Redirecciona cuando no hay usuario autenticado -->
	<script>location.replace("i_admin.php") </script>
<? }

if ($_SESSION['estado']==1) {
	include 'conexion.php'; //funciones para conectar db sid
?>

