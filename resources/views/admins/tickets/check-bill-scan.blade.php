@foreach ($tickets as $key => $value)
	<div class="text-center border ml-auto mr-auto {{$value->check == 1 ? 'border-success' : 'border-warning'}}" style="width: 350px; height: 200px; margin-top: 10px !important;">
		<p>Số: {{covert_code_bill($value->number_bill_number)}}</p>
		@if ($result_tickets[$value->number_bill_number] == 1)
		<p class="font-weight-bold text-uppercase">Vé hợp lệ</p>
		<img src="{{asset('images/success.png')}}" style="width: 100px; height:100px; " alt="Vé hợp lệ">
		@else
		<p class="font-weight-bold text-uppercase">Vé Không hợp lệ</p>
		<img src="{{asset('images/erross.png')}}" style="width: 100px; height:100px; " alt="Vé không hợp lệ">
		@endif
	</div>
	@endforeach