$('.btn-plus').on('click', function(e) {
  let input_quantity = $('#input_quantity');

  if (input_quantity.val() == ''){

  	input_quantity.val('0' + 1);

  }
  else
  {
  	let result =  parseInt(input_quantity.val())  + 1;

	if (result > 9) {

	  	input_quantity.val(result);

	}
	else input_quantity.val('0'+result);
  }

  


});

$('.btn-minus').on('click', function(e) {
  let input_quantity = $('#input_quantity');

  if (input_quantity.val() == ''){

  	input_quantity.val(0);

  }
  else
  {
  	let result = parseInt(input_quantity.val()) - 1;

	if (result > 9) {

		input_quantity.val(result);

	}
	else if (result == 0 || result < 0) {
		input_quantity.val(0);
	}else input_quantity.val('0'+result);
  }

  
});

// max

$('#input_quantity').on('change', function(e) {

	let input_quantity = $('#input_quantity');

	let number = input_quantity.val();

	let max = input_quantity.attr('max');

	if (number > max) {

			input_quantity.val(max);

	}

});
