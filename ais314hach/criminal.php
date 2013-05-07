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

		function getName()
		{
			return "criminal";
		}
		
     	function getCaption()
		  {
        return "Criminals";
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
      	//$db = mysql_connect( $db_host, $db_username, $db_userpass);
	   	//mysql_select_db( $db_namedb, $db);
   	   mysql_set_charset("utf8");
      
			$fio = $_POST['fio'];
			$fof = $_POST['fof'];
			$snp = $_POST['snp'];
			$fof = ($fof == "on" ? 1 : 0);
			
			$query = "insert into criminal(fio,fof,snp) values('$fio', $fof, $snp)";
			$result = mysql_query( $query ) or die("cann't insert");		
      }
      
      function convertToPrintData($name, $data)
      {
         if($name == "fof")
            return ($data == 0 ? "Нет" : "Да" ); 
 
         return $data;
      }
   }
?>
