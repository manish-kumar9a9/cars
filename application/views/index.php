
    <?php $this->load->view('header'); ?>
        <div class="clr"></div>
        <div class="home-banner1">
            <div class="inner">
                <div class="container">
                    <div class="banner1-txt">
                        <?php echo $this->lang->line('WHERE_WILL_YOU_DRIVE_TODAY');?>
                        <div class="divider gradient_filter"></div>
                    </div>
                </div>
                <?php $this->load->view('include/searchbox'); ?>
                <div class="container">
                    <div class="col-md-12 text-center ">
                        <img class="margin-top-20" src="<?php echo base_url(); ?>assets/image/Allianz.png" />
                    </div>
                </div>
            </div>
        </div>

        <div class="clr"></div>
        <div class="featuredcars homesection ">
            <div class="gradient_filter" style="width: 100%;height: 265px;position: absolute;margin-top: -20px;"></div>
            <div class="inner ">
                <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h2><?php echo $this->lang->line('FEATURED_VEHICLES');?></h2>
                    </div>
                    <div class="col-md-8 ">
                        <div class="filter-car-cats pull-right">
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
                    <div class="carholder">
                        <?php if($featured_cars): ?>
                            <?php foreach ($featured_cars as $car): ?>
                                <a href="<?php echo site_url('user/car_data/' . $car->id )?>">
                                    <div class="carpanel col-sm-6 col-md-4 margin-top-20  <?php echo $car->category?>">
                                        <div>
                                            <div class="new gradient_filter"><?php echo $this->lang->line('NEW');?></div>
                                            <img src="<?php echo base_url(); ?>assets/image/<?php echo $car->CarImage?>"/>
                                            <div class="info">
                                                <div class="col-xs-9">
                                                    <div class="title"><?php echo /*$car->id.", ".*/$car->company." "
                                                            .$car->modelnmae?></div>
                                                    <div><?php echo $car->cubicCapacity.", ".$car->doors.", "
                                                        .$car->fuel ?></div>
                                                </div>
                                                <div class="col-xs-3 text-right">
                                                    <div class="col-md-12 price no-padding">€<?php echo
                                                        $car->price_daily; ?></div>
                                                    <div class="col-md-12 no-padding"><?php echo $this->lang->line('PER_DAY');?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach ;?>
                        <?php endif; ?>
