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
        return CRIMINALS;
  		}
		
		function onClick_Table($id)
      {
      	return "document.location = 'index.php?".$this->getName()."=&view=".$id."';";
      }
      
		function echo_view_extended($id)
		{
		
		}
		
      function getColumns()
      {
         $arr = array();
         $arr[IDENTIFICATOR] = 'id';
         $arr[FULL_NAME] = 'fio';
         $arr[OURS] = 'fof';
         $arr[PASSPORT_NUMBER] = 'snp';
         return $arr;
      }
      
      function getColumns_Insert()
      {
      	$arr = $this->getColumns();
      	unset($arr[IDENTIFICATOR]);
      	return $arr;
      }
      
      function getColumns_View()
		{
			return $this->getColumns();
		}
		
      function createInputTag($name, $value = "")
		{
			if($name == 'id')
				return "<input type=hidden name='$name' value='$value'/>$value";
			else if($name == "fio" || $name == "snp")
				return "<input type='text' name='$name' value='$value'/>";
			else if($name == "fof")
			{
				$checked = ($value== '1' ? "checked" : "");
				return "<input type='checkbox' name='$name' $checked/><br>";
			}
			else
				return I_DONT_KNOW_WHAT_ARE_YOU_WHAT;

		}
		
      function insert()
      {
   	   mysql_set_charset("utf8");
      
			$fio = $_POST['fio'];
			$fof = $_POST['fof'];
			$snp = $_POST['snp'];
			$fof = ($fof == "on" ? 1 : 0);
			
			$query = "insert into criminal(fio,fof,snp) values('$fio', $fof, $snp)";
			$result = mysql_query( $query ) or die(CAN_NOT_INSERT.", query = [".$query."]");
      }
      
      function delete($id)
		{
			mysql_set_charset("utf8");
			$query = "delete from criminal where id = $id";
			$result = mysql_query( $query ) or die(CAN_NOT_DELETE.", query = [".$query."]");
		}
		
		function update($id)
		{
			mysql_set_charset("utf8");
      	
      	$fio = htmlspecialchars($_POST['fio']);
			$fof = htmlspecialchars($_POST['fof']);
			$snp = $_POST['snp'];
			$fof = ($fof == "on" ? 1 : 0);
			
			$query = "update criminal set fio = '$fio', fof = $fof, snp = $snp where id = $id";
			$result = mysql_query( $query ) or die(CAN_NOT_UPDATE.", query = [".$query."]");
		}
		
      function convertToPrintData($name, $data)
      {
      	if($name == 'fio')
				return "<img src='images/1367971172_user.png' height=20px/>".$data;				
         else if($name == "fof")
            return ($data == 0 ? NO : "<img src='images/1367971099_notification_warning.png' height=20px/>".YES ); 
 
         return $data;
      }
   }
?>
