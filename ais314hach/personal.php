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
	   
		function getColumns()
		{
			$arr = array();
			$arr['id'] = 'id';
			$arr['Ф.И.О.'] = 'fio';
			$arr['Старший смены'] = 'stsm';
			return $arr; 
		}
      
		function convertToPrintData($name, $data)
		{
			if($name == 'stsm')
				return ($data == 0 ? 'Нет' : 'Да');
			return $data;
		}
   }
?>
