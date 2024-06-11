<div class="col-lg-12">
	

							<div class="row pl-2 pr-2 content_bill light-small">

								<div class="box-wrap col-lg-12 mt-1">
							            <p class="title-row">Họ tên người nộp: {{$amountReceived7->fullname}}</p>
							        
							    </div>

							    <div class="box-wrap col-lg-12 mt-1 light-small">
							    
							            @if ($amountReceived7->dormitory_id != 0) 
							        		<p class="title-row">Khu KTX: {{getNameDorByID($amountReceived7->dormitory_id) ?? ''}}</p>
							        	
							        	@endif

							        	@if ($amountReceived7->apartment_id != 0)
							            	<p class="title-row">Địa chỉ: {{getNameApartmentByID($amountReceived7->apartment_id) ?? ''}} - {{getNameRoomByID($amountReceived7->room_id) ?? ''}}</p>
							            @endif

							            @if ($amountReceived7->district_id != 0)
							            	<p class="title-row">Địa chỉ: {{$amountReceived7->apartment_number ?? ''}} {{$amountReceived7->street ?? ''}}, {{getNameWardByID($amountReceived7->ward_id) ?? ''}}, {{getNameDistrictByID($amountReceived7->district_id) ?? ''}}</p>
							            @endif
							       
							    </div>

							    <div class="box-wrap col-lg-12 mt-1 light-small">
							        
							            <p class="title-row">Lí do nộp: {{$amountReceived7->content_bill_debt_month}}{{$amountReceived7->content_bill_debt_additional_arrears ? ', '.$amountReceived7->content_bill_debt_additional_arrears : ''}}</p>
							        
							    </div>

							    <div class="box-wrap col-lg-12 mt-1 light-small">
							       
							            <p class="title-row">Số tiền: {{number_format($amountReceived7->sum_price_amount_received,0,',','.')}} đồng</p>

							    </div>

								<div class="box-wrap col-lg-12 mt-1 light-small">
							            <p class="title-row">(Viết bằng chữ):</p>

							            <p class="title-row light-medium" id="myContentEditableDiv">{{convert_curency_to_words($amountReceived7->sum_price_amount_received)}} đồng</p>

							    </div>

							    <div class="box-wrap col-lg-12 mt-1 light-small">
							        
							            <p class="title-row">Hình thức nộp tiền: {{$amountReceived7->payment_method->title}}</p>
							        
							        
							           
							        
							    </div>

							    <div class="col-lg-12 text-right pr-4 ngaythang light-small">
									<p>Ngày {{$amountReceived7->created_at->format('d')}} tháng {{$amountReceived7->created_at->format('m')}} năm {{$amountReceived7->created_at->format('Y')}}</p>
								</div>

								<div class="col-lg-12 mt-3 nguoilap_phieu light-medium">
									<div class="text-center">
										<p class="font-weight-bold">Người lập phiếu</p>
										<p style="margin-top: -10px; font-style: italic;">(Ký, họ tên)</p>
										<h4 class="mt-4">{{getNameAccountByID($amountReceived7->account_paid) ?? ''}}</h4>
									</div>
								</div>

							</div>

						</div>