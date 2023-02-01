<?php
require_once 'db.php';
//Get Data
if(isset($_POST['updateid'])){
	
	$id=$_POST['updateid'];
	$sql="SELECT * FROM contact_details WHERE Id='$id'";
	$result=mysqli_query($conn,$sql);
	
	$response=array();
	while($row=mysqli_fetch_assoc($result)){
		$response=$row;
	}
	echo json_encode($response);
	
}

//Update Data
if(isset($_POST['hiddendata'])){
	
	$id=$_POST['hiddendata'];
	$fname=$_POST['updatefname'];
	$lname=$_POST['updatelname'];
	$email=$_POST['updateemail'];
	$mobile=$_POST['updatemobile'];
	
	$sql="UPDATE contact_details SET
			First_name='$fname',
			Last_name='$lname',
			Email='$email',
			Mobile='$mobile'
			WHERE Id='$id'";
			
	$result=mysqli_query($conn,$sql);
	
}
