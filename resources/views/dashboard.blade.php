@extends('layout')

@section('main')

<div class="row">
    
	<div class="col-md-12 card-box">
		<div id="map" style="width: inherit; height: 800px;"></div>	
    </div>
</div>

@stop

@section('custom-scripts')

<?php

$locations = \App\Location::all();

?>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1bTUQnG3MdnJnJQ9z1KzcQYovliaGcqs"></script>
<script src="{{url('maps/jquery.googlemap.js')}}"></script>
<script type="text/javascript">
  $(function() {
	  
	var geocoder = new google.maps.Geocoder();

	console.log(geocoder)	
	  
    $("#map").googleMap({
      zoom: 15, // Initial zoom level (optional)
      type: "ROADMAP" // Map type (optional)
    });
	@foreach($locations as $l)
		
		var address = '{{$l->address}}';
		var email   = '{{$l->email}}';
		var phone   = '{{$l->mobileno}}';
		
		geocoder.geocode( { 'address': address}, function(results, status) {

			if (status == google.maps.GeocoderStatus.OK) {
				var latitude = results[0].geometry.location.lat();
				var longitude = results[0].geometry.location.lng();
				$("#map").addMarker({
					 coords: [latitude, longitude],
					 title: '{{$l->fullname}}',
					 text: '<b>Address: </b> ' + address + ' , \n\r  <b>Email: </b> ' +  email + '\n, <b>Phone: </b> ' +  phone + '\n'
				});
			}
		}); 
	
		
	@endforeach
  })
</script>

@stop