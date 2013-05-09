<? error_reporting(E_ALL); ?>
<?	
   class log_of_offense
   {
      function createSQL($find, $count = false)
      {
		   $fields = "*";
		   if($count)
			   $fields = "COUNT(*) as count_rec";
			else $fields = "*, 
				t1.fio as fio_stsm, 
				t2.fio as fio_personal, 
				t3.type as str_type_of_offense";
			
         return "select ".$fields." from log_of_offenses t0
            inner join personal t1 on t1.id = t0.id_stsm
            inner join personal t2 on t2.id = t0.id_personal
            inner join type_of_offense t3 on t3.id = t0.id_type_of_offense
          where 
            t0.text like '%%".$find."%%'
            or t1.fio like '%%".$find."%%'
            or t2.fio like '%%".$find."%%'
            or t3.type like '%%".$find."%%'
            ";
      }

		function createSQL_View($id)
		{
			return "
			select *,
				t1.fio as fio_stsm, 
				t2.fio as fio_personal, 
				t3.type as str_type_of_offense
			from log_of_offenses t0
            inner join personal t1 on t1.id = t0.id_stsm
            inner join personal t2 on t2.id = t0.id_personal
            inner join type_of_offense t3 on t3.id = t0.id_type_of_offense
          where 
            t0.id = $id
			";
		}
		
		function getName()
		{
			return "log_of_offense";
		}
		
  		function getCaption()
		{
			return "Log Of Offences";
		}
          
		function getColumns()
		{
			$arr = array();
			$arr['id'] = 'id';
			$arr['Дата нарушения'] = 'date';			
			$arr['Тип нарушения'] = 'str_type_of_offense';
			$arr['Старший смены'] = 'fio_stsm';
			$arr['Охраник'] = 'fio_personal';         
			// $arr['Текст'] = 'text';
			// $arr['Скан документа:'] = 'scan';
			return $arr;
		}
		
		function getColumns_View()
		{
			$arr = $this->getColumns();
			$arr['<img src="images/1367971109_message.png" height=20px/> Текст'] = 'text';
			$arr['Скан документа'] = 'scan';
			return $arr;
		}
		
		function echo_view_extended($id)
		{
			echo "here it will insert and view table for criminals :) ";
		}
		
		function createTagSelect($query, $field, $name, $value)
		{
			$ret = "<select name='$name'>";
			$result = mysql_query($query) or die("cann't execute query");
			for( $i = 0; $i < mysql_num_rows($result); $i++ )
			{
				$id = mysql_result($result, $i, "id");
				$type = mysql_result($result, $i, $field);
				$checked = ($value == $id ? "checked" : "");
				$ret .= "<option value=$id $checked>$type</option>";
			};
      		$ret .= "</select>";
			return $ret;
		}
		
		function createInputTag($name, $value = "")
		{
			
			if($name == "str_type_of_offense")
				return $this->createTagSelect("select id,type from type_of_offense", "type", $name, $value);
			if($name == "fio_stsm")
				return $this->createTagSelect("select id, fio from personal where stsm = 1", "fio", $name, $value);
			if($name == "fio_personal")
				return $this->createTagSelect("select id, fio from personal where stsm <> 1", "fio", $name, $value);
			else if($name == "text")
				return "<textarea name='$name' cols='40' rows='3'>$value</textarea><br>";
			else if($name == "scan")
				return "<input type='file' name='$name' value=''><br>";
			else if($name == "date")
				return "<input type='text' name='$name' id='datepicker' value=''/>";
			else
				return "I don't know, what are you want!";
		}
		
		function insert()
		{
			mysql_set_charset("utf8");
			$id_type_of_offense = $_POST['str_type_of_offense'];
			$id_stsm = $_POST['fio_stsm'];
			$id_personal = $_POST['fio_personal'];
			$date = htmlspecialchars($_POST['date']);
			$text = htmlspecialchars($_POST['text']);
			//echo "[".$date."]";
			//exit();
			$query = "insert into log_of_offenses(
				`date`, id_type_of_offense, id_stsm, id_personal, text, scan
			)
				values('$date', $id_type_of_offense, $id_stsm, $id_personal, '$text', '')";
			//echo $query;
			//exit(0);
			$result = mysql_query( $query ) or die("cann't insert");
		}
	  
		function delete($id)
		{
			mysql_set_charset("utf8");
			$query = "delete from log_of_offenses where id = $id";
			$result = mysql_query( $query ) or die("cann't delete, query = ".$query);
		}
		
		function getColumns_Insert()
		{
			$arr = $this->getColumns();
			$arr['<img src="images/1367971109_message.png" height=20px/> Текст'] = 'text';
			// $arr['Скан документа:'] = 'scan';
			unset($arr['id']);
			return $arr;
		}
		
      function convertToPrintData($name, $data)
      {
      	if($name == 'fio_stsm')
				return "<img src='images/1367971172_user.png' height=20px/>".$data;
      	else if($name == 'fio_personal')
				return "<img src='images/1367971172_user.png' height=20px/>".$data;				
         else if($name == "scan")
            return "<img src='$data' width=50px />"; 

         return $data;
      }
   }
?>
