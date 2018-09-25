<?php
if(isset($_SESSION['username']))
{
	echo "<h1>Hello,{$_SESSION['username']}</h1><br />";
}
echo "________________________________";
?>