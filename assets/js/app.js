
var init_car_search = false;

function main () {

    /*
    $customerCarousel = $("#customerCarousel");
    $customerCarousel.swiperight(function() {
        $(this).carousel('prev');
    });
    $customerCarousel.swipeleft(function() {
        $(this).carousel('next');
    });*/

    if(init_car_search) {
        $.when(get_car_model()).done(function () {
            $("select[name=model]").val("");
        });
    }

    $('#demo1').skdslider({'delay': 7000, 'animationSpeed': 800, 'showNextPrev': true, 'showPlayButton': true, 'autoSlide': true, 'animationType': 'sliding'});
    $('#responsive').change(function () {
        $('#responsive_wrapper').width(jQuery(this).val());
    });

    $(".calender-next").click(function () {
        last_active = $(this).data('nav-active');
        if (last_active != 5) {
            $('.calender-element').hide();
            $('.calender_element' + last_active).show();
            $('.calender_element' + (last_active + 1)).show('slow');

            $(this).data('nav-active', (last_active + 1));
            $('.calender-prevs').data('nav-active', (last_active));
        }
    });

    $(".calender-prevs").click(function () {
        last_active = $(this).data('nav-active');
        if (last_active != 1) {

            $('.calender-element').hide();
            $('.calender_element' + last_active).show();
            $('.calender_element' + (last_active - 1)).show('slow');

            $('.calender-next').data('nav-active', (last_active));
            $(this).data('nav-active', (last_active - 1));
        }
    });

    $("#filter-bookings div").click(function () {
        var className = $(this).attr('class');
        if(className == 'pull-right') return;

        $("#filter-bookings div").removeClass('active');
        $(this).addClass('active');
        if(className == 'all'){
            $('.booking').show(); return;
        }
        $('.booking').hide();
        $('.'+className).show();
    });

    $("#filter-requests div").click(function () {
        var className = $(this).attr('class');
        if(className == 'pull-right') return;

        $("#filter-requests div").removeClass('active');
        $(this).addClass('active');
        if(className == 'all'){
            $('.booking').show(); return;
        }
        $('.booking').hide();
        $('.'+className).show();
    });

    $("#filter-notifications div").click(function () {
        var className = $(this).attr('class');
        if(className == 'pull-right') return;

        $("#filter-notifications div").removeClass('active');
        $(this).addClass('active');
        if(className == 'all'){
            $('.notification').show(); return;
        }
        $('.notification').hide();
        $('.'+className).show();
    });

    $("#filter-reviews div").click(function () {
        var className = $(this).attr('class');
        if(className == 'pull-right') return;

        $("#filter-reviews div").removeClass('active');
        $(this).addClass('active');
        if(className == 'all'){
            $('.review').show(); return;
        }
        $('.review').hide();
        $('.'+className).show();
    });

    $('.account_field .edit').click(function(){
        $(this).parent().find('input').focus();
    });

    $('#licence_edit').click(function(){
        $('#licence_modal').modal();
    });

    $(document).on('change', '.btn.btn-file :file', function() {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
    });
    $('.btn.btn-file :file').on('fileselect', function(event, label) {
        var input = $(this).parents('.input-group').find(':text'),
            log = label;
        if( input.length )
            input.val(log);
        else
            if( log ) console.log(log);
    });
    function readURL(input, parent) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(parent).find("#img-upload").show();
                $(parent).find('#img-upload').attr('src', e.target.result);
                $(parent).find('#img-upload-placeholder').hide();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#edit_profile').on('click', function(){
        $(this).hide();
        $('#txtabout').removeClass('col-xs-12').addClass('col-xs-8');
        $('#upload_profile .btn-file').show();
    });
    $('#img-upload').on('click', function () {
        $(this).hide();
        $('#img-upload-placeholder').show();
    });
    $("#imgInp, #imgInplicence1, #imgInplicence2").change(function(){
        readURL(this, $(this).parent());
    });


    $(function () {

        $('input[name="dob"]').daterangepicker({
            parentEl: "#dob_holder",
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'DD/MM/YYYY'
            },
        });

        $('.timepicker').datetimepicker({
            format: 'LT',
            stepping : 5
        });
        $('.datepicker').datepicker({
            dateFormat: 'D d/m',
            minDate: new Date(),
            numberOfMonths: 2
        });
        $('.datepickerinsurance').datepicker({
            dateFormat: 'yy-mm-dd',
            numberOfMonths: 2
        });

        var $date_picker_start = $("#date_picker_start");
        if($date_picker_start.length) {
            var $date_picker_end = $("#date_picker_end");
            $date_picker_start.datepicker(
                'option', 'onSelect', function (dateText, inst) {
                    $(this).datepicker("option", "dateFormat", "yy-mm-dd");
                    var limitDay = $date_picker_start.datepicker('getDate', '+1d');
                    limitDay.setDate(limitDay.getDate() + 2);
                    $date_picker_end.datepicker("setDate", limitDay);
                    $date_picker_end.datepicker("option", "minDate", limitDay);
                    $(this).datepicker("option", "dateFormat", "D d/m");
                });
            $date_picker_start.datepicker("setDate", new Date());
            $date_picker_end.datepicker("option", "dateFormat", "yy-mm-dd");
            var limitDay = $date_picker_start.datepicker('getDate', '+1d');
            limitDay.setDate(limitDay.getDate() + 2);
            $date_picker_end.datepicker("setDate", limitDay);
            $date_picker_end.datepicker("option", "dateFormat", "D d/m");
        }
    });


    $("#autocomplete").keyup(function () {
        str = $.trim($("#autocomplete").val());
        if (str == "") {
            $('#lon_string').val('');
            $('#lat_string').val('');
        }
    });
    var preUrl = document.referrer;
    var res = preUrl.split('?');
    var currentUrl = location.href.split('?') [0];
    if (navigator.geolocation && res[0] != currentUrl) {
        navigator.geolocation.getCurrentPosition(function (position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });

                $.ajax({
                    url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + geolocation['lat'] + ',' + geolocation['lng'] + '&key='+GOOGLE_MAP_API_KEY,
                    success: function (data) {
                        $('#autocomplete').val(data.results[0].formatted_address);
                        $('#lon_string').val(geolocation['lat']);
                        $('#lat_string').val(geolocation['lng']);
                        $('#filter_form_element').submit();
                    }
                });
                autocomplete.setBounds(circle.getBounds());
            }
        );
    }

    function lang_changer(val) {
        var cname = "lang";
        var cvalue = val;
        var exdays = 30;
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        window.location.reload();
    }

    $('#urend_forgot').click(function () {
        $('#login-form').attr('style', "display:none");
        $('#signup-form').attr('style', "display:none");
        $('#forgot-pswd').attr('style', "display:block");
    });

    $("#user_login_form").submit(function (e) {
        if ($("#user_login_form").hasClass('element_clear')) {

        } else {
            e.preventDefault();
        }

        $(".border-danger").removeClass("border-danger");

        if ($('#user_email').val() == "") {
            $('#user_email').focus().addClass("border-danger");
            return false;
        }

        if ($('#user_password').val() == "") {
            $('#user_password').focus().addClass("border-danger");
            return false;
        }


        jQuery.ajax({
            url: base_url + 'index.php/user/login_receiver',
            method: 'POST',
            dataType: 'json',
            data: {
                email: jQuery("#user_email").val(),
                password: jQuery("#user_password").val(),
                action: 'normal_login'
            },
            success: function (data) {

                if (data.isSuccess) {
                    $("#user_login_form").addClass('element_clear');
                    $('#user_login_form').unbind().submit();
                } else {

                    $("#user_login_form").removeClass('element_clear');
                    jQuery("#login_msg").show().html("<div class='error-alert '>" + data.message + "</div>");
                    if (data.message == "Account is not verified.") {
                        login_account_verification(data.Result.email);
                    }
                }
            }
        });

    });

    $("#user_sign_form").submit(function (e) {
        $(".border-danger").removeClass("border-danger");

        if ($('#signup_firstName').val() == "") {
            $('#signup_firstName').focus().addClass("border-danger");
            return false;
        }
        if ($('#signup_lastName').val() == "") {
            $('#signup_lastName').focus().addClass("border-danger");
            return false;
        }

        if ($('#signup_mobile').val() == "") {
            $('#signup_mobile').focus().addClass("border-danger");
            return false;
        }

        if ($('#date_timepicker_dob').val() == "") {
            $('#date_timepicker_dob').focus().addClass("border-danger");
            return false;
        }

        if ($('#signup_email').val() == "") {
            $('#signup_email').focus().addClass("border-danger");
            return false;
        }

        if ($('#signup_password').val() == "" && jQuery("#signup_social_type").val() == "") {
            $('#signup_password').focus().addClass("border-danger");
            return false;
        }

        e.preventDefault();
        terms_condition = "";
        if ($('#terms_condition').is(":checked")) {
            terms_condition = "set";
        }

        jQuery.ajax({
            url: base_url + 'index.php/user/signup_receiver',
            method: 'POST',
            dataType: 'json',
            data: {
                firstName: jQuery("#signup_firstName").val(),
                lastName: jQuery("#signup_lastName").val(),
                email: jQuery("#signup_email").val(),
                mobile: jQuery("#signup_mobile").val(),
                password: jQuery("#signup_password").val(),
                fbId: jQuery("#signup_social_fbid").val(),
                gId: jQuery("#signup_social_gid").val(),
                loginType: jQuery("#signup_social_type").val(),
                /* countryCode: jQuery("#signup_countryCode").val(),*/
                countryCode: $('#element_phone_number a span').html(),
                profileImage: $('#signup_social_image').val(),
                dob: $('#date_timepicker_dob').val(),
                terms_condition: terms_condition
            },
            success: function (data) {

                if (data.isSuccess) {
                    $('#signup-form').attr('style', "display:none");
                    $('#mobile-verify').attr('style', "display:block");
                    $('#verify-email').val(data.Result.email);
                    $('#signup-form input').val('');
                }
                jQuery("#signup_msg").show().html("<div class='error-alert '>" + data.message + "</div>");

            }
        });
    });


    jQuery("#fgt-pswd").click(function (key) {
        jQuery.ajax({
            url: base_url + 'index.php/user/forgot_password',
            method: 'POST',
            dataType: 'json',
            data:
            {
                email: jQuery("#fgt-email").val(),
            },
            success: function (data) {

                if (data.isSuccess) {
                    jQuery("#forget_msg").show('slow').html("<div class='success-alert'>" + data.message + "</div>");
                } else {
                    jQuery("#forget_msg").show('slow').html("<div class='error-alert'>" + data.message + "</div>");
                }
                jQuery("#fgt-email").val('');

            }
        });
    });

    jQuery("#mob-verify-continue").click(function (key) {

        jQuery.ajax({
            url: base_url + 'index.php/user/verify_otp',
            method: 'POST',
            dataType: 'json',
            data:
            {
                email: jQuery("#verify-email").val(),
                otp: jQuery("#verify-mob").val(),
            },
            success: function (data) {

                if (data.isSuccess) {
                    jQuery("#verify-mob").removeClass("border-danger");
                    //$('#login-form').attr('style',"display:block");
                    $('#signup-form').attr('style', "display:none");
                    $('#verify_login_link').attr('style', "display:block");
                    jQuery("#verify-mob").val('');
                    jQuery("#verify_mobile_msg").css('color', 'green');
                    jQuery("#verify_mobile_msg").show().html("<div class='success-alert'>Phone verified successfully .</div>");
                    window.location.href = encodeURI(data.message);
                } else {
                    jQuery("#verify-mob").focus().addClass("border-danger");
                    jQuery("#verify_mobile_msg").show().html("<div class='error-alert'>" + data.message + "</div>");
                }
            }
        });
    });

    jQuery("#mob-verify-resend").click(function (key) {
        jQuery.ajax({
            url: base_url + 'index.php/user/resend_otp',
            method: 'POST',
            dataType: 'json',
            data:
            {
                email: jQuery("#verify-email").val(),
            },
            success: function (data) {

                if (data.isSuccess) {
                    $('#signup-form').attr('style', "display:none");
                    jQuery("#verify_mobile_msg").show().text("<div class='success-alert'>" + data.message + "</div>");
                } else {
                    jQuery("#verify_mobile_msg").show().text(data.message);

                }

            }
        });
    });

    function login_account_verification(email) {
        $('#login-form').attr('style', "display:none");
        jQuery.ajax({
            url: base_url + 'index.php/user/resend_otp',
            method: 'POST',
            dataType: 'json',
            data:
            {
                email: email,
            },
            success: function (data) {

                if (data.isSuccess) {
                    $('#verify-email').val(email);
                    $('#mobile-verify').attr('style', "display:block");
                }
                jQuery("#verify_mobile_msg").show().text(data.message);

            }
        });
    }

    $('.triggerMobileMenu').click( function () {
        $('.mobilemenu').animate({left: '0px'}, 500);

        });
    $('.icon-close').click( function () {
        $('.mobilemenu').animate({left: '-90%'}, 700);
        });


    $('.simleneasytouse .button').click(function(){

        $('.simleneasytouse .owner_data, .simleneasytouse .renter_data').hide();
        var obj = $(this).attr('id');
        $('.'+obj +'_data').show();

        $('.simleneasytouse .button').removeClass('white').removeClass('gradient_filter');
        $('#'+obj).addClass('gradient_filter');
        if(obj == 'renter') {
            $('#owner').addClass('white');
        } else if(obj == 'owner') {
            $('#renter').addClass('white');
        }
    });



    $('.dropdown-menu li').on('click', function(e) {
        e.preventDefault();
        var parentwrapper = $(this).parent().parent();
        parentwrapper.find('button span:first-child').text($(this).text());
        parentwrapper.find('.btn-select-input').val($(this).attr('data-id'));
    });

    $('#filterswitch').click(function(){
        $('#filters').slideToggle( "fast", function() {});
    });
    $('#dropdownsortcars li').on('click', function(){
        //$(this).parent().parent().find('.selectedsort').text($(this).text());
        var filterValue = $(this).text().toLowerCase();
        $carcontainer.isotope({ sortBy: filterValue });
    });
    var filters = {};
    $('#filters .clear-all').click(function(){
        filters = {};
        console.log(filters);
        $('.dropdownsfiltercars').each(function(){
            $(this).parent().parent().find('.selectedfilter').text($(this).find('.carpanel').text());
        });
        $('.filter-car-cats>div').removeClass('active');
        $carcontainer.isotope();
    });
    $('.filter-car-cats>div, .dropdownsfiltercars li').click( function () {

        var id = $(this).parent().attr('id');
        var className = $(this).attr('class');
        $('.filter-car-cats>div').removeClass('active');
        if ($(this).parent().attr('class') == 'filter-car-cats pull-right')
            $(this).addClass('active');
        //else
          //  $(this).parent().parent().find('.selectedfilter').text($(this).text());

        className = className.split(' ');
        //if(className.length > 1)
            className = className[0];

        if(id == 'dropdownsfiltercarmake'){
            get_car_model(className);
        }

        className = filterFns[ className ] || className;
        if(typeof className !== 'function')
            className = '.'+className;

        filters[ $(this).parent().attr('id') ] = className;
        $carcontainer.isotope();
    });
    var numberPattern = /\d+/g;
    function isNumeric(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }


    //initialize isotope
    // filter functions
    var filterFns = {
        'bmw': function( r, itemElem) {
            var name = itemElem.querySelector('.title').textContent;
            return name.match( /bmw/gi );
        },
        'vw': function( r, itemElem) {
            var name = itemElem.querySelector('.title').textContent;
            return name.match( /vw/gi );
        },
        'mercedes': function( r, itemElem) {
            var name = itemElem.querySelector('.title').textContent;
            return name.match( /mercedes/gi );
        },
        'porsche': function( r, itemElem) {
            var name = itemElem.querySelector('.title').textContent;
            return name.match( /porsche/gi );
        },
        'petrol': function( r, itemElem) {
            var name = itemElem.querySelector('.info').textContent;
            return name.match( /petrol/gi );
        },
        'gas': function( r, itemElem) {
            var name = itemElem.querySelector('.info').textContent;
            return name.match( /gas/gi );
        },
        'hybrid': function( r, itemElem) {
            var name = itemElem.querySelector('.info').textContent;
            return name.match( /hybrid/gi );
        },
        'diesel': function( r, itemElem) {
            var name = itemElem.querySelector('.info').textContent;
            return name.match( /diesel/gi );
        },
        'electric': function( r, itemElem) {
            var name = itemElem.querySelector('.info').textContent;
            return name.match( /electric/gi );
        },
        '50': function() {
            var number = $(this).find('.price').text();
            number = number.match(numberPattern);
            return number <= 50;
        },
        '100': function() {
            var number = $(this).find('.price').text();
            number = number.match(numberPattern);
            return number <= 100;
        },
        '150': function() {
            var number = $(this).find('.price').text();
            number = number.match(numberPattern);
            return number <= 150;
        },
        '200': function() {
            var number = $(this).find('.price').text();
            number = number.match(numberPattern);
            return number <= 200;
        },
        '300': function() {
            var number = $(this).find('.price').text();
            number = number.match(numberPattern);
            return number <= 300;
        },
    };
    var $carcontainer = $('.carholder').isotope({
        itemSelector: '.carpanel',
        getSortData: {
            price: '.price',
            make: '.title'
        },
        filter: function() {

            var isMatched = true;
            var $this = $(this);

            for ( var prop in filters ) {
                var filter = filters[ prop ];
                filter = filterFns[ filter ] || filter;
                if ( filter )
                    isMatched = isMatched && $(this).is( filter );
                if ( !isMatched )
                    break;
            }
            return isMatched;
        }
    });


};
$(document).ready(main);


