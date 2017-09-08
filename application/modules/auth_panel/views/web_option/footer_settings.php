<section class="panel">
<header class="panel-heading">
<?php echo $this->session->flashdata('success'); ?>
     Footer Settings
</header>
        <div class="panel-body">
            <form role="form" action="" method="post" autocomplete="off">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input class="form-control" id="footer_address"  value="<?php echo get_web_meta_data ('footer_address');?>" placeholder="Enter address" name="footer_address" type="text">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input class="form-control" id="footer_phone"  value="<?php echo get_web_meta_data('footer_phone');?>" placeholder="Enter phone" name="footer_phone" type="text">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" id="footer_email"  value="<?php echo get_web_meta_data('footer_email');?>"   placeholder="Enter email" name="footer_email" type="email">
                </div>
                <div class="form-group">
                    <label for="facebook_link">Facebook Link</label>
                    <input class="form-control" id="facebook_link"  value="<?php echo get_web_meta_data('facebook_link');?>" placeholder="Enter facebook link" name="facebook_link" type="text">
                </div>
                <div class="form-group">
                    <label for="google_link">Google Link</label>
                    <input class="form-control" id="google_link"  value="<?php echo get_web_meta_data('google_link');?>" placeholder="Enter google link" name="google_link" type="text">
                </div>
                <div class="form-group">
                    <label for="twitter_link">Twitter Link</label>
                    <input class="form-control" id="twitter_link"  value="<?php echo get_web_meta_data('twitter_link');?>" placeholder="Enter twitter link" name="twitter_link" type="text">
                </div>
                <div class="form-group">
                    <label for="linkedin_link">Linkedin Link</label>
                    <input class="form-control" id="linkedin_link"  value="<?php echo get_web_meta_data('linkedin_link');?>" placeholder="Enter linkedin link" name="linkedin_link" type="text">
                </div>
                <div class="form-group">
                    <label for="youtube_link">Youtube Link</label>
                    <input class="form-control" id="youtube_link"  value="<?php echo get_web_meta_data('youtube_link');?>" placeholder="Enter youtube link" name="youtube_link" type="text">
                </div>
                <div class="form-group">
                    <label for="pinterset_link">Pinterset Link</label>
                    <input class="form-control" id="pinterset_link"  value="<?php echo get_web_meta_data('pinterset_link');?>" placeholder="Enter pinterset link" name="pinterset_link" type="text">
                </div>
                <div class="form-group">
                    <label for="instagram_link">Instagram Link</label>
                    <input class="form-control" id="instagram_link"  value="<?php echo get_web_meta_data('instagram_link');?>" placeholder="Enter instagram link" name="instagram_link" type="text">
                </div>
                <button type="submit" class="btn btn-info">Submit</button>
            </form>

        </div>
        </section>