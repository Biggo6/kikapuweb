
<?php 

$rowId =  $category->id;

?>

<form role="form" id="registerForm_Cat_Edit">

	{!!csrf_field()!!}

	<div class="form-group">
		<label for="catName">Category Name: </label>
		<input type="text" required class="form-control validate[required]" data-errormessage-value-missing="Category name is required!" value="{{$category->category_name}}" data-prompt-position="bottomRight" id="catName" name="catName" placeholder="Enter Category Name">
	</div>
	
	
	
	
	
	<div class="form-group">
		<label for="status">Status: {!!getStatus($category->status)!!}</label>
		<select class="form-control validate[required]" data-errormessage-value-missing="Status is required!" id="status" name="status" data-prompt-position="bottomRight">
			@if($category->status == 1)
			<option value="1">Activated</option>
			<option value="0">Blocked</option>
			@else
			<option value="0">Blocked</option>
			<option value="1">Activated</option>		
			@endif
		</select>
	</div>
	
	<hr/>
	
	@include('partials._buttonSave', ['btnId'=>'saveCatEdit', 'title'=>'Update Category'])
	
	
	


</form>

<!-- jQuery -->
<script src="{{url('BACKEND/vendors/jquery/dist/jquery.min.js')}}"></script>

@include('partials._saveFunc', ["btnID" => "saveCatEdit", "formID"=>"registerForm_Cat_Edit", "route"=>"configure.categories.update", "routeWith"=>"app.updated", "rowId"=>$rowId, "update"=>true])

