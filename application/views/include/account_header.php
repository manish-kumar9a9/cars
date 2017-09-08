<div id="account-header" class="header-banner gradient_filter">

    <div class="container">
        <?php
        $user_session = $this->session;

        $user_image = base_url() . "assets/image/Icon-user-1.png";
        if ($user_session->profileImage != "") {
            $user_image = base_url() . "profileImages/" . $this->session->userdata('profileImage');
        }
        ?>
        <div class="row">
            <div class="col-sm-10">
                <h3><?php echo $user_session->firstName.' '.$user_session->lastName; ?></h3>
                <span style="font-size: 13px;">
                    <?php genrate_star_html(4.5, "fa-fw fa-lg"); ?>
                    <?php echo round(4.5, 2); ?> (<?php echo '49 reviews' ?>)
                </span>

                <div class="col-md-12 no-padding profile">
                    <div style="margin-left:0">
                        <?php echo $this->lang->line('JOINED_IN'); ?> <?php echo date('M Y ', strtotime($user_session->createdAt)); ?></div>
                    <div class="">Cars(2)</div>
                    <div class="">Rentals(4)</div>
                    <div class="">Cars(2)</div>
                    <div class="">Rented(2)</div>
                    <div class="">Lives in Athens, Greece</div>
                </div>

            </div>
            <div class="col-sm-2 pull-right text-right no-padding">
                <img class="profile-pic" src="<?php echo $user_image; ?>" >
            </div>
        </div>
    </div>
</div>