function search_records() {

    if (validate_date() == false) {
        $('#filter_form_element').submit();
    } else {
        $('#page_pop_error_element').modal();
    }
}

function validate_date() {

    //TODO achronak have to talk about date range validate
    return false;

    var from_date = $('#date_timepicker_start').val();
    dateTimeParts = from_date.split(' '),
        timeParts = dateTimeParts[1].split(':'),
        dateParts = dateTimeParts[0].split('-'),
        date;
    from_date = new Date(dateParts[0], parseInt(dateParts[1], 10) - 1, dateParts[2], timeParts[0], timeParts[1]);

    var to_date = $('#date_timepicker_end').val();
    dateTimeParts = to_date.split(' '),
        timeParts = dateTimeParts[1].split(':'),
        dateParts = dateTimeParts[0].split('-'),
        date;
    to_date = new Date(dateParts[0], parseInt(dateParts[1], 10) - 1, dateParts[2], timeParts[0], timeParts[1]);

    from_date = Number(from_date);
    to_date = Number(to_date);
    diff = to_date - from_date;
    diff = diff / (1000 * 60 * 60);
    minimum_hours =  4 ;

    from_date = $('#date_timepicker_start').val();
    dateTimeParts = from_date.split(' '),
        timeParts = dateTimeParts[1].split(':'),
        dateParts = dateTimeParts[0].split('-'),
        date;
    var date = new Date(dateParts[0], parseInt(dateParts[1], 10) - 1, dateParts[2], timeParts[0], timeParts[1]);
    var current_date = new Date();
    console.log(date);
    var increment_date_time = new Date();
    increment_date_time.setHours(current_date.getHours() + 2);
    increment_date_time.setMinutes(current_date.getMinutes() + 30);
    increment_date_time.setSeconds(00);
    increment_date_time.setMilliseconds(000);
    /* time after 2:30 lator*/
    if (increment_date_time.getMinutes() > 0 && increment_date_time.getMinutes() <= 29) {
        increment_date_time.setMinutes(increment_date_time.getMinutes() + (30 - increment_date_time.getMinutes()));
    } else if (increment_date_time.getMinutes() >= 31 && increment_date_time.getMinutes() <= 59) {
        increment_date_time.setMinutes(increment_date_time.getMinutes() + (60 - increment_date_time.getMinutes()));
    }
    console.log(Number(date));
    console.log(Number(increment_date_time));

    if (new Date(date) < new Date(increment_date_time)) {
        var text = CAR_REQUEST_NOT_ACCEPTABLE_BEFORE + increment_date_time;
        document.getElementById("page_pop_error_element-message").innerHTML = text;
    } else if(diff < minimum_hours ){

        var text = CAR_REQUEST_MINIMUM_HOURS;
        document.getElementById("page_pop_error_element-message").innerHTML = text;
    }else
        return false;

}


