$( document ).ready(function() {

	//index.html
	$("#owl-example").owlCarousel({
	  navigation : false, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true
	});


	// order.html 
	// convert the all input into scanner
	$('.qty_spinner').TouchSpin({initval: 1,min:1,max:50,});

		
		
	// var row =  $('#order_row1');
	// row.on('change',function(e){
	// 	console.log(row);
	// 	var meat_length = $('input[class="meat"]:checked').length;
	// 	var vege_length = $('input[class="vege"]:checked').length;

	// 	if (meat_length == 0 || vege_length == 0) {
	// 		$("#single_price1").text("0.00");
	// 		$("#total_price1").text("0.00");
	// 	};

	// 	// 5.50 meal function
	// 	if ( ((meat_length == 1)&&(vege_length == 2)) || ((meat_length == 1)&&(vege_length == 1)) ) {
	// 		// set single price without parsing
	// 		$("#single_price1").text("5.50");
	// 		//get single price with parsing
	// 		var single1 = parseFloat($("#single_price1").text()).toFixed(2);
	// 		console.log(single1);
	// 		// get quantity value 
	// 		var qty1 = parseInt($("#single_qty1").val());
	// 		console.log(qty1);
	// 		//single price multiply 
	// 		var total = parseFloat(single1*qty1).toFixed(2);
	// 		console.log(total);
	// 		$("#total_price1").text(total);			
	// 	};

	// 	// 6.00 meal function
	// 	if ( ((meat_length == 2)&&(vege_length == 1)) || (meat_length == 2) ) {
	// 		// set single price without parsing
	// 		$("#single_price1").text("6.00");
	// 		//get single price with parsing
	// 		var single1 = parseFloat($("#single_price1").text()).toFixed(2);
	// 		console.log(single1);
	// 		// get quantity value 
	// 		var qty1 = parseInt($("#single_qty1").val());
	// 		console.log(qty1);
	// 		//single price multiply 
	// 		var total = parseFloat(single1*qty1).toFixed(2);
	// 		console.log(total);
	// 		$("#total_price1").text(total);			
	// 	};

	// });




	var list = $('#add_order_table');
	var initial = 0;
	
		list.click(function(){


		html  = '<tr id="select-row'+initial+'">';
			html += '<td class="col-md-7">';
			//meat
			html += '<div class="col-md-6">';
			html += '<div class="checkbox"><label><input type="checkbox" name="meat'+initial+'[]" class="cmeat'+initial+'"> Black Pepper Fried Chicken</label></div>';
			html += '<div class="checkbox"><label><input type="checkbox" name="meat'+initial+'[]" class="cmeat'+initial+'"> Pineapple Pork</label></div>';
			html += '<div class="checkbox"><label><input type="checkbox" name="meat'+initial+'[]" class="cmeat'+initial+'"> Bitter Gourd with Dash Fish</label></div>';
			html += '</div>';

			//vege
			html += '<div class="col-md-6">';
			html += '<div class="checkbox"><label><input type="checkbox" name="vege'+initial+'[]" class="cvege'+initial+'"> Garlic Bayam</label></div>';
			html += '<div class="checkbox"><label><input type="checkbox" name="vege'+initial+'[]" class="cvege'+initial+'"> Oyster Young Pakchoy</label></div>';
			html += '</div>';

			html += '</td>';
			html += '<td class="col-md-1 text-center"><b><p>RM <span id="single_price'+initial+'">0.00</span></p><b></td>';
			html += '<td class="col-md-2"><p><input id="single_qty'+initial+'"type="text" value="" name="demo" class="text-center qty_spinner"></p></td>';
			html += '<td class="col-md-1 text-center"><b><p>RM <span id="total_price'+initial+'">0.00</span></p><b></td>';			
			html += '<td class="col-md-1 text-center"><p><button type="button" class="btn btn-danger" onclick="$(\'#select-row' + initial + '\').remove();">';
				html += '<span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>';
			html += '</button></p></td>';
		html += '</tr>';		

		$('#order_table tbody').append(html);

		$('.qty_spinner').TouchSpin({
			initval: 0,
			min:0,
			max:50,
			buttondown_class: 'btn btn-danger',
      		buttonup_class: 'btn btn-primary',
		});

		(function(initial) {
		    var row =  $("#select-row"+initial);
		    row.on('change',function(e){

		    var meat_length = $('input[class="cmeat'+initial+'"]:checked').length;
		    var vege_length = $('input[class="cvege'+initial+'"]:checked').length;

		    console.log("initial is "+initial);
		    console.log("meat_length is "+meat_length);

		    if (meat_length == 0 || vege_length == 0) {
		        $("#single_price"+initial).text("0.00");
		        $("#total_price"+initial).text("0.00");
		    };

		    // 5.50 meal function
		    if ( ((meat_length == 1)&&(vege_length == 2)) || ((meat_length == 1)&&(vege_length == 1)) ) {
		        // set single price without parsing
		        $("#single_price"+initial).text("5.50");
		        //get single price with parsing
		        var single1 = parseFloat($("#single_price"+initial).text()).toFixed(2);

		        // get quantity value 
		        var qty1 = parseInt($("#single_qty"+initial).val());

		        //single price multiply 
		        var total = parseFloat(single1*qty1).toFixed(2);

		        $("#total_price"+initial).text(total);          
		    };

		    // 6.00 meal function
		    if ( ((meat_length == 2)&&(vege_length == 1)) || (meat_length == 2) ) {
		        // set single price without parsing
		        $("#single_price"+initial).text("6.00");
		        //get single price with parsing
		        var single1 = parseFloat($("#single_price"+initial).text()).toFixed(2);
		        // get quantity value 
		        var qty1 = parseInt($("#single_qty"+initial).val());
		        //single price multiply 
		        var total = parseFloat(single1*qty1).toFixed(2);

		        $("#total_price"+initial).text(total);          
		    };

		    });
		})(initial);

		initial++;
	});


});