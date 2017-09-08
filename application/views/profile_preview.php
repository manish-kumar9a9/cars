<?php
$this->load->view('header');
$this->load->view('include/account_header');

$car_list = array ( 0 => array ( 'id' => '1', 'fk_user_id' => '2', 'type' => '8', 'make' => '1', 'model' => '1', 'year' => '0', 'car_brought_year' => '2017', 'mileage' => '0-15000km', 'cubicCapacity' => 'Less than 1000cc', 'fuelType' => '2', 'Transmission' => '2', 'color' => '1', 'doors' => '2 doors', 'airbags' => '2-4 airbags', 'seat' => '4 seats', 'description' => 'Bxnxnx', 'availablity' => '1', 'price_daily' => '25', 'price_weekly' => '175', 'price_monthly' => '750', 'kmOrMiles' => '0', 'kmOrMilesValue' => '100', 'youEarn' => '18', 'carExtraKmOrMl' => '0.1', 'country' => '1', 'city' => '1', 'zipCode' => '', 'carDropOffLocation' => 'Evagora Laniti Avenue, Limassol, Cyprus', 'carDropOffLat' => '34.707130', 'carDropOffLon' => '33.022617', 'carPickUpLocation' => 'Evagora Laniti Avenue, Limassol, Cyprus', 'carPickUpLat' => '34.707130', 'carPickUpLon' => '33.022617', 'price' => '22', 'deliveryOption' => '1', 'insuranceType' => '1', 'insuranceValidTill' => '2017-06-14', 'insurance_file_front' => '31497442743image.png', 'insurance_file_back' => '31497442743image.png', 'carPlateNumber' => 'VVV777', 'market_value' => '', 'isActive' => '1', 'is_verified' => '1', 'createdDate' => '2017-06-14 15:19:03', 'modifiedDate' => '0000-00-00 00:00:00', 'availablity_modified' => '2017-06-14 15:19:03', 'insurance_file_front_path' => 'http://localhost/urend/uploads/31497442743image.png', 'insurance_file_back_path' => 'http://localhost/urend/uploads/31497442743image.png', 'get_username' => 'Vinni Test', 'get_type_name' => 'Cabriolet', 'get_make_name' => 'Abarth', 'get_model_name' => '500', 'get_fuel_type_name' => 'Diesel', 'get_transmission_name' => 'Automatic', 'get_car_color' => 'Black', 'get_country' => 'Cyprus', 'get_city_name' => 'Limassol', 'car_features' => array ( 0 => array ( 'id' => '1', 'fkFeaturesId' => '10', 'fkCardId' => '1', 'isActive' => '1', 'createdDate' => '2017-06-14 15:19:03', 'modifiedDate' => '0000-00-00 00:00:00', 'feature_name' => 'Baby Seat', ), 1 => array ( 'id' => '2', 'fkFeaturesId' => '9', 'fkCardId' => '1', 'isActive' => '1', 'createdDate' => '2017-06-14 15:19:03', 'modifiedDate' => '0000-00-00 00:00:00', 'feature_name' => 'CD Player', ), 2 => array ( 'id' => '3', 'fkFeaturesId' => '11', 'fkCardId' => '1', 'isActive' => '1', 'createdDate' => '2017-06-14 15:19:03', 'modifiedDate' => '0000-00-00 00:00:00', 'feature_name' => 'GPS', ), ), 'car_images' => array ( 0 => array ( 'id' => '1', 'fkCarId' => '1', 'CarImage' => '81497442706image.jpg', 'createdDate' => '2017-06-14 15:19:03', 'CarImage_path' => 'http://localhost/urend/uploads/81497442706image.jpg', ), ), ), 1 => array ( 'id' => '2', 'fk_user_id' => '2', 'type' => '2', 'make' => '2', 'model' => '5', 'year' => '0', 'car_brought_year' => '2017', 'mileage' => '0-15000km', 'cubicCapacity' => '1000-1200cc', 'fuelType' => '3', 'Transmission' => '2', 'color' => '8', 'doors' => '2 doors', 'airbags' => '1-2 airbags', 'seat' => '4 seats', 'description' => 'Ggg', 'availablity' => '1', 'price_daily' => '25', 'price_weekly' => '175', 'price_monthly' => '750', 'kmOrMiles' => '0', 'kmOrMilesValue' => '200', 'youEarn' => '18', 'carExtraKmOrMl' => '0.1', 'country' => '1', 'city' => '1', 'zipCode' => '', 'carDropOffLocation' => 'Evagora Laniti Avenue, Limassol, Cyprus', 'carDropOffLat' => '34.707130', 'carDropOffLon' => '33.022617', 'carPickUpLocation' => 'Evagora Laniti Avenue, Limassol, Cyprus', 'carPickUpLat' => '34.707130', 'carPickUpLon' => '33.022617', 'price' => '27', 'deliveryOption' => '1', 'insuranceType' => '1', 'insuranceValidTill' => '2017-06-15', 'insurance_file_front' => '101497509696image.png', 'insurance_file_back' => '21497509696image.png', 'carPlateNumber' => 'VVV111', 'market_value' => '', 'isActive' => '1', 'is_verified' => '1', 'createdDate' => '2017-06-15 09:54:56', 'modifiedDate' => '0000-00-00 00:00:00', 'availablity_modified' => '2017-06-15 09:54:56', 'insurance_file_front_path' => 'http://localhost/urend/uploads/101497509696image.png', 'insurance_file_back_path' => 'http://localhost/urend/uploads/21497509696image.png', 'get_username' => 'Vinni Test', 'get_type_name' => 'Convertible', 'get_make_name' => 'Aixam', 'get_model_name' => '400', 'get_fuel_type_name' => 'Electric', 'get_transmission_name' => 'Automatic', 'get_car_color' => 'Green', 'get_country' => 'Cyprus', 'get_city_name' => 'Limassol', 'car_features' => array ( 0 => array ( 'id' => '4', 'fkFeaturesId' => '3', 'fkCardId' => '2', 'isActive' => '1', 'createdDate' => '2017-06-15 09:54:56', 'modifiedDate' => '0000-00-00 00:00:00', 'feature_name' => '4-wheel drive', ), 1 => array ( 'id' => '5', 'fkFeaturesId' => '8', 'fkCardId' => '2', 'isActive' => '1', 'createdDate' => '2017-06-15 09:54:56', 'modifiedDate' => '0000-00-00 00:00:00', 'feature_name' => 'Air Condition', ), ), 'car_images' => array ( 0 => array ( 'id' => '2', 'fkCarId' => '2', 'CarImage' => '41497509630image.jpg', 'createdDate' => '2017-06-15 09:54:56', 'CarImage_path' => 'http://localhost/urend/uploads/41497509630image.jpg', ), ), ), 2 => array ( 'id' => '3', 'fk_user_id' => '2', 'type' => '8', 'make' => '1', 'model' => '1', 'year' => '0', 'car_brought_year' => '2017', 'mileage' => '15000-30000km', 'cubicCapacity' => '1000-1200cc', 'fuelType' => '2', 'Transmission' => '2', 'color' => '1', 'doors' => '3 doors', 'airbags' => '2-4 airbags', 'seat' => '5 seats', 'description' => 'Hii', 'availablity' => '1', 'price_daily' => '20', 'price_weekly' => '140', 'price_monthly' => '600', 'kmOrMiles' => '0', 'kmOrMilesValue' => '200', 'youEarn' => '14', 'carExtraKmOrMl' => '0.1', 'country' => '1', 'city' => '1', 'zipCode' => '', 'carDropOffLocation' => 'Evagora Laniti Avenue, Limassol, Cyprus', 'carDropOffLat' => '34.707130', 'carDropOffLon' => '33.022617', 'carPickUpLocation' => 'Evagora Laniti Avenue, Limassol, Cyprus', 'carPickUpLat' => '34.707130', 'carPickUpLon' => '33.022617', 'price' => '0', 'deliveryOption' => '0', 'insuranceType' => '1', 'insuranceValidTill' => '2017-06-15', 'insurance_file_front' => '71497514230image.png', 'insurance_file_back' => '51497514230image.png', 'carPlateNumber' => 'VVV222', 'market_value' => '', 'isActive' => '1', 'is_verified' => '1', 'createdDate' => '2017-06-15 11:10:30', 'modifiedDate' => '0000-00-00 00:00:00', 'availablity_modified' => '2017-06-15 11:10:30', 'insurance_file_front_path' => 'http://localhost/urend/uploads/71497514230image.png', 'insurance_file_back_path' => 'http://localhost/urend/uploads/51497514230image.png', 'get_username' => 'Vinni Test', 'get_type_name' => 'Cabriolet', 'get_make_name' => 'Abarth', 'get_model_name' => '500', 'get_fuel_type_name' => 'Diesel', 'get_transmission_name' => 'Automatic', 'get_car_color' => 'Black', 'get_country' => 'Cyprus', 'get_city_name' => 'Limassol', 'car_features' => array ( 0 => array ( 'id' => '6', 'fkFeaturesId' => '3', 'fkCardId' => '3', 'isActive' => '1', 'createdDate' => '2017-06-15 11:10:30', 'modifiedDate' => '0000-00-00 00:00:00', 'feature_name' => '4-wheel drive', ), 1 => array ( 'id' => '7', 'fkFeaturesId' => '8', 'fkCardId' => '3', 'isActive' => '1', 'createdDate' => '2017-06-15 11:10:30', 'modifiedDate' => '0000-00-00 00:00:00', 'feature_name' => 'Air Condition', ), 2 => array ( 'id' => '8', 'fkFeaturesId' => '10', 'fkCardId' => '3', 'isActive' => '1', 'createdDate' => '2017-06-15 11:10:30', 'modifiedDate' => '0000-00-00 00:00:00', 'feature_name' => 'Baby Seat', ), ), 'car_images' => array ( 0 => array ( 'id' => '3', 'fkCarId' => '3', 'CarImage' => '21497514196image.jpg', 'createdDate' => '2017-06-15 11:10:30', 'CarImage_path' => 'http://localhost/urend/uploads/21497514196image.jpg', ), ), ), );
$review_data = array(
    array(
        'id'        =>  1,
        'givenby_username'  =>  'bingo',
        'date'    =>  '2017-06-20',
        'givenby_user_image'    =>  base_url() . "assets/image/profileicon.png",
        'rating'   => 4.6,
        'remarks'  => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys.
        It has survived not only five centuries, but also the leap into electronic'
    ),
    array(
        'id'        =>  2,
        'givenby_username'  =>  'alexa',
        'date'    =>  '2017-06-21',
        'givenby_user_image'    =>  base_url() . "assets/image/profileicon.png",
        'rating'   => 3.8,
        'remarks'  => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys.
        It has survived not only five centuries, but also the leap into electronic'
    )
);

