<section class="panel">
	<header class="panel-heading">
		<?php echo $this->session->flashdata('success'); ?>
		Car details Settings
	</header>
	<div class="panel-body">
		<form role="form" action="" method="post" autocomplete="off">
			<div class="form-group">
				<label for="mileage">Mileage</label>
				<input class="form-control" id="car_element_mileage"  value="<?php echo get_web_meta_data('car_element_mileage'); ?>" placeholder="Enter mileage" name="car_element_mileage" type="text">
			</div>
			<div class="form-group">
				<label for="cubic_capacity">Cubic capacity</label>
				<input class="form-control" id="car_element_cubic_capacity"  value="<?php echo get_web_meta_data('car_element_cubic_capacity'); ?>" placeholder="Enter cubic capacity" name="car_element_cubic_capacity" type="text">
			</div>
			<div class="form-group">
				<label for="doors">Doors</label>
				<input class="form-control" id="car_element_doors"  value="<?php echo get_web_meta_data('car_element_doors'); ?>" placeholder="Enter doors" name="car_element_doors" type="text">
			</div>
			<div class="form-group">
				<label for="airbags">Airbags</label>
				<input class="form-control" id="car_element_airbags"  value="<?php echo get_web_meta_data('car_element_airbags'); ?>" placeholder="Enter airbags" name="car_element_airbags" type="text">
			</div>
			<div class="form-group">
				<label for="seats">Seats</label>
				<input class="form-control" id="car_element_seats"  value="<?php echo get_web_meta_data('car_element_seats'); ?>" placeholder="Enter seats" name="car_element_seats" type="text">
			</div>
			<div class="form-group">
				<label for="Years">Years(car should be listed for Past * number of years set value like 10 for last 10 years)</label>
				<input class="form-control" id="car_element_year"  value="<?php echo get_web_meta_data('car_element_year'); ?>" placeholder="Enter number" name="car_element_year" type="text">
			</div>			
			<button type="submit" class="btn btn-info">Submit</button>
		</form>

	</div>
</section>