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
      
      function getColumns()
      {
         $arr = array();
         $arr['id'] = 'id';
         $arr['Ф.И.О.'] = 'fio';
         $arr['Свой'] = 'fof';
         $arr['Серия и номер паспорта'] = 'snp';
         return $arr;
      }
      
      function convertToPrintData($name, $data)
      {
         if($name == "fof")
            return ($data == 0 ? "Нет" : "Да" ); 
 
         return $data;
      }
   }
?>
