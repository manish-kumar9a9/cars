<!-- date picker css -->
<link rel="stylesheet" type="text/css" href="<?php echo AUTH_ASSETS;?>assets/bootstrap-datepicker/css/datepicker.css" />
<link rel="stylesheet" type="text/css" href="<?php echo AUTH_ASSETS;?>assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
<!-- end-->

<div class="panel-body">
    <form role="form" action="web_car_report_data" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Car Report</label>
            <select class="form-control m-bot15" name="user_report">
                    <option value="LISTED_CAR">Listed Car</option>
                    <option value="APPROVED_CAR">Approved Car</option>
                    <option value="PENDING_APPROVAL_CAR">Pending Approval Car</option>
                    <option value="UNLISTED/DELETED_CAR">Unlisted / Deleted Car</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Time Period</label>
            <select class="form-control m-bot15" name = "time_period"  id="time-period">
                    <option value="DAILY">Daily</option>
                    <option value="WEEKLY">Weekly</option>
                    <option value="MONTHLY">Monthly</option>
                    <option value="YEARLY">Yearly</option>
                    <option value="CUSTOM_DATE_RANGE">Custom date range</option>
            </select>
        </div>
        <div class="form-group custom_date_ranger">
            <label class="control-label">Select Date</label>
                <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                    <input class="form-control dpd1" name="from" id="pre_date"  type="text">
                    <span class="input-group-addon">To</span>
                    <input class="form-control dpd2" name="to" id= "post_date" type="text">
                </div>
                <span class="help-block">Select date range</span>
            </div>
        </div>
        <button type="submit" class="btn btn-info"  onclick="return date_match()">Csv Download</button>
    </form>

</div>
<?php
$auth_assets = AUTH_ASSETS;
$custum_js = <<<EOD
/* date range page plugins  */
<script type="text/javascript" src="{$auth_assets}assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="{$auth_assets}assets/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="{$auth_assets}js/advanced-form-components.js"></script>

  <script>
    $(document).ready(function(){
      $( "select[name=time_period]" ).change(function() {
        if($(this).val() == 'CUSTOM_DATE_RANGE'){
          $('.custom_date_ranger').show('slow');
        }else{
          $('.custom_date_ranger').hide('slow');
        }
      }).change();

    });
  </script>
  <script>
  function date_match() {
      if($( "#time-period option:selected" ).val() == "CUSTOM_DATE_RANGE"){
        var pre_date = $('#pre_date').val();
         var post_date  = $('#post_date').val();
         if(pre_date == ''){
           alert('Please enter the From date ! ');
           return false;
         }else if(post_date == ''){
           alert('Please enter the To date  ! ');
           return false;
         }
         if(pre_date > post_date){
           alert('Please check the date range ! ');
           return false;
         }else{
             return true;
         }
      }else{
        $('#pre_date').removeAttr('value');
        $('#pre_date').removeAttr('value');
        return true;
      }
  }
  </script>

EOD;

	echo modules::run('auth_panel/template/add_custum_js',$custum_js );
?>
