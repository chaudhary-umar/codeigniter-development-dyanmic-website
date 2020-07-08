<?php
$servicesArray = $serviceProvider->getServices();
$services = [];
$locations = [];

foreach($servicesArray as $service) {
    $service_name = $service->getServiceName();
    if (isset($services[$service_name])) continue;
    $services[$service_name] = '<span data-min-price="'.$service->getMinPrice().'" data-max-price="'.$service->getMaxPrice().'">'.$service_name.'</span>';
}

$contacts = $serviceProvider->getContacts();
foreach($contacts as $contact){
    $addresses = $contact->getAddresses();
    foreach($addresses as $address) {
        $location = $address->getAddress();
        $key = $location->city.'|'.$location->country;
        $locations[$key] = '<a href="javascript:;" onClick="gpt_blog(\''.$location->city.'\', \''.$serviceProvider->getCompanyName().'\')" data-city="'.$location->city.'">'.$location->city.', '.$location->country.' <i class="fa fa-external-link" aria-hidden="true"></i></a>';				
    }
}
ksort($services);
ksort($locations);
?>

<div class="col-md-6 search_grid_item result-block">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">
                <?php echo $serviceProvider->getCompanyName();?>
            </h3>
            <?php if ($isUserLoggedIn): ?>
            <i class="fa fa-heart-o text-danger float-right icon-favorite pb-2" style="position: absolute;    right: 28px;    top: 32px;"
                data-type="service_provider" data-id="<?php echo $serviceProvider->getId();?>"></i>
            <?php endif; ?>
            <div style="clear:both;"></div>
			<p class="card-text block-services"><b>Services:</b>
				<?php echo implode($services, ', ');?>
			</p>
			<p class="card-text block-location"><b>Locations:</b>
				<?php echo implode($locations, ', ');?>
			</p>
        </div>
    </div>
</div>