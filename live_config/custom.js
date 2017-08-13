//  global variable
var HTTP_HOST = window.location.host;
var channelURL = '';
if (HTTP_HOST == 'localhost.com') {
	channelURL = 'http://localhost.com/food_2_user/';
}else{
	channelURL = 'http://www.lovelymealbox.com';
};

$( document ).ready(function() {

	//index.html
	$("#owl-example").owlCarousel({
	  navigation : false, // Show next and prev buttons
	  pagination : false,
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true
	});

	$("#owl-example1").owlCarousel({
	  navigation : false, // Show next and prev buttons
	  pagination : false,
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true
	});

	$('.qty_spinner').TouchSpin({
		initval: 1,
		min:1,
		max:50,
		buttondown_class: 'btn btn-danger',
		buttonup_class: 'btn btn-primary',
		buttondown_txt: '<i class="glyphicon glyphicon-minus"></i>',
		buttonup_txt: '<i class="glyphicon glyphicon-plus"></i>'
	});

	var quantity_box = $(".quantity_box");
	quantity_box.on('change',function(e){
		var value = $(this).val();
		var id = $(this).closest('tr').attr('id');

		$.ajax({
			url: channelURL+'/cart/update',
			type: 'post',
			data: {key: id, value: value},
			dataType: 'text',
			success: function(json) {
				location.reload();
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});

	var menu_form = $('#menu-form');
	menu_form.on('change',function(e){

	    var meat_length = $('input[class="meat"]:checked').length;
	    var vege_length = $('input[class="vege"]:checked').length;

	    if (meat_length == 0 || vege_length == 0) {
	        $("#per-price").text("0.00");
	        $("#total-price").text("0.00");
	    };

	    // 5.50 meal function
	    if ( ((meat_length == 1)&&(vege_length == 2)) || ((meat_length == 1)&&(vege_length == 1)) ) {
	        // set single price without parsing
	        $("#per-price").text("6.00");
	        //get single price with parsing
	        var single1 = parseFloat($("#per-price").text()).toFixed(2);

	        // get quantity value 
	        var qty1 = parseInt($("#box-qty").val());

	        //single price multiply 
	        var total = parseFloat(single1*qty1).toFixed(2);

	        $("#total-price").text(total);          
	    };

	    // 6.00 meal function
	    if ( ((meat_length == 2)&&(vege_length == 1)) || (meat_length == 2) ) {
	        // set single price without parsing
	        $("#per-price").text("6.50");
	        //get single price with parsing
	        var single1 = parseFloat($("#per-price").text()).toFixed(2);

	        // get quantity value 
	        var qty1 = parseInt($("#box-qty").val());

	        //single price multiply 
	        var total = parseFloat(single1*qty1).toFixed(2);

	        $("#total-price").text(total);
	    };

	});

});

var cart = {
	'remove' :function(key) {
		$.ajax({
			url: channelURL+'/cart/remove',
			type: 'post',
			data: 'key=' + key,
			dataType: 'text',
			success: function(json) {
				location.reload();
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
}