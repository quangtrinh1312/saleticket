<div id="">
						<div class="header-bill" style="margin-top: -20px; width: 100%; text-align: ;">
							<div class="d-block text-center mt-2 mau_so" style="position: relative;">
								<p class="font-weight-bold">Mẫu số: C40-BB</p>
								<p class="" style="margin-top: -10px;">(Ban hành theo QĐ số: 107/2017/TT-BTC ngày 10/10/2017 của Bộ Tài Chính)</p>
							</div>
							<div class="w-100">
								<!-- <div class="horizontal_dotted_line mt-1 font-weight-bold"><b>Đơn vị</b>: Trung tâm Quản lý và Khai thác Nhà Đà Nẵng </div>
								<div class="horizontal_dotted_line mt-1 font-weight-bold"><b>Địa chỉ</b>: 06 Trần Quý Cáp – Tp Đà Nẵng</div>
								<div class="horizontal_dotted_line mt-1 font-weight-bold"><b>Mã đơn vị SDNS</b>: 1127535</div> -->
								<p class="font-weight-bold ">Đơn vị: Trung tâm Quản lý và Khai thác Nhà Đà Nẵng</p>
								<p class="font-weight-bold ">Địa chỉ: 06 Trần Quý Cáp, P. Thạch Thang, Q. Hải Châu, TP. Đà Nẵng</p>
								<p class="font-weight-bold ">Mã đơn vị SDNS: 1127535</p>
								<!-- <img src="{{asset('global_assets/images/logo_qlnhadn.jpg')}}" alt="" style="width: 50%; display: block; margin: 0 auto"> -->
							</div>
							<div class="w-100 mt-2 text-center phieuthu" >
								<H1 style="margin: 0px;"><b>PHIẾU THU</b></H1>
								<p class="light-small">Số: {{$amountReceived7->number_bill_string}}</p>
								<p class="light-small">Ngày {{$amountReceived7->created_at->format('d')}} tháng {{$amountReceived7->created_at->format('m')}} năm {{$amountReceived7->created_at->format('Y')}}</p>
							</div>
						</div>
						
					

						@include('admins.layouts.bill_apartment')

					</div>

					<div id="printJS-bill">
						<div class="header-bill" style="margin-top: -20px; width: 100%; text-align: ;">
							<div class="d-block text-center mt-2 mau_so"style="position: relative;">
								<p class="font-weight-bold">Mẫu số: C40-BB</p>
								<p class="" style="margin-top: -10px;">(Ban hành theo QĐ số: 107/2017/TT-BTC ngày 10/10/2017 của Bộ Tài Chính)</p>
							</div>
							<div class="w-100">
								<!-- <div class="horizontal_dotted_line mt-1 font-weight-bold"><b>Đơn vị</b>: Trung tâm Quản lý và Khai thác Nhà Đà Nẵng </div>
								<div class="horizontal_dotted_line mt-1 font-weight-bold"><b>Địa chỉ</b>: 06 Trần Quý Cáp – Tp Đà Nẵng</div>
								<div class="horizontal_dotted_line mt-1 font-weight-bold"><b>Mã đơn vị SDNS</b>: 1127535</div> -->
								<p class="font-weight-bold">Đơn vị: Trung tâm Quản lý và Khai thác Nhà Đà Nẵng</p>
								<p class="font-weight-bold light-medium">Địa chỉ: 06 Trần Quý Cáp, P. Thạch Thang, Q. Hải Châu, TP. Đà Nẵng</p>
								<p class="font-weight-bold light-medium">Mã đơn vị SDNS: 1127535</p>
								<!-- <img src="{{asset('global_assets/images/logo_qlnhadn.jpg')}}" alt="" style="width: 24%; display: block; margin:0 auto; z-index: -99;" id="image_logo"> -->
							</div>
							<div class="w-100 mt-2 text-center phieuthu" >
								<H3 style="margin: 0px;"><b>PHIẾU THU</b></H3>
								<p>Số: {{$amountReceived7->number_bill_string}}</p>
								<p class="light-medium">Ngày {{$amountReceived7->created_at->format('d')}} tháng {{$amountReceived7->created_at->format('m')}} năm {{$amountReceived7->created_at->format('Y')}}</p>
							</div>
						</div>
						
					

						@include('admins.layouts.bill_apartment_print')

					</div>