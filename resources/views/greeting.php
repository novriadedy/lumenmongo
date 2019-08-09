<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.3/dist/bootstrap-table.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.15.3/dist/bootstrap-table.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<!-- https://medium.com/@kiddy.xyz/tutorial-crud-lumen-5-4-microframework-restful-api-untuk-laravel-ab2a5783d55 -->


<div class="container">
	<div class="row">
		
        
        <div class="col-md-12">
        <h4>Bootstrap Snipp for Datatable</h4>
		 <button type="button" id="buttoncreate" data-toggle="modal" data-target="#edit" data-title="add" class="btn btn-warning btn-lg" style="width: 100%;">Create</button>
        <div class="table-responsive">
		
		<table
		  id="clienti"
		  data-height="460"
		  data-ajax="ajaxRequest"
		  data-search="true"
		  
		  data-pagination="true"
		  searchOnEnterKey="true",
		  >
		</table>

<div class="clearfix"></div>

                
            </div>
            
        </div>
	</div>
</div>


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
      </div>
          <div class="modal-body">
          <div class="form-group">
		<input class="form-control " name="id" id="id" type="hidden">
        <input class="form-control " name="name" id="name" type="text" placeholder="name">
        </div>
        <div class="form-group">
        <input class="form-control " name="email" id="email" type="email"  placeholder="email">
        </div>
        <div class="form-group">
        <textarea rows="2" class="form-control" id="address" name="address"  placeholder="address"></textarea>
        </div>
      </div>
          <div class="modal-footer ">
        <button type="button" id="update" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Submit</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
	
    
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
      </div>
          <div class="modal-body">
       <input class="form-control " name="id" id="id" type="hidden">
       <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
       
      </div>
        <div class="modal-footer ">
        <button type="button" id="confirmdelete" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
	
<script>

function ajaxRequest(params) {
    var url = 'person'
    $.get(url + '?' + $.param(params.data)).then(function (res) {
      params.success(res)
    });
	
	
  }
  
  function ValidateEmail(mail) 
{
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
  {
    return true;
  }
    alert("You have entered an invalid email address!")
    return false;
}


$(document).ready(function(){

  
	var $table = $('#clienti')

	  $(function() {
		$table.bootstrapTable({
		  columns: [
				{ 
                    field: 'name',
                    title: 'Name',
                    align: 'left',
                    valign: 'middle',
                    clickToSelect: false,
                },
				{ 
                    field: 'email',
                    title: 'Email',
                    align: 'left',
                    valign: 'middle',
                    clickToSelect: false,
                },
				{ 
                    field: 'address',
                    title: 'Address',
                    align: 'left',
                    valign: 'middle',
                    clickToSelect: false,
                },
				{ 
                    title: 'Edit',
                    align: 'left',
                    valign: 'middle',
                    formatter: function(value,row,index) {
					   return '<p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs edit" data-title="Edit" data-toggle="modal" data-id="'+row['_id']+'" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p>';
					 },
                },
				{ 
                    title: 'Delete',
                    align: 'left',
                    valign: 'middle',
                    formatter: function(value,row,index) {
					   return '<p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs delete" data-title="Delete" data-toggle="modal" data-id="'+row['_id']+'" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p>';
					 },
                },
				]
		})
	  })
	
	$(document).on("click", ".edit", function () {
		 var id = $(this).data('id');
		 $("#edit #id").val(id );
		  $("#edit #Heading").html($(this).data('title'));
		 $.ajax({
		   method: 'GET',
		   url: 'person/'+id,
		   dataType: 'json',
		   success: function(data) {
				console.log(data);
				
				//var mydata = JSON.parse(data);
				
			    $("#edit #name").val(data[0]['name']);
				$("#edit #email").val(data[0]['email']);
				$("#edit #address").val(data[0]['address']);
			}
		 });
	});
	
	$(document).on("click", ".delete", function () {
		 var id = $(this).data('id');
		 $("#delete #id").val(id );
	});
	
	$(document).on("click", "#buttoncreate", function () {
		 $("#edit #name").val('');
		 $("#edit #email").val('');
		 $("#edit #address").val('');
		 $("#edit #Heading").html($(this).data('title'));
	});
	
	
	
	$(document).on("click", "#update", function () {
		 var id =  $("#edit #id").val();
		 var email = $("#edit #email").val();
		 
		 var noerror = ValidateEmail(email);
		 
		 if(noerror == false)
			 return false;
		 
		 if(id != ''){
			 var name = $("#edit #name").val();
			 
			 var address = $("#edit #address").val();
			 $.ajax({
			   method: 'PUT',
			   url: 'person/'+id,
			   data: {id:id,name:name,email:email,address:address},
			   success: function(data) {
				   $('#edit').modal('hide');
				   $('#clienti').bootstrapTable('refresh');
				}
			 });
		 }
		 else{
			 var name = $("#edit #name").val();
			 var address = $("#edit #address").val();
			 $.ajax({
			   method: 'POST',
			   url: 'person/',
			   data: {id:id,name:name,email:email,address:address},
			   success: function(data) {
				   $('#edit').modal('hide');
				   $('#clienti').bootstrapTable('refresh');
				}
			 });
		 }
		 
	});
	
	$(document).on("click", "#confirmdelete", function () {
		 var id =  $("#delete #id").val();
		 $.ajax({
		   method: 'DELETE',
		   url: 'person/'+id,
		   data: {id:id},
		   success: function(data) {
			   $('#delete').modal('hide');
			   $('#clienti').bootstrapTable('refresh');
			}
		 });
	});
    
    $("[data-toggle=tooltip]").tooltip();
});

</script>