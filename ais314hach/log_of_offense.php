<? error_reporting(E_ALL); ?>
<?	
   class log_of_offense
   {
      function createSQL($find, $count = false)
      {
		   $fields = "*";
		   if($count)
			   $fields = "COUNT(*) as count_rec";

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

  		function getCaption()
		{
			return "Log Of Offences";
		}
          
      function getColumns()
      {
         $arr = array();
         $arr['id'] = 'id';
         $arr['Тип нарушения'] = 't3.type';
         $arr['Старший смены'] = 't1.fio';
         $arr['Охранник'] = 't2.fio';         
         // $arr['Текст'] = 'text';
         // $arr['Скан документа:'] = 'scan';
         return $arr;
      }
      
      function convertToPrintData($name, $data)
      {
         if($name == "scan")
         {
            return "<img src='$data' width=50px />"; 
         }
         return $data;
      }
   }
?>
