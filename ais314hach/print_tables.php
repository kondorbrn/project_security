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
      echo "<td></td>\r\n";
      foreach ($arr as $caption => $name) {
         echo "<td>".$caption."</td>\r\n";
      };

      for( $i = 0; $i < mysql_num_rows($result); $i++ )
      {
	      if( $i % 2 == 0 ) $color = $color1; else $color = $color2;
         
         echo "
	      <tr bgcolor='$color'>\r\n";
   	      echo "<td>look</td>\r\n";
	      foreach ($arr as $caption => $name) {
	         $data = mysql_result($result, $i, $name);
	         $data = $obj->convertToPrintData($name, $data);
            echo "<td>".$data."</td>\r\n";
         };      
	      echo "</tr>\r\n";
      }
      
      echo "</table><br/>
      <a href=''>add record</a>";
   };
   
   function echo_record($obj, $find, $page)
   {
		
   }
   
   function echo_header($objs, $find)
   {
		
   };
?>
