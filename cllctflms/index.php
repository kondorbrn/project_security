<? error_reporting(E_ALL); ?>
<html>
<head>
<title> Project Security </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
</head>

<script>
function SetCaretAtEnd(elem) {
        var elemLen = elem.value.length;
        // For IE Only
        if (document.selection) {
            // Set focus
            elem.focus();
            // Use IE Ranges
            var oSel = document.selection.createRange();
            // Reset position to 0 & then set at end
            oSel.moveStart('character', -elemLen);
            oSel.moveStart('character', elemLen);
            oSel.moveEnd('character', 0);
            oSel.select();
        }
        else if (elem.selectionStart || elem.selectionStart == '0') {
            // Firefox/Chrome
            elem.selectionStart = elemLen;
            elem.selectionEnd = elemLen;
            elem.focus();
        } // if
    } // SetCaretAtEnd()
</script>

<!-- body OnLoad="document.form_search.find.focus();" -->
<body OnLoad="SetCaretAtEnd(document.form_search.find); ">

<center>

<?
	include_once "basepage.php";
	include_once "config.php";
	include_once "bbcode.php";
   include_once "print_tables.php";

	$db = mysql_connect( $db_host, $db_username, $db_userpass);
	mysql_select_db( $db_namedb, $db);
	//mysql_set_charset("cp1251");
	$find = "";
	$page = 0;

	if( isset($_GET["find"]) )
		$find = htmlspecialchars($_GET["find"]);

	if( isset($_GET["page"]) )
		$page = htmlspecialchars($_GET["page"]);
		   
   if( isset($_GET["personal"]) )
   {
      print_header("personal", "Personals", $find);
      include_once "personal.php";
      $obj = new personal();
      echo_tabl($obj, $find, $page);
   }
   else if( isset($_GET["offense"]) )
   {
      print_header("offense", "Offenses", $find);
      include_once "offense.php";
      $obj = new offense();
      echo_tabl($obj, $find, $page);
   }
   else if( isset($_GET["criminal"]) )
   {
      print_header("criminal", "Criminals", $find);
      include_once "criminal.php";
      $obj = new criminal();
      echo_tabl($obj, $find, $page);
   }
   else if( isset($_GET["log_of_offense"]) )
   {
      print_header("log_of_offense", "Log of Offenses", $find);
      include_once "log_of_offense.php";
      $obj = new log_of_offense();
      echo_tabl($obj, $find, $page);
   }
   else
   {
      print_header("", "Main page");
   }
   
   
   
	/*if( isset( $_POST["addnewfilm"] ) )
	{
		$name_orig = htmlspecialchars(addslashes($_POST["name_orig"]));
		
		$insert = "INSERT INTO list_films( name_orig ) VALUES(\"$name_orig\")";
		
		$result = mysql_query($insert);

		//echo $result;
		
		//exit;
		refreshTo("index.php?find=$find");
	};*/



/*
	echo "<br>
<br>
<br>
<form action='index.php' method='GET'>
<table>
	<tr>
		<td>Find:</td>
		<td><input type='text' name='find' value='$find' size=100/></td>
		<td><input type='submit' value='FIND'/></td>
	</tr>

</table>
</form>



<br>
<!-- ôîðìà äëÿ äîáàâëåíèÿ íîâîî ôèëüìà -->

<!-- <form action='index.php' method='post'>
	<table>
	<tr>
		<td>Original name:</td>
		<td><input type='text' name='name_orig' value=''/></td>
		<td><input type='submit' name='addnewfilm' value='Add NEW FILM'/> or <a href='execute_sql.php'> execute sql</a> </td>
	</tr>
</table>
</form> --> 
";
*/

	$query = createQueryForFind($find, true);

	$result = mysql_query( $query );
	$count_all_films = mysql_result($result, 0, "count_films");

	$page = 0;
	if( isset($_GET['page']) ) $page = $_GET['page'];

//	echo "[page: ".$page."]";

	$start_record = $page * 10;
	$end_record = 10;
//	echo "[start: $start_record count: $end_record ]";

	$query = createQueryForFind($find)." ORDER BY id_film DESC LIMIT $start_record,$end_record;";


/*
	$result = mysql_query( $query );
	
	$color = "";
	$color1 = "#adffb9";
	$color2 = "#fff6ad";

	echo "
	<hr>
	find films ($count_all_films); pages:
	";

	$count_pages = $count_all_films / 10;

	for( $i = 0; $i < $count_pages; $i++)
	{
		if( $page == $i )
			echo "<font size=5>(".($i+1).")</font>, ";
		else
			echo "<a href='index.php?page=".$i."&find=$find'>(".($i+1).")</a>, ";
	};

	echo "

	<hr>
	<table cellspacing='0' cellpadding='10' >";

	echo "
	<tr bgcolor='$color'>
		<td> id </td>
		<td> Äèñê </td>
		<td> Ïîñòåð </td>
		<td> Íàçâàíèå </td>
		<td> Ñòðàíà </td>		
		<td> Æàíð </td>
		<td> Ðåæèñåð </td>
		<td> Ãîä âûïóñêà </td>
		<td> Ïðîäîëæèòåëüíîñòü </td>
	</tr>";
	
	for( $i = 0; $i < mysql_num_rows($result); $i++ )
	{
		$id_film = mysql_result($result, $i, "id_film");
		$name_orig = mysql_result($result, $i, "name_orig");
		$name_ru = mysql_result($result, $i, "name_ru");
		$film_year = mysql_result($result, $i, "film_year");
		$creater = mysql_result($result, $i, "creater");
		//$actors = mysql_result($result, $i, "actors");
		//$descript = mysql_result($result, $i, "descript");
		$poster = mysql_result($result, $i, "poster");
		$film_time = mysql_result($result, $i, "film_time");
 		$disk = mysql_result($result, $i, "disk");
		$ganre = mysql_result($result, $i, "ganre");
		$film_country = mysql_result($result, $i, "film_country");

		if( $i % 2 == 0 ) $color = $color1; else $color = $color2;

		
		echo "
		<tr bgcolor='$color'>
			<td> $id_film) </td>
			<td> <a href='?find=$disk'>".bbcode_format($disk)."</a> </td>
			<td> <img src='posters/$id_film/$poster' width=50px> </td>
			<td> <a href='film.php?id=$id_film'>$name_orig / $name_ru</a> </td>
			<td> $film_country </td>		
			<td> $ganre </td>
			<td> $creater </td>
			<td> $film_year </td>
			<td> $film_time </td>
			

		</tr>";
	}
	
	echo "</table>";

	echo "<hr/><center><a href='getzip.php?find=$find'>DOWNLOAD ZIP</a></center>";
	echo "<hr/><center><a href='getposter.php?find=$find'>GET POSTER</a></center>";
	*/
?>

</body>
</html>
