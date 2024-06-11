<div id="printJS-bill1">
	@if(isset($result_tickets) && count($result_tickets) > 0)
	@if (isset($price) && $price > 0)
	<div class="header-bill" style="margin-top: -20px; width: 100%; text-align: center;">
		<p class="font-weight-bold"  style=""> {{$config ? $config->name : ''}}</p>
		<div id="content_inv">
			<div class="w-100 ">
				<div class="col-lg-12 mt-4 ">
			        <div class="header_receipt_comment">
			            <p class="mt_header" style="margin-top: -20px;">-----***-----</p>
						<p class="" style="margin-top: -28px; font-size: 20px;">Mã số thuế: {{$config ? $config->mst : ''}}</p>
						<p class="" style="margin-top: -24px; font-size: 22px;">Địa chỉ: {{$config ? $config->address_user : ''}}</p>
			        </div>
			    </div>
			</div>
			<div class="w-100 mt-2 text-center phieuthu" >
				<H3 style="margin-top: -10px; font-size: 24px;" class="mt_content_covert"><b>BIÊN LAI THU TIỀN PHÍ, LỆ PHÍ IN SẴN MỆNH GIÁ</b></H3>
				<!-- <p style="margin-top: -20px;">{!!$qrCode ?? ''!!}</p> -->
				<p class="" style="margin-top: -20px;">Tên loại phi, lệ phi: <font class="bold"> {{$value->prod_name ?? ''}}</font></p>
				<!-- <p class="bold title_price mt_content_covert">Số tiền: <font class="price">{{number_format($price, 0, ',', '.')}} đồng</font></p> -->
				<p class="bold title_price" style="font-size: 26px; margin-top: -18px;">Số tiền: <font class="">{{number_format($price, 0, ',', '.')}} đồng</font></p>
				<p class="" style="margin-top: -28px;">Bằng chữ: <font class="bold italic">{{ucfirst(convert_curency_to_words($price))}} đồng</font></p>
			    <p class="" style="margin-top: -16px;">Tên khách hàng: <font class="bold italic">{{ucwords($result_tickets[0]->cus_name)}}</font></p>
			    <p class="" style="margin-top: -16px">Mẫu số: {{$result_tickets[0] ? $result_tickets[0]->pattern : ''}}</p>
			    <p class="" style="margin-top: -16px">Kí hiệu: {{$result_tickets[0] ? $result_tickets[0]->serial : ''}}</p>
			    <p class="" style="margin-top: -16px;">Số: 
			    	<font class="bold italic">
			    	@foreach ($result_tickets as $key => $result_ticket)
			        @php $inv = $key + 1; @endphp
			        {{$result_ticket->number_bill_number}}@if($inv != count($result_tickets)),@endif
			       	@endforeach
				    </font>
				</p>
				<p class="italic" style="margin-top: -20px">Ngày {{$result_tickets[0]->created_at->format('d')}} tháng {{$result_tickets[0]->created_at->format('m')}} năm {{$result_tickets[0]->created_at->format('Y')}}</p>
			</div>
			<div class="kyten" style="margin-top: -10px;padding-left: 10px;">
				<p style="margin-top: 0px;">Signature Valid</p>
				<div id="infor_inv" style="margin-top: 0px;">
					<div class="row">
						<p class="title-left-ky italic mt_ky">Ký bởi:</p>
						<p class="title-right-ky mt_ky">{{$config ? $config->name : ''}}</p>
					</div>
				</div>
				<p class="italic" style="margin-top: -26px; margin-bottom: 2px;">Ký ngày: {{$result_tickets[0]->created_at->format('d/m/Y')}}</p>
			</div>
			<div class="row">
				<p class="">----------***----------</p>
				<div class="row text-left">
					<h1 class="col-8">Quét mã tại đây</h1>
					<p class="col-4">{{$qrCode_check}}</p>
					<!-- <p class="col-8">Phần này dành cho kiểm soát viên</p> -->
				</div>
			</div>
		</div>
	</div>
	@else
	@foreach($result_tickets as $key => $value)
	<div class="header-bill" style="margin-top: -20px; width: 100%; text-align: center;">
		<p class="font-weight-bold"  style=""> {{$config ? $config->name : ''}}</p>
		<div id="content_inv">
			<div class="w-100 ">
				<div class="col-lg-12 mt-4 ">
			        <div class="header_receipt_comment">
			            <p class="mt_header" style="margin-top: -20px;">-----***-----</p>
						<p class="" style="margin-top: -28px; font-size: 20px;">Mã số thuế: {{$config ? $config->mst : ''}}</p>
						<p class="" style="margin-top: -24px; font-size: 22px;">Địa chỉ: {{$config ? $config->address_user : ''}}</p>
			        </div>
			    </div>
				
			</div>
			<div class="w-100 mt-2 text-center phieuthu" >
				<H3 style="margin-top: -10px; font-size: 24px;" class="mt_content_covert"><b>BIÊN LAI THU TIỀN PHÍ, LỆ PHÍ IN SẴN MỆNH GIÁ</b></H3>
				<!-- <p style="margin-top: -20px;">{!!QrCode::size(150)->generate(route('get.bill', ['name' => Str::slug($config->name, '-') ?? '', 'number' => [$value->number_bill_number], 'config_id' => $config->id])) ?? ''!!}</p> -->
				<p class="" style="margin-top: -20px;">Tên loại phi, lệ phi: <font class="bold"> {{$value->prod_name ?? ''}}</font></p>
				<p class="bold title_price" style="font-size: 26px; margin-top: -18px;">Số tiền: <font class="">{{number_format($value->price, 0, ',', '.')}} đồng</font></p>
			    <p class="" style="margin-top: -28px;">Bằng chữ: <font class="bold italic">{{ucfirst(convert_curency_to_words($value->price))}} đồng</font></p>
			    <p class="" style="margin-top: -16px;">Tên khách hàng: <font class="bold italic">{{ucwords($result_tickets[0]->cus_name)}}</font></p>
			    <p class="" style="margin-top: -16px">Mẫu số: {{$value->pattern ? $value->pattern : ''}}</p>
			    <p class="" style="margin-top: -16px">Kí hiệu: {{$value->serial ? $value->serial : ''}}</p>
			    <!-- <p class="" style="margin-top: -16px;">Số: <font class="bold italic">{{$value->number_bill_number}}</font></p> -->
				<p class="italic" style="margin-top: -20px">Ngày {{$result_tickets[0]->created_at->format('d')}} tháng {{$result_tickets[0]->created_at->format('m')}} năm {{$result_tickets[0]->created_at->format('Y')}}</p>
			</div>
			<div class="kyten" style="margin-top: -10px; padding-left: 10px;">
				<p style="margin-top: 0px;">Signature Valid</p>
				<div id="infor_inv" style="margin-top: 0px;">
					<div class="row">
						<p class="title-left-ky italic mt_ky">Ký bởi:</p>
						<p class="title-right-ky mt_ky">{{$config ? $config->name : ''}}</p>
					</div>
				</div>
				<p class="italic" style="margin-top: -26px; margin-bottom: 2px;">Ký ngày: {{$result_tickets[0]->created_at->format('d/m/Y')}}</p>
			</div>
			<div class="row">
				<p class="">----------***----------</p>
				<div class="row text-left">
					<h1 class="col-8">Quét mã tại đây</h1>
					<p class="col-4">{!!QrCode::size(190)->generate($value->number_bill_number) ?? ''!!}</p>
					<!-- <p class="col-8">Phần này dành cho kiểm soát viên</p> -->
				</div>
			</div>
		</div>
	</div>
	@endforeach
	@endif
	@endif
	
