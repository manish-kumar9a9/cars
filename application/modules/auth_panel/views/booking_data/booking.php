
<?php
$option = array(
	'is_json' => false,
	'url' => site_url() . '/service_fetch_single_request_data',
	'data' => array('id' => $booking_id)
);

$result = get_data_with_curl($option);
$booking_data = $result['Result'];
$owner_data = $booking_data['car_owner_data'];
$renter_data = $booking_data['car_renter_data'];
$car_details = $booking_data['car_details'];
$account_data = $booking_data['booking_renter_transaction'];
?>
<style>
	.profile-fixer img {
		height: 90px;
		width: 90px;
	}
</style>

<?php
				if (count($booking_renter_transaction) > 0 && array_key_exists('transaction_id', $booking_renter_transaction) && $booking_renter_transaction['transaction_id'] != "" &&$booking_renter_transaction['status'] == 0) {
					?>
					<div class="col-md-12">
						<div class="pull-right">
				              <span class="posted_in">
				              		<strong>Set this booking complete for pay back transaction: </strong>
				              		<a class="btn-sm btn btn-info" href="<?php echo base_url(); ?>index.php/auth_panel/booking/booking_complete_pay_back/<?php echo $booking_renter_transaction['booking_id']; ?>">Click Me</a>
				              </span>
		              
	            		</div>
            		</div>
				<?php } ?>
<div class="col-lg-4">
	<!--user info table start-->
	<section class="panel">
		<?php
		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_account_info_with_user_id',
			'data' => array('user_id' => $renter_data['userId'])
		);

		$result = get_data_with_curl($option);
		$account_data_renter = $result['Result'];
		?>

		<?php
		if (count($account_data_renter) > 0 && array_key_exists('banking_account_id', $account_data_renter) && $account_data_renter['banking_account_id'] != "") {
			?>
			<div class="alert alert-success alert-block fade in no-margin ">
				<p> <i class="fa fa-check"></i> User Bank Account  information is available.</p>
			</div>				
		<?php } else { ?>
			<div class="alert alert-danger alert-block fade in no-margin  ">
				<p> <i class="fa fa-warning"></i> User Bank Account  information is not available.</p>
			</div>				
		<?php } ?>	

		<div class="panel-body">
			<a href="#" class="task-thumb profile-fixer">
				<img src="<?php echo $renter_data['user_image']; ?>" alt="">
				<div class="">
					<span class="">
						<?php genrate_star_html($renter_data['user_rating'], "fa-lg", 'span'); ?>
					</span>
				</div>
			</a>
			<div class="task-thumb-details">
				<h1><a href="#">CAR RENTER</a></h1>
				<p><?php echo $renter_data['firstName'] . ' ' . $renter_data['lastName']; ?></p>
				<p><?php echo $renter_data['email']; ?></p>
			</div>
		</div>
		<table class="  table table-hover personal-task">
			<tbody>
				<tr class= "bg-success">
					<td>
						<i class=" fa fa-check"></i>
					</td>
					<td>Booking request </td>
					<td><?php echo $booking_data['creation_time']; ?></td>
				</tr>
				<?php if ($booking_data['rejected_by_car_renter'] == 1) { ?>
					<tr class= "bg-danger" >
						<td>
							<i class="fa fa-times text-danger"></i>
						</td>
						<td>Request rejected</td>
						<td><?php echo $booking_data['rejected_by_car_renter_time']; ?></td>
					</tr>
				<?php } ?>
				<?php if ($booking_data['pickup_confirmed'] == 1) { ?>
					<tr class= "bg-success">
						<td>
							<i class=" fa fa-check"></i>
						</td>
						<td>Pickup confirmed </td>
						<td><a href="<?php echo AUTH_PANEL_URL . "booking/booking_pickup_data/" . $booking_data['id']; ?>" >view_info</a></td>
					</tr>
				<?php } ?>

			</tbody>
		</table>
	</section>
	<!--user info table end-->
