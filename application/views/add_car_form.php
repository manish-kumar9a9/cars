<?php

$option = array(
    'is_json' => false,
    'url' => site_url() . '/service_car_input_parameters',
    'data' => ""
);
$result = get_data_with_curl($option);
$car_input_data = $result['Result'];

$this->load->view('header');
?>

<div class="view-car" xmlns="http://www.w3.org/1999/html">

    <div class="banner">
        <ul id="demo1">
            <li> <img src="<?php echo base_url(); ?>assets/image/carmainimage.jpg" /></li>
            <li> <img src="<?php echo base_url(); ?>assets/image/carmainimage.jpg" /></li>
            <li> <img src="<?php echo base_url(); ?>assets/image/carmainimage.jpg" /></li>
            <li> <img src="<?php echo base_url(); ?>assets/image/carmainimage.jpg" /></li>

        </ul>
    </div>

    <div class="clr"></div>
    <div class="carmenu">
        <div class="inner">
            <div class="carmenuitems">
                <div class="active"><a href="#car_details"><?php echo $this->lang->line('CAR_DETAILS');?></a></div>
                <div class=""><a href="#availability"><?php echo $this->lang->line('AVAILABLITY');?></a></div>
                <div class=" "><a href="#location"><?php echo $this->lang->line('LOCATION');?></a></div>
                <div class=""><a href="#car_delivery"><?php echo $this->lang->line('DELIVERY');?></a></div>
                <div class=""><a href="#car_photos"><?php echo $this->lang->line('PHOTOS');?></a></div>
            </div>
        </div>
    </div>

    <div class="clr"></div>
    <div id="overview-panel">
        <div class="inner">
            <div class="container">
                <div class="row">
                    <?php
                    //var_dump($car_input_data);
                    //var_dump($car_makers);
                    //var_dump($single_car_data);
                    ?>
                    <form autocomplete="off" method="post" id="input_car_data" enctype='multipart/form-data' action="">
                        <input type="hidden" name="uploaded_with" value="WEBSITE">
                        <input type="hidden" name="fk_user_id" value="<?php echo $this->session->userdata('userId'); ?>">

                        <div class="col-md-8 margin-bottom-50">
                            <div id="car_details" class="row margin-top-50">
                                <div class="col-md-12">
                                    <h3><?php echo $this->lang->line('CAR_DETAILS'); ?></h3>
                                </div>

                                <div class="col-sm-6">
                                    <div class="col-sm-12 spec">
                                        <div class="row">
                                            <div class="col-xs-6"><?php echo $this->lang->line('MAKE'); ?></div>
                                            <div class="col-xs-6 text-right">
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle button white pull-right" type="button" id="dropdowncarmake" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <span >Select</span>
                                                        <input type="hidden" id="carmake" class="btn-select-input" name="carmake" value="" />
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu carmake-menu" aria-labelledby="dropdowncarmake">
                                                        <li class=""><a href="#">Select</a></li>
                                                        <?php
                                                        foreach ($car_makers as $cm) {
                                                            echo "<li class='carmake-menu-li' data-id='".$cm['id']."'><a href='#'>".$cm['name']."</a></li>";
                                                        } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 spec">
                                        <div class="row">
                                            <div class="col-xs-6"><?php echo $this->lang->line('CATEGORY'); ?></div>
                                            <div class="col-xs-6 text-right">
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle button white pull-right" type="button" id="dropdowncarcat" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <span>Select</span>
                                                        <input type="hidden" class="btn-select-input" name="carcat" value="" />
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdowncarcat">
                                                        <li class=""><a href="#">Select</a></li>
                                                        <?php
                                                        foreach ($car_types as $ct) {
                                                            echo "<li data-id='".$ct['id']."'><a href='#'>".$ct['name']."</a></li>";
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="col-sm-12 spec">
                                        <div class="row">
                                            <div class="col-xs-6"><?php echo $this->lang->line('MODEL'); ?></div>
                                            <div class="col-xs-6 text-right">
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle button white pull-right" type="button" id="dropdowncarmodel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <span>Select</span>
                                                        <input type="hidden" class="btn-select-input" name="carmodel" value="" />
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul id="ddcarmodel" class="dropdown-menu" aria-labelledby="dropdowncarmodel">
                                                        <li class=""><a href="#">Select</a></li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 spec">
                                        <div class="row">
                                            <div class="col-xs-6"><?php echo $this->lang->line('YEAR'); ?></div>
                                            <div class="col-xs-6 text-right">
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle button white pull-right" type="button" id="dropdowncaryear" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <span>Select</span>
                                                        <input type="hidden" class="btn-select-input" name="caryear" value="" />
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdowncaryear">
                                                        <li ><a href="#">Select</a></li>
                                                        <?php
                                                        foreach($car_input_data['car_element_year'] as $car_year ) {
                                                            echo "<li data-id='" . $car_year . "'><a href='#'>" . $car_year . "</a></li>";
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clr"></div>

                            <div id="car_specs" class="row margin-top-50">
                                <div class="col-md-12">
                                    <h3><?php echo $this->lang->line('SPECIFICATIONS'); ?></h3>
                                </div>

                                <div class="col-sm-6">
                                    <div class="col-sm-12 spec">
                                        <div class="row">
                                            <div class="col-xs-6"><?php echo $this->lang->line('KILOMETERS'); ?></div>
                                            <div class="col-xs-6 text-right">
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle button white pull-right" type="button" id="dropdowncarmileage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <span>Select</span>
                                                        <input type="hidden" class="btn-select-input" name="carmileage" value="" />
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdowncarmileage">
                                                        <li class=""><a href="#">Select</a></li>
                                                        <?php
                                                        $car_element_mileage = explode(",",$car_input_data['car_element_mileage']);
                                                        foreach($car_element_mileage as $car_mileage ) {
                                                            echo "<li data-id='".$car_mileage."'><a href='#'>".$car_mileage."</a></li>";
                                                        } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 spec">
                                        <div class="row">
                                            <div class="col-xs-6"><?php echo $this->lang->line('ENGINE_SIZE'); ?> (cc)</div>
                                            <div class="col-xs-6 text-right">
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle button white pull-right" type="button" id="dropdowncarengine" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <span>Select</span>
                                                        <input type="hidden" class="btn-select-input" name="carengine" value="" />
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdowncarengine">
                                                        <li class=""><a href="#">Select</a></li>
                                                        <?php
                                                        $car_element_cubic_capacity = explode(",",$car_input_data['car_element_cubic_capacity']);
                                                        foreach($car_element_cubic_capacity as $car_enginecc ) {
                                                            echo "<li data-id='".$car_enginecc."'><a href='#'>".$car_enginecc."</a></li>";
                                                        } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 spec">
                                        <div class="row">
                                            <div class="col-xs-6"><?php echo $this->lang->line('FUEL_TYPE'); ?> (cc)</div>
                                            <div class="col-xs-6 text-right">
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle button white pull-right" type="button" id="dropdowncarfuel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <span>Select</span>
                                                        <input type="hidden" class="btn-select-input" name="carfuel" value="" />
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdowncarfuel">
                                                        <li class=""><a href="#">Select</a></li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 spec">
                                        <div class="row">
                                            <div class="col-xs-6"><?php echo $this->lang->line('TRANSMISSION'); ?> (cc)</div>
                                            <div class="col-xs-6 text-right">
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle button white pull-right" type="button" id="dropdowncartransmission" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <span>Select</span>
                                                        <input type="hidden" class="btn-select-input" name="cartransmission" value="" />
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdowncartransmission">
                                                        <li class=""><a href="#">Select</a></li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="col-sm-12 spec">
                                        <div class="row">
                                            <div class="col-xs-6"><?php echo $this->lang->line('COLOR'); ?></div>
                                            <div class="col-xs-6 text-right">
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle button white pull-right" type="button" id="dropdowncarcolor" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <span>Select</span>
                                                        <input type="hidden" class="btn-select-input" name="carcolor" value="" />
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdowncarcolor">
                                                        <li class=""><a href="#">Select</a></li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 spec">
                                        <div class="row">
                                            <div class="col-xs-6"><?php echo $this->lang->line('DOORS'); ?></div>
                                            <div class="col-xs-6 text-right">
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle button white pull-right" type="button" id="dropdowncardoors" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <span>Select</span>
                                                        <input type="hidden" class="btn-select-input" name="cardoors" value="" />
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdowncardoors">
                                                        <li ><a href="#">Select</a></li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 spec">
                                        <div class="row">
                                            <div class="col-xs-6"><?php echo $this->lang->line('SEATS'); ?></div>
                                            <div class="col-xs-6 text-right">
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle button white pull-right" type="button" id="dropdowncarseats" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <span>Select</span>
                                                        <input type="hidden" class="btn-select-input" name="carseats" value="" />
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdowncarseats">
                                                        <li ><a href="#">Select</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 spec">
                                        <div class="row">
                                            <div class="col-xs-6"><?php echo $this->lang->line('AIRBAGS'); ?></div>
                                            <div class="col-xs-6 text-right">
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle button white pull-right" type="button" id="dropdowncarairbags" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <span>Select</span>
                                                        <input type="hidden" class="btn-select-input" name="carairbags" value="" />
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdowncarairbags">
                                                        <li ><a href="#">Select</a></li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="clr"></div>
                            <div id="car_extras" class="row margin-top-50">
                                <div class="col-md-12">
                                    <h3><?php echo $this->lang->line('EXTRAS'); ?></h3>
                                </div>

                                <div class="col-sm-12">
                                    <div class="">
                                        <div class="col-sm-4">
                                            <div class="checkbox">
                                                <input id="gpschk" name="gpschk" type="checkbox">
                                                <label for="gpschk" class="margin-top">
                                                    <?php echo $this->lang->line('GPS_NAVIGATION'); ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="checkbox">
                                                <input id="ccchk" name="ccchk" type="checkbox">
                                                <label for="ccchk" class="margin-top">
                                                    <?php echo $this->lang->line('CRUISE_CONTROL'); ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="checkbox">
                                                <input id="radiochk" name="radiochk" type="checkbox">
                                                <label for="radiochk" class="margin-top">
                                                    <?php echo $this->lang->line('RADIO'); ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="clr"></div>
                                        <div class="col-sm-4">
                                            <div class="checkbox">
                                                <input id="acchk" name="acchk" type="checkbox">
                                                <label for="acchk" class="margin-top">
                                                    <?php echo $this->lang->line('AIR_CONDITION'); ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="checkbox">
                                                <input id="paschk" name="paschk" type="checkbox">
                                                <label for="paschk" class="margin-top">
                                                    <?php echo $this->lang->line('PARKING_ASSIST_SYSTEM'); ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="checkbox">
                                                <input id="cdchk" name="cdchk" type="checkbox">
                                                <label for="cdchk" class="margin-top">
                                                    <?php echo $this->lang->line('CD_PLAYER'); ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="clr"></div>
                                        <div class="col-sm-4">
                                            <div class="checkbox">
                                                <input id="sunchk" name="sunchk" type="checkbox">
                                                <label for="sunchk" class="margin-top">
                                                    <?php echo $this->lang->line('SUNROOF'); ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="checkbox">
                                                <input id="rcchk" name="rcchk" type="checkbox">
                                                <label for="rcchk" class="margin-top">
                                                    <?php echo $this->lang->line('REAR_CAMERA'); ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="checkbox">
                                                <input id="mp3chk" name="mp3chk" type="checkbox">
                                                <label for="mp3chk" class="margin-top">
                                                    MP3
                                                </label>
                                            </div>
                                        </div>
                                        <div class="clr"></div>
                                        <div class="col-sm-4">
                                            <div class="checkbox">
                                                <input id="bschk" name="bschk" type="checkbox">
                                                <label for="bschk" class="margin-top">
                                                    <?php echo $this->lang->line('BABY_SEAT'); ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="checkbox">
                                                <input id="rrchk" name="rrchk" type="checkbox">
                                                <label for="rrchk" class="margin-top">
                                                    <?php echo $this->lang->line('ROOF_RACK'); ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="checkbox">
                                                <input id="dvdchk" name="dvdchk" type="checkbox">
                                                <label for="dvdchk" class="margin-top">
                                                    DVD/TV
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="clr"></div>
                            <div class="row margin-top-50">
                                <div class="col-xs-12">
                                    <h3><?php echo $this->lang->line('DESCRIPTION'); ?></h3>
                                    <div class="clr"></div>
                                    <div class="form-group">
                                        <textarea class="form-control" style="border:0" rows="4">Add your desrcription here. Maximum 500 characters</textarea>
                                    </div>

                                </div>
                            </div>

                            <div class="clr"></div>
                            <div id="availability" class="row margin-top-20">
                                <div class="col-xs-12">
                                    <h3><?php echo $this->lang->line('AVAILABILITY'); ?></h3>
                                    <div class="clr"></div>

                                    <label class="col-xs-6 col-sm-4 custom-control custom-radio margin-top">
                                        <input id="avail1" name="availablity" value="1" type="radio" class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description"><?php echo $this->lang->line('EVERY_DAY');?> (MON-SUN)</span>
                                    </label>
                                    <label class="col-xs-6 col-sm-4 custom-control custom-radio margin-top ">
                                        <input id="avail2" name="availablity" value="2" type="radio" class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description"><?php echo $this->lang->line('WEEKEND_ONLY');?> (SAT-SUN)</span>
                                    </label>
                                    <label class="col-xs-12 col-sm-4 custom-control custom-radio margin-top">
                                        <input id="avail3" name="availablity" value="3" type="radio" class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description"><?php echo $this->lang->line('WEEKDAYS_ONLY');?> (MON-FRI)</span>
                                    </label>

                                    <div class="clr"></div>
                                    <label class="col-xs-12 custom-control custom-radio margin-top-10">
                                        <input id="datepicker_array" name="availablity" value="4" type="radio" class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description"><?php echo $this->lang->line('MANUAL');?> (Use calendar below to select days when your car is not available)</span>
                                    </label>
                                    <div class="manual_date">
                                        <input type="text" name="datepicker" value="" />
                                    </div>
                                    <div id="unavail" class="display-none">
                                        <div class="col-xs-4 col-sm-2 margin-top-10 pull-right text-right no-padding">
                                            <div class="col-xs-1 col-sm-3 no-padding " style="width:20px;height:20px;background:#9f9f9f"></div>
                                            <div class="col-xs-9 col-sm-9" style="margin-top: 3px;"><?php echo $this->lang->line('UNAVAILABLE'); ?></div>
                                        </div>
                                    </div>
                                    <div id="myDateRange" class=""></div>
                                </div>
                            </div>

                            <div class="clr"></div>
                            <div id="location" class="row margin-top-20">
                                <div class="col-xs-12">
                                    <h3><?php echo $this->lang->line('LOCATION'); ?></h3>

                                    <div class="col-xs-12 padding-bottom-20" >
                                        <div class="col-xs-12 margin-top-20" style="background: #fff; min-height: 300px;">
                                            <h5><?php echo $this->lang->line('PICK_UP');?></h5>
                                            <input name="carPickUpLat" id="carPickUpLat"  type="hidden" placeholder="">
                                            <input name="carPickUpLon" id="carPickUpLon"  type="hidden" placeholder="">
                                            <input  name="carPickUpLocation" id="carPickUpLocation" class="form-control" type="text" placeholder="">

                                            <div id="us2" style="width: 690px; height: 200px;"></div>
                                        </div>
                                        <label class="col-xs-12 custom-control custom-radio margin-top">
                                            <input type="radio" name="loc_return" id="loc_return" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">
                                            I have a different address for a car dropoff
                                        </span>
                                        </label>
                                        <div id="location_return" class="col-xs-12 " style="background: #fff; min-height: 300px;">
                                            <h5><?php echo $this->lang->line('DROP_OFF');?></h5>
                                            <input name="carDropOffLat" id="carDropOffLat" type="hidden" placeholder="">
                                            <input name="carDropOffLon" id="carDropOffLon" type="hidden" placeholder="">
                                            <input name="carDropOffLocation" id="carDropOffLocation" class="form-control" type="text" placeholder="">

                                            <div id="us1" style="width: 690px; height:200px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="clr"></div>
                            <div id="car_delivery" class="row margin-top-20">
                                <div class="col-xs-12">
                                    <h3><?php echo $this->lang->line('CAR').'&nbsp'.$this->lang->line('DELIVERY_OPTIONS'); ?></h3>
                                    <div class="col-xs-12 padding-bottom-20">
                                        <label class="col-xs-12 custom-control custom-radio margin-top">
                                            <input type="radio" name="car_delivery" checked class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">
                                            Car must be collected from Pickup address
                                        </span>
                                        </label>
                                        <label class="col-xs-12 custom-control custom-radio margin-top">
                                            <input type="radio" name="car_delivery" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">
                                            Car can be delivered for a cost of
                                            <input type="text" maxlength="5" class="margin-left-10" style="width: 50px"/>
                                        </span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="clr"></div>
                            <div id="car_photos" class="row margin-top-20">
                                <div class="col-xs-12">
                                    <h3><?php echo $this->lang->line('UPLOAD_PHOTO_OF_YOUR_CAR'); ?></h3>
                                    <div class="col-xs-12 padding-bottom-20">
                                        <input id="input-photos" name="carimages[]" type="file" multiple class="file-loading">
                                    </div>
                                </div>
                            </div>

                            <div class="clr"></div>
                            <div class="col-md-12">
                                <div class="row">
                                    <input class="col-xs-12 col-sm-5 button margin-top-20 cancel" type='button' value="<?php echo $this->lang->line('CANCEL'); ?>"  style="margin-right: 10px">
                                    <input class="col-xs-12 col-sm-5 button gradient_filter margin-top-20" type='button' value="<?php echo $this->lang->line('RENT_MY_CAR'); ?>">
                                </div>
                            </div>

                        </div><!--left side-->

                        <div class="col-md-3 gradient_filter sidebar rental_price">
                            <h4 class="center" style="color:#fff"><?php echo $this->lang->line('RENTAL_PRICE'); ?></h4>
                            <h5 class="text-white center">Set your rental price and kilometer limits</h5>

                            <div class="col-xs-12" style="padding: 0 20px;">
                                <div class="col-xs-12 margin-top" style="background: #fff;padding: 15px 10px;">
                                    <div class="col-xs-6 no-gutter no-padding ">
                                        <div class="row ">
                                            <div class="col-lg-1 col-md-3 col-sm-1 col-xs-1">
                                                <img src="<?php echo base_url(); ?>assets/image/dailyicon.png" />
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 no-padding">
                                                <div class="col-md-12 title">
                                                    <?php echo $this->lang->line('DAILY_PRICE');?>
                                                </div>
                                                <div class="col-md-12 subtitle">
                                                    <span>&euro;</span><input type="text" maxlength="5" name="perdayprice" id="perdayprice" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 no-gutter no-padding">
                                        <div class="row ">
                                            <div class="col-lg-1 col-md-3 col-sm-1 col-xs-1">
                                                <img src="<?php echo base_url(); ?>assets/image/kilometericon.png" />
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 no-padding">
                                                <div class="col-md-12 title">
                                                    <?php echo $this->lang->line('KILOMETERS');?>
                                                </div>
                                                <div class="col-md-12 subtitle">
                                                    km <input type="text" maxlength="5" name="perdaykm" id="perdaykm" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 no-padding center text-white margin-top">
                                    Our commission is 30%. You receive &euro;32 per day
                                </div>

                                <div class="col-xs-12 margin-top-20" style="background: #fff;padding: 15px 10px;">
                                    <div class="col-xs-6 no-gutter no-padding ">
                                        <div class="row ">
                                            <div class="col-lg-1 col-md-3 col-sm-1 col-xs-1">
                                                <img src="<?php echo base_url(); ?>assets/image/weeklyicon.png" />
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 no-padding">
                                                <div class="col-md-12 title">
                                                    <?php echo $this->lang->line('WEEKLY_PRICE');?>
                                                </div>
                                                <div class="col-md-12 subtitle">
                                                    <span>&euro;</span><input type="text" maxlength="5" name="perweekprice" id="perweekprice" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 no-gutter no-padding">
                                        <div class="row ">
                                            <div class="col-lg-1 col-md-3 col-sm-1 col-xs-1 ">
                                                <img src="<?php echo base_url(); ?>assets/image/kilometericon.png" />
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 no-padding">
                                                <div class="col-md-12 title">
                                                    <?php echo $this->lang->line('KILOMETERS');?>
                                                </div>
                                                <div class="col-md-12 subtitle">
                                                    km <input type="text" maxlength="5" name="perweekkm" id="perweekkm" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 no-padding center text-white margin-top">
                                    Our commission is 30%. You receive &euro;32 per week
                                </div>

                                <div class="col-xs-12 margin-top-20" style="background: #fff;padding: 15px 10px;">
                                    <div class="col-xs-6 no-gutter no-padding ">
                                        <div class="row ">
                                            <div class="col-lg-1 col-md-3 col-sm-1 col-xs-1">
                                                <img src="<?php echo base_url(); ?>assets/image/calendaricon.png" />
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 no-padding">
                                                <div class="col-md-12 title">
                                                    <?php echo $this->lang->line('MONTHLY_PRICE');?>
                                                </div>
                                                <div class="col-md-12 subtitle">
                                                    <span>&euro;</span><input type="text" maxlength="5" name="permonthprice" id="permonthprice" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 no-gutter no-padding">
                                        <div class="row ">
                                            <div class="col-lg-1 col-md-3 col-sm-1 col-xs-1 ">
                                                <img src="<?php echo base_url(); ?>assets/image/kilometericon.png" />
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 no-padding">
                                                <div class="col-md-12 title">
                                                    <?php echo $this->lang->line('KILOMETERS');?>
                                                </div>
                                                <div class="col-md-12 subtitle">
                                                    km <input type="text" maxlength="5" name="permonthkm" id="permonthkm" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 no-padding center text-white margin-top">
                                    Our commission is 30%. You receive &euro;32 per month
                                </div>

                                <div class="col-xs-12 margin-top-20" style="background: #fff;padding: 15px 10px;">
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle button white" type="button" id="dropdownextrakm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="padding: 10px;">
                                            <span id="dropdownscostextrakm">Cost per extra kilometer</span>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownscostextrakm" style="width: 100%">
                                            <li class=""><a href="#">Cost per extra kilometer</a></li>
                                            <li class=""><a href="#">0.1</a></li>
                                            <li class=""><a href="#">0.2</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-3 sidebar rental-includes margin-bottom-20">
                            <h4 class="center"><?php echo $this->lang->line('INSURANCE'); ?></h4>
                            <h5 class="center">Select your current insurance for your car</h5>

                            <div class="col-xs-12 ">
                                <div class="col-xs-12 margin-top" style="margin-left: 20px">
                                    <div class="checkbox">
                                        <input id="stadardinschk" type="checkbox">
                                        <label for="stadardinschk" class="margin-top">
                                            <?php echo $this->lang->line('STANDARD'); ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-12" style="margin-left: 20px">
                                    <div class="checkbox">
                                        <input id="fullcoverinschk" type="checkbox">
                                        <label for="fullcoverinschk" class="margin-top">
                                            <?php echo $this->lang->line('FULL_COVERAGE'); ?>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-xs-10 margin-top-20" style="margin-left: 20px">
                                <label class="form-control-label" for="inputreg">
                                    <?php echo $this->lang->line('VEHICLE_PLATE_NUMBER'); ?>
                                </label>
                                <input type="text" value="" class="center" name="carPlateNumber" placeholder="Enter your plate no.">
                            </div>
                            <div class="form-group col-xs-10 margin-top-20" style="margin-left: 20px">
                                <label class="form-control-label" for="inputexpiry">
                                    <?php echo $this->lang->line('INSURANCE_EXPIRY_DATE'); ?>
                                </label>
                                <input type="text" class="datepickerinsurance center" value="" name="insuranceValidTill" placeholder="DD/MM/YYYY">
                            </div>
                            <input class="button gradient_filter margin-top-20" type='button' value="<?php echo $this->lang->line('ADD_INSURANCE_CONTRACT'); ?>">
                            <input class="button gradient_filter margin-top-20" type='button' value="<?php echo $this->lang->line('ADD_REGISTRATION_PAPER'); ?>">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">

    function get_car_year() {
        c_id = jQuery("#car_maker").val();
        jQuery.ajax({
            url: '<?php echo base_url('index.php/user/call_car_year'); ?>',
            method: 'POST',
            dataType: 'json',
            data: {
                id: c_id
            },
            success: function (data) {
                if (data.status == 1) {
                    jQuery("#car_year").html(data.html);
                }
            }
        });
    }

    function get_car_model(id) {
        m_id = id;
        alert(m_id);
        jQuery.ajax({
            url: '<?php echo base_url('index.php/user/call_car_model'); ?>',
            method: 'POST',
            dataType: 'json',
            async: false,
            data: {
                id: m_id
            },
            success: function (data) {
                if (data.status == 1) {
                    //jQuery("#car_model").html(data.html);
                    jQuery("#ddcarmodel").html(data.html);
                    console.log(data);
                }
            }
        });
    }
    function get_city_list() {
        m_id = jQuery("#country_type").val();
        jQuery.ajax({
            url: '<?php echo base_url('index.php/user/call_city_list'); ?>',
            method: 'POST',
            dataType: 'json',
            async: false,
            data: {
                id: m_id
            },
            success: function (data) {
                if (data.status == 1) {
                    jQuery("#city_list").html(data.html);
                }
            }
        });

    }
    function show_step(step) {
        $(".border-danger").removeClass("border-danger");

        error = $('.error');
        error.html('');

        if ($('select[name=type]').val() == "") {
            show_error('* Please select car type.');
            $('select[name=type]').focus().addClass("border-danger");
            return false;
        }
        if ($('select[name=car_brought_year]').val() == "") {
            show_error('* Please select car year.');
            $('select[name=car_brought_year]').focus().addClass("border-danger");
            return false;
        }
        if ($('select[name=make]').val() == "") {
            show_error('* Please select car maker.');
            $('select[name=make]').focus().addClass("border-danger");
            return false;
        }

        if ($('select[name=model]').val() == "") {
            show_error('* Please select car model.');
            $('select[name=model]').focus().addClass("border-danger");
            return false;
        }

        if ($('select[name=mileage]').val() == "") {
            show_error('* Please select car mileage.');
            $('select[name=mileage]').focus().addClass("border-danger");
            return false;
        }
        if ($('select[name=cubicCapacity]').val() == "") {
            show_error('* Please select car Cubic capacity.');
            $('select[name=cubicCapacity]').focus().addClass("border-danger");
            return false;
        }
        if ($('select[name=fuelType]').val() == "") {
            show_error('* Please select car Fuel type.');
            $('select[name=fuelType]').focus().addClass("border-danger");
            return false;
        }
        if ($('select[name=Transmission]').val() == "") {
            show_error('* Please select car Transmission.');
            $('select[name=Transmission]').focus().addClass("border-danger");
            return false;
        }

        if ($('select[name=color]').val() == "") {
            show_error('* Please select car color.');
            $('select[name=color]').focus().addClass("border-danger");
            return false;
        }
        if ($('select[name=doors]').val() == "") {
            show_error('* Please select car doors.');
            $('select[name=doors]').focus().addClass("border-danger");
            return false;
        }
        if ($('select[name=airbags]').val() == "") {
            show_error('* Please select car airbags.');
            $('select[name=airbags]').focus().addClass("border-danger");
            return false;
        }
        if ($('select[name=seat]').val() == "") {
            show_error('* Please select car seat.');
            $('select[name=seat]').focus().addClass("border-danger");
            return false;
        }

        if ($('textarea[name=description]').val() == "") {
            show_error('* Please enter description.');
            $('textarea[name=description]').focus().addClass("border-danger");
            return false;
        }
        if($('input[name="car_features[]"]:checked').length == 0){
            show_error('* Please choose car features.');
            $('input[name="car_features[]').focus();
            return false;
        }

        if ($('input[name=availablity]:checked').val() != 1 &&  $('input[name=availablity]:checked').val() != 2 && $('input[name=availablity]:checked').val() != 3 && $('#manual_datebox').html()== "") {
            show_error('* Please choose date from calender.');
            $('#manual_datebox').focus().addClass("border-danger");
            document.getElementById('manual_datebox').scrollIntoView();
            return false;
        }

        if ($('input[name=price_daily]').val() == "") {
            show_error('* Please enter daily price.');
            $('input[name=price_daily]').focus().addClass("border-danger");
            return false;

        } else if ($('input[name=price_daily]').val() < 15) {
            show_error('* Daily price should be equal or more than 15.');
            $('input[name=price_daily]').focus().addClass("border-danger");
            return false;
        }
        if ($('#input_w_price').val() < 70) {
            show_error('* Weekly price should be equal or more than 70.');
            $('#input_w_price').focus().addClass("border-danger");
            return false;
        } else if ($('#input_w_price').val() > $('input[name=price_daily]').val() * 7) {
            show_error('* Weekly price can not be  more than ' + $('input[name=price_daily]').val() * 7);
            $('#input_w_price').focus().addClass("border-danger");
            return false;
        }

        if ($('#input_m_price').val() < 200) {
            show_error('* Monthly price should be equal or more than 200.');
            $('#input_m_price').focus().addClass("border-danger");
            return false;
        } else if ($('#input_m_price').val() > $('input[name=price_daily]').val() * 30) {
            show_error('* Monthly price can not be  more than ' + $('input[name=price_daily]').val() * 30);
            $('#input_m_price').focus().addClass("border-danger");
            return false;
        }

        if ($('input[name=kmOrMilesValue]').val() == "" || $('input[name=kmOrMilesValue]').val() > 500 || $('input[name=kmOrMilesValue]').val() < 50) {
            show_error('* Please enter distance from 50 to 500.');
            $('input[name=kmOrMilesValue]').focus().addClass("border-danger");
            return false;
        }

        if ($('select[name=country]').val() == "") {
            show_error('* This location is not available for listing the car.');
            //$('select[name=country]').focus().addClass("border-danger");
            return false;
        }
        if ($('input[name=city]').val() == "") {
            show_error('* This location is not available for listing the car.');
            //$('input[name=city]').focus().addClass("border-danger");
            return false;
        }

        if ($('input[name=deliveryOption]:checked').val() == 1) {
            if (jQuery('input[name=price]').val() > 100) {
                show_error('* Price should be not more than 100.');
                return false;
            }
        }

        if ($('input[name=delete_car_images]').val() != "") {
            if ($('input[name=car_image1]').val() == "" && $('input[name=car_image2]').val() == "" && $('input[name=car_image3]').val() == "" && $('input[name=car_image4]').val() == "" && $('input[name=car_image5]').val() == "") {
                show_error('* Please choose car images.');
                return false;
            }

        }

        if($('input[name=insuranceValidTill]').val() == ""){
            show_error('* Please fill insurance expiry date.');
            $('input[name=insuranceValidTill]').focus().addClass("border-danger");
            return false;
        }

        if ($('input[name=carPlateNumber]').val() == "") {
            show_error('* Please enter car plate number.');
            $('input[name=carPlateNumber]').focus().addClass("border-danger");
            return false;
        }

        $('#input_car_data').submit();
    }
    function show_distance(text) {
        $(".distance_text").html(text);
    }
    jQuery('input[name=price]').keyup(function () {
        this.value = this.value.replace(/[^0-9\.]/g, '');
    });

    jQuery('#input_daily_price').keyup(function () {
        this.value = this.value.replace(/[^0-9\.]/g, '');
        jQuery('#input_w_price').val('');
        jQuery('#input_m_price').val('');
        jQuery("#input_daily_earn").val('');
        jQuery("#input_w_earn").val('');
        jQuery("#input_m_earn").val('');
        jQuery('#input_w_price_discount').html("");
        jQuery('#input_m_price_discount').html("");
        if (this.value > 0) {
            earn = this.value - (this.value * <?php echo get_web_meta_data ('commission_rate');?> ) / 100;
            jQuery("#input_daily_earn").val(earn);
            earn = (this.value * 7) - (this.value * <?php echo get_web_meta_data ('commission_rate');?> * 7) / 100;
            jQuery("#input_w_earn").val(earn);

            earn = (this.value * 30) - (this.value * <?php echo get_web_meta_data ('commission_rate');?> * 30) / 100;
            jQuery("#input_m_earn").val(earn);

            jQuery('#input_w_price').val(this.value * 7);
            jQuery('#input_m_price').val(this.value * 30);
        }
    });
    //input_distance
    jQuery('#input_distance').keyup(function () {
        this.value = this.value.replace(/[^0-9\.]/g, '');
        jQuery('#input_w_distance').val('');
        jQuery('#input_m_distance').val('');
        if (this.value > 0) {
            jQuery('#input_w_distance').val(this.value * 7);
            jQuery('#input_m_distance').val(this.value * 30);
        }
    });

    jQuery('#input_w_price').keyup(function () {
        this.value = this.value.replace(/[^0-9\.]/g, '');
        jQuery('#input_w_price_discount').html('');
        discount = 100 - Math.round((this.value * 100) / (jQuery('#input_daily_price').val() * 7));
        earn = this.value - (this.value * <?php echo get_web_meta_data ('commission_rate');?> ) / 100;
        jQuery("#input_w_earn").val(earn);

        if (this.value > 0 && discount > 0) {
            jQuery('#input_w_price_discount').html("Weekly Discount " + discount + "%");
        }

    });

    jQuery('#input_m_price').keyup(function () {
        this.value = this.value.replace(/[^0-9\.]/g, '');
        jQuery('#input_m_price_discount').html('');
        discount = 100 - Math.round((this.value * 100) / (jQuery('#input_daily_price').val() * 30));
        earn = this.value - (this.value * <?php echo get_web_meta_data ('commission_rate');?> ) / 100;
        jQuery("#input_m_earn").val(earn);

        if (this.value > 0 && discount > 0) {
            jQuery('#input_m_price_discount').html("Monthly Discount " + discount + "%");
        }
    });
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAP_API_KEY ; ?>&sensor=false&libraries=places"
    ></script>
<script src="<?php echo base_url(); ?>assets/js/locationpicker.jquery.js"></script>
<script>
    $('#us1').locationpicker({

        radius: 0.5,
        zoom: 6,
        inputBinding: {
            latitudeInput: $('#carDropOffLat'),
            longitudeInput: $('#carDropOffLon'),
            locationNameInput: $('#carDropOffLocation')
        },
        addressFormat: "formatted_address",
        enableAutocomplete: true
    });

    $('#us2').locationpicker({

        radius: 0.5,
        zoom: 6,
        inputBinding: {
            latitudeInput: $('#carPickUpLat'),
            longitudeInput: $('#carPickUpLon'),
            locationNameInput: $('#carPickUpLocation')
        },
        addressFormat: "formatted_address",
        enableAutocomplete: true,
        onchanged: function(currentLocation, radius, isMarkerDropped) {
            var pick=$('#carPickUpLocation').val();
            $('#carDropOffLocation').val(pick);
            $('#us1').locationpicker({
                location: {latitude: currentLocation.latitude, longitude: currentLocation.longitude},
                radius: 0.5,
                zoom: 6,
                inputBinding: {
                    latitudeInput: $('#carPickUpLat'),
                    longitudeInput: $('#carPickUpLon'),
                    locationNameInput: $('#carPickUpLocation')
                },
                addressFormat: "formatted_address",
                enableAutocomplete: true,

            });
        }
    });
</script>


<script>

    $(document).ready(function (e) {
        $('#input_car_data').on('submit', (function (e) {
            e.preventDefault();
            //$('#message').empty();
            //$('#loading').show();
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/service_edit_car_data',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                success: function (data)
                {
                    if(data.isSuccess){
                        show_success('car information updated.');
                        location.href = '<?php echo base_url() . 'index.php/user/car_list' ?>';
                    }else{
                        show_error(data.message);
                        $('#loading').hide();
                    }

                }
            });
        }));
    });

