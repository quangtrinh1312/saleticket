
function resetValueForm() {

	$('.select').val(0).trigger("change");

	$('select[name = "district_id"]')[0] ? $('select[name = "district_id"]')[0].selectedIndex == 0  : console.log('');

	$('select[name = "ward_id"]').empty();

	$('input[name = "street"]').val('');

	$('input[name = "apartment_number"]').val('');

	$('select[name = "type_price_id"]')[0] ? $('select[name = "type_price_id"]').val('').trigger('change')  : console.log('');;

	$('select[name = "send_accountant"]')[0] ? $('select[name = "send_accountant"]').val('').trigger('change')   : console.log('');;

	$('select[name = "original_bill"]')[0] ? $('select[name = "original_bill"]').val('').trigger('change')   : console.log('');;

	$('select[name = "type_paid"]')[0] ? $('select[name = "type_paid"]').val('').trigger('change')   : console.log('');;

	$('select[name = "status"]')[0] ? $('select[name = "status"]').val('').trigger('change')   : console.log('');;

	$('input[name = "fullname"]').val('');

	$('input[name = "name"]').val('');

	$('input[name = "number_bill_number"]').val('');

	$('input[name = "number_bill_string"]').val('');

	$('textarea[name = "content_bill_debt_month"]').val('');

	$('textarea[name = "content_bill_debt_additional_arrears"]').val('');

	$('input[name = "date_start"]').val('').attr('type', 'text')
    .attr('type', 'date');

    $('input[name = "date_end"]').val('').attr('type', 'text')
    .attr('type', 'date');

    $('select[name = "dormitory_id"]')[0] ? $('select[name = "dormitory_id"]').val('').trigger('change')   : console.log('');;
}