?>

<div id="account_wrapper">
        <div class="container view-profile">
            <div class="row margin-top-20">
                <div class="col-md-8 margin-bottom-50">

                    <div class="col-xs-12 no-padding">
                        <div class="col-xs-12 no-padding "><h3><?php echo $this->lang->line('ABOUT_ME'); ?></h3></div>
                        <div class="no-padding">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                                but also the leap into electronic </p>
                        </div>
                    </div>

                    <div class="clr"></div>
                    <div class="col-xs-12 no-padding">
                        <div class="col-xs-4 no-padding ">
                            <h3>My Cars</h3>
                        </div>
                    </div>

                    <div class="clr"></div>
                    <?php foreach ($car_list as $cd) { ?>
                        <div class="carpanel col-sm-6 margin-top-20 ">
                            <a href="<?php echo site_url('user/edit_car/' . $cd['id']) ?>">
                                <div>
                                    <img src="<?php echo (isset($cd['car_images'][0]['CarImage_path'])) ? $cd['car_images'][0]['CarImage_path'] : ''; ?>"/>
                                    <div class="info">
                                        <div class="col-xs-9">
                                            <div class="title"><?php echo $cd['get_make_name'] . ' ' . $cd['get_model_name']; ?></div>
                                            <div><?php echo $cd['cubicCapacity'] . ', ' . $cd['doors'] . ', ' . $cd['get_fuel_type_name'] ?></div>
                                        </div>
                                        <div class="col-xs-3 text-right">
                                            <div
                                                class="col-md-12 price no-padding">&euro;<?php echo $cd['price_daily']; ?></div>
                                            <div
                                                class="col-md-12 no-padding"><?php echo $this->lang->line('PER_DAY'); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>

                    <div class="clr"></div>
                    <div class="col-xs-12 no-padding">
                        <div class="col-sm-3 margin-top-20 no-padding">
                            <h3>Reviews</h3>
                        </div>
                        <div id="filter-reviews" class="col-sm-9 text-right no-padding margin-top-20">
                            <div class="pull-right">
                                <a class="all_segment" href="<?php echo site_url('user/reviews') ?>">See all Reviews</a>
                            </div>
                        </div>
                    </div>
                    <div class="clr"></div>
                    <div class="col-xs-12 no-padding">
                        <?php
                        $i = 1 ;
                        foreach($review_data as $review){ ?>
                            <?php include(__DIR__.'/include/ui_blocks/reviews.php'); ?>
                        <?php } ?>
                    </div>
                </div>



            <div class="col-xs-4 gradient_filter summary sidebar">
                <h4 style="color:#fff" class="center">Rent from George</h4>
                <h5 class="center">To adjust rental period, click on date/time to change</h5>

                <form action="<?php echo site_url('user/user_identity_verification') ?>" method="get">

                    <div class="searchbox no-margin">

                        <div class="col-xs-12" style="background: #fff;padding: 15px 5px;">
                            <div class="col-lg-1 col-md-2 col-sm-1 col-xs-1">
                                <img src="<?php echo base_url(); ?>assets/image/icon_location.svg" />
                            </div>
                            <div class="col-lg-10 col-md-9 col-sm-10 col-xs-10 no-padding">
                                <div class="col-md-12 title">
                                    <?php echo $this->lang->line('START_LOCATION');?>
                                </div>
                                <div class="col-md-12 subtitle">
                                    <input type="text" id="autocomplete" value="<?php echo ($this->input->get('autocomplete')) ? $this->input->get('autocomplete') : ""; ?>" name="autocomplete"   onFocus="geolocate()"  placeholder="<?php echo $this->lang->line('CURRENT_LOCATION'); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 margin-top-10" style="background: #fff;padding: 15px 5px;">
                            <div class="col-xs-6 no-gutter ">
                                <div class="row ">
                                    <div class="col-lg-1 col-md-3 col-sm-1 col-xs-1">
                                        <img src="<?php echo base_url(); ?>assets/image/icon_date.svg" />
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 no-padding">
                                        <div class="col-md-12 title">
                                            <?php echo $this->lang->line('START_DATE');?>
                                        </div>
                                        <div class="col-md-12 subtitle">
                                            <input type="text" name="from" class="datepicker" id="date_picker_start" value="" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 no-gutter">
                                <div class="row ">
                                    <div class="col-lg-1 col-md-3 col-sm-1 col-xs-1">
                                        <img src="<?php echo base_url(); ?>assets/image/icon_time.svg" />
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 no-padding">
                                        <div class="col-md-12 title">
                                            <?php echo $this->lang->line('START_TIME');?>
                                        </div>
                                        <div class="col-md-12 subtitle">
                                            <input type="text" class="timepicker" id="time_picker_start" value="11:00 AM"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 margin-top-10" style="background: #fff;padding: 15px 5px;">
                            <div class="col-xs-6 no-gutter ">
                                <div class="row ">
                                    <div class="col-lg-1 col-md-3 col-sm-1 col-xs-1">
                                        <img src="<?php echo base_url(); ?>assets/image/icon_date.svg" />
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 no-padding">
                                        <div class="col-md-12 title">
                                            <?php echo $this->lang->line('END_DATE');?>
                                        </div>
                                        <div class="col-md-12 subtitle">
                                            <input type="text" name="to" class="datepicker" id="date_picker_end" value="" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 no-gutter">
                                <div class="row ">
                                    <div class="col-lg-1 col-md-3 col-sm-1 col-xs-1">
                                        <img src="<?php echo base_url(); ?>assets/image/icon_time.svg" />
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 no-padding">
                                        <div class="col-md-12 title">
                                            <?php echo $this->lang->line('RETURN_TIME');?>
                                        </div>
                                        <div class="col-md-12 subtitle">
                                            <input type="text" class="timepicker" id="time_picker_end" value="11:00 AM"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 margin-top-10 margin-bottom-10 center" style="color:initial;background: #fff;padding: 15px 5px;">
                            <div class="col-xs-12">
                                <a href="#">
                                    <input  class="button gradient_filter" type='button' value="<?php echo $this->lang->line('check_availability'); ?>" style="margin-top:0">
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.

        var place = autocomplete.getPlace();

        document.getElementById('lat_string').value = place.geometry.location.lat();
        document.getElementById('lon_string').value = place.geometry.location.lng();

        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }
    }
    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAP_API_KEY; ?>&libraries=places&callback=initAutocomplete" async defer></script>

<!--footer-->
<?php $this->load->view('include/footer_block'); ?>
<!--/footer-->