</script>





<script>
    $(document).ready(function () {
        /*jQuery('input[name=insuranceValidTill]').datetimepicker({
         dayOfWeekStart: 1,
         lang: 'en',
         format: 'Y-m-d',
         formatDate: 'Y-m-d',
         minDate:0,
         mask:true,
         yearStart: '<?php echo date('Y'); ?>',
         timepicker:false
         });
         jQuery('#datepicker').datetimepicker({
         dayOfWeekStart: 1,
         lang: 'en',
         format: 'Y-m-d',
         formatDate: 'Y-m-d',
         minDate:0,
         inline:true,
         mask:true,
         timepicker:false
         });*/
       

        $('#dropdowncarmake .dropdown-menu').click(function(){
    //Show table
             alert('9999'); 
        });
        $('.carmake-menu-li').click(function(){
            console.log(this);
            var z = $(this).data('id')

            console.log(z);
            get_car_model(z);
        });
    });
    $(document).ready(function () {
        $('.xdsoft_today_button').trigger("mousedown");
        $('.xdsoft_today_button').trigger("mouseup");
    });
</script>


<script>
    $(document).ready(function(){

        $("#carPickUpLat").change(function(){
            $('#carDropOffLat').val($("#carPickUpLat").val());
            location_add();
        });
        $("#carPickUpLon").change(function(){
            $('#carDropOffLon').val($("#carPickUpLon").val());
            location_add();
        });

        function location_add(){
            lat = $("#carPickUpLat").val();
            lon = $("#carPickUpLon").val();
            url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+ lat +','+ lon +'&key=<?php echo GOOGLE_MAP_API_KEY ; ?>';
            $.ajax({
                url: url,
                dataType: 'json',
                success: function (data){
                    result = data.results;
                    var lastItem = result.reverse();
                    var lastItem = lastItem.reverse()[0];
                    final = lastItem.formatted_address;
                    final = final.split(',').reverse();
                    //alert(final[0]);alert(final[1]);
                    country = final[0].trim();
                    city = final[1].trim();
                    $("#country_type option") .each(function() { this.selected = (this.text == country); });
                    $("#city_list").val(city);
                }
            });
        }


    });
