//  global variable
var HTTP_HOST = window.location.host;
var channelURL = '';
if (HTTP_HOST == 'localhost.com') {
	channelURL = 'http://localhost.com/food_2_user/';
}else{
	channelURL = 'http://www.lovelymealbox.com';
};

$( document ).ready(function() {

	if($('#cod').is(':checked')) { 
		$('#fee').text("2.00");
	}else{
		$('#fee').text("0.00");
	}

        $("#cod").click(function() {
            var checked = $(this).is(':checked');
            if (checked) {
            	$('#fee').text("2.00");   
            	var fee =      parseFloat($('#fee').text());         
                var total_fee = parseFloat($('#total_fee').text());
                var total_with_delivery = parseFloat(total_fee + fee).toFixed(2);
                 console.log(fee);
                  console.log(total_fee);
                console.log(total_with_delivery);

                $('#total_fee').text(total_with_delivery);
            }
        });

        $("#ub").click(function() {
            var checked = $(this).is(':checked');
            if (checked) {
                $('#fee').text("0.00");
            }
        });

	// $('#cod:checked')

	$("#owl-example1").owlCarousel({
	  navigation : false, // Show next and prev buttons
	  pagination : false,
      slideSpeed : 300,
      autoHeight:true,
      paginationSpeed : 400,
      	  autoPlay:true,
      autoplayTimeout:1000,
      singleItem:true
	});

	$("input[name='box-quantity']").TouchSpin({
		initval: 1,
		min:1,
		max:50,
		buttondown_class: 'btn btn-danger',
		buttonup_class: 'btn btn-primary',
		buttondown_txt: '<i class="glyphicon glyphicon-minus"></i>',
		buttonup_txt: '<i class="glyphicon glyphicon-plus"></i>'
	});

	$('#alacarte_modal').on('hidden.bs.modal', function (e) {
	  //reset form
      $("#menu-form input[type='checkbox']").removeAttr('checked');
      $("#alert-out").remove();
      $("#box-qty").val("1");
      $("#per-price").text("0.00");
      $("#total-price").text("0.00");

	});

	$('.del_item').click(function(e){

		var url = channelURL+"/meal/delete_item"
		e.preventDefault();
		item_id = $(this).data("item-id");

	    $.ajax({
	        url : url,
	        type: "POST",
	        dataType: "JSON",
	        data: { id : item_id },
	        success: function(data)
	        { 
	            location.reload();
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	          console.log(jqXHR);
	        }
	    });

	});

	$('#mealbox_submit').click(function(e){

		var url = "http://www.lovelymealbox.com/meal/ajax_meal_add";
	      e.preventDefault();
		    $.ajax({
		        url : url,
		        type: "POST",
		        dataType: "JSON",
		        data: $('#menu-form').serializeArray(),
		        success: function(data)
		        { 
		           if (data.status == 'failed') {
		           	 $('#message').html("<div class='alert alert-danger alert-dismissable fade in'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"+data.message+"</div>");
		           }else{
		           	  location.reload();
		           }
		        },
		        error: function (jqXHR, textStatus, errorThrown)
		        {
		          console.log(jqXHR);
		        }
		    });


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
	    var meat_length  = $('input[class="meat"]:checked').length;
	    var vege_length  = $('input[class="vege"]:checked').length;
	    
		meat_string = Array(meat_length+1).join("m");
	    vege_string = Array(vege_length+1).join("v");

	    code = vege_string+meat_string;
		switch (code) {
		    case 'vvm':
		    case 'vm':
		    case 'vmm':
		    case 'mm':
		    case 'vvv':
				$("#per-price").text("6.00");
	        	var single1 = parseFloat($("#per-price").text()).toFixed(2);
	        	var qty1 = parseInt($("#box-qty").val());
	        	var total = parseFloat(single1*qty1).toFixed(2);
	        	$("#total-price").text(total); 
	        	break;
		    default:
		        $("#per-price").text("0.00");
	        	$("#total-price").text("0.00");
		        break;
		}
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