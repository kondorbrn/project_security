<? error_reporting(E_ALL); ?>
<?	
   class criminal
   {
      function createSQL($find, $count = false)
      {
		   $fields = "*";
		   if($count)
			   $fields = "COUNT(*) as count_rec";

         return "select ".$fields." from criminal t0 where fio like '%%".$find."%%'";    
      }

		function createSQL_View($id)
		{
			return "select * from criminal t0 where id = $id";
		}
		
		function getName()
		{
			return "criminal";
		}
		
     	function getCaption()
		{
        return "Criminals";
  		}

		function echo_view_extended($id)
		{
		
		}
		
      function getColumns()
      {
         $arr = array();
         $arr['id'] = 'id';
         $arr['Ф.И.О.'] = 'fio';
         $arr['Свой'] = 'fof';
         $arr['Серия и номер паспорта'] = 'snp';
         return $arr;
      }
      
      function getColumns_Insert()
      {
      	$arr = $this->getColumns();
      	unset($arr['id']);
      	return $arr;
      }
      
      function getColumns_View()
		{
			return $this->getColumns();
		}
		
      function createInputTag($name, $value = "")
		{
			if($name == "fio" || $name == "snp")
				return "<input type='text' name='$name' value='$value'/>";
			else if($name == "fof")
				return "<input type='checkbox' name='$name'/><br>";
			else
				return "I don't know, what are you want!";

		}
		
      function insert()
      {
   	   mysql_set_charset("utf8");
      
			$fio = $_POST['fio'];
			$fof = $_POST['fof'];
			$snp = $_POST['snp'];
			$fof = ($fof == "on" ? 1 : 0);
			
			$query = "insert into criminal(fio,fof,snp) values('$fio', $fof, $snp)";
			$result = mysql_query( $query ) or die("cann't insert");		
      }
      
      function delete($id)
		{
			mysql_set_charset("utf8");
			$query = "delete from criminal where id = $id";
			$result = mysql_query( $query ) or die("cann't delete, query = ".$query);
		}
		
      function convertToPrintData($name, $data)
      {
      	if($name == 'fio')
				return "<img src='images/1367971172_user.png' height=20px/>".$data;				
         else if($name == "fof")
            return ($data == 0 ? "Нет" : "<img src='images/1367971099_notification_warning.png' height=20px/> Да" ); 
 
         return $data;
      }
   }
?>