</script>



<!-- Js files-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/imgupload_sets/plugins/piexif.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/imgupload_sets/plugins/purify.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/imgupload_sets/plugins/sortable.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/imgupload_sets/scripts/fileinput.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/pop_plug/jquery.toastee.0.1.js"></script>
<div id="testy" style="margin: 0 auto;position: fixed;top:7.5%;width: 100%;z-index: 100;"></div>
<script>
    function show_error(text){
        $('#testy').toastee({
            header: 'Error!',
            type: 'error',
            message: text
        });
    }
    function show_success(text){
        $('#testy').toastee({
            type: 'success',
            message: text
        });
    }
</script>
<script>

    $(document).ready(function () {

        $('input[name=carPlateNumber]').blur(function () {
            var car_plate = $(this).val().toUpperCase();
            $(this).val(car_plate);
            var greece = /^[A-Z]{3}[0-9]{4}$/;
            var cyprus = /^[A-Z]{3}[0-9]{3}$/;
            var country = $('#country_type :selected').text().toLowerCase().trim();
            if(country == "greece" && !car_plate.match(greece) ){
                show_error('car number plate is not valid for '+ country);
            }
            if(country == "cyprus" && !car_plate.match(cyprus) ){
                show_error('car number plate is not valid for '+ country);
            }

        });


        //$('#datepicker_array').trigger('click');

        $('#input_w_price').trigger('keyup');
        $('#input_m_price').trigger('keyup');


        $(".manual_date").hide();
        var $daterangepickerinput = $('input[name="datepicker"]');
        $daterangepickerinput.daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD',
                    cancelLabel: 'Clear'
                },
                "parentEl": "myDateRange",
                "opens": "right",
                autoUpdateInput: true,
            },
            function(start, end, label) {
                //alert("A new date range was chosen: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        $daterangepickerinput.on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' / ' + picker.endDate.format('YYYY-MM-DD'));
        });
        $daterangepickerinput.on('cancel.daterangepicker', function(ev, picker) {
            picker = null;
            $(this).val('');
        });
        $daterangepickerinput.on('hide.daterangepicker', function(ev, picker) {
            picker.isShowing = false;
            picker.show();
        });


        $("#datepicker_array").click(function () {
            if (this.id == "datepicker_array") {
                $(".manual_date").show('fast');
                $(".daterangepicker").appendTo('#myDateRange');
                $("#unavail").appendTo('#myDateRange .daterangepicker ').show();
                $('input[name="datepicker"]').click();
            } else {
                $(".manual_date").hide('fast');
            }
        });

        var radioLocationState;
        $('input:radio[name="loc_return"]').click(function(){
            if (radioLocationState === this) {
                this.checked = false;
                radioLocationState = null;
            } else
                radioLocationState = this;
            $(this).attr('checked', radioLocationState);

            //$('#location_return').slideToggle( "fast", function() {});
        });

        $("#input-photos").fileinput({
            initialPreview: [
                'http://via.placeholder.com/200x200',
                'http://via.placeholder.com/200x200',
            ],
            initialPreviewAsData: true,
            initialPreviewConfig: [
                {width: "120px", key: 1, frameClass: "carimgipload", showZoom: false},
                {width: "120px", key: 2, frameClass: "carimgipload", showZoom: false}
            ],
            deleteUrl: "/site/file-delete",
            overwriteInitial: false,
            showUpload: false,
            showCaption: false,
            maxFileSize: 100,
            initialCaption: ""
        });

    });


</script>


<link href="<?php echo base_url(); ?>assets/css/skdslider.css" rel="stylesheet">

<!--footer-->
<?php $this->load->view('include/footer_block'); ?>
<!--/footer-->