</div>
<div class="col-lg-4">

	<!--features carousel start-->
	<section class="panel">
		<div class="flat-carousal">
			<div id="owl-demo" class="owl-carousel owl-theme">
				<?php
				foreach ($car_details['car_images'] as $cl) {
					?>

					<div style="width: 330px;" class="owl-item">
						<div class="item">
							<img src="<?php echo $cl['CarImage_path']; ?>">

						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
		<div class="panel-body hide">
			<ul class="ft-link">
				<li class="active">
					<a href="javascript:;">
						<i class="fa fa-bars"></i>
						Sales
					</a>
				</li>
				<li>
					<a href="javascript:;">
						<i class=" fa fa-calendar-o"></i>
						promo
					</a>
				</li>
				<li>
					<a href="javascript:;">
						<i class=" fa fa-camera"></i>
						photo
					</a>
				</li>
				<li>
					<a href="javascript:;">
						<i class=" fa fa-circle"></i>
						other
					</a>
				</li>
			</ul>
		</div>
	</section>
	<!--features carousel end-->
</div>

<div class="col-lg-4">
	<!--user info table start-->
	<section class="panel">
		<?php
		$option = array(
			'is_json' => false,
			'url' => site_url() . '/service_account_info_with_user_id',
			'data' => array('user_id' => $owner_data['userId'])
		);

		$result = get_data_with_curl($option);
		$account_data_owner = $result['Result'];
		?>
		<?php
		if (count($account_data_owner) > 0 && array_key_exists('banking_account_id', $account_data_owner) && $account_data_owner['banking_account_id'] != "") {
			?>
			<div class="alert alert-success alert-block fade in no-margin  ">
				<p> <i class="fa fa-check"></i> User Bank Account  information is available.</p>
			</div>				
		<?php } else { ?>
			<div class="alert alert-danger alert-block fade in no-margin  ">
				<p> <i class="fa fa-warning"></i> User Bank Account  information is not available.</p>
			</div>				
		<?php } ?>

		<div class="panel-body">
			<a href="#" class="task-thumb profile-fixer pull-right">
				<img src="<?php echo $owner_data['user_image']; ?>" alt="">
				<div class="">
					<span class="">
						<?php genrate_star_html($owner_data['user_rating'], "fa-lg", 'span'); ?>
					</span>
				</div>
			</a>
			<div class="task-thumb-details">
				<h1><a href="#">CAR OWNER</a></h1>
				<p><?php echo $owner_data['firstName'] . ' ' . $owner_data['lastName']; ?></p>
				<p><?php echo $owner_data['email']; ?></p>
			</div>
		</div>
		<table class="table table-hover personal-task">
			<tbody>
				<?php if ($booking_data['accepted_car_owner'] == 1) { ?>
					<tr class= "bg-success">
						<td>
							<i class=" fa fa-check"></i>
						</td>
						<td>Request accept</td>
						<td><?php echo $booking_data['accepted_car_owner_time']; ?></td>
					</tr>
				<?php } ?>
				<?php if ($booking_data['rejected_by_car_owner'] == 1) { ?>
					<tr class= "bg-danger" >
						<td>
							<i class="fa fa-times"></i>
						</td>
						<td>Request rejected</td>
						<td><?php echo $booking_data['rejected_by_car_owner_time']; ?></td>
					</tr>
				<?php } ?>
				<?php if ($booking_data['transaction_complete'] == 1) { ?>
					<tr class= "bg-success">
						<td>
							<i class=" fa fa-check"></i>
						</td>
						<td>Transaction complete </td>
						<td><a href="<?php echo AUTH_PANEL_URL . "booking/booking_pickup_data/" . $booking_data['id']; ?>" >view_info</a></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</section>
	<!--user info table end-->
</div>

<aside class="profile-info col-md-12">
	<section class="panel">
		<div class="panel-body bio-graph-info">
			<h1>Booking Information</h1>
			<div class="row">
				<div class="bio-row">
					<p><span>Car to </span>: <?php echo $booking_data['car_to']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Car from </span>: <?php echo $booking_data['car_from']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Monthly discount </span>: <?php echo $booking_data['discount_monthly']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Weekly discount</span>: <?php echo $booking_data['discount_weekly']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Car distance per day </span>: <?php echo $booking_data['car_distance_per_day']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Extra distance </span>: <?php echo $booking_data['for_extra_distance']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Pickup location </span>: <?php echo $booking_data['pickup_location']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Drop location </span>: <?php echo $booking_data['drop_off_location']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Weekly discount in (%) </span>: <?php echo $booking_data['percent_discount_weekly']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Monthly discount in (%) </span>: <?php echo $booking_data['percent_discount_monthly']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Car daily price </span>: <?php echo $booking_data['car_daily_price']; ?></p>
				</div>
			</div>
		</div>
	</section>
	<section class="panel">

		<table class="table table-hover personal-task">
			<tbody>
				<tr>
					<td>
						<i class=" fa fa-calendar"></i>
					</td>
					<td>price_for_time</td>
					<td> <i class="fa fa-euro"> <?php echo $booking_data['price_for_time']; ?> </i>   </td>
				</tr>
				<tr>
					<td>
						<i class="fa fa-lock"></i>
					</td>
					<td>security_amount</td>
					<td> <i class="fa fa-euro"> <?php echo $booking_data['security_amount']; ?> </i> </td>
				</tr>
				<tr>
					<td>
						<i class="fa fa-arrow-right"></i>
					</td>
					<td>delivery_price</td>
					<td>  <i class="fa fa-euro"> <?php echo $booking_data['delivery_price']; ?> </i> </td>
				</tr>
				<?php
				if (count($booking_renter_transaction) > 0 && array_key_exists('transaction_id', $booking_renter_transaction) && $booking_renter_transaction['transaction_id'] != "") {
					?>
					<tr>
						<td>
							<i class=" fa fa-user"></i>
						</td>
						<td>Total money deducted from renter account. ( Transaction id <?php echo $booking_renter_transaction['transaction_id']; ?> ) </td>
						<td> <i class="fa fa-euro"> <?php echo $booking_renter_transaction['booking_amount']; ?> </i>  </td>
					</tr>
					
					<tr>
						<td>
							<i class=" fa fa-list-alt"></i>
						</td>
						<td>Contract Number </td>
						<td> <a href="https://ws-uat.allianz.gr/DocumentProducerSrv/generate/car/new/contract/document?username=urend&hash=8e5f8e0c22db8cf7eeb9b40fb503dcd7&symbol=<?php echo $booking_data['contract_id']; ?>" target="_blank"> <?php echo $booking_data['contract_id']; ?> </a> </td>
					</tr>					
					
					
					<?php
				}
				?>
			</tbody>
		</table>
	</section>

	<?php
	if (count($booking_renter_transaction) > 0 && array_key_exists('transaction_id', $booking_renter_transaction) && $booking_renter_transaction['transaction_id'] != "") {

		if ($booking_data['rejected_by_car_owner'] == 1 || $booking_data['rejected_by_car_renter'] == 1 || $booking_data['auto_cancel_state'] == 1) {
			?>
			<section class="panel">
				<div class="panel-body bio-graph-info">
					<h1>Refund the amount </h1>
					<div class="row">

						<?php
						$condition = "";
						/* if booking is cancelled by owner refund full amount */
						if ($booking_data['rejected_by_car_owner'] == 1) {
							$condition = 4;
						} elseif ($booking_data['rejected_by_car_renter'] == 1) {

							$diff = (strtotime($booking_data['car_from']) - strtotime($booking_data['rejected_by_car_renter_time'])) / (3600 * 24);
							if ($diff >= 7) {
								$condition = 1;
							} elseif ($diff < 7 && $diff >= 1) {
								$condition = 2;
							} else {
								$condition = 3;
							}
						} elseif ($booking_data['auto_cancel_state'] == 1) {
							$condition = 5;
						}
						?>
						<table class="table table-hover personal-task">
							<tbody>
								<tr class="<?php echo ($condition == 1 ) ? " alert-success " : "  alert-danger "; ?>">
									<td>
										condition 1
									</td>
									<td>if renter's rejection time is equal or more than 7 days refund full amount.</td>
									<td><i class="fa fa-euro"> <?php echo $booking_renter_transaction['booking_amount']; ?></i> </td>
									<td> 
										<i class="fa <?php echo ($condition == 1 ) ? " fa-check " : " fa-times text-danger "; ?>"> </i>

									</td>
								</tr>
								<tr class="<?php echo ($condition == 4 ) ? " alert-success " : "  alert-danger "; ?>">
									<td>
										condition 2
									</td>
									<td>if owner reject the request.</td>
									<td><i class="fa fa-euro"> <?php echo $booking_renter_transaction['booking_amount']; ?></i></td>
									<td>  
										<i class="fa <?php echo ($condition == 4 ) ? " fa-check " : " fa-times text-danger "; ?>"></i> 

									</td>
								</tr>
								<tr class="<?php echo ($condition == 2 ) ? " alert-success " : " alert-danger  "; ?>">
									<td>
										condition 3
									</td>
									<td>if renter's rejection time  is in between  6 -1  days refund 50% amount.</td>
									<td><i class="fa fa-euro"> <?php echo $booking_data['security_amount'] + ($booking_renter_transaction['booking_amount'] - $booking_data['security_amount'] )  / 2; ?></i></td>
									<td> 
										<i class="fa <?php echo ($condition == 2 ) ? " fa-check " : " fa-times text-danger "; ?>"> </i> 

									</td>
								</tr>
								<tr class="<?php echo ($condition == 3 ) ? " alert-success " : "  alert-danger "; ?>">
									<td>
										condition 4
									</td>
									<td>if renter's rejection time is less than 1  day refund security amount only.</td>
									<td><i class="fa fa-euro"> <?php echo $booking_data['security_amount']; ?></i>  </td>
									<td>  
										<i class="fa <?php echo ($condition == 3 ) ? " fa-check " : " fa-times text-danger "; ?>"></i> 

									</td>
								</tr>	

								<tr class="<?php echo ($condition == 5 ) ? " alert-success " : "  alert-danger "; ?>">
									<td>
										condition 5
									</td>
									<td>if request is auto cancel due to no action taken from users.  Refund security amount only.</td>
									<td><i class="fa fa-euro"> <?php echo $booking_data['security_amount']; ?></i> </td>
									<td> 
										<i class="fa <?php echo ($condition == 5 ) ? " fa-check " : " fa-times text-danger "; ?>"></i>

									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</section>
			<?php
		}
	}
	?>

</aside>



<div class="col-lg-8 hide">
	<!--timeline start-->
	<section class="panel">
		<div class="panel-body ">
			<div class="text-center mbot30">
				<h3 class="timeline-title">Timeline</h3>
				<p class="t-info">This is a transaction timeline</p>
			</div>

			<div class="timeline">
				<?php
				foreach ($booking_actions as $ba) {
					if ($ba['transaction_type'] == "to_renter") {
						$user_data = $owner_data;
						?>
						<article class="timeline-item <?php echo ($ba['car_owner_id'] == $user_data['userId']) ? 'alt' : ''; ?>">
							<div class="timeline-desk">
								<div class="panel">
									<div class="panel-body">
										<a href="#" class="task-thumb profile-fixer pull-right">
											<img src="<?php echo $user_data['user_image'] ?>" alt="">
										</a>
										<span class="arrow"></span>
										<span class="timeline-icon <?php echo ($ba['car_owner_id'] == $user_data['userId']) ? 'red' : 'green'; ?>"></span>
										<span class="timeline-date"><?php echo date("H:i:s", strtotime($ba['action_time'])); ?></span>
										<h1 class="<?php echo ($ba['car_owner_id'] == $user_data['userId']) ? 'red' : 'green'; ?>"><?php echo date("d M | D", strtotime($ba['action_time'])); ?> </h1>
										<p><?php echo str_replace('_', ' ', $ba['transaction_action']); ?></p>
									</div>
								</div>
							</div>
						</article>
						<?php
					}
				}
				?>

			</div>

			<div class="clearfix">&nbsp;</div>
		</div>

	</section>
	<!-- timeline end-->
</div>
<form action="" method="post">
	<div class="col-lg-12 show">
		<section class="panel">
			<div class="panel-body">
				<div class="form-group col-md-6">
					<label for="address">PayBack Renter Id</label>
					<input type="hidden" name="renter_user_id" value="<?php echo $renter_data['userId']; ?>" />
					<input class="form-control" id="payback_renter" value="" placeholder="Enter renter transaction id" name="payback_renter" type="text">
				</div>
				<div class="form-group col-md-6">
					<input type="hidden" name="owner_user_id" value="<?php echo $owner_data['userId']; ?>" />
					<label for="address">PayBack Owner Id</label>
					<input class="form-control" id="payback_owner" value="" placeholder="Enter owner transaction id" name="payback_owner" type="text">
				</div>
				<input type="submit"  name="payment_transaction_submit" class="btn btn-info pull-right" value="submit">
						<?php 
			foreach($booking_payout as $bp ){
				
				//if($bp['user_type'] == "RENTER"){
				echo "transaction id  for ".$bp['user_type'] ." is ". $bp['transaction_id'] ."  and status ". $bp['status']."</br>";
				//}
			}
			?>
			</div>
		</section>

	</div>
</form>

<div class="col-lg-6 hide">
	<section class="panel">
		<header class="panel-heading"> Payout renter    </header>
		<div class="panel-body">
			<form  method="post" action="" class="form-horizontal">
				<div class="form-group">
					<label class="col-lg-3 col-sm-3 control-label">Tag</label>
					<div class="col-lg-9">
						<input type="text" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 col-sm-3 control-label">AuthorId</label>
					<div class="col-lg-9">
						<input name="AuthorId" type="text" readonly="readonly"    value="<?php echo $account_data_renter['author_id']; ?>" class="form-control" >
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 col-sm-3 control-label">BankAccountId</label>
					<div class="col-lg-9">
						<input name="BankAccountId"  type="text" readonly="readonly"   value="<?php echo $account_data_renter['banking_account_id']; ?>"  class="form-control" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 col-sm-3 control-label">DebitedWalletId</label>
					<div class="col-lg-9">
						<input name="DebitedWalletId"  type="text" readonly="readonly"   value="<?php echo $account_data_renter['wallet_id']; ?>"  class="form-control" >
					</div>
				</div>        
				<div class="form-group">
					<label class="col-lg-3 col-sm-3 control-label">Amount</label>
					<div class="col-lg-9">
						<input name="DebitedFunds"  type="text" class="form-control" placeholder="Amount">
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 col-sm-3 control-label">Fee</label>
					<div class="col-lg-9">
						<input name="Fees"  type="text" class="form-control" placeholder="Fee">
					</div>
				</div>
				<input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>" />	
				<input type="hidden" name="user_id" value="<?php echo $renter_data['userId']; ?>" />
				<input type="hidden" name="user_type" value="RENTER" />
				
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<input class="btn btn-danger pull-right " type="submit" name="renter_payout" value="pay"/>
					</div>
				</div>

			</form>
			<?php 
			foreach($booking_payout as $bp ){
				
				if($bp['user_type'] == "RENTER"){
				echo "transaction id ". $bp['transaction_id'] ."  -------- status ". $bp['status']."</br>";
				}
			}
			?>
		</div>
	</section>
</div>

<div class="col-lg-6 hide">
	<section class="panel">
		<header class="panel-heading"> Payout Owner    </header>
		<div class="panel-body">
			<form  method="post" action="" class="form-horizontal">
				<div class="form-group">
					<label class="col-lg-3 col-sm-3 control-label">Tag</label>
					<div class="col-lg-9">


						<input type="text" class="form-control">

					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 col-sm-3 control-label">AuthorId</label>
					<div class="col-lg-9">
						<input type="text" readonly="readonly"    value="<?php echo $account_data_owner['author_id']; ?>" class="form-control" >
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 col-sm-3 control-label">BankAccountId</label>
					<div class="col-lg-9">
						<input type="text" readonly="readonly"   value="<?php echo $account_data_owner['banking_account_id']; ?>"  class="form-control" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 col-sm-3 control-label">DebitedWalletId</label>
					<div class="col-lg-9">
						<input type="text" readonly="readonly"   value="<?php echo $account_data_owner['wallet_id']; ?>"  class="form-control" >
					</div>
				</div>    
				<div class="form-group">
					<label class="col-lg-3 col-sm-3 control-label">Amount</label>
					<div class="col-lg-9">


						<input type="text" class="form-control" placeholder="Amount">

					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 col-sm-3 control-label">Fee</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" placeholder="Fee">
					</div>
				</div>
				<input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>" />	
				<input type="hidden" name="user_id" value="<?php echo $owner_data['userId']; ?>" />
				<input type="hidden" name="user_type" value="OWNER" />

				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<input class="btn btn-danger pull-right " type="submit" name="owner_payout" value="pay"/>
					</div>
				</div>
			</form>
		</div>
	</section>
</div>

<link rel="stylesheet" href="<?php echo AUTH_ASSETS; ?>css/owl.carousel.css" type="text/css">

<?php
$custum_js = '<script src="' . AUTH_ASSETS . 'js/owl.carousel.js" ></script>
    <script>

	 $(document).ready(function() {
          $("#owl-demo").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 300,
              singleItem : true,
			        autoPlay:true

          });
      });
			$(window).on("resize",function(){
          var owl = $("#owl-demo").data("owlCarousel");
          owl.reinit();
      });
</script>
	';
echo modules::run('auth_panel/template/add_custum_js', $custum_js);
?>


<?php
//pre($booking_actions);
//pre($owner_data);
//pre($renter_data);
//pre($booking_data);
?>
