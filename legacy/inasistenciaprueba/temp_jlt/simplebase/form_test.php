<html>

<style>

body {
    background-color: linen;
}

h1 {
    color: maroon;
    margin-left: 40px;
}
p {
    font-family: Arial;
    margin-left: 40px;
}
table {
    font-family: sans-serif;
}

</style>

<body>

<p>BIENVENIDO. SU CURSO ES <?php echo $_POST['curso']; ?></p>
<p>SU DIVISION ES: <?php echo $_POST['div']; ?></p>
<p><?php echo $_POST['areatexto']; ?></p>

</body>
</html> 
