<?php $price_fn = ['highest_priced_service_provider_service', 'lowest_priced_service_provider_service', 'highest_priced_hospital_service', 'lowest_priced_hospital_service']; ?>
<div class="section-two section-two-one  sec-two wow fadeInDown" data-wow-delay="0.2s">
         <div class="white">
         <div class="container">
            <div class="row">
               <h2>OUR STRENGTH</h2>
               <?php foreach($counters as $counter_fn):
                $counter = call_user_func($counter_fn);
                ?>

               <div class="count-wrap col-md-2 col-sm-4 col-xs-12">
               <a href="javascript:;" class="bx">
            
                  <h2><?php echo (in_array($counter_fn, $price_fn))?'<span>$</span>':'';?><span class="timer count-title count-number" data-to="<?php echo $counter['count'];?>" data-speed="1500"></span></h2>
                  <h4> <?php echo $counter['title'];?>  </h4>
                  </a> 
               <div class="count-content"> 
                  <h3><?php echo $counter['back_title'];?></h3>
                  <p><?php echo $counter['back_description'];?></p>
               </div>
               </div>
              <?php endforeach;?>
            </div>
         </div>
         </div>
      </div>