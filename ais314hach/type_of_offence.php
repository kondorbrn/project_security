<? error_reporting(E_ALL); ?>
<?	
   class offense
   {
      function createSQL($find, $count = false)
      {
		   $fields = "*";
		   if($count)
			   $fields = "COUNT(*) as count_rec";

         return "select ".$fields." from offense t0 where type like '%%".$find."%%'";    
      }

  	function getCaption()
		{
			return "Offenses";
		}      
      function getColumns()
      {
         $arr = array();
         $arr['id'] = 'id';
         $arr['Тип'] = 'type';
         return $arr;
      }
      
      function convertToPrintData($name, $data)
      {
         return $data;
      }
   }
?>
