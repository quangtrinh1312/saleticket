<div id="">
						<div class="header-bill" style="margin-top: -20px; width: 100%; text-align: ;">
							<div class="d-block text-center mt-2 mau_so" style="position: relative;">
								<p class="font-weight-bold">CÔNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</p>
								<p class="" style="margin-top: -10px;">Độc lập - Tự do - Hạnh phúc</p>

							</div>
							<hr class="hr" style="font-weight: bold; height: 2px; color: black; width: 40%; margin-top: -10px;">
							<div class="w-100 ">
								<div class="box-wrap col-lg-12 mt-4 ">
							        <div class="header_receipt">
							            <p class="font-weight-bold"  style="">TRUNG TÂM QUẢN LÝ VÀ KHAI THÁC NHÀ ĐÀ NẴNG</p>
										<p class="" style="margin-top: -12px;">Mã số thuế: 0401931849</p>
										<p class="" style="margin-top: -12px;">Địa chỉ: 06 Trần Quý Cáp, P. Thạch Thang, Q. Hải Châu, TP. Đà Nẵng</p>

							            <!-- <p class="" style="">Mẫu số: ........................................</p>
										<p class="" style="margin-top: -12px; ">Kí hiệu: .........................................</p>
										<p class="" style="margin-top: -12px; ">Số: ................................................</p> -->
										<!-- <img src="{{asset('global_assets/images/logo_qlnhadn.jpg')}}" alt="" style="width: 50%; display: block; margin: 0 auto"> -->
							        </div>
							    </div>
								
							</div>
							<div class="w-100 mt-2 text-center phieuthu" >
								<H3 style="margin: 0px;"><b>BIÊN LAI THU TIỀN</b></H3>
								<p class="">Số: {{$amountReceived7->number_bill_string}}</p>
								<p>Ngày {{$amountReceived7->created_at->format('d')}} tháng {{$amountReceived7->created_at->format('m')}} năm {{$amountReceived7->created_at->format('Y')}}</p>
							</div>
						</div>
						
						

						@include('admins.layouts.bill_apartment')

					</div>

					<div id="printJS-bill">
						<!-- <img src="{{asset('global_assets/images/logo_qlnhadn.jpg')}}" alt="" style="width: 70%; position: absolute; top: 50%; transform: translateY(-50%); opacity: 0.2; z-index: -9999; left: 14%;"> -->
						<div class="header-bill" style="margin-top: -20px; width: 100%; text-align: ;">
							<div class="w-100 ">
								<div class="box-wrap col-lg-12 mt-4">
							        <div class=" header_receipt" style="width: 50%;">
							            <p class="font-weight-bold"  style="">TRUNG TÂM QUẢN LÝ VÀ KHAI THÁC NHÀ ĐÀ NẴNG</p>
										<p class="light-medium" style="margin-top: -12px;">Mã số thuế: 0401931849</p>
										<p class="light-medium" style="margin-top: -12px;">Địa chỉ: 06 Trần Quý Cáp, P. Thạch Thang, Q. Hải Châu, TP. Đà Nẵng</p>
							        </div>
							        <div class="right-info  header_receipt" style="width: 50%;">
							            <!-- <p class="" style="">Mẫu số: ........................................</p>
										<p class="" style="margin-top: -12px; ">Kí hiệu: .........................................</p>
										<p class="" style="margin-top: -12px; ">Số: ................................................</p> -->
										<!-- <img src="{{asset('global_assets/images/logo_qlnhadn.jpg')}}" alt="" style="width: 30%; display: block; margin: 0 auto"> -->
							        </div>
							    </div>
								
							</div>
							<div class="w-100 mt-2 text-center phieuthu" >
								<H3 style="margin: 0px;"><b>BIÊN LAI THU TIỀN</b></H3>
								<p class="">Số: {{$amountReceived7->number_bill_string}}</p>
								<p>Ngày {{$amountReceived7->created_at->format('d')}} tháng {{$amountReceived7->created_at->format('m')}} năm {{$amountReceived7->created_at->format('Y')}}</p>
							</div>
						</div>

						@include('admins.layouts.bill_apartment_print')

					</div>