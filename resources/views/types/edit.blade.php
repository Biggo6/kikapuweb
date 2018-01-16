
<?php 

$rowId =  $type->id;

?>

<form role="form" id="registerForm_Type_Edit">

	{!!csrf_field()!!}

	<div class="form-group">
		<label for="typeName">Type Name: </label>
		<input type="text" required class="form-control validate[required]" data-errormessage-value-missing="Type name is required!" value="{{$type->type_name}}" data-prompt-position="bottomRight" id="typeName" name="typeName" placeholder="Enter Type Name">
	</div>
	
	
	
	
	
	<div class="form-group">
		<label for="status">Status: {!!getStatus($type->status)!!}</label>
		<select class="form-control validate[required]" data-errormessage-value-missing="Status is required!" id="status" name="status" data-prompt-position="bottomRight">
			@if($type->status == 1)
			<option value="1">Activated</option>
			<option value="0">Blocked</option>
			@else
			<option value="0">Blocked</option>
			<option value="1">Activated</option>		
			@endif
		</select>
	</div>
	
	<hr/>
	
	@include('partials._buttonSave', ['btnId'=>'saveTypeEdit', 'title'=>'Update Type'])
	
	
	


</form>

<!-- jQuery -->
<script src="{{url('BACKEND/vendors/jquery/dist/jquery.min.js')}}"></script>

@include('partials._saveFunc', ["btnID" => "saveTypeEdit", "formID"=>"registerForm_Type_Edit", "route"=>"configure.types.update", "routeWith"=>"app.updated", "rowId"=>$rowId, "update"=>true])

