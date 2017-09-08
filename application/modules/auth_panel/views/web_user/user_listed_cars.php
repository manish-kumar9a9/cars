<?php
$option = array(
  'is_json'=> false ,
  'url'=> site_url() . '/service_fetch_user_primary_record' ,
  'data'=> json_encode(array('user_id' =>  $user_id))
);

$result = get_data_with_curl($option);
$user_data = $result['Result'];
/* loading side bar view for user */
$this->load->view('web_user/user_side_bar' ,array("user_data"=>$user_data) ); 

?>


<?php
$option = array(
  'is_json'=> false ,
  'url'=> site_url() . '/service_user_car_list' ,
  'data'=> json_encode(array('fk_user_id' => $user_id))
);

$result = get_data_with_curl($option);
$car_data = $result['Result'];

?>

<div class="col-md-9">

	  <div class="row product-list">

      <?php

        foreach($car_data as $cd){
          ?>
          <div class="col-md-4">
    			  <section class="panel">

    				  <div class="pro-img-box">
    					  <a href ="<?php echo AUTH_PANEL_URL.'web_user/user_car_detail/'.$cd['id'] ; ?>"><img src="<?php echo $cd['car_images'][0]['CarImage_path'];?>" alt=""></a>
    					  <a href="<?php echo AUTH_PANEL_URL.'web_user/user_car_detail/'.$cd['id'] ; ?>" class="adtocart">
    						  <i class="fa fa-search-plus"></i>
    					  </a>
    				  </div>

    				  <div class="panel-body text-center">
    					  <h4>
    						  <a href="<?php echo AUTH_PANEL_URL.'web_user/user_car_detail/'.$cd['id'] ; ?>" class="pro-title">

                      <?php echo $cd['get_make_name']." ".$cd['get_model_name'] ?>

    						  </a>
    					  </h4>
    					  <p class="price"> € <?php echo $cd['price_daily'];?></p>
    					  <div class="">
    						  <span class="text-danger fa-2x">
    							    <?php genrate_star_html($cd['car_rating'] ,"fa-lg  " );?>
    						  </span>
    					  </div>
    				  </div>
    			  </section>

    		  </div>
          <?php
        }
      ?>


	  </div>
  </div>
