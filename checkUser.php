<?php

/* On this page we will

	- return the form info using POST
	email
	pswrd


	Username
	Userpass


*/

?>

<?php	
$Username_v = $_POST["email"];
$Userpass_v = $_POST["pswrd"];

$sqlUCheck = "SELECT * FROM log WHERE username . Userpass = '$Username_v'$pswrd_v ";
	$result = mysqli_query($conn, $sqlUCheck);
	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
	        $storedPassword_v = $row["pswrd"];
	        echo "$storedPassword_v";
			if (password_verify($pswrd_v, $storedPassword_v))
			{ 
			  echo "Password correct!";
			}
			else
			{  echo "Nope"; }
	    }
	} else {  echo "0 results";	}
?>

<?php
