<? error_reporting(E_ALL); ?>
<?	
   class type_of_offense
   {
      function createSQL($find, $count = false)
      {
		   $fields = "*";
		   if($count)
			   $fields = "COUNT(*) as count_rec";

         return "select ".$fields." from type_of_offense t0 where type like '%%".$find."%%'";    
      }

		function getName()
		{
			return "type_of_offense";
		}
		
  		function getCaption()
		{
			return "Types of Offense";
		}
		
      function getColumns()
      {
         $arr = array();
         $arr['id'] = 'id';
         $arr['Тип'] = 'type';
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
			if($name == "type")
				return "<input type='text' name='$name' value='$value'/>";
			else 
				return "I don't know, what are you want!";
		}
		
      function insert()
      {
      	//$db = mysql_connect( $db_host, $db_username, $db_userpass);
	   	//mysql_select_db( $db_namedb, $db);
   	   mysql_set_charset("utf8");
      
			$type = $_POST['type'];
			$query = "insert into type_of_offense(type) values('$type')";
			$result = mysql_query( $query ) or die("cann't insert");;		
      }
      
      function convertToPrintData($name, $data)
      {
         return $data;
      }
   }
?>
