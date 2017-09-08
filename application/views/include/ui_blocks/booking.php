<div class="booking col-xs-12 no-padding open">
    <a href="<?php echo site_url('booking_auth/booking/'.$r_data['id']);?>">
        <div class="col-xs-3 booking-img no-padding">
            <img src="<?php echo $r_data['car_details']['car_images'][0]['CarImage_path']; ?>">
        </div>
        <div class="col-xs-9 booking-data no-padding">
            <div class="col-xs-12 details">
                <div class="col-xs-7 col-md-9 no-padding">
                    <h4><?php echo $r_data['car_details']['get_make_name']." ".$r_data['car_details']['get_model_name'] ?></h4>
                    <div class="col-md-12 no-padding subtitle">
                        3000cc, 2 Doors, Petrol
                    </div>
                </div>
                <div class="col-xs-5 col-md-3 text-right">
                    <div class="row">
                        <div class="col-xs-9 no-padding">
                            <span class="subtitle" style="display: block; ">Rented from </span>
                            <span style="color: #006be8"><?php echo $r_data['car_renter_data']['firstName']." ".$r_data['car_renter_data']['lastName'] ?></span>
                        </div>
                        <img class="profile-pic" src="<?php echo $r_data['car_renter_data']['user_image'];?>">
                    </div>
                </div>
            </div>
            <div class="col-xs-12 center margin-top-10 report">
                <div class="row">
                    <div class="col-xs-2 col-sm-3 no-padding">
                        <div class="subtitle">Start</div>
                        <div>20/05/17 (09:00)</div>
                    </div>
                    <div class="col-xs-2 col-sm-3 no-padding">
                        <div class="subtitle">End</div>
                        <div>25/05/17 (09:00)</div>
                    </div>
                    <div class="col-xs-2 no-padding">
                        <div class="subtitle">Period</div>
                        <div>5 days</div>
                    </div>
                    <div class="col-xs-2 col-sm-1 no-padding">
                        <div class="subtitle">Earned</div>
                        <div>&euro; 2,320</div>
                    </div>
                    <div class="col-xs-4 col-sm-3 no-padding">
                        <div class="subtitle">Review</div>
                        <div>
                            <span style="font-size: 11px;">
                                <?php genrate_star_html($r_data['car_renter_data']['user_rating'], "fa-fw fa-lg"); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="clr"></div>