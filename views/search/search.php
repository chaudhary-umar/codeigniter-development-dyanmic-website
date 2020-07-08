<div class="banner-section">
 <img src="<?php echo $base_url;?>assets/global/img/about-banner.png" alt="" class="img-responsive">
 <div class="container">
	<h2>Patient Search</h2>
	<ul class="list-inline">
	   <li>
		  <h3>Home</h3>
	   </li>
	   <li>
		  <h3>/</h3>
	   </li>
	   <li>
		  <h3>Search</h3>
	   </li>
	</ul>
 </div>
</div>
<div class="searc-wrap">
         <div class="container">
         <form role="search" method="get" action="<?php echo $base_url;?>search">
     <div class="row">
               <div class="col-md-3 col-md-offset-1">
                  <div class="form-group">
                     <select name="c" class="form-control">
                        <option value="">All Countries</option>
                         <?php foreach($search_countries as $country):?>
						  <option value="<?php echo $country;?>"<?php echo ($country === $selected_country)?' selected':'';?>><?php echo $country;?></option>
						  <?php endforeach; ?>
                     </select>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <select name="d" class="form-control">
                        <option value="">All Services</option>
                       <?php foreach($search_departments as $department):?>
					  <option value="<?php echo $department;?>"<?php echo ($department === $selected_department)?' selected':'';?>><?php echo $department;?></option>
					  <?php endforeach; ?>
                     </select>
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="form-group">
                     <input type="search" class="form-control" placeholder="Search medical terms" value="<?php echo $keyword;?>" name="s" title="Search for:" autocomplete="off">
                  </div>
               </div>
               <div class="col-md-3">
                  <input type="submit" value="Search" class="read-more">
               </div>
            </div>
     </form>
         </div>
      </div>
<div class="container">
         <div class="row">
            <div class="col-md-3">
               <div class="filter">
                  <h3>Filter</h3>
                     <label>City</label>
                     <select class="form-control" id="filter_city"></select>
                     <fieldset class="filter-price">
                        <label>Price: </label><span id="selected-price-range"></span>
                        <div class="price-field">
                           <input type="range" min="0" value="0" id="filter_price_min">
                           <input type="range" min="0" id="filter_price_max">
                        </div>
                     </fieldset>
                     <input type="button" value="Search" class="read-more" id="btn_filter_apply"><input type="button" value="Reset" class="read-more" id="btn_filter_reset">
               </div>
            </div>
            <div class="col-md-9 search-section">
               <div class="search-tab">
                  <div>
                     <!-- Nav tabs -->
                     <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#hospitals" aria-controls="home" role="tab" data-toggle="tab">Hospitals</a></li>
                        <li role="presentation"><a href="#service-providers" aria-controls="profile" role="tab" data-toggle="tab">Service Providers</a></li>
                        <li role="presentation"><a href="#blog" aria-controls="profile" role="tab" data-toggle="tab">Blog</a></li>
                     </ul>
                     <!-- Tab panes -->
                     <div class="tab-content">
					   <div role="tabpanel" class="tab-pane active" id="hospitals">
                     <div class="container-result search_grid" style="display:none">
                         <?php $this->load->view('search/search-hospital', ['hospitals' => $hospitals]);?>
                     </div>
                     <button type="button" class="btn btn-primary btn-lg btn-block for-hospitals btn-load-more">Load More</button>
                  </div>
                  
					   <div role="tabpanel" class="tab-pane" id="service-providers">
                     <div class="container-result search_grid" style="display:none">
                        <?php $this->load->view('search/search-service-provider', ['serviceProviders' => $serviceProviders]);?>
                     </div>
                     <button type="button" class="btn btn-primary btn-lg btn-block for-providers btn-load-more">Load More</button>
						</div>

                  <div role="tabpanel" class="tab-pane" id="blog">
                     <div class="earch_grid">
                     <?php $blog_keywords = [$selected_country,$selected_department,$keyword];?>
                     <a href="http://blog.global-patienttransfer.com/?s=<?php echo implode(',',array_filter($blog_keywords));?>">Search</a> our blogs for your information.
                     </div>
                     
						</div>	
   
						</div>	
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
<?php $this->load->view('common/counters');?>
<?php $this->load->view('common/map');?>
<script type="text/javascript">
var favoriteEntities = <?php echo json_encode($favoriteEntities);?>;
</script>
<?php echo form_open(); ?>
<?php echo form_close(); ?>