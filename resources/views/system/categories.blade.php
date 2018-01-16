@extends('layout')

@section('title', 'Manage Categories')

@section('main')
	
	<div class="modal fade" id="modal-idx">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title"><i class="fa fa-th"></i>  Categories</h4>
		  </div>
		  <div class="modal-body" style="">
			<center>
			  <img class="loadeCats" style="display:none" src="{{url('BACKEND/images/loader.gif')}}" />
			</center>
			<div id="cats_area"></div>
		  </div>
		</div>
	  </div>
	</div>

	<div class="row">

		<div class="col-sm-12">
			<div class="">
				<div class="row">
					<div class="col-md-3 card-box">
						<h4 class="m-t-0 header-title "><b><i class="fa fa-plus"></i> Add New Category</b></h4>
						<hr/>
						
						<form role="form" id="registerForm_Cat">

							{!!csrf_field()!!}

							<div class="form-group">
								<label for="catName">Category Name: </label>
								<input type="text" required class="form-control validate[required]" data-errormessage-value-missing="Category name is required!" value="" data-prompt-position="bottomRight" id="catName" name="catName" placeholder="Enter Category Name">
							</div>
							
							
							
							
							
							<div class="form-group">
								<label for="status">Status: </label>
								<select class="form-control validate[required]" data-errormessage-value-missing="Status is required!" id="status" name="status" data-prompt-position="bottomRight">
									<option value="">--Select Status Here--</option>
									<option value="1">Activated</option>
									<option value="0">Blocked</option>
								</select>
							</div>
							
							<hr/>
							
							@include('partials._buttonSave', ['btnId'=>'saveCat', 'title'=>'Add New Category'])
							
							
							


						</form>
					</div>
					<div class="col-md-6 card-box">
					
						<?php 
						
							$data = \App\Category::orderBy('created_at', 'DESC')->get();
							
						?>
					
						@include('partials._success')
						@include('partials._datatables', ["columns"=>["Category Name", "Status", "Actions"], "mapEls"=>["category_name", "status"], "data"=>$data, "modal"=>"normal", "url_edit"=>"configure/items/categories/edit", "url_delete" =>"configure/items/categories/delete", "refreshWix"=>"app.refresh", "isTaggedHtml"=>true, 'perms'=>['perm_name'=>'Category']])

					</div>
					
				</div>
			</div>
		</div>

	</div>


@stop


@section('custom-scripts')

<script>
$(function(){
	
	

});
</script>

@include('partials._saveFunc', ['btnID'=>'saveCat', 'formID'=>'registerForm_Cat', 'route'=>'configure.categories.store', 'routeWith'=>'app.refresh'])

@stop