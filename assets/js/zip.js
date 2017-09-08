
$(".dropdown1 dt a").click(function(e) {
  $(".dropdown1 dd ul").toggle();
  e.preventDefault();
});

$(".dropdown1 dd ul li a").click(function() {
  var text = $(this).find('span').html();
  $(".dropdown1 dt a span").html(text);
  $(".dropdown1 dd ul").hide();
}); 

$(document).bind('click', function(e) {
    var $clicked = $(e.target);
    if (! $clicked.parents().hasClass("dropdown1"))
        $(".dropdown1 dd ul").hide();
});