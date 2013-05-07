<? 
	error_reporting(E_ALL); 
	
	function create_objects()
	{
		$objs = array();
		
		include_once "personal.php";
		$objs["personal"] = new personal();
		
		include_once "offense.php";
		$objs["offense"] = new offense();
		
		include_once "criminal.php";
		$objs["criminal"] = new criminal();
		
		include_once "log_of_offense.php";
		$obj["log_of_offense"] = new log_of_offense();
		return $objs;
	}

?>