var placeSearch, autocomplete;
var componentForm = {
    /*locality: 'long_name',
     country: 'long_name'*/
};


/* When the user clicks on the button,
 toggle between hiding and showing the dropdown content */
function toggleDropDown(toggleClass) {

    $elem = $('#'+toggleClass);
    var state = $elem.is(":visible");
    $('.dropdown-content').hide();
    if(state)
        $elem.hide();
    else
        $elem.show();

}

$('#signup_mobile').keyup(function () {
    this.value = this.value.replace(/[^0-9\.]/g, '');
});

$('.login-popup').click(function() {
    $('#login-form').attr('style',"display:block");
    $('#signup-form').attr('style',"display:none");
    $('#user_email').val('');
    $('#user_password').val('');
    $('#login_msg').html('');
});
$('.login-close').click(function() {
    $('#login-form').attr('style',"display:none");
    $('#user_email').val('');
    $('#user_password').val('');
    $('#login_msg').html('');
});
$('.login-overlay').click(function() {
    $('#login-form').attr('style',"display:none");
});

$('.signup-popup').click(function() {
    $('#signup-form').attr('style',"display:block");
    $('#login-form').attr('style',"display:none");
    $('#signup_email').val('');
    $('#signup_password').val('');
    $('#signup_firstName').val('');
    $('#signup_lastName').val('');
    $('#signup_mobile').val('');
    $('#signup_msg').html('');

});

