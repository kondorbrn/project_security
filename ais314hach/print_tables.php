<?   
   include_once "basepage.php";	
	include_once "config.php";
	include_once "bbcode.php";
	
   function echo_tabl($obj, $find, $page)
   {      
      $db = mysql_connect( $db_host, $db_username, $db_userpass);
   	mysql_select_db( $db_namedb, $db);
      mysql_set_charset("utf8");
      	      
      $result = mysql_query( $obj->createSQL($find, true) );
      $count_all_films = mysql_result($result, 0, "count_rec");

      $start_record = $page * 10;
      $end_record = 10;
      //	echo "[start: $start_record count: $end_record ]";
   
      $query = $obj->createSQL($find)." ORDER BY t0.id DESC LIMIT $start_record,$end_record;";
      
      echo $query;
      $result = mysql_query( $query );
      
      $color = "";
      $color1 = "#adffb9";
      $color2 = "#fff6ad";

      echo "
      <hr>
      found ($count_all_films); pages:
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

      $arr = $obj->getColumns();
      
      echo "
      <tr bgcolor='$color'>";
      
      foreach ($arr as $caption => $name) {
         echo "<td>".$caption."</td>\r\n";
      };

      for( $i = 0; $i < mysql_num_rows($result); $i++ )
      {
	      $id = mysql_result($result, $i, "id");
	      $fio = mysql_result($result, $i, "fio");
	      $stsm = mysql_result($result, $i, "stsm");

	      if( $i % 2 == 0 ) $color = $color1; else $color = $color2;
         if($stsm == 1) $stsm = "да"; else $stsm = "нет";
         
         echo "
	      <tr bgcolor='$color'>\r\n";
	      
	      foreach ($arr as $caption => $name) {
	         $data = mysql_result($result, $i, $name);
	         $data = $obj->convertToPrintData($name, $data);
            echo "<td>".$data."</td>\r\n";
         };
	      echo "</tr>\r\n";
      }
      
      echo "</table>";
   };
?>
