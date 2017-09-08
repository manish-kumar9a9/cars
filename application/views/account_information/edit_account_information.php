<?php
$this->load->view('header');
$this->load->view('include/account_header'); ?>


<?php
$option = array(
	'is_json' => false,
	'url' => site_url() . '/service_fetch_user_primary_record',
	'data' => json_encode(array('user_id' => $this->session->userdata('userId')))
);

$result = get_data_with_curl($option);
$user_data = $result['Result'];
//var_dump($user_data);
?>


<div id="account_wrapper">
    <div class="container">
        <div class="row margin-top-20">
            <div class="col-sm-3 col-md-3 margin-top-20">
                <ul class="nav nav-tabs nav-stacked">
                    <li><a href='<?php echo site_url('user/dashboard') ?>'>Dashboard</a></li>
                    <li><a href='<?php echo site_url('notification') ?>'>Notifications (2)</a></li>
                    <li><a href='#'>My Rentals (120)</a></li>
                    <li><a href='<?php echo site_url('request/received') ?>'>Rental Requests (4)</a></li>
                    <li><a href='<?php echo site_url('request/current_booking') ?>'>Bookings (1)</a></li>
                    <li><a href='<?php echo site_url('user/reviews') ?>'>Reviews (48)</a></li>
                    <li><a href='<?php echo site_url('user/user_profile/' . $this->session->userdata('userId')) ?>'><?php echo $this->lang->line('PROFILE');?></a></li>
                    <li class="active gradient_filter"><a href='<?php echo site_url('account_information/index') ?>'>Account Settings</a></li>
                    <li><a href='<?php echo base_url() ?>index.php/user/logout'>Logout</a></li>
                </ul>
            </div>
            <div class="col-sm-9 col-md-9">
                <?php
                // Get Flash data on view
                if ($this->session->flashdata('page_error') != "") {
                    echo '<div><span class="text-danger clr">' . $this->session->flashdata('page_error') . '</span> </div>';
                }
                ?>

                <div class="col-sm-5 no-padding">
                    <h3>Main Settings</h3>
                </div>

                <form id="accountForm">

                    <div class="clr margin-top"></div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div ><?php echo $this->lang->line('FIRST_NAME');?></div>
                        </div>
                        <div class="col-xs-8">
                            <input type="text" name="first_name" autofocus value="<?php echo $user_data['firstName']; ?>" class="form-control"/>
                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div ><?php echo $this->lang->line('LAST_NAME');?></div>
                        </div>
                        <div class="col-xs-8">
                            <input type="text" name="last_name" value="<?php echo $user_data['lastName']; ?>" class="form-control"/>
                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div ><?php echo $this->lang->line('PHONE');?></div>
                        </div>
                        <div class="col-xs-8">
                            <input type="text" name="phone" value="<?php echo $user_data['countryCode'] . ' ' . $user_data['mobile']; ?>" class="form-control"/>
                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div ><?php echo $this->lang->line('EMAIL');?></div>
                        </div>
                        <div class="col-xs-8">
                            <input type="text" name="email" value="<?php echo $user_data['email'] ?>" class="form-control"/>
                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div >Country of residence</div>
                        </div>
                        <div class="col-xs-8">
                            <input type="text" name="country" value="" class="form-control"/>
                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>

                    <div class="col-sm-3 no-padding">
                        <h3>Password</h3>
                    </div>
                    <div class="clr margin-top"></div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div ><?php echo $this->lang->line('PASSWORD');?></div>
                        </div>
                        <div class="col-xs-8">
                            <input type="password" name="password" value="<?php echo $user_data['password']; ?>" class="form-control"/>
                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>

                    <div class="col-sm-5 no-padding">
                        <h3><?php echo $this->lang->line('PAYMENT_SETTINGS');?></h3>
                    </div>
                    <div class="clr margin-top"></div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div ><?php echo $this->lang->line('PAYMENT_METHOD');?></div>
                        </div>
                        <div class="col-xs-8">

                            <select class="form-control" name="cardType">
                                <option value="">Select a type</option>
                                <option value="Ae">American Express</option>
                                <option value="Master">Master</option>
                                <option value="Visa">Visa</option>
                            </select>

                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div >Card Number</div>
                        </div>
                        <div class="col-xs-8">
                            <input type="text" name="card_number" value="" class="form-control"/>
                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div >Expiry</div>
                        </div>
                        <div class="col-xs-8">
                            <div class="col-xs-6">
                                <input type="text" class="form-control" placeholder="Month" data-stripe="exp-month" />
                            </div>
                            <div class="col-xs-6">
                                <input type="text" class="form-control" placeholder="Year" data-stripe="exp-year" />
                            </div>
                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div >CVV</div>
                        </div>
                        <div class="col-xs-8">
                            <input type="text" name="card_CVV" maxlength="4" value="" class="form-control"/>
                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>

                    <div class="col-sm-5 no-padding">
                        <h3><?php echo $this->lang->line('BANK_ACCOUNT');?></h3>
                    </div>
                    <div class="clr margin-top"></div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div >Bank Name</div>
                        </div>
                        <div class="col-xs-8">
                            <input type="text" name="bank_name" value="Eurobank" class="form-control"/>
                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div ><?php echo $this->lang->line('ACCOUNT_NAME');?></div>
                        </div>
                        <div class="col-xs-8">
                            <input type="text" name="bank_acnt_name" value="George A White" class="form-control"/>
                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div >BIC (Swift Code)</div>
                        </div>
                        <div class="col-xs-8">
                            <input type="text" name="bank_acnt_bic" value="ERBKGRAXXX" class="form-control"/>
                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div >IBAN</div>
                        </div>
                        <div class="col-xs-8">
                            <input type="text" name="bank_acnt_iban" value="NL91 PODA 0417 1643 00" class="form-control"/>
                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div >Address Line 1</div>
                        </div>
                        <div class="col-xs-8">
                            <input type="text" name="bank_acnt_address2" value="20 Amalias Avenue" class="form-control"/>
                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div >Address Line 2</div>
                        </div>
                        <div class="col-xs-8">
                            <input type="text" name="bank_acnt_address2" value="" class="form-control"/>
                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div >City</div>
                        </div>
                        <div class="col-xs-8">
                            <input type="text" name="bank_acnt_city" value="" class="form-control"/>
                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div >Region/State</div>
                        </div>
                        <div class="col-xs-8">
                            <input type="text" name="bank_acnt_region" value="" class="form-control"/>
                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div >Postcode/Zip</div>
                        </div>
                        <div class="col-xs-8">
                            <input type="text" name="bank_acnt_zip" value="" class="form-control"/>
                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div >Country</div>
                        </div>
                        <div class="col-xs-8">
                            <input type="text" name="bank_acnt_country" value="" class="form-control"/>
                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>


                    <div class="col-sm-7 no-padding">
                        <h3 class="col-xs-12 no-padding margin-top-40">
                            <?php echo $this->lang->line('DRIVING_LICENSE');?>
                            <span id="licence_edit" class="edit margin-top-10" style="font-size: initial">Edit</span>
                        </h3>
                    </div>

                    <div class="clr margin-top"></div>
                    <div class="col-sm-5 no-padding">
                        <h3>Vehicle preferences</h3>
                    </div>
                    <div class="clr margin-top"></div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div ><?php echo $this->lang->line('TRANSMISSION');?></div>
                        </div>
                        <div class="col-xs-8">
                            <select class="form-control" name="vehicle_trans">
                                <option value="automatic">Automatic</option>
                                <option value="manual">Manual</option>
                            </select>
                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div ><?php echo $this->lang->line('FUEL_TYPE');?></div>
                        </div>
                        <div class="col-xs-8">
                            <select class="form-control" name="vehicle_fuel">
                                <option value="any">Any</option>
                                <option value="petrol">Petrol</option>
                                <option value="diesel">Diesel</option>
                                <option value="hybrid">Hybrid</option>
                                <option value="electric">Electric</option>
                                <option value="gas">Gas</option>
                            </select>
                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>

                    <div class="col-sm-6 no-padding">
                        <h3><?php echo $this->lang->line('ACCOUNT_NOTIFICATIONS');?></h3>
                    </div>
                    <div class="clr margin-top"></div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div ><?php echo $this->lang->line('EMAIL_NOTIFICATION');?></div>
                        </div>
                        <div class="col-xs-8">
                            <select class="form-control" name="nots_email">
                                <option value="yes">YES</option>
                                <option value="no">NO</option>
                            </select>
                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>
                    <div class="col-xs-12 account_field">
                        <div class="col-xs-3">
                            <div ><?php echo $this->lang->line('MOBILE_NOTIFICATIONS');?></div>
                        </div>
                        <div class="col-xs-8">
                            <select class="form-control" name="nots_mobile">
                                <option value="yes">YES</option>
                                <option value="no">NO</option>
                            </select>
                        </div>
                        <div class="col-xs-1 edit">Edit</div>
                    </div>

                    <div class="clr"></div>
                    <div class="col-md-12">
                        <div class="row">
                            <input class="col-xs-12 col-sm-3 button margin-top-20 cancel" type='button' value="<?php echo $this->lang->line('CANCEL'); ?>"  style="margin-right: 10px">
                            <input class="col-xs-12 col-sm-3 button gradient_filter margin-top-20" type='submit' value="<?php echo $this->lang->line('SAVE'); ?>">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade"  id="licence_modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">

                <a data-dismiss="modal" href="javascript:void(0)" class="pull-right login-close">x</a>
                <div class="row">
                    <div class="col-md-12 center">
                        <h3>Driving Licence Verification</h3>
                        To approve you for rentals, we need details from your driving licence. <br/>
                        Your details are encrypted and are not visible to other users. <a href="#">Learn more</a>
                    </div>

                    <form id="licence_form" class="col-md-12 margin-top-20">
                        <div class="col-md-6 no-padding">
                            <div class="form-group">
                                <label for="licence_country">
                                    Country of Issue
                                </label>
                                <input type="text" name="licence_country" value="United Kingdom" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="licence_number">
                                    Driving Licence Number
                                </label>
                                <input type="text" name="licence_number" value="MAX33425331513513" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="licence_number">
                                    Driving Licence Type
                                </label>
                                <select class="form-control" name="licence_type">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="licence_number">
                                    <?php echo $this->lang->line('FIRST_ISSUE_DATE');?>
                                </label>
                                <input type="text" name="licence_date" value="" placeholder="YYYY/MM/DD" class="form-control"/>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Upload a photo of your driving licence</label>
                            <label class="btn btn-default btn-file text-right" style="background: none; border: 0;">
                                <input id="imgInplicence1" type="file" >
                                <img id="img-upload-placeholder" src="<?php echo base_url(); ?>assets/image/photoUploadFront.png"/>
                                <img id="img-upload" style="display: none;height: 170px;width: 280px;"/>
                            </label>
                            <label class="btn btn-default btn-file text-right" style="background: none; border: 0;">
                                <input id="imgInplicence2" type="file" >
                                <img id="img-upload-placeholder" src="<?php echo base_url(); ?>assets/image/photoUploadBack.png"/>
                                <img id="img-upload" style="display: none;height: 170px;width: 280px;"/>
                            </label>
                        </div>

                        <div class="clr"></div>
                        <div class="col-md-12 center">
                            <div class="row">
                                <button class="col-xs-12 col-sm-12 button gradient_filter margin-top-20"><?php echo $this->lang->line('submit'); ?></button>
                            </div>
                        </div>
                        <div class="clr"></div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('#licence_form').formValidation({
            framework: 'bootstrap',
            err: {
                container: 'popover'
            },
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                licence_date: {
                    validators: {
                        date: {
                            format: 'YYYY/MM/DD',
                            message: 'The value is not a valid date'
                        },
                        notEmpty: {
                            message: 'The field is required'
                        }
                    }
                }
            }
        });

        $('#accountForm').formValidation({
            framework: 'bootstrap',
            err: {
                container: 'popover'
            },
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                first_name: {
                    validators: {
                        notEmpty: {
                            message: 'The first name is required'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'The first name must be more than 6 and less than 30 characters long'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_]+$/,
                            message: 'The first name can only consist of alphabetical, number and underscore'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required'
                        }
                    }
                },
                cardType: {
                    validators: {
                        notEmpty: {
                            message: 'The type is required'
                        }
                    }
                },
                card_number: {
                    validators: {
                        notEmpty: {
                            message: 'The credit card number is required'
                        },
                        creditCard: {
                            message: 'The credit card number is not valid'
                        }
                    }
                },
                card_CVV: {
                    validators: {
                        notEmpty: {
                            message: 'The cvv is required'
                        },
                        cvv: {
                            creditCardField: 'card_number',
                            message: 'The CVV number is not valid'
                        }
                    }
                },
                expMonth: {
                    selector: '[data-stripe="exp-month"]',
                    row: '.col-xs-3',
                    validators: {
                        notEmpty: {
                            message: 'The expiration month is required'
                        },
                        digits: {
                            message: 'The expiration month can contain digits only'
                        },
                        callback: {
                            message: 'Expired',
                            callback: function(value, validator) {
                                value = parseInt(value, 10);
                                var year         = validator.getFieldElements('expYear').val(),
                                    currentMonth = new Date().getMonth() + 1,
                                    currentYear  = new Date().getFullYear();
                                if (value < 0 || value > 12) {
                                    return false;
                                }
                                if (year == '') {
                                    return true;
                                }
                                year = parseInt(year, 10);
                                if (year > currentYear || (year == currentYear && value >= currentMonth)) {
                                    validator.updateStatus('expYear', 'VALID');
                                    return true;
                                } else {
                                    return false;
                                }
                            }
                        }
                    }
                },
                expYear: {
                    selector: '[data-stripe="exp-year"]',
                    row: '.col-xs-3',
                    validators: {
                        notEmpty: {
                            message: 'The expiration year is required'
                        },
                        digits: {
                            message: 'The expiration year can contain digits only'
                        },
                        callback: {
                            message: 'Expired',
                            callback: function(value, validator) {
                                value = parseInt(value, 10);
                                var month        = validator.getFieldElements('expMonth').val(),
                                    currentMonth = new Date().getMonth() + 1,
                                    currentYear  = new Date().getFullYear();
                                if (value < currentYear || value > currentYear + 100) {
                                    return false;
                                }
                                if (month == '') {
                                    return false;
                                }
                                month = parseInt(month, 10);
                                if (value > currentYear || (value == currentYear && month >= currentMonth)) {
                                    validator.updateStatus('expMonth', 'VALID');
                                    return true;
                                } else {
                                    return false;
                                }
                            }
                        }
                    }
                },
                bank_acnt_bic: {
                    validators: {
                        bic: {
                            message: 'The value is not valid BIC'
                        },
                        notEmpty: {
                            message: 'The bic number is required'
                        }
                    }
                },
                bank_acnt_iban: {
                    validators: {
                        iban: {
                            message: 'The value is not valid IBAN'
                        },
                        notEmpty: {
                            message: 'The iban number is required'
                        }
                    }
                }
            }
        });
    });
</script>

<!--footers-->
<?php $this->load->view('include/footer_block'); ?>
<!--/footer-->