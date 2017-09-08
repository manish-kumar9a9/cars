<div class="review col-xs-12">
    <div class="col-xs-6 col-sm-7">
        <img class="col-xs-3 col-sm-4 profile-pic no-margin" src="<?php echo $review['givenby_user_image'] ?>" />
        <div class="col-xs-12 col-sm-7 margin-top-20">
            <span class="name"><?php echo $review['givenby_username'] ?></span><br/>
            <span class="date"><?php echo date('d/m/Y', strtotime($review['date'])); ?></span>
        </div>
    </div>
    <div class="col-xs-6 col-sm-5 text-right margin-top-20">
        <span style="font-size: 13px;"><?php genrate_star_html($review['rating'], "fa-fw fa-lg"); ?></span>
    </div>
    <div class="col-xs-12 margin-top-10">
        <p><?php echo $review['remarks'] ?></p>
    </div>
</div>