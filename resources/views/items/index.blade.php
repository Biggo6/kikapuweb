@extends('layout')

@section('title', 'Manage Items')

@section('main')

	<div class="row">

		<div class="col-sm-12">
			<div class="">
				<div class="row">
					<div class="col-md-3 card-box">
						<h4 class="m-t-0 header-title "><b><i class="fa fa-plus"></i> Add New Item/Product</b></h4>
						<hr/>
						
						<form role="form" id="registerForm_Item">

							{!!csrf_field()!!}

							<div class="form-group">
								<label for="itemTitle">Item Title: </label>
								<input type="text" required class="form-control validate[required]" data-errormessage-value-missing="Item title is required!" value="" data-prompt-position="bottomRight" id="itemTitle" name="itemTitle" placeholder="Enter Item title">
							</div>


							<div class="form-group">
								<label for="itemPrice">Item Price(TZS): </label>
								<input type="text" required class="form-control validate[required,custom[number]]" data-errormessage-custom-error="Price Must be Numbers" data-errormessage-value-missing="Item price is required!" value="" data-prompt-position="bottomRight" id="itemPrice" name="itemPrice" placeholder="Enter Item price">
							</div>
							
							
							<div class="form-group">
								<label for="category">Category: </label>
								<select class="form-control validate[required]" data-errormessage-value-missing="Category is required!" id="category" name="category" data-prompt-position="bottomRight">
									<?php
										$categories = App\Category::where('status', 1)->get();
									?>
									<option value="">--Select Category Here--</option>
									@foreach($categories as $c)
									<option>{{$c->category_name}}</option>	
									@endforeach
								</select>
							</div>

							<div class="form-group">
								<label for="itemtype">Type: </label>
								
								<?php
									$types = App\ItemType::where('status', 1)->get();
									$i = 1;	
								?>
								@foreach($types as $t)
								<div>
									<input type="checkbox" id="checkbox{{$i}}" name="types[]" value="{{$t->type_name}}" class="css-checkbox lrg" />
						            <label for="checkbox{{$i}}" name="checkbo{{$i}}_lbl" class="css-label lrg vlad">{{$t->type_name}}</label>
								</div>
								<?php $i++; ?>
								@endforeach
								<hr/>
							</div>
							
							<div class="form-group">
								<label for="status">Status: </label>
								<select class="form-control validate[required]" data-errormessage-value-missing="Status is required!" id="status" name="status" data-prompt-position="bottomRight">
									<option value="">--Select Status Here--</option>
									<option value="1">Activated</option>
									<option value="0">Blocked</option>
								</select>
							</div>

							<div class="form-group">
								<label for="itemPrice">Item Image: </label>
								<input type="file" id="itemImage" name="itemImage"  data-errormessage-value-missing="Item image is required!"  class="filestyle validate[required]" data-buttonName="btn-primary">
								<br/>
								<div id="image-placeholder"></div>
							</div>
							
							<hr/>
							
							@include('partials._buttonSave', ['btnId'=>'saveItem', 'title'=>'Add New Item'])
							
							
							


						</form>
					</div>
					<div class="col-md-9 card-box">
					
					    <?php 
						
							$data = \App\Product::orderBy('created_at', 'DESC')->get();
							
							
							$dxX = [];
							
							foreach($data as $d){
								
								$types = explode(",", $d->types);
								
								$txt = "<ol>";
								
								foreach($types as $t){
									if($t != ""){
										$txt .= "<li>" . $t . "</li>";
									}
								}
								
								$txt .= "</ol>";
								
								
								$dx = [];
								$dx['id']           = $d->id;
								$dx['title']        = $d->title;
								$dx['price']        = $d->price;
								$dx['category']     = $d->category;
								$dx['status']       = $d->status;
								$dx['types']        = $txt;
								$dx['image']        = '<img style="width: 150px" src="' . $d->productimage . '" />';
								
								$dxX[] = (object)$dx;
							} 
						
						?>
					
						@include('partials._success')
						@include('partials._datatables', ["columns"=>["Product Image", "Title", "Price", "Category", "Status", "Types", "Actions"],
						"mapEls"=>["image", "title", "price", "category", "status", "types"],
						"data"=>$dxX, "modal"=>"normal", "url_edit"=>"items/edit", "url_delete" =>"items/delete", "refreshWix"=>"app.refresh", "isTaggedHtml"=>true, 'perms'=>['perm_name'=>'Items']])
						
					</div>
					
				</div>
			</div>
		</div>

	</div>


@stop


@section('custom-scripts')


<script type="text/javascript" src="{{url('BACKEND/iztools/biggo.js')}}"></script>
<script type="text/javascript">
    
    $(function(){
        Biggo.changePhotoDiv('itemImage', 'image-placeholder', 190, 170, '');
    });

</script>


@include('partials._saveFunc', ['btnID'=>'saveItem', 'formID'=>'registerForm_Item', 'route'=>'items.store', 'routeWith'=>'app.refresh',  'photo'=>'itemImage'])

@stop