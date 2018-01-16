@extends('layout')

@section('main')

<div class="row">
    
	<div class="col-md-12 card-box">
		<div id="map" style="width: inherit; height: 800px;"></div>	
    </div>
</div>

@stop

@section('custom-scripts')

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1bTUQnG3MdnJnJQ9z1KzcQYovliaGcqs"></script>
<script src="{{url('maps/jquery.googlemap.js')}}"></script>
<script type="text/javascript">
  $(function() {
    $("#map").googleMap({
      zoom: 10, // Initial zoom level (optional)
      type: "ROADMAP" // Map type (optional)
    });
	$("#map").addMarker({
    	 coords: [48.869439, 2.308664]
    });
  })
</script>

@stop