<form action="friendsbook.php" method="post">
Name: <input type="text" name="name">
<input type="submit" value="Add new friend">
</form>
<p>My Best Friends :</p>
<ul>

<?php
//read file
	$filename = 'friends.txt';
$file = fopen( $filename, "r" );
$friends=array();

if(file_exists($filename)){
while (!feof($file)) {
    $read_name=trim(fgets($file));
    if(strlen($read_name)>0 && !isset($_POST['nameFilter'])){
    	echo "<li>$read_name</li>";
    }
    if (isset($_POST['nameFilter']) && strlen($_POST['nameFilter'])>0) {	
	$nameFilter=$_POST['nameFilter'];
	$lower=strtolower($read_name);
	$nameLow=strtolower($nameFilter);
    	
    		$startingWith=strpos($lower, $nameLow);
    if (isset($_POST['startingWith']) && strlen($_POST['nameFilter'])>0) {    			
    	if ($startingWith===0) {
    		echo "<li>$read_name</li>";
    		}
    	}elseif (strstr($lower,$nameLow)) {
    		echo "<li>$read_name</li>";
    	}	
}
}
fclose($file);
}
// appending to file
if(isset($_POST['name']) && strlen($_POST['name'])>0){
	$stringData=$_POST['name'];
	echo "<li><b>$stringData</b></li>";
	$file = fopen( $filename, "a" );
	fwrite( $file, "$stringData\n");
	fclose($file);
}
?>
</ul>
<form action= "friendsbook.php" method="post">
<input type="text" name="nameFilter">
<input type="submit" value="Filter list">
<input type="checkbox" name="startingWith" value="TRUE">Only names starting with</input>
</form>

