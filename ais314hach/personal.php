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
      
      function extendedColumns($id)
      {
			if($id != "")
				echo "<a href='personal&delete'><img src='images/'></a>";			
      };

      function getColumns_Insert()
      {
      	$arr = $this->getColumns();
      	unset($arr['id']);
      	return $arr;
      }
      
      function insert()
      {
			$fio = $_POST['fio'];
			$stsm = $_POST['stsm'];
			$stsm = ($stsm == "on" ? 1 : 0);
			$query = "insert into personal(fio,stsm) values('$fio', $stsm)";
			$result = mysql_query( $query );			
			echo "[fio:".$fio."][stsm:".$stsm."]";
			
      }

		function convertToPrintData($name, $data)
		{
			if($name == 'stsm')
				return ($data == 0 ? 'Нет' : 'Да');
			return $data;
		}
   }
?>
