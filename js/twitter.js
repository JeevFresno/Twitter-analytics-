$(document).ready(function() {

var query = window.location.search.substring(1);
var param = query.split("=");
$("."+param[1]).addClass("active");

});