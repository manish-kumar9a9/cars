(function($){
    //***********************
    //  toastee plugin v1.0
    //  super light weight toast notification plugin ( requires jQuery )
    //  author: Eric Rogers
    //  options: {
    //  type: 'info', 'error', 'success',
    //  header: 'your header text',
    //  message: 'your message',
    //  color: 'text and close button color',
    //  background: 'background color',
    //  width: takes an integer (default is 150),
    //  height: takes an integer (default is 150)
    //  }
    //**********************

    $.fn.toastee = function(options) {
        var settings = $.extend ({
            type: 'info',
            header: '',
            message: 'What a great Toast!',
            color: '#fff',
            background: '#3498db',
            width: 200,
            fadeout: 3000
        }, options);


        var self = this;
        var dataId = Math.floor(Math.random() * 100000);
        var backgrounds = {'info': '#3498db', 'error': '#e74c3c', 'success': '#2ecc71'};
        var headers = {'info': 'Info', 'error': 'Error', 'success': 'Success!'};

        if (options == undefined) {
            options = {'empty': 'empty'};
        }

        switch (settings.type) {
            case 'info':
                settings.background = options.background || backgrounds.info;
                settings.header = options.header || headers.info;
                break;
            case 'error':
                settings.background = options.background || backgrounds.error;
                settings.header = options.header || headers.error;
                break;
            case 'success':
                settings.background = options.background || backgrounds.success;
                settings.header = options.header || headers.success;
        };

        var toast = '<div data-id="' + dataId +'" style="display: block;margin: 0 auto; position: relative; min-width: 100%; max-width: '+ settings.width +'px; height: '+ settings.height +'px; background: '+ settings.background +'; box-shadow: 0 5px 5px 2px #ccc">';
        toast += '<a class="closeToastee" style="color: '+ settings.color +'; text-align: center; line-height: 2.8; width: 10px; height: 10px; padding: 5px; font-family: sans-serif; display: block; cursor: pointer; position: absolute;font-family:ralewaybold; top: 10px; right: 10px; color: ' + settings.color + ';">X</a>';
       // toast += '<h3 style="margin: 0px 0;text-align: center; padding: 10px 0px ; color: '+ settings.color +'">' + settings.header + '</h3>';
        //toast += '<hr style="color: transparent; width: 97%; margin: 0 auto; border-bottom: 1px solid ' + settings.color +'; opacity: 0.3" />'
        toast += '<p style="font-family: ralewaysemibold;padding: 25px 10px 25px 89px; color: '+ settings.color +'">' + settings.header +' -: '+ settings.message + '</p>';
        toast += '</div>';

        var timer ={};

        var startTimer = function(){
            timer.dataId =  setTimeout(function() {

            $('div[data-id="'+ dataId +'"]').fadeOut(settings.fadeout, function(){
                $(this).remove();
            });
            }, 3000);
        };

        var stopTimer = function () {
            clearTimeout(timer.dataId);
        };

        //$(this).append(toast).show('fast');
        $(this).html(toast).show('fast');
        
        $('div[data-id="'+ dataId +'"]').hide(0).fadeIn(500);
        startTimer();

        $('.closeToastee').on('click', function () {
           $(this).parent().hide().remove();
        });

        $('div[data-id="' + dataId + '"]').mouseover(function(){
            stopTimer();
            $(this).stop().fadeIn(0);
        }).mouseout(function(){
            startTimer();
        });


        return this;
    };
})(jQuery);
