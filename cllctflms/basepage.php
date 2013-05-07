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
	
	function print_header($item, $str, $find)
	{
	   echo "Project Security<br/><br/>
	   <a href='index.php'>Main</a> |
	   <a href='index.php?personal'>Personals</a> |
      <a href='index.php?offense'>Offences</a> |
      <a href='index.php?criminal'>Criminals</a> |
      <a href='index.php?log_of_offense'>Log of Offense</a><br/> <br/> $str :  
      <br>
      <br>
      <form action='index.php' name='form_search' method='GET'>
      <input type='hidden' name='".$item."' value=''/>
      <table>
	      <tr>
		      <td>Find:</td>
		      <td><input type='text' name='find' value='$find' size=100/></td>
		      <td><input type='submit' value='FIND'/></td>
	      </tr>

      </table>
      </form>";
	};
?>
