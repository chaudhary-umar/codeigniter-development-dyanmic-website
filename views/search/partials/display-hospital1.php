<?php
$departments = [];
$services = [];
$locations = [];

foreach($hospital['departments'] as $department) {
	$departments[] = $department['name'];
	foreach($department['services'] as $service) {
		if (isset($services[$service->service_name])) continue;
		$services[$service->service_name] = '<span data-min-price="'.$service->min_price.'" data-max-price="'.$service->max_price.'">'.$service->service_name.'</span>';
	}
	

	foreach($department['location'] as $location) {
		$key = $location->city.'|'.$location->country;
		$locations[$key] = '<a href="javascript:;" onClick="gpt_blog(\''.$location->city.'\', \''.$hospital['name'].'\')" data-city="'.$location->city.'">'.$location->city.', '.$location->country.' <i class="fa fa-external-link" aria-hidden="true"></i></a>';		
	}

}

ksort($services);
ksort($departments);
?>

<div class="col-md-6 search_grid_item result-block">
	<div class="card">
		<div class="card-body">
			<h3 class="card-title">
				<?php echo $hospital['name'];?>
			</h3>
			<?php if ($isUserLoggedIn): ?>
			<i class="fa fa-heart-o text-danger float-right icon-favorite pb-2" style="position: absolute;    right: 28px;    top: 32px;"
			 data-type="hospital" data-id="<?php echo $hospital['id'];?>"></i>
			<?php endif; ?>
			<div style="clear:both;"></div>
			<p class="card-text block-department"><b>Departments:</b>
				<?php echo implode($departments, ', ');?>
			</p>
			<p class="card-text block-services"><b>Services:</b>
				<?php echo implode($services, ', ');?>
			</p>
			<p class="card-text block-location"><b>Locations:</b>
				<?php echo implode($locations, ', ');?>
			</p>
		</div>
	</div>
</div>