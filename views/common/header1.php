<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8" />
      <title><?php echo $site_title;?></title>
      <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
      <link rel="icon" href="img/favicon.ico" type="image/x-icon">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway:300,400,500,600,700,900" rel="stylesheet">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
	  <link rel="stylesheet" href="<?php echo $base_url; ?>assets/vendor/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/global/css/animate.css">
      <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/global/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/global/css/style.css">
   </head>
   <body>
      <!-- Small modal -->
      <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <form role="search" method="get" class="search-form" action="<?php echo $base_url;?>search">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Search</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <div class="form-group">
                        <select name="c" class="form-control">
                           <option value="">All Countries</option>
                           <?php foreach($search_countries as $country):?>
								<option value="<?php echo $country;?>"><?php echo $country;?></option>
								<?php endforeach; ?>
                        </select>
                     </div>
                     <div class="form-group">
                        <select name="d" class="form-control">
                           <option value="">All Services</option>
                          <?php foreach($search_departments as $department):?>
								<option value="<?php echo $department;?>"><?php echo $department;?></option>
								<?php endforeach; ?>
                        </select>
                     </div>
                     <div class="form-group">
                        <input type="search" class="form-control" placeholder="Search medical terms" value="" name="s" title="Search for:" autocomplete="off">
                     </div>
                  </div>
                  <div class="modal-footer">
                     <input type="submit" value="Search" class="read-more">
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- BEGIN:HEADER SECTION -->
      <div class="header-wrap">
         <nav class="navbar navbar-default">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="col-md-3 text-center">
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="<?php echo $base_url;?>"><img src="<?php echo $base_url; ?>assets/global/img/logo.png" alt="" class="img-responsive" data-height-percentage="74"></a>
               </div>
            </div>
            <div class="col-md-9">
               <!-- Collect the nav links, forms, and other content for toggling -->
               <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav top-head">
					 <?php if ($isUserLoggedIn): ?>
					  <li><a href="<?php echo $base_url;?>my-account">My Account</a></li>
					  <li><a  href="<?php echo $base_url;?>logout">Logout</a></li>
					<?php else: ?>
					  <li><a href="<?php echo $base_url;?>register-patient">Register</a></li>
					  <li><a href="<?php echo $base_url;?>login">Login</a></li>
					<?php endif;?>
                     <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fas fa-search"></i> Search </a></li>
                  </ul>
                  <ul class="nav navbar-nav" id="mainNavigationBar">
                     <li><a href="<?php echo $base_url; ?>">Homepage</a></li>
                     <li><a href="<?php echo $base_url; ?>about-us">About Us</a></li>
                     <li><a href="<?php echo $base_url; ?>services">Services</a></li>
                     <li><a href="<?php echo $base_url; ?>patients">Patient</a></li>
                     <li><a href="<?php echo $base_url; ?>hospitals">Hospitals</a></li>
                     <li><a href="<?php echo $base_url; ?>providers">Service Providers</a></li>
                     <li><a href="http://blog.global-patienttransfer.com/">Blog</a></li>
                     <li><a href="<?php echo $base_url; ?>contact-us">Contact us</a></li>
                  </ul>
               </div>
               <!-- /.navbar-collapse -->
            </div>
         </nav>
      </div>