$('.signup-close').click(function() {
    $('#signup-form').attr('style',"display:none");
    $('#signup_email').val('');
    $('#signup_password').val('');
    $('#signup_firstName').val('');
    $('#signup_lastName').val('');
    $('#signup_mobile').val('');
    $('#signup_msg').html('');
});

$('.signup-overlay').click(function() {
    $('#signup-form').attr('style',"display:none");

});

$('.mob-verification').click(function() {
    $('#mobile-verify').attr('style',"display:block");
    $('#signup-form').attr('style',"display:none");
    $('#login-form').attr('style',"display:none");
});
$('.mob-verify-close').click(function() {
    $('#mobile-verify').attr('style',"display:none");

});
$('.mob-verify-overlay').click(function() {
    $('#mobile-verify').attr('style',"display:none");

});

$('.forgot-popup').click(function() {
    $('#forgot-pswd').attr('style',"display:block");
    $('#login-form').attr('style',"display:none");
    $('#fgt-email').val('');
    $('#forget_msg').html('');

});
$('.forgot-pswd-close').click(function() {
    $('#forgot-pswd').attr('style',"display:none");
    $('#fgt-email').val('');
    $('#forget_msg').html('');

});
$('.forgot-pswd-overlay').click(function() {
    $('#forgot-pswd').attr('style',"display:none");
    $('#fgt-email').val('');
    $('#forget_msg').html('');
});

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {

        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

$(window).scroll(function() {
    var scroll = $(window).scrollTop();

    if (scroll >= 50) {
        $(".header").addClass("fix-header");
    } else {
        $(".header").removeClass("fix-header");
    }
});
