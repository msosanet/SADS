<?PHP
session_start();
if ($_SESSION['estado']==1) { 

if (isset($_GET['mat']) OR isset($_GET['actor']) OR isset($_POST['id']))
{
	if (isset($_GET['actor'])){$materia=$_GET['actor'];} 
	if (isset($_GET['mat'])){$materia=$_GET['mat'];} 
	
	echo $materia;

?>

