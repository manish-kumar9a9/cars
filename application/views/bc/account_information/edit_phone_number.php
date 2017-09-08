<?php
$option = array(
    'is_json' => false,
    'url' => site_url() . '/service_fetch_user_primary_record',
    'data' => json_encode(array('user_id' => $this->session->userdata('userId')))
);

$result = get_data_with_curl($option);
$user_data = $result['Result'];
//pre($user_data);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>UREND</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/app.css">
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/animate.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/imageadd.css" />
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet"> 
        <link href="<?php echo base_url(); ?>assets/css/booking_style.css" rel="stylesheet">

        <style type="text/css">
            /* Custom container */

            .container-narrow {
                margin: 150px auto 50px auto;
                max-width: 728px;
            }
        </style>

        <style>
            .profile-setting-center{width: 50%;margin: auto;}
            .profile-setting-input{width:100%;height:45px;border:none;}
            tr.profile-setting-table{border:1px solid #000}
            .border-none{border:none}
            .edit-input{width: 100%;float:left; margin-bottom: 20px;}
            .edit-input-text{width: 100%;height: 41px;padding-left: 18px;margin-bottom: 20px;
                             -webkit-box-sizing: border-box;
                             -moz-box-sizing: border-box;
                             box-sizing: border-box;
            }
            .edit-input-countryCode{width: 10%;height: 41px;
                                    -webkit-box-sizing: border-box;
                                    -moz-box-sizing: border-box;
                                    box-sizing: border-box;
            }
            .edit-submit{width: 30%;background-color: #00968a;border:none;padding: 10px 5px;text-align: center;color: #fff;border-radius: 5px;float: left;margin: 5px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;}
            .cancel-submit{width: 30%;background-color: #171717;border:none;padding: 10px 5px;text-align: center;color: #fff;border-radius: 5px;float: left;margin: 5px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;}
            .border-bottom{border-bottom: 1px solid #ccc !important;}

            .profile-sub-heading{
                padding-bottom: 15px;
                border-bottom: 2px solid #333;
                margin-bottom: 5px;
            }

            .profile-sub-section{
                margin-bottom: 40px;
            }

            .edit-feild{
                width: 30%;
                float:left;
            }

            .edit-feild h4{

                margin-top: 5px;
                font-size: 18px;
            }

            .edit-form-feild{
                width: 70%;
                float: left;
            }

            .full-width-new{
                width: 100% ; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;padding-bottom: 10px;
            }
        </style>


        <?php $this->load->view('include/head_block'); ?>

        <!-- main section starts -->
        <div class="container">

            <div class="payment-section">
                <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 payment-heading">
                    <h2><?php echo $this->lang->line('PHONE_NUMBER');?></h2>
                    <p><?php echo $this->lang->line('PHONE_NUMBER_INFO');?></p>
                </div>



                <?php if ($this->input->get('edit') != 'send_otp') { ?>
                    <form method="post" name ="phone_information" action="<?php echo site_url('account_information/update_phone_no'); ?>">

                        <?php
                        // Get Flash data on view 
                        if ($this->session->flashdata('page_error') != "") {
                            echo '<div><span class="text-danger clr">' . $this->session->flashdata('page_error') . '</span> </div>';
                        }
                        ?>
                        <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
                            <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
                                <label class="payment-label"><?php echo $this->lang->line('COUNTRY_CODE');?></label>
                                <select class="form-select" name="country_code">
                                    <option value="+30">+30(Greece)</option>
                                    <option value="+91">+91(India)</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
                            <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
                                <label class="payment-label"><?php echo $this->lang->line('MOBILE_NO');?></label>
                                <input type="text" name="phone_no" class="payment-form-input">
                            </div>
                        </div>

                        <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
                            <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
                                <input type="submit" name="" class="theme-btn-basic ralewaymedium payment-button text-white margin-top-15 padding-10-0" value="<?php echo $this->lang->line('SEND_OTP');?>">
                            </div>

                            <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
                                <a href="<?php echo site_url('account_information/index'); ?>"><input type="button" name="" class="ralewaymedium payment-cancel margin-top-15 padding-10-0" value="<?php echo $this->lang->line('CANCEL');?>"></a>
                            </div>
                        </div>
                    </form>

                <?php } ?>

                <?php if ($this->input->get('edit') == 'send_otp') { ?>
                    <form method="post" action="<?php echo site_url('account_information/confirm_otp'); ?>">
                        <?php
                        // Get Flash data on view 
                        if ($this->session->flashdata('page_error') != "") {
                            echo '<div><span class="text-danger clr">' . $this->session->flashdata('page_error') . '</span> </div>';
                        }
                        ?>
                        <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
                            <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
                                <label class="payment-label"><?php echo $this->lang->line('COUNTRY_CODE');?></label>
                                <select class="form-select" id="country_code" name="country_code" >
                                    <option value="+30">+30(Greece)</option>
                                    <option value="+91">+91(India)</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
                            <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
                                <label class="payment-label"><?php echo $this->lang->line('MOBILE_NO');?></label>
                                <input type="text" name="phone_no" value="<?php echo $this->session->userdata('phone_no'); ?>" readonly='readonly' class="payment-form-input">
                            </div>
                        </div>

                        <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
                            <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12 margin-bottom-15">
                                <label class="payment-label"><?php echo $this->lang->line('VERIFICATION_CODE');?></label>
                                <input type="text" name="send_otp" class="payment-form-input">
                            </div>
                        </div>



                        <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
                            <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
                                <input type="submit" name="" class="theme-btn-basic ralewaymedium payment-button text-white margin-top-15 padding-10-0" value="<?php echo $this->lang->line('SAVE');?>">
                            </div>

                            <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
                                <a href="<?php echo site_url('account_information/index'); ?>"><input type="button" name="" class="ralewaymedium payment-cancel margin-top-15 padding-10-0" value="<?php echo $this->lang->line('CANCEL');?>"></a>
                            </div>
                        </div>
                    </form>
                <?php } ?>

            </div>
        </div>
        <!-- main section ends -->

        <!--footers-->
        <?php $this->load->view('include/footer_block'); ?>
        <!--/footer-->


        <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/popup.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/custem.js"></script>
        <script>
            jQuery('select[id=country_code]').val('<?php echo $this->session->userdata('country_code'); ?>');
        </script>
        <script>
            var op =
                    document.getElementById("country_code").getElementsByTagName("option");

            for (var i = 0; i < op.length; i++) {
                (op[i].value != '<?php echo $this->session->userdata('country_code'); ?>')
                        ? op[i].disabled = true
                        : op[i].disabled = false;
            }
        </script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
        <script>
            // Wait for the DOM to be ready
            $(function () {
                $("form[name='phone_information']").validate({
                    // Specify validation rules
                    rules: {
                        phone_no: {required: true, digits: true}
                    },
                    // Specify validation error messages
                    messages: {
                        phone_no: {required: "Please enter Phone no.", digits: "Please enter only digits."}
                    },
                    submitHandler: function (form) {
                        form.submit();
                    }
                });
            });
        </script>
    </body>
</html>