<!--                        <div class="carpanel col-sm-6 col-md-4 margin-top-20  family sport">-->
<!--                            <div>-->
<!--                                <div class="new gradient_filter">--><?php //echo $this->lang->line('NEW');?><!--</div>-->
<!--                                <img src="--><?php //echo base_url(); ?><!--assets/image/porsche.png"/>-->
<!--                                <div class="info">-->
<!--                                    <div class="col-xs-9">-->
<!--                                        <div class="title">Porsche Macan</div>-->
<!--                                        <div>3600cc, 4 Door, Petrol</div>-->
<!--                                    </div>-->
<!--                                    <div class="col-xs-3 text-right">-->
<!--                                        <div class="col-md-12 price no-padding">€350</div>-->
<!--                                        <div class="col-md-12 no-padding">--><?php //echo $this->lang->line('PER_DAY');?><!--</div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="carpanel  col-sm-6 col-md-4 margin-top-20  sport">-->
<!--                            <div>-->
<!--                                <img src="--><?php //echo base_url(); ?><!--assets/image/vwgolf.png"/>-->
<!--                                <div class="info">-->
<!--                                    <div class="col-xs-9">-->
<!--                                        <div class="title">VW Golf GTI</div>-->
<!--                                        <div>1600cc, 2 Door, Petrol</div>-->
<!--                                    </div>-->
<!--                                    <div class="col-xs-3 text-right">-->
<!--                                        <div class="col-md-12 price no-padding">€100</div>-->
<!--                                        <div class="col-md-12 no-padding">--><?php //echo $this->lang->line('PER_DAY');?><!--</div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="carpanel  col-sm-6 col-md-4 margin-top-20 sport 4x4">-->
<!--                            <div>-->
<!--                                <img src="--><?php //echo base_url(); ?><!--assets/image/bmw.png"/>-->
<!--                                <div class="info">-->
<!--                                    <div class="col-xs-9">-->
<!--                                        <div class="title">BMW X1</div>-->
<!--                                        <div>1800cc, 4 Door, Diesel</div>-->
<!--                                    </div>-->
<!--                                    <div class="col-xs-3 text-right">-->
<!--                                        <div class="col-md-12 price no-padding">€250</div>-->
<!--                                        <div class="col-md-12 no-padding">--><?php //echo $this->lang->line('PER_DAY');?><!--</div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="carpanel  col-sm-6 col-md-4 margin-top-20  sport 4x4">-->
<!--                            <div>-->
<!--                                <img src="--><?php //echo base_url(); ?><!--assets/image/bmw.png"/>-->
<!--                                <div class="info">-->
<!--                                    <div class="col-xs-9">-->
<!--                                        <div class="title">BMW X1</div>-->
<!--                                        <div>1800cc, 4 Door, Diesel</div>-->
<!--                                    </div>-->
<!--                                    <div class="col-xs-3 text-right">-->
<!--                                        <div class="col-md-12 price no-padding">€250</div>-->
<!--                                        <div class="col-md-12 no-padding">--><?php //echo $this->lang->line('PER_DAY');?><!--</div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="carpanel  col-sm-6 col-md-4 margin-top-20  sport">-->
<!--                            <div>-->
<!--                                <div class="new gradient_filter">--><?php //echo $this->lang->line('NEW');?><!--</div>-->
<!--                                <img src="--><?php //echo base_url(); ?><!--assets/image/vwgolf.png"/>-->
<!--                                <div class="info">-->
<!--                                    <div class="col-xs-9">-->
<!--                                        <div class="title">VW Golf GTI</div>-->
<!--                                        <div>1600cc, 2 Door, Petrol</div>-->
<!--                                    </div>-->
<!--                                    <div class="col-xs-3 text-right">-->
<!--                                        <div class="col-md-12 price no-padding">€100</div>-->
<!--                                        <div class="col-md-12 no-padding">--><?php //echo $this->lang->line('PER_DAY');?><!--</div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="carpanel  col-sm-6 col-md-4 margin-top-20 family sport ">-->
<!--                            <div>-->
<!--                                <img src="--><?php //echo base_url(); ?><!--assets/image/porsche.png"/>-->
<!--                                <div class="info">-->
<!--                                    <div class="col-xs-9">-->
<!--                                        <div class="title">Porsche Macan</div>-->
<!--                                        <div>3600cc, 4 Door, Petrol</div>-->
<!--                                    </div>-->
<!--                                    <div class="col-xs-3 text-right">-->
<!--                                        <div class="col-md-12 price no-padding">€350</div>-->
<!--                                        <div class="col-md-12 no-padding">--><?php //echo $this->lang->line('PER_DAY');?><!--</div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                    </div>
                    <div class="col-xs-12"><div class="gradient_filter show_more button"><?php echo $this->lang->line('SHOW_MORE');?></div></div>
                </div>
                </div>
            </div>
        </div>

        <div class="clr"></div>
        <div class="meetthepeople homesection gradient_filter">
            <div class="inner ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h4><?php echo $this->lang->line('RENT_FROM_PEOPLE');?></h4>
                            <h2 class="no-margin"><?php echo $this->lang->line('MEET_THE_PEOPLE');?></h2>
                        </div>
                    </div>
                    <div id="customerCarousel" class="carousel slide margin-top-20" data-ride="carousel">
                        <div class="row">
                            <div class="carousel-inner" role="listbox">
                                <?php $i=0;?>
                                <?php foreach($breaks as $values):?>
                                    <div class="item  <?php if($i ==0){ echo "active";}?>">
                                        <?php foreach($values as $owner):?>
                                            <div class="col-sm-3 margin-top-20 margin-bottom-20">
                                                <img src="<?php echo base_url(); ?>assets/image/person2.png"/>
                                                <div>
                                                    <div class="name"><?php echo $owner->firstName." "
                                                            .$owner->lastName ?></div>
                                                    <div class="car"><?php echo $owner->company." "
                                                            .$owner->modelnmae ?></div>
                                                    <div class="white button"><?php echo $this->lang->line('VIEW_CAR');?></div>
                                                </div>
                                            </div>
                                        <?php endforeach;?>
                                    </div>
                                    <?php $i++;?>
                                <?php endforeach;?>
                                <!--<div class="item active">
                                    <div class="col-sm-3 margin-top-20 margin-bottom-20">
                                        <img src="<?php /*echo base_url(); */?>assets/image/person1.png"/>
                                        <div>
                                            <div class="name">Jason</div>
                                            <div class="car">VW Golf GTI</div>
                                            <div class="white button"><?php /*echo $this->lang->line('VIEW_CAR');*/?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 margin-top-20 margin-bottom-20">
                                        <img src="<?php /*echo base_url(); */?>assets/image/person2.png"/>
                                        <div>
                                            <div class="name">Mariza</div>
                                            <div class="car">VW Golf GTI</div>
                                            <div class="white button"><?php /*echo $this->lang->line('VIEW_CAR');*/?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 margin-top-20 margin-bottom-20">
                                        <img src="<?php /*echo base_url(); */?>assets/image/person3.png"/>
                                        <div>
                                            <div class="name">Sofia</div>
                                            <div class="car">BMX X1</div>
                                            <div class="white button"><?php /*echo $this->lang->line('VIEW_CAR');*/?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 margin-top-20 margin-bottom-20">
                                        <img src="<?php /*echo base_url(); */?>assets/image/person4.png"/>
                                        <div>
                                            <div class="name">Jason</div>
                                            <div class="car">VW Golf GTI</div>
                                            <div class="white button"><?php /*echo $this->lang->line('VIEW_CAR');*/?></div>
                                        </div>
                                    </div>
                                </div>-->
                                <!--<div class="item">
                                    <div class="col-sm-3 margin-top-20 margin-bottom-20">
                                        <img src="<?php /*echo base_url(); */?>assets/image/person2.png"/>
                                        <div>
                                            <div class="name">Jason</div>
                                            <div class="car">VW Golf GTI</div>
                                            <div class="white button"><?php /*echo $this->lang->line('VIEW_CAR');*/?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 margin-top-20 margin-bottom-20">
                                        <img src="<?php /*echo base_url(); */?>assets/image/person1.png"/>
                                        <div>
                                            <div class="name">Jason</div>
                                            <div class="car">VW Golf GTI</div>
                                            <div class="white button"><?php /*echo $this->lang->line('VIEW_CAR');*/?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 margin-top-20 margin-bottom-20">
                                        <img src="<?php /*echo base_url(); */?>assets/image/person4.png"/>
                                        <div>
                                            <div class="name">Jason</div>
                                            <div class="car">VW Golf GTI</div>
                                            <div class="white button"><?php /*echo $this->lang->line('VIEW_CAR');*/?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 margin-top-20 margin-bottom-20">
                                        <img src="<?php /*echo base_url(); */?>assets/image/person3.png"/>
                                        <div>
                                            <div class="name">Jason</div>
                                            <div class="car">VW Golf GTI</div>
                                            <div class="white button"><?php /*echo $this->lang->line('VIEW_CAR');*/?></div>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                            <ol class="carousel-indicators">
                                <?php foreach($breaks as $key=> $values):?>
                                    <li data-target="#customerCarousel" data-slide-to="<?php echo $key ?>"
                                    class="<?php if($key ==0){
                                        echo "active";}?>"></li>
                                <?php endforeach;?>
                                <!--<li data-target="#customerCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#customerCarousel" data-slide-to="1"></li>-->
                                <!-- divide by 4 your total and place here as many data-slide-to as you want. -->
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="clr"></div>
        <div class="simleneasytouse homesection">
            <div class="inner margin-top-20">
                <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <img src="<?php echo base_url(); ?>assets/image/hand_urend.png"/>
                    </div>
                    <div class="col-md-6">
                        <h4 class="margin-top-50"><?php echo $this->lang->line('HOW_IT_WORKS');?></h4>
                        <h1 class="no-margin"><?php echo $this->lang->line('SIMPLE_AND_EASY_TO_USE');?></h1>
                        <div class="divider gradient_filter"></div>
                        <div class="row">
                            <div class="col-xs-5 col-md-3 margin-top-20">
                                <div id="renter" class="gradient_filter button"><?php echo $this->lang->line('RENTER');?></div>
                            </div>
                            <div class="col-xs-5 col-md-3 margin-top-20">
                                <div id="owner" class="white button"><?php echo $this->lang->line('OWNER');?></div>
                            </div>
                        </div>
                        <div class="row margin-top-50 renter_data">
                            <div class="col-md-12">
                                <div class="title">
                                    1. <?php echo $this->lang->line('SELECT_YOUR_CAR');?>
                                </div>
                                <p>Browse the listed cars on Urend and find the one which best fits you!
                                </p>
                            </div>
                            <div class="col-md-12 margin-top-20">
                                <div class="title">
                                    2. <?php echo $this->lang->line('SEND_REQUEST');?>
                                </div>
                                <p>Book the car in just a few steps. Send the request to the car owner and he
                                    will confirm your booking.
                                </p>
                            </div>
                            <div class="col-md-12 margin-top-20">
                                <div class="title">
                                    3. <?php echo $this->lang->line('PICK_UP_KEYS');?>
                                </div>
                                <p>Meet the owner at the agreed place, fill the electronic agreement and you
                                    are ready to go!
                                </p>
                            </div>
                        </div>
                        <div class="row margin-top-50 owner_data display-none">
                            <div class="col-md-12">
                                <div class="title">
                                    1. <?php echo $this->lang->line('LIST_YOUR_CAR');?>
                                </div>
                                <p>List your car in simple and easy steps. Specify conditions, features and price.
                                    Upload photos to make your listing more attractive.
                                </p>
                            </div>
                            <div class="col-md-12 margin-top-20">
                                <div class="title">
                                    2. <?php echo $this->lang->line('MANAGE_YOUR_REQUESTS');?>
                                </div>
                                <p>Accept or Decline your incoming requests using the web or mobile app of Urend.
                                </p>
                            </div>
                            <div class="col-md-12 margin-top-20">
                                <div class="title">
                                    3. <?php echo $this->lang->line('MEET_THE_RENTER');?>
                                </div>
                                <p>Meet the renters for the handover and give them your keys. Feel completely safe as rental
                                    is fully insured by Allianz!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="clr"></div>
        <div class="securityandsafety homesection">
            <div class="inner">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="margin-top-5"><?php echo $this->lang->line('SECURITY_AND_SAFETY');?></h4>
                            <h1 class="no-margin"><?php echo $this->lang->line('PEACE_OF_MIND');?></h1>
                            <div class="divider gradient_filter"></div>
                            <div class="col-md-4 no-padding margin-top-20">
                                <p><?php echo $this->lang->line('PEACE_OF_MIND_TEXT'); ?>
                                </p>
                                <img class="margin-top-20" src="<?php echo base_url(); ?>assets/image/Allianzblue.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="clr"></div>
        <div class="downloadapp homesection gradient_filter">
            <div class="inner margin-top-50">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="<?php echo base_url(); ?>assets/image/1_UREND_Home.png"/>
                        </div>
                        <div class="col-md-6">
                            <h4 class="">Urend App</h4>
                            <h1 class="no-margin"><?php echo $this->lang->line('DOWNLOAD_THE_APP');?></h1>
                            <div class="divider"></div>
                            <div class="row">
                                <div class="col-md-8 margin-top-50">
                                    <p>Join our community of car owners and car renters now and live the
                                        experience!
                                    </p>
                                </div>
                            </div>
                            <h4 class="margin-top-50"><?php echo $this->lang->line('FREE_DOWNLOAD');?></h4>
                            <div class="row margin-top-20 margin-bottom-20">
                                <div class="col-xs-5 col-md-4 ">
                                    <a href="#"><img src="<?php echo base_url(); ?>assets/image/AppleAppLogo.png"/></a>
                                </div>
                                <div class="col-xs-5 col-md-4">
                                    <a href="#"> <img src="<?php echo base_url(); ?>assets/image/GooglePlayLogo.png"/></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="clr"></div>
        <div class="listyourcar homesection">
            <div class="inner margin-top-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="margin-top-5"><?php echo $this->lang->line('LIST_YOUR_CAR');?></h4>
                            <h1 class="no-margin"><?php echo $this->lang->line('LET_YOUR_CAR_WORK_FOR_YOU');?></h1>
                            <div class="divider gradient_filter"></div>
                            <div class="col-md-4 no-padding margin-top-20">
                                <p>List your car today and start earning money! You can cover your car’s 
                                    yearly expenses after only 26* days of renting.  
                                    Your car is completely insured by our partner ALLIANZ, so no worries! 
                                    Let your car do the work for you!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="clr"></div>
        <div class="customertrips homesection margin-bottom-20">
            <div class="inner ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2><?php echo $this->lang->line('CUSTOMER_ROAD_TRIPS');?></h2>
                            <h4 class="margin-top-5">Lorem Ipsum is simply dummy text of</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="customerpanel">
                                <img class="playButton" src="<?php echo base_url(); ?>assets/image/playButton.png"/>
                                <img src="<?php echo base_url(); ?>assets/image/george.png"/>
                                <div class="info">
                                    <div class="title">George</div>
                                    <div>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                                        Aenean commodo ligula ege t dolor. Aenean mass
                                    </div>
                                </div>
                            </div>
                            <div class="customerpanel">
                                <img class="playButton" src="<?php echo base_url(); ?>assets/image/playButton.png"/>
                                <img src="<?php echo base_url(); ?>assets/image/zoe.png"/>
                                <div class="info">
                                    <div class="title">Zoe</div>
                                    <div>Lorem Ipsum is  simply du</div>
                                </div>
                            </div>
                            <div class="customerpanel">
                                <img class="playButton" src="<?php echo base_url(); ?>assets/image/playButton.png"/>
                                <img src="<?php echo base_url(); ?>assets/image/george.png"/>
                                <div class="info">
                                    <div class="title">Nick</div>
                                    <div>Lorem Ipsum is simply dummy t Ipsum is simply du
                                        Ipsum is simply du Ipsum is simply du
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="clr"></div>
        <div class="instagramsection homesection ">
            <div class="inner ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Instagram</h2>
                        </div>
                        <div class="col-md-6">
                            <h4 class="text-right">
                                <?php echo $this->lang->line('FOLLOW_US');?>
                                <a href="<?php echo get_web_meta_data('instagram_link'); ?>">https://www.instagram.com/urend_official/</a>
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        // Supply a user id and an access token
                        $userid = "3318616981";
                        $accessToken = "3318616981.1677ed0.715c978fec3e4ce1b6b188859e1452f1";

                        // Gets our data
                        function fetchData($url){
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_TIMEOUT, 20);
                            $result = curl_exec($ch);
                            curl_close($ch); 
                            return $result;
                        }

                        // Pulls and parses data.
                        $result = fetchData("https://api.instagram.com/v1/users/{$userid}/media/recent/?access_token={$accessToken}");
                        $result = json_decode($result);	
                        ?>
                        <?php foreach ($result->data as $post): ?>
                        <!-- Renders images. @Options (thumbnail,low_resoulution, high_resolution) -->

                            <div class="col-xs-4 col-md-2 margin-top-10">
                                <a class="group" rel="group1" href="<?= $post->images->standard_resolution->url ?>"><img src="<?= $post->images->thumbnail->url ?>" class="image-responsive"></a>
                            </div>

                        <?php endforeach ?>


                    </div>
                </div>
            </div>
        </div>

        <!--footer-->
		<?php $this->load->view('include/footer_block'); ?>
        <!--/footer-->


