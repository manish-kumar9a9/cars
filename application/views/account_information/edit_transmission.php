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
                width: 100% ;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                padding-bottom: 10px;
            }
        </style>

        <?php $this->load->view('include/head_block'); ?>

        <!-- main section starts -->
        <div class="container">
            <div class="payment-section">
                <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 payment-heading">
                    <h2><?php echo $this->lang->line('TRANSMISSION');?></h2>
                    <p><?php echo $this->lang->line('TRANSMISSION_INFO');?></p>
                </div>
                <form method="post" id="transmission" action="<?php echo site_url('account_information/update_transmission'); ?>">

                    <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 payment-form">
                        <p><?php echo $this->lang->line('TRANSMISSION_INFO_TEXT');?></p>
                    </div>
                    <?php
                    // Get Flash data on view 
                    if ($this->session->flashdata('page_error') != "") {
                        echo '<div><span class="text-danger clr">' . $this->session->flashdata('page_error') . '</span> </div>';
                    }
                    ?>
                    <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
                        <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 margin-bottom-15">
                            <input type="radio" name="transmission" value="1" <?php if($state == "1") {
                                        echo "checked";
                                    }
                                    ?>> <?php echo $this->lang->line('MANUAL_TRANSMISSION');?>
                        </div>
                    </div>

                    <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
                        <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 margin-bottom-15">
                            <input  type="radio" name="transmission" value="2" <?php if($state == "2") {
                                        echo "checked";
                                    }
                                    ?>> <?php echo $this->lang->line('AUTOMATIC_TRANSMISSION');?>
                        </div>
                    </div>

                    <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
                        <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 margin-bottom-15">
                            <input type="radio" name="transmission" value="3" <?php if($state == "3") {
                                        echo "checked";
                                    }
                                    ?>> <?php echo $this->lang->line('SEMI_AUTOMATIC_TRANSMISSION');?>
                        </div>
                    </div>





                    <div class="col-new-lg-12 col-new-md-12 col-new-sm-12 col-new-xs-12 no-padding">
                        <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
                            <input type="submit" name="" class="theme-btn-basic ralewaymedium payment-button text-white margin-top-15 padding-10-0" value="<?php echo $this->lang->line('UPDATE_TRANSMISSION');?>">
                        </div>

                        <div class="col-new-lg-6 col-new-md-6 col-new-sm-12 col-new-xs-12">
                            <a href="<?php echo site_url('account_information/index'); ?>"><input type="button" name="" class="ralewaymedium payment-cancel margin-top-15 padding-10-0" value="<?php echo $this->lang->line('CANCEL');?>"></a>
                        </div>
                    </div>
                </form>

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
    </body>
</html>
