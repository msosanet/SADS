<html>

<head>
<title>Getting Data out of the Database</title>
</head>

<body bgcolor="#FFFFFF">
<h1>LISTADO DE ALUMNOS QUE ADEUDAN ESPACIOS</h1>

Order news by 

<a href="data_out.php?orderby=date">Date</a>, 
<a href="data_out.php?orderby=heading">Heading</a> or by 
<a href="data_out.php?orderby=author">Author</a>.

<p>
<form action="data_out.php" method="POST">
	Or only see articles written by (<i>enter author name</i>):
	<input type="text" name="author"> 
	<input type="submit" name="submit" value="Submit!">
</form>

<table border="1" cellpadding="3">

<?php
/* This program gets news items from the database */
	$db = mysql_connect("localhost", "root");
	mysql_select_db("php3", $db);

	if ($orderby == 'date'):
	$sql = "select * from news order by 'date'";

	elseif ($orderby == 'author'):
	$sql = "select * from news order by 'author_name'";

	elseif ($orderby == 'heading'):
	$sql = "select * from news order by 'heading'";

	elseif (isset($submit)):
	$sql = "select * from news where author_name = '$author'";

	else:
	$sql = "select * from news";
	endif;

	$result = mysql_query($sql);

	while ($row = mysql_fetch_array($result)) {
		print("<tr><td bgcolor=\"#003399\"><b>");
		printf("<font color=\"white\">%s</font></b></td></tr>\n", 
		$row["heading"]);
		printf("<td>By: <a href=\"mailto:%s\">%s</a>\n", 
		$row["author_email"], $row["author_name"]);
		printf("<br>Posted: %s<hr>\n", 
		$row["date"]);
		printf("%s</td></tr>\n", 
		$row["body"]);
}
?>

</table>
</body>
</html>
