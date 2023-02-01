<!DOCTYPE html>
<html>
<head>
<!-- Bootastrap 4.6.2 CDN -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container my-3">
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addusermodel">
	  Add User
	</button>
	<div id="displayData" class="my-3"> </div>
	
</div>

	<!-- Modal -->
	<div class="modal fade" id="addusermodel" tabindex="-1" aria-labelledby="addusermodelLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="addusermodelLabel">Add User</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div class="form-group">
				<label for="firstName">First Name</label>
				<input type="text" class="form-control" id="firstName">
			</div>
			<div class="form-group">
				<label for="lastName">Last Name</label>
				<input type="text" class="form-control" id="lastName">
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control" id="email">
			</div>
			<div class="form-group">
				<label for="mobile">Mobile</label>
				<input type="text" class="form-control" id="mobile">
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="button" onclick="addUser()" class="btn btn-primary">Save</button>
		  </div>
		</div>
	  </div>
	</div>
<!-- Update User Modal -->
<div class="modal fade" id="updatemodel" tabindex="-1" aria-labelledby="updatemodelLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="updatemodelLabel">Update User</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div class="form-group">
				<label for="firstName">First Name</label>
				<input type="text" class="form-control" id="updatefirstName">
			</div>
			<div class="form-group">
				<label for="lastName">Last Name</label>
				<input type="text" class="form-control" id="updatelastName">
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control" id="updateemail">
			</div>
			<div class="form-group">
				<label for="mobile">Mobile</label>
				<input type="text" class="form-control" id="updatemobile">
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="button" onclick="updateDetails()" class="btn btn-primary">Update</button>
			<input type="hidden" id="hiddendata">
		  </div>
		</div>
	  </div>
	</div>

<script>
	$(document).ready(function(){
		displayData();
	});
	
	function displayData(){
		var displayData="true";
		$.ajax({
			url:'display.php',
			type:'POST',
			data:{
				displaysend:displayData
			},
			success:function(data,status){
				
				$('#displayData').html(data);
			}
		});
	}
	
	function addUser(){
		var fname=$('#firstName').val();
		var lname=$('#lastName').val();
		var email=$('#email').val();
		var mobile=$('#mobile').val();

		$.ajax({
			url:'insert.php',
			type:'POST',
			data:{
				fnamesend:fname,
				lnamesend:lname,
				emailsend:email,
				mobilesend:mobile
			},
			success:function(data,status){
				$('#addusermodel').modal('toggle');
				displayData();
			}
		});
	}

	function deleteUser(deleteid){
		$.ajax({
			url:'delete.php',
			type:'POST',
			data:{
				deletesend:deleteid
			},
			success:function(data,status){
				displayData();
			}
		});
	}
	function getDetails(updateid){
		$('#hiddendata').val(updateid);
		$.post("update.php",{updateid:updateid},function(data,status){
			
			var userid=JSON.parse(data);
			$('#updatefirstName').val(userid.FirstName);
			$('#updatelastName').val(userid.LastName);
			$('#updateemail').val(userid.Email);
			$('#updatemobile').val(userid.Mobile);
		});
		
		$('#updatemodel').modal('show');	
	}
	
	function updateDetails(){
		var updatefname=$('#updatefirstName').val();
		var updatelname=$('#updatelastName').val();
		var updateemail=$('#updateemail').val();
		var updatemobile=$('#updatemobile').val();
		var hiddendata=$('#hiddendata').val();
		
		$.post("update.php",{
			updatefname:updatefname,
			updatelname:updatelname,
			updateemail:updateemail,
			updatemobile:updatemobile,
			hiddendata:hiddendata
			
		},function(data,status){
			
			$('#updatemodel').modal('toggle');
			displayData();
		});
	}
	
</script>
</body>
</html>
