<?php //pre($pickup_data); ?>
<div class="col-sm-12">
	<section class="panel">

		<div class="panel-body">
			<h1>Owner Info (Pick up) </h1>
			<div class="product_meta">
	              <span class="posted_in">
	              		<strong>Meter Reading: </strong>
	              		<?php echo $pickup_data['pickup_owner']['meter_reading']; ?>
	              </span>
	              <span class="posted_in">
	              		<strong>Remarks: </strong>
	              		<?php echo $pickup_data['pickup_owner']['remarks']; ?>
	              </span>
            </div>
			<div class="row img-rounded">
				<?php
				foreach ($pickup_data['pickup_owner']['images'] as $img) {
					?>
					<div class=" col-md-3">
						<img src="<?php echo $img['image_name']; ?>" class="img-rounded  img-responsive ">
					</div>
					<?php
				}
				?>
			</div>
		</div>

		<div class="panel-body">
			<h1>Renter Info (Pick up)</h1>
			<div class="product_meta">
	              <span class="posted_in">
	              		<strong>Meter Reading: </strong>
	              		<?php echo $pickup_data['pickup_renter']['meter_reading']; ?>
	              </span>
	              <span class="posted_in">
	              		<strong>Remarks: </strong>
	              		<?php echo $pickup_data['pickup_renter']['remarks']; ?>
	              </span>
            </div>
			<div class="row img-rounded">
				<?php
				foreach ($pickup_data['pickup_renter']['images'] as $img) {
					?>
					<div class=" col-md-3">
						<img src="<?php echo $img['image_name'] ; ?>" class="img-rounded  img-responsive ">
					</div>
					<?php
				}
				?>
			</div>
		</div>

		<div class="panel-body">
			<h1>Renter Info (drop off)</h1>
			<div class="product_meta">
	              <span class="posted_in">
	              		<strong>Meter Reading: </strong>
	              		<?php echo $dropoff_data['dropoff_renter']['meter_reading']; ?>
	              </span>
	              <span class="posted_in">
	              		<strong>Damage Type: </strong>
	              		<?php echo $dropoff_data['dropoff_renter']['damage_type']; ?>
	              </span>
            </div>
        </div>
        <div class="panel-body">
			<h1>Owner Info (drop off)</h1>
			<div class="product_meta">
	              <span class="posted_in">
	              		<strong>Meter Reading: </strong>
	              		<?php echo $dropoff_data['dropoff_owner']['meter_reading']; ?>
	              </span>
	              <span class="posted_in">
	              		<strong>Damage Type: </strong>
	              		<?php echo $dropoff_data['dropoff_owner']['damage_type']; ?>
	              </span>
            </div>
        </div>			
		
	</section>
</div>

<?php //pre($pickup_data); ?>
<?php //pre($dropoff_data); ?>


