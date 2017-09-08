
    <?php $this->load->view('header');

    if ($this->input->get('car_from') == "" and $this->input->get('car_to') == "") {
        $from = date('Y-m-d H:00', strtotime('+4 hours'));
        $to = date('Y-m-d H:00', strtotime("+7 days"));
    } else {
        $from = $this->input->get('car_from');
        $to = $this->input->get('car_to');
    }
    $date_segment = array(
        'from_time' => $from,
        'to_time' => $to
    );
    $this->session->set_userdata($date_segment);
    ?>

    <div class="clr"></div>
    <div class="header-banner gradient_filter">
        <div class="inner">
            <div class="container">
                <div class="banner1-txt">
                    <h1><?php echo $this->lang->line('WHERE_WILL_YOU_DRIVE_TODAY');?></h1>
                    <h4 class="margin-bottom-50">Rent a fully insured car in Greece from just €39 per day</h4>
                </div>
            </div>
            <?php $this->load->view('include/searchbox'); ?>
            <div class="container">
                <div class="row">
                    <div id="filterswitch" class="col-md-12 margin-top-20">
                        <img src="<?php echo base_url(); ?>assets/image/Filter_icon.png" />
                        <?php echo '&nbsp'.$this->lang->line('FILTER').' '.$this->lang->line('RESULTS');?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clr"></div>
    <div id="filters">
        <div class="inner ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 no-gutter">
                        <div class="col-md-12">
                            Price per day
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle button white" type="button" id="dropdownprice" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span class="selectedfilter">All Prices</span>
                                    <span class="caret"></span>
                                </button>
                                <ul id="dropdownsfiltercarprice" class="dropdown-menu dropdownsfiltercars" aria-labelledby="dropdownprice">
                                    <li class="carpanel"><a href="#">All Prices</a></li>
                                    <li class="50"><a href="#"><50€</a></li>
                                    <li class="100"><a href="#"><100€</a></li>
                                    <li class="150"><a href="#"><150€</a></li>
                                    <li class="200"><a href="#"><200€</a></li>
                                    <li class="300"><a href="#"><300€</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 no-gutter">
                        <div class="col-md-12">
                            Vehicle Categories
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle button white" type="button" id="dropdowncat" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span class="selectedfilter">All</span>
                                    <span class="caret"></span>
                                </button>
                                <ul id="dropdownsfiltercarcat" class="dropdown-menu dropdownsfiltercars" aria-labelledby="dropdowncat">
                                    <li class="carpanel"><a href="#">All</a></li>
                                    <li class="city"><a href="#">City</a></li>
                                    <li class="family"><a href="#">Family</a></li>
                                    <li class="minibus"><a href="#">Minibus</a></li>
                                    <li class="sport"><a href="#">Sport</a></li>
                                    <li class="convertible"><a href="#">Convertible</a></li>
                                    <li class="4x4"><a href="#">4x4</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 no-gutter">
                        <div class="col-md-12">
                            Make
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle button white" type="button" id="dropdownmake" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span class="selectedfilter">All</span>
                                    <span class="caret"></span>
                                </button>
                                <ul id="dropdownsfiltercarmake" class="dropdown-menu dropdownsfiltercars" aria-labelledby="dropdownmake">
                                    <li class="carpanel"><a href="#">All</a></li>

                                    <?php
                                        foreach ($car_makers as $cm) {
                                            echo "<li class='".$cm['name']."' data-id='".$cm['id']."'><a href='#'>".$cm['name']."</a></li>";
                                        } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 no-gutter">
                        <div class="col-md-12">
                            Model
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle button white" type="button" id="dropdownmodel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span class="selectedfilter">All Models</span>
                                    <span class="caret"></span>
                                </button>
                                <ul id="dropdownsfiltercarmodel" class="dropdown-menu dropdownsfiltercars" aria-labelledby="dropdownmodel">
                                    <li class="carpanel"><a href="#">All Models</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 no-gutter">
                        <div class="col-md-12">
                            Transmission
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle button white" type="button" id="dropdowntrans" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span class="selectedfilter">All Types</span>
                                    <span class="caret"></span>
                                </button>
                                <ul id="dropdownsfiltercartrans" class="dropdown-menu dropdownsfiltercars" aria-labelledby="dropdowntrans">
                                    <li class="carpanel"><a href="#">All Types</a></li>
                                    <li class="automatic"><a href="#">Automatic</a></li>
                                    <li class="manual"><a href="#">Manual</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-6 col-xs-6 no-gutter">
                        <div class="col-md-12">
                            Fuel Type
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle button white" type="button" id="dropdownfuel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span class="selectedfilter">All Types</span>
                                    <span class="caret"></span>
                                </button>
                                <ul id="dropdownsfiltercarfuel" class="dropdown-menu dropdownsfiltercars" aria-labelledby="dropdownfuel">
                                    <li class="carpanel"><a href="#">All Types</a></li>
                                    <li class="petrol"><a href="#">Petrol</a></li>
                                    <li class="diesel"><a href="#">Diesel</a></li>
                                    <li class="hybrid"><a href="#">Hybrid</a></li>
                                    <li class="electric"><a href="#">Electric</a></li>
                                    <li class="gas"><a href="#">Gas</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-11 col-xs-11 no-gutter pull-right">
                        <div class="button clear-all">
                            <span>Clear all</span>
                            <img src="<?php echo base_url(); ?>assets/image/Xicon.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clr"></div>
    <div id="carresults">
        <div class="inner ">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h2><span><?php echo count($car_data);?></span><?php echo '&nbsp'.$this->lang->line('VEHICLES').' '.$this->lang->line('AVAILABLE');?></h2>
                    </div>
                    <div class="col-md-8 margin-top-20">
                        <div class="pull-right button gradient_filter margin-left-15">
                            <?php if ($this->input->get('result_page_view') == "map") { ?>
                                <a href="#" onClick="$('input:radio[id=result_page_view_list]').prop('checked', true);$('#filter_form_element').submit();" >
                                    <span><?php echo $this->lang->line('GRID').' '.$this->lang->line('VIEW');?></span>
                                    <img src="<?php echo base_url(); ?>assets/image/gridpinicon.png" />
                                </a>
                            <?php } else { ?>
                                <a href="#" onClick="$('input:radio[id=result_page_view_map]').prop('checked', true); search_records();" >
                                    <span><?php echo $this->lang->line('MAP').' '.$this->lang->line('VIEW');?></span>
                                    <img src="<?php echo base_url(); ?>assets/image/MapPinicon.png" />
                                </a>
                            <?php } ?>
                        </div>
                        <div class="pull-right">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle button white" type="button" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span class="selectedsort"><?php echo $this->lang->line('SORT');?></span>
                                    <span class="caret"></span>
                                </button>
                                <ul id="dropdownsortcars" class="dropdown-menu" aria-labelledby="dropdown1">
                                    <li><a href="#">Price</a></li>
                                    <li><a href="#">Make</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8 ">
                        <div id="filter-car-cats" class="filter-car-cats pull-right">
                            <div class="carpanel active"><?php echo $this->lang->line('ALL');?></div>
                            <div class="city"><?php echo $this->lang->line('CITY');?></div>
                            <div class="family"><?php echo $this->lang->line('FAMILY');?></div>
                            <div class="minibus"><?php echo $this->lang->line('MINIBUS');?></div>
                            <div class="sport"><?php echo $this->lang->line('SPORT');?></div>
                            <div class="convertible"><?php echo $this->lang->line('CONVERTIBLE');?></div>
                            <div class="4x4"><?php echo $this->lang->line('4X4');?></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="carholder margin-top-20 margin-bottom-20">

                        <?php
                        if (count($car_data) < 1) {
                            echo "<div class='filter-img center '>No cars found for this period</div>";
                        } else {
                            if ($this->input->get('result_page_view') == "map") {
                                ?>
                                <div id="map_wrapper">
                                    <div id="map_canvas" class="mapping"></div>
                                </div>

                                <?php
                            } else {
                                foreach ($car_data as $cd) {
                                    //var_dump($cd);
                                    $user_image = base_url() . "assets/image/profileicon.png";
                                    if ($cd['get_user_image'] != "")
                                        $user_image = $cd['get_user_image'];

                                    $is_4x4 = '';
                                    foreach ($cd['car_features'] as $feature){
                                        if(strpos($feature['feature_name'], '4-wheel drive') !== false) {
                                            $is_4x4 = '4x4';break;
                                        }
                                    }
                                    ?>

                                    <a href="<?php echo site_url('user/car_data/' . $cd['id']) ?>?car_from=<?php echo $from; ?>&car_to=<?php echo $to; ?>">
                                        <div class="carpanel  col-sm-6 col-md-4 margin-top-20 <?php echo $is_4x4.' '; echo strtolower($cd['get_type_name']) ?> <?php echo strtolower($cd['get_transmission_name']) ?>">
                                            <div>
                                                <img
                                                    src="<?php echo (isset($cd['car_images'][0]['CarImage_path'])) ? $cd['car_images'][0]['CarImage_path'] : ''; ?>"/>

                                                <div class="info">
                                                    <div class="col-xs-9">
                                                        <div
                                                            class="title"><?php echo $cd['get_make_name'] . ' ' . $cd['get_model_name']; ?></div>
                                                        <div><?php echo $cd['cubicCapacity'] . ', ' . $cd['doors'] . ', ' . $cd['get_fuel_type_name'] ?></div>
                                                    </div>
                                                    <div class="col-xs-3 text-right">
                                                        <div
                                                            class="col-md-12 price no-padding">&euro;<?php echo $cd['price_daily']; ?></div>
                                                        <div
                                                            class="col-md-12 no-padding"><?php echo $this->lang->line('PER_DAY'); ?></div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 divider"></div>
                                                <div class="info profile">
                                                    <div class="col-xs-8 col-md-7">
                                                        <div class="col-xs-3 col-md-2 no-padding">
                                                            <img src="<?php echo $user_image; ?>"/>
                                                        </div>
                                                        <div class="col-md-9  name">
                                                            <?php echo current(explode(' ', $cd['get_username'])); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4 col-md-5 text-right distance">
                                                        <div class="col-xs-7 col-md-9 no-padding">6.5Km</div>
                                                        <div class="col-xs-5 col-md-3 no-padding">
                                                            <img src="<?php echo base_url(); ?>assets/image/Mapicon.png"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <?php
                                }
                            }
                        }?>

                    </div>
                </div>
            </div>
        </div>
    </div>






    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAP_API_KEY; ?>&libraries=places&callback=initAutocomplete"
            async defer></script>
    <?php

    if (count($car_data) > 0 && $this->input->get('result_page_view') == "map") {
        ?>
        <script>

            function initialize() {

                var map;
                var bounds = new google.maps.LatLngBounds();
                var mapOptions = {
                    mapTypeId: 'roadmap'
                };

                // Display a map on the page
                map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
                map.setTilt(45);


                <?php
                $i = 1;
                $max = count($car_data);
                $markers = $info_window = "";
                foreach ($car_data as $cd) {

                    $pickuplat = $cd['carPickUpLat'];
                    $pickuplon = $cd['carPickUpLon'];
                    $markers .= "['',$pickuplat,$pickuplon]";

                    $user_image = base_url() . "assets/image/profileicon.png";
                    if ($cd['get_user_image'] != "")
                        $user_image = $cd['get_user_image'];
                    $is_4x4 = '';
                    foreach ($cd['car_features'] as $feature){
                        if(strpos($feature['feature_name'], '4-wheel drive') !== false) {
                            $is_4x4 = '4x4';break;
                        }
                    }
                    $car_image = (isset($cd["car_images"][0]["CarImage_path"])) ? $cd["car_images"][0]["CarImage_path"] : "";

                    $info_window .= '["' .
                        "<a href='".site_url("user/car_data/" . $cd["id"])."?car_from=".$from."&car_to=".$to."'><div class='carpanel no-padding col-xs-12 margin-top-20 ".$is_4x4." ".strtolower($cd["get_type_name"])." ".strtolower($cd["get_transmission_name"])."'><div><img src='".$car_image."'/><div class='info'><div class='col-xs-7'><div class='title'>".$cd["get_make_name"] . " " . $cd["get_model_name"]."</div><div>".$cd["cubicCapacity"] . ", " . $cd["doors"] . ", " . $cd["get_fuel_type_name"]."</div></div><div class='col-xs-5 text-right'><div class='col-md-12 price no-padding'>&euro;".$cd["price_daily"]."</div><div class='col-md-12 no-padding'>".$this->lang->line("PER_DAY")."</div></div></div><div class='col-xs-12 divider'></div><div class='info profile'><div class='col-xs-7'><div class='col-xs-3 no-padding'><img src='".$user_image."'/></div><div class='col-xs-9 name'>".current(explode(" ", $cd["get_username"]))."</div></div><div class='col-xs-5 text-right distance'><div class='col-xs-7 no-padding'>6.5Km</div><div class='col-xs-5 no-padding'><img src='".base_url()."assets/image/Mapicon.png'/></div></div></div></div></div></a>"
                        . '"]';

                    if ($i != $max) {
                        $markers = $markers . ",";
                        $info_window = $info_window . ",";
                    }
                    $i++;
                }
                ?>

                // Multiple Markers
                var markers = [<?php echo $markers; ?>
                ];

                // Info Window Content
                var infoWindowContent = [<?php echo $info_window; ?>
                ];

                // Display multiple markers on a map
                var infoWindow = new google.maps.InfoWindow(), marker, i;

                // Loop through our array of markers & place each one on the map
                for (i = 0; i < markers.length; i++) {
                    var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
                    bounds.extend(position);
                    marker = new google.maps.Marker({
                        position: position,
                        map: map,
                        //title: markers[i][0]
                        icon: "<?php echo base_url(); ?>assets/image/pins.png"
                    });

                    // Allow each marker to have an info window
                    google.maps.event.addListener(marker, 'click', (function (marker, i) {
                        return function () {
                            infoWindow.setContent(infoWindowContent[i][0]);
                            infoWindow.open(map, marker);
                        }
                    })(marker, i));

                    // Automatically center the map fitting all markers on the screen
                    map.fitBounds(bounds);
                }

                // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
                var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function (event) {
                    this.setZoom(5);
                    google.maps.event.removeListener(boundsListener);
                });

            }
        </script>

        <?php
    }
    ?>
    <script>

        var init_car_search = true;
        //TODO achronak have to get data back in a different format

        function get_car_model(makeid) {

            m_id = makeid;
            if(typeof makeid !== 'undefined') {
                m_id = $('.' + makeid).attr('data-id');
            }

            jQuery.ajax({
                url: base_url+'index.php/user/call_car_model',
                method: 'POST',
                dataType: 'json',
                async: false,
                data: {
                    id: m_id
                },
                success: function (data) {
                    if (data.status == 1) {
                        jQuery("select[name=model]").html(data.html);
                    }
                }
            });
        }

        function initAutocomplete() {
            <?php if (count($car_data) > 0 && $this->input->get('result_page_view') == "map") { ?>
            initialize();
            <?php } ?>
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



    <div class="modal fade"  id="page_pop_error_element" style="z-index:9999999;" role="dialog">
        <div class="modal-dialog modal-dialog-new">

            <!-- Modal content-->
            <div class="modal-content modal-content-new">

                <div class="modal-body text-center">
                    <i class="fa  fa-clock-o fa-4x"></i>
                    <p id="page_pop_error_element-message"></p>
                </div>

            </div>
        </div>
    </div>

    <!--footer-->
    <?php $this->load->view('include/footer_block'); ?>
    <!--/footer-->
