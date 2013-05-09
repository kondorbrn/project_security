<? error_reporting(E_ALL); ?>
<?	
   class personal
   {
		function createSQL($find, $count = false)
		{
			$fields = "*";
			if($count)
			$fields = "COUNT(*) as count_rec";
			return "select ".$fields." from personal t0 where fio like '%%".$find."%%'";
		}
		
		function createSQL_View($id)
		{
			return "select * from personal t0 where id = $id";
		}
      
		function getCaption()
		{
			return "Personals";
		}
	   
	   function getName()
		{
			return "personal";
		}
		
		function createInputTag($name, $value = "")
		{
			if($name == "fio")
				return "<input type='text' name='$name' value='$value'/>";
			else if($name == "stsm")
				return "<input type='checkbox' name='$name'/><br>";
			else 
				return "I don't know, what are you want!";
		}
		
		function getColumns()
		{
			$arr = array();
			$arr['id'] = 'id';
			$arr['Ф.И.О.'] = 'fio';
			$arr['Старший смены'] = 'stsm';
			return $arr; 
		}

		function getColumns_Insert()
		{
			$arr = $this->getColumns();
			unset($arr['id']);
			return $arr;
		}

		function echo_view_extended($id)
		{
			
		}
		
      function getColumns_View()
		{
			return $this->getColumns();
		}
		
      function insert()
      {
			mysql_set_charset("utf8");
      
			$fio = htmlspecialchars($_POST['fio']);
			$stsm = $_POST['stsm'];
			$stsm = ($stsm == "on" ? 1 : 0);
			$query = "insert into personal(fio,stsm) values('$fio', $stsm)";
			$result = mysql_query( $query ) or die("cann't insert");
      }

		function delete($id)
		{
			mysql_set_charset("utf8");
			$query = "delete from personal where id = $id";
			$result = mysql_query( $query ) or die("cann't delete, query = ".$query);
		}
		
		function convertToPrintData($name, $data)
		{
			if($name == 'fio')
				return "<img src='images/1367971172_user.png' height=20px/>".$data;
			else if($name == 'stsm')
				return ($data == 0 ? 'Нет' : 'Да');
			return $data;
		}
   }
?>
