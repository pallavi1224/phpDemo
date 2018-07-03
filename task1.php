<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
	<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" /> 
    <title>Task!</title>
  </head>
  <body>
   <div class="container">
   <form class="m-3">
	<div class="col-md-5 offset-md-3">
	<div id="result" class="m-5">
	
	</div>
	<h3 class="m-3 p-4 text-success text-center">Add Personal Details</h3>
	<div class="form-group">
		<label for="First Name">First Name</label>
		<input type="text" name="f_name" id="f_name" class="form-control" />
	</div>
	<div class="form-group">
		<label for="First Name">First Name</label>
		<input type="text" name="l_name" id="l_name" class="form-control"/>
   </div>
   <div class="form-group">
		<label for="Email address">Email address</label>
		<input type="email" name="email" id="email" class="form-control"/>
   </div>
   <button type="button" id="add" class="bn btn-primary">Add Info</button>
	</div>
   </form>

 
	<div id="records_table">
   
   </div> 

   
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
		  <input type="hidden" id="info_id" class="form-control">
            <label for="recipient-name" class="col-form-label">First Name:</label>
            <input type="text" class="form-control" id="fname">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Last Name:</label>
            <input class="form-control" id="lname"/>
          </div>
		   <div class="form-group">
            <label for="message-text" class="col-form-label">Email:</label>
            <input class="form-control" id="eemail"/>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update">Update</button>
      </div>
    </div>
  </div>
</div> 
   
   
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
		  <input type="hidden" id="info_id1" class="form-control">
            <label for="recipient-name" class="col-form-label">First Name:</label>
            <input type="text" class="form-control" id="fname1">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Last Name:</label>
            <input class="form-control" id="lname1"/>
          </div>
		   <div class="form-group">
            <label for="message-text" class="col-form-label">Email:</label>
            <input class="form-control" id="eemail1"/>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="delete">Delete</button>
      </div>
    </div>
  </div>
</div>
   
  </body>
</html>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
   
   <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
   
<script>
$(document).ready(function() {
	get_data();
});
</script>

<script>
$('#add').click(function(){
	var f_name = $('#f_name').val();
	var l_name = $('#l_name').val();
	var email = $('#email').val();
	if(f_name == ''){
		alert("Please Enter First Name");
		return;
	}else if(l_name == ''){
		alert("Please Enter Last Name");
		return;
	}else if(email == ''){
		alert("Please Enter Email");
		return;
	}
	$.ajax({
		url: 'add.php',
		data: 'f_name='+f_name+'&l_name='+l_name+'&email='+email,
		method: 'POST',
		success : function(result){
			//console.log(result);
			var data = JSON.parse(result);
			get_data();
			if(data.success == 1)
			{
				$('#result').html("<div class='alert alert-primary' role='alert'>Record Added Successfully</div>");
			}
			else if(data.error == 1){
				$('#result').html("<div class='alert alert-primary' role='alert'>Record Not Added </div>");
			}
		}
	});
});
</script>

<script>
function get_data(){
	$.ajax({
	  url: 'get_data.php',
	  method: 'POST',
	  success : function(result){
			//console.log(result);
			var data = JSON.parse(result);
			var trHTML = "<table id='example' class='table table-striped table-bordered' style='width:100%'><thead><tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Update</th><th>Delete</th></tr></thead><tbody>";
            $.each(data, function (i, item) {
            trHTML += "<tr><td>" + data[i].f_name + "</td><td>" + data[i].l_name + "</td><td>" + data[i].email + "</td><td><button type='button' class='btn btn-warning' onclick='update_data("+data[i].id+")'>Edit</button>"+"</td><td><button type='button' class='btn btn-danger' onclick='delete_data("+data[i].id+")'>Delete</button>" +"</td></tr>";
            });
			trHTML += "</tbody></table>";
            $('#records_table').html(trHTML);
			var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
	  }
	})
}
</script>

<script>
function update_data(id){
	$('#myModal').modal('show');
	$('#info_id').val(id);
	$.ajax({
		url: 'per_person.php',
		data: 'id='+id,
		method: 'POST',
		success : function(result){
			//console.log(result);
			var data = JSON.parse(result);
			console.log(data);
			$('#info_id').val(data.id);
			$('#fname').val(data.f_name);
			$('#lname').val(data.l_name);
			$('#eemail').val(data.email);
		}
	});
	
}
</script>

<script>
function delete_data(id){
	$('#myModal1').modal('show');
	$('#info_id').val(id);
	$.ajax({
		url: 'per_person.php',
		data: 'id='+id,
		method: 'POST',
		success : function(result){
			//console.log(result);
			var data = JSON.parse(result);
			console.log(data);
			$('#info_id1').val(data.id);
			$('#fname1').val(data.f_name);
			$('#lname1').val(data.l_name);
			$('#eemail1').val(data.email);
		}
	});
	
}
</script>

<script>
$('#update').click(function(){
	var id = $('#info_id').val();
	var f_name = $('#fname').val();
	var l_name = $('#lname').val();
	var email = $('#eemail').val();
	$.ajax({
		url: 'update_person.php',
		data: 'id='+id+'&f_name='+f_name+'&l_name='+l_name+'&email='+email,
		method: 'POST',
		success : function(result){
			//console.log(result);
			var data = JSON.parse(result);
			get_data();
			if(data.success == 1)
			{
				$('#myModal').modal('hide');
				$('#result').html("<div class='alert alert-primary' role='alert'>Record Updated Successfully</div>");
			}
			else if(data.error == 1){
				$('#result').html("<div class='alert alert-primary' role='alert'>Record Not Updated </div>");
			}
		}
	});
});
</script>

<script>
$('#delete').click(function(){
	var id = $('#info_id1').val();
	$.ajax({
		url: 'delete_person.php',
		data: 'id='+id,
		method: 'POST',
		success : function(result){
			//console.log(result);
			var data = JSON.parse(result);
			get_data();
			if(data.success == 1)
			{
				$('#myModal1').modal('hide');
				$('#result').html("<div class='alert alert-primary' role='alert'>Record deleted Successfully</div>");
			}
			else if(data.error == 1){
				$('#result').html("<div class='alert alert-primary' role='alert'>Record Not Deleted </div>");
			}
		}
	});
});
</script>

 