</div>
<div class="text-center">
	@if(isset($result_tickets) && count($result_tickets) > 0)
	@if (isset($price) && $price > 0)
	@else
	@foreach($result_tickets as $key => $value1)
	<div class="header-bill" style="margin-top: -20px; width: 100%; text-align: center;">
		<p class="font-weight-bold"  style=""> {{$config ? $config->name : ''}}</p>
		<div id="content_inv">
			<div class="w-100 ">
				<div class="box-wrap col-lg-12 mt-4 ">
			        <div class="header_receipt_comment">
			            <p class="mt_header" style="margin-top: -10px;">-----***-----</p>
						<p class="" style="margin-top: -20px; font-size: 20px;">Mã số thuế: {{$config ? $config->mst : ''}}</p>
						<p class="" style="margin-top: -24px; font-size: 22px;">Địa chỉ: {{$config ? $config->address_user : ''}}</p>
			        </div>
			    </div>
				
			</div>
			<div class="w-100 mt-2 text-center phieuthu" >
				<H3 style="margin-top: -10px; font-size: 24px;" class="mt_content_covert"><b>BIÊN LAI THU TIỀN PHÍ, LỆ PHÍ IN SẴN MỆNH GIÁ</b></H3>
				<!-- <div class="row">
					<div class="col-5 p-0"></div>
					<div class="col-7 p-0"><p style="margin-top: -10px; text-align: center;">{!!QrCode::size(100)->generate(route('get.bill', ['name' => Str::slug($config->name, '-') ?? '', 'number' => [$value1->number_bill_number], 'config_id' => $config->id])) ?? ''!!}</p></div>
					
				</div> -->
				<p class="">Tên loại phi, lệ phi: <font class="bold"> {{$value1->prod_name ?? ''}}</font></p>
				<p class="bold title_price" style="font-size: 26px; margin-top: -18px;">Số tiền: <font class="">{{number_format($value1->price, 0, ',', '.')}} đồng</font></p>
			    <p class="" style="margin-top: -24px;">Bằng chữ: <font class="bold italic">{{ucfirst(convert_curency_to_words($value1->price))}} đồng</font></p>
			    <p class="" style="margin-top: -16px;">Tên khách hàng: <font class="bold italic">{{ucwords($result_tickets[0]->cus_name)}}</font></p>
			    <p class="" style="margin-top: -16px">Mẫu số: {{$config ? $config->pattern : ''}}</p>
			    <p class="" style="margin-top: -16px">Kí hiệu: {{$config ? $config->serial : ''}}</p>
			    <!-- <p class="" style="margin-top: -16px;">Số: <font class="bold italic">{{$value1->number_bill_number}}</font></p> -->
				<p class="italic" style="margin-top: -20px">Ngày {{$result_tickets[0]->created_at->format('d')}} tháng {{$result_tickets[0]->created_at->format('m')}} năm {{$result_tickets[0]->created_at->format('Y')}}</p>
			</div>
			<div class="kyten border text-left" style="margin-top: -10px; font-size: 20px; padding-left: 10px;">
				<p style="margin-top: 0px;">Signature Valid</p>
				<div class="row">
					<p class="col-4">Ký bởi:</p>
					<p class="col-8">{{$config ? $config->name : ''}}</p>
				</div>
				<p class="italic" style="margin-bottom: 2px;">Ký ngày: {{$result_tickets[0]->created_at->format('d/m/Y')}}</p>
			</div>
			<div class="row text-center">
				<div class="col-12">
					<p class="">----------***----------</p>
					<div class="col-12 text-center">
						<p class="col-12">Quét mã tại đây</p>
						<div class="row">
							<p class="col-5 p-0"></p>
							<p class="col-7 p-0">{!!QrCode::size(100)->generate($value1->number_bill_number) ?? ''!!}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach
	@endif
	@endif
	
</div>
