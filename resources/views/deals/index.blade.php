@extends('layout')

@section('title', 'Manage Deals')

@section('main')

	<div class="row">

		<div class="col-sm-12">
			<div class="">
				<div class="row">
					<div class="col-md-3 card-box">
						<h4 class="m-t-0 header-title "><b><i class="fa fa-plus"></i> Add New Deal</b></h4>
						<hr/>
						
						<form role="form" id="registerForm_Deal">

							{!!csrf_field()!!}

							
							<div class="form-group">
								<label for="dealImage">Deal Image: </label>
								<input type="file" id="dealImage" name="dealImage"  data-errormessage-value-missing="Deal image is required!"  class="filestyle validate[required]" data-buttonName="btn-primary">
								<br/>
								<div id="image-placeholder"></div>
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
							
							@include('partials._buttonSave', ['btnId'=>'saveDeal', 'title'=>'Add New Deal'])
							
							
							


						</form>
					</div>
					<div class="col-md-9 card-box">
					
					    <?php 
						
							$data = \App\Deal::orderBy('created_at', 'DESC')->get();
							
							
							$dxX = [];
							
							foreach($data as $d){
												
								$dx = [];
								$dx['id']           = $d->id;
								$dx['status']       = $d->status;
								$dx['image']        = '<img style="width: 150px" src="' . $d->imagepath . '" />';
								
								$dxX[] = (object)$dx;
							} 
						
						?>
					
						@include('partials._success')
						@include('partials._datatables', ["columns"=>["Deal Image", "Status", "Actions"],
						"mapEls"=>["image", "status"],
						"data"=>$dxX, "modal"=>"normal", "url_edit"=>"deals/edit", "url_delete" =>"deals/delete", "refreshWix"=>"app.refresh", "isTaggedHtml"=>true, 'perms'=>['perm_name'=>'Deals']])
						
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
        Biggo.changePhotoDiv('dealImage', 'image-placeholder', 190, 170, '');
    });

</script>


@include('partials._saveFunc', ['btnID'=>'saveDeal', 'formID'=>'registerForm_Deal', 'route'=>'deals.store', 'routeWith'=>'app.refresh',  'photo'=>'dealImage'])

@stop