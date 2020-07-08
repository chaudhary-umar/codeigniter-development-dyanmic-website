
<div class="section-four wow fadeInDown" data-wow-delay="0.2s">
	 <div class="container">
		<div class="row">
		   <h2>OUR LOCATION MAP</h2>
		   <h3>Get in Touch with us</h3>
		   <div id="infowindow" class="col-12" style="height:20em"></div>
		</div>
	 </div>
  </div>
<script type="text/javascript">
	function initMap() {
		var houton = {
			lat: 29.704890648467092,
			lng: -95.42628881754355
		};
		var map = new google.maps.Map(document.getElementById('infowindow'), {
			zoom: 18,
			center: houton
		});
		var marker = new google.maps.Marker({
			position: houton,
			map: map
		});
	}

</script>
<script async defer type='text/javascript' src='https://maps.googleapis.com/maps/api/js?key=AIzaSyAzqI_CafN4-jMhc21XlFa6OKrlalPjGv8&callback=initMap'></script>
