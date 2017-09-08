
<a href="<?php echo AUTH_PANEL_URL . 'web_user/user_car_detail/' . $car_id; ?>"><button class="pull-right btn btn-info">Back</button></a>
<div class="panel-body">
    <form role="form" action="<?php echo site_url('auth_panel/web_user/car_market_value/'.$car_id);?>" method="post" autocomplete="off">
        <div class="form-group">
        <input type="hidden" name="id" value="<?php echo $car_id; ?>">
                    <label for="address">Market value</label>
                    <input class="form-control" id="market_value" placeholder="Enter market value" name="market_value" value="<?php echo $market_value; ?>" type="text">
                </div>
        <button type="submit" class="btn btn-info">Update</button>
    </form>

</div>

