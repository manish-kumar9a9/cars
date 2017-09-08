
<?php
/* Fetch car detail start */
$option = array(
	'is_json' => false,
	'url' => site_url() . '/service_get_single_car_data',
	'data' => array('id' => $car_id)
);

$result = get_data_with_curl($option);
$car_data = $result['Result'];
$user_id = $car_data['fk_user_id'];

/*  Fetch car detail end */
?>

<?php
/* fetch user detail start */
$option = array(
	'is_json' => false,
	'url' => site_url() . '/service_fetch_user_primary_record',
	'data' => json_encode(array('user_id' => $user_id))
);

$result = get_data_with_curl($option);
$user_data = $result['Result'];
/* loading side bar view for user */
$this->load->view('web_user/user_side_bar', array("user_data" => $user_data));
?>


<aside class="profile-info col-lg-9">
	<section class="panel">

		<?php if (!empty($car_reason)) {
			?>
			<div class="bio-graph-heading">
				<i class="fa fa-2x fa-warning text-danger"></i>
				<ul class="text-danger">
					<?php
					foreach ($car_reason as $reason) {
						echo '<li>' . $reason . '</li>';
					}
					?>
				</ul>
			</div>
		<?php } ?>
		</br>
		<?php if ($car_data['description'] != "") { ?>
			<div class="bio-graph-heading">
				<?php echo $car_data['description']; ?>
			</div>
		<?php } ?>

		<div class="panel-body bio-graph-info">
			<h1>Car Details <a href="<?php echo AUTH_PANEL_URL . 'web_user/car_market_value/' . $car_id; ?>"><button class="pull-right btn btn-info">Update Market Value</button></a>
			</h1>

			<div class="row">
				<div class="bio-row">
					<p><span>Type </span>: <?php echo $car_data['get_type_name']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Year </span>: <?php echo $car_data['car_brought_year']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Make </span>: <?php echo $car_data['get_make_name']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Model </span>: <?php echo $car_data['get_model_name']; ?></p>
				</div>
			</div>
		</div>
		<div class="panel-body bio-graph-info">
			<h1>Engine details
			</h1>
			<div class="row">
				<div class="bio-row">
					<p><span>Mileage </span>: <?php echo $car_data['mileage']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Cubic capacity </span>: <?php echo $car_data['cubicCapacity']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Fuel type </span>: <?php echo $car_data['get_fuel_type_name']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Transmission </span>: <?php echo $car_data['get_transmission_name']; ?>
					</p>
				</div>
			</div>
		</div>
		<div class="panel-body bio-graph-info">
			<h1>Body Details
			</h1>
			<div class="row">
				<div class="bio-row">
					<p><span>Colour </span>: <?php echo $car_data['get_car_color']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Doors </span>: <?php echo $car_data['doors']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Airbags </span>: <?php echo $car_data['airbags']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Seats </span>: <?php echo $car_data['seat']; ?></p>
				</div>
			</div>
		</div>
		<div class="panel-body bio-graph-info">
			<h1>Car Features
			</h1>
			<div class="row">
				<?php foreach ($car_data['car_features'] as $car_features) { ?>
					<div class="bio-row">
						<p><?php echo $car_features['feature_name']; ?></p>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="panel-body bio-graph-info">
			<h1>Your Car Availability
			</h1>
			<div class="row">
				<div class="bio-row">
					<p><?php
				if ($car_data['availablity'] == 1) {
					echo 'Every day';
				} elseif ($car_data['availablity'] == 2) {
					echo 'Weekend only';
				} elseif ($car_data['availablity'] == 3) {
					echo 'Weekdays only';
				} else {
					$data_array = explode(",", $car_data['availablity']);
					foreach ($data_array as $array) {
						if (!empty($array)) {
							echo $array . ', ';
						}
					}
				}
				?></p>
				</div>
			</div>
		</div>
		<div class="panel-body bio-graph-info">
			<h1>Daily Price
			</h1>
			<div class="row">
				<div class="bio-row">
					<p><span>Daily Price </span>: <?php echo $car_data['price_daily']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Distance(Km) </span>: <?php echo $car_data['kmOrMilesValue']; ?></p>
				</div>
			</div>
		</div>
		<div class="panel-body bio-graph-info">
			<h1>Weekly Price
			</h1>
			<div class="row">
				<div class="bio-row">
					<p><span>Weekly Price </span>: <?php echo $car_data['price_weekly']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Distance(Km) </span>: <?php echo 7 * $car_data['kmOrMilesValue']; ?></p>
				</div>
			</div>
		</div>
		<div class="panel-body bio-graph-info">
			<h1>Monthly Price
			</h1>
			<div class="row">
				<div class="bio-row">
					<p><span>Monthly Price </span>: <?php echo $car_data['price_monthly']; ?></p>
				</div>
				<div class="bio-row">
					<p><span>Distance(Km) </span>: <?php echo 30 * $car_data['kmOrMilesValue']; ?></p>
				</div>
			</div>
		</div>
		<div class="panel-body bio-graph-info">
			<h1>Cost of Every Extra Kilometer
			</h1>
			<div class="row">
				<div class="bio-row">
					<p><?php echo $car_data['carExtraKmOrMl']; ?></p>
				</div>
			</div>
		</div>
		<div class="panel-body bio-graph-info">
			<h1>Car Pickup Location
			</h1>
			<div class="row">
				<div class="bio-row">
					<p><?php echo $car_data['carPickUpLocation']; ?></p>
				</div>
			</div>
		</div>
		<div class="panel-body bio-graph-info">
			<h1>Car Drop Off Location
			</h1>
			<div class="row">
				<div class="bio-row">
					<p><?php echo $car_data['carDropOffLocation']; ?></p>
				</div>
			</div>
		</div>
		<?php
		if ($car_data['deliveryOption'] == 0) {
			
		} else {
			?>
			<div class="panel-body bio-graph-info">
				<h1>Delivery
				</h1>
				<div class="row">
					<div class="bio-row">
						<p><span>Price </span>: <?php echo $car_data['price']; ?></p>
					</div>
				</div>
			</div>
		<?php }
		?>
		<div class="panel-body bio-graph-info">
			<h1>Registration And Insurance
			</h1>
			<div class="row">
				<div class="bio-row">
					<p><span>Insurance Type </span>: <?php
		if ($car_data['insuranceType'] == 1) {
			echo 'Standard';
		} else {
			echo 'Full Coverage';
		}
		?></p>
				</div>
			</div>
		</div>
		<div class="panel-body bio-graph-info">
			<h1>Insurance Expiry Date
			</h1>
			<div class="row">
				<div class="bio-row">
					<p><?php echo $car_data['insuranceValidTill']; ?></p>
					<a target="_blank" href="<?php echo $car_data['insurance_file_front_path']; ?>"><i class="fa fa-picture-o fa-2x" aria-hidden="true"></i></a>
					<a target="_blank" href="<?php echo $car_data['insurance_file_back_path']; ?>"><i class="fa fa-picture-o fa-2x" aria-hidden="true"></i></a>
				</div>
			</div>
		</div>
		<div class="panel-body bio-graph-info">
			<h1>Car Plate Number
			</h1>
			<div class="row">
				<div class="bio-row">
					<p><?php echo $car_data['carPlateNumber']; ?></p>
				</div>
			</div>
		</div>
		<div class="panel-body bio-graph-info">
			<h1>Last Availability Updated
			</h1>
			<div class="row">
				<div class="bio-row">
					<p><?php echo $car_data['last_avail_string']; ?></p>
				</div>
			</div>
		</div>
		<div class="panel-body bio-graph-info">
			<h1>Car Images
			</h1>
			<div class="row img-rounded">
				<?php foreach ($car_data['car_images'] as $car_images) { ?>
					<div class="bio-row">
						<img src = "<?php echo $car_images['CarImage_path']; ?>" class="img-rounded  img-responsive "></img>
					</div>
				<?php } ?>
			</div>

		</div>
		<div class="panel-body bio-graph-info">
			<?php if ($car_data['is_verified'] == 0) { ?>
				<a href="<?php echo AUTH_PANEL_URL . 'car/verify_car/' . $car_id; ?>" class='btn-sm btn btn-info pull-right'>Approve</a>
			<?php } ?>
			<a href="<?php echo AUTH_PANEL_URL . 'car/fill_car_basic_info?car_id=' . $car_id; ?>" class='btn-sm btn btn-success pull-right'>Car Contract Info</a>
		</div>
	</section>
</aside>
