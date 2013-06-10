<? error_reporting(E_ALL); ?>
<?	
   class report_month
   {
      function getType()
      {
         return "report"; 
      }
		
		function getFilter()
		{
		   $arr = array();
		   $arr[START_DATE] = 'start_date';
         $arr[END_DATE] = 'end_date';
		   return $arr; 
		}
		
		function printPage()
      {
         $start_date = "";
         if(isset($_GET['start_date']))
            $start_date = $_GET['start_date'];
            
         $end_date = "";
         if(isset($_GET['end_date']))
            $end_date = $_GET['end_date'];
         
         echo "<br>";
         
         $start_date = "'".$start_date."'";
         $end_date = "'".$end_date."'";
                  
         $query = "select 
            *,
            t1.fio as fio_stsm, 
				t2.fio as fio_personal, 
				t3.type as str_type_of_offense
				
          from log_of_offenses t0
            inner join personal t1 on t1.id = t0.id_stsm
            inner join personal t2 on t2.id = t0.id_personal
            inner join type_of_offense t3 on t3.id = t0.id_type_of_offense
          where 
            t0.date >= $start_date 
               and
            t0.date <= $end_date 
            ";
         
         mysql_set_charset("utf8");
         
         $result = mysql_query( $query ) or die(INCORRECT_SQL_QUERY." = ".$query);

         echo "<table bordercolor=#000000 border=1px>";
         $rows = mysql_num_rows($result);
         for($i = 0; $i < $rows; $i++)
         {
            $id = mysql_result($result, $i, "id");
            $fio_stsm = mysql_result($result, $i, "fio_stsm");
            $fio_personal = mysql_result($result, $i, "fio_personal");
            $str_type_of_offense = mysql_result($result, $i, "str_type_of_offense");
            $text = mysql_result($result, $i, "text");
            $date = mysql_result($result, $i, "date");
            echo "
               <tr>
                  <td width=10%>
                     ID: $id<br>
                     Дата нарушения: <br><i>$date</i> <br>
                  </td>
                  <td width=20%>
                     Старший смены: <br><i>$fio_stsm</i><br>
                     Охранник: <br><i>$fio_stsm</i><br>
                  </td>
                  <td width=50%>
                     Тип нарушения: <br><i>$str_type_of_offense</i><br>
                     Описание: <br>$text
                  </td>";
                  
            $query1 = "select *, 
				   t1.fio as fio_criminal,
				   t1.fof as fof_criminal 
				from 
				   participants_of_criminal t0
				   inner join criminal t1 on t1.id = t0.id_criminal
				where
				   t0.id_log_of_offenses = $id
				";
              
              
            $result1 = mysql_query( $query1 ) or die(INCORRECT_SQL_QUERY." = ".$query1);
            $rows1 = mysql_num_rows($result1);
            
            echo " <td>";
 
            for($i1 = 0; $i1 < $rows1; $i1++)
            {
               $fio_criminal = mysql_result($result1, $i1, "fio_criminal");
               $fof_criminal = mysql_result($result1, $i1, "fof_criminal");
               $resolution = mysql_result($result1, $i1, "resolution");
               if($fof_criminal == "1")
                  $fof_criminal = "Свой";
               else
                  $fof_criminal = "Чужой";
                  
               echo "Нарушитель:
                  <br><i>".$fio_criminal."($fof_criminal)</i><br>
                  Решение:<br>
                  <i>".$resolution."</i><br>
               ";
            }    
                  
            echo " </td>
               </tr>
            ";
         }
         echo "</table>";

         //print_r($result);
         
      }
      
		function getName()
		{
			return "report_month";
		}
		
  		function getCaption()
		{
			return REPORT_MONTH;
		}
		
		function onClick_Table($id)
      {
      	return "document.location = 'index.php?".$this->getName()."=&view=".$id."';";
      }
      		
      function getColumns()
      {
         $arr = array();
         $arr[IDENTIFICATOR] = 'id';
         $arr[TYPE] = 'type';
         return $arr;
      }
      
      function echo_view_extended($id)
		{
		
		}
		
		function getColumns_View()
		{
			return $this->getColumns();
		}
		
      function createInputTag($name, $value = "")
		{
		  //return "<input type='text' name='$name' value='$value' id='datepicker'				
		//		/> $value";
				
			if($name == "start_date")
				return "<input type='text' name='$name' id='datepicker' value='$value'/>";
			if($name == "end_date")
				return "<input type='text' name='$name' id='datepicker2' value='$value'/>";
			else 
				return I_DONT_KNOW_WHAT_ARE_YOU_WHAT;
		}
		
      function insert()
      {
      	//$db = mysql_connect( $db_host, $db_username, $db_userpass);
	   	//mysql_select_db( $db_namedb, $db);
   	   mysql_set_charset("utf8");
      
			$type = htmlspecialchars($_POST['type']);
			$query = "insert into type_of_offense(type) values('$type')";
			$result = mysql_query( $query ) or die(CAN_NOT_INSERT.", query = [".$query."]");		
      }
      
		function delete($id)
		{
			mysql_set_charset("utf8");
			$query = "delete from type_of_offense where id = $id";
			$result = mysql_query( $query ) or die(CAN_NOT_DELETE.", query = [".$query."]");
		}
      
      function update($id)
		{
			mysql_set_charset("utf8");
      
			$type = htmlspecialchars($_POST['type']);
			$query = "update type_of_offense set type='$type' where id = $id";
			$result = mysql_query( $query ) or die(CAN_NOT_UPDATE.", query = [".$query."]");
		}
		
      function convertToPrintData($name, $data)
      {
         return $data;
      }
   }
?>
