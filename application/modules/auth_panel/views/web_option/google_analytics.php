<section class="panel">
<header class="panel-heading">
     Google Analytics
</header>
        <div class="panel-body">
            <form role="form" action="" method="post">
                <div class="form-group">
                    <label for="code">Code</label>
                    <textarea class="form-control" name="google_analytics_code" rows="5" id="comment"><?php echo get_web_meta_data('google_analytics_code');?></textarea>
                </div>
                <div class="form-group">
                    <label for="address">Active</label>
                    <input class="form-control" id="google_active1" value="1"  <?php if(get_web_meta_data('google_analytics_active')==1){ echo 'checked'; } ?> name="google_analytics_active" type="radio"/>
                    <span for="address">Yes</span>
                    <input class="form-control" id="google_active2" value="0" <?php if(get_web_meta_data('google_analytics_active')==0){ echo 'checked'; } ?> name="google_analytics_active" type="radio"/>
                    <span for="address">No</span>
                </div>
                <button type="submit" class="btn btn-info">Submit</button>
            </form>

        </div>
        </section>
