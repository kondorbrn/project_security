<?
	session_start();
	
	
	function getFromPost($name)
	{
		$m = "";
		if( isset( $_POST[$name] ) ) $m = htmlspecialchars( $_POST[$name] );
		return $m;
	};

	function refreshTo($new_page)
	{
		header ("Location: $new_page");
		exit;
	};	
?>
