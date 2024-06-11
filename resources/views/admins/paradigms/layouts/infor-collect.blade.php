<div class="collect mt-3">
	<fieldset class="scheduler-border embed-responsive overflow-auto">
        <legend class="scheduler-border">Thông tin thu tiền</legend>
        <form action="{{route('post.paradigms.collect')}}" method="POST" >
        	@csrf
        	@method('POST')
        	<div class="row">
                @if ($paradigm_id == 1 || $paradigm_id == 5 || $paradigm_id == 6 || ($paradigm_id == 4 && $household_type == 1))
        		<div class="col-lg-6">
                        <div class="form-group">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <label for="" class=" col-form-label float-right">Khu chung cư:</label>
                                </div>
                                <div class="col-8">
                                    <label for="" class=" col-form-label ">{{getNameApartmentByID($householdInformation->apartment_id) ?? ''}}</label>
                                </div>
                            </div>
                        </div>
        		</div>
        		<div class="col-lg-6">
                        <div class="form-group">
                            <div class="row align-items-center">
                                <div class="col-4 float-right">
                                    <label for="" class="col-form-label float-right">Căn hộ:</label>
                                </div>
                                <div class="col-8">
                                    <label for="" class="col-form-label">{{getNameRoomByID($householdInformation->room_id) ?? ''}}</label>
                                </div>
                            </div>
                        </div>
        		</div>
                @elseif ($paradigm_id == 2 || $paradigm_id == 3 || $paradigm_id == 8 || ($paradigm_id == 4 && $household_type == 2) || $paradigm_id == 9)
                <div class="col-lg-6">
                        <div class="form-group">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <label for="" class=" col-form-label float-right">Quận/huyện:</label>
                                </div>
                                <div class="col-8">
                                    @if ($paradigm_id == 9)
                                    <select class="custom-select select" name="district_id"  id="select-district" onchange="getWard()" required>
                                        <option value=""></option>
                                        @if ($districts && count($districts) > 0)
                                            @foreach ($districts as $district)
                                                <option class="option_district" value="{{$district->id}}" {{isset($params['district_id']) ? $params['district_id'] == $district->id ? 'selected' : '' : ''}}>{{$district->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @else
                                    <label for="" class=" col-form-label ">{{getNameDistrictByID($householdInformation->district_id) ?? ''}}</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>

                <div class="col-lg-6">
                        <div class="form-group">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <label for="" class=" col-form-label float-right">Phường/xã:</label>
                                </div>
                                <div class="col-8">
                                    @if ($paradigm_id == 9)
                                    <select name="ward_id" id="select-ward" class="custom-select select" required>
                                        <option value=""></option>
                                        @if ($wards && count($wards) > 0)
                                            @foreach ($wards as $ward)
                                                <option class="option_ward" value="{{$ward->id}}" {{isset($params['ward_id']) ? $params['ward_id'] == $ward->id ? 'selected' : '' : ''}}>{{$ward->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @else
                                    <label for="" class=" col-form-label ">{{getNameWardByID($householdInformation->ward_id) ?? ''}}</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>

                <div class="col-lg-6">
                        <div class="form-group">
                            <div class="row align-items-center">
                                <div class="col-4 float-right">
                                    <label for="" class="col-form-label float-right">Đường:</label>
                                </div>
                                <div class="col-8">
                                    @if ($paradigm_id == 9)
                                    <input type="text" class="form-control" name="street" value="" placeholder="Nguyễn Công Hoan" required>
                                    @else
                                    <label for="" class="col-form-label">{{$householdInformation->street}}</label>
                                    <input type="text" class="form-control" name="street" value="{{$householdInformation->street ?? old('street')}}" placeholder="Nguyễn Công Hoan" required hidden>
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>

                <div class="col-lg-6">
                        <div class="form-group">
                            <div class="row align-items-center">
                                <div class="col-4 float-right">
                                    <label for="" class="col-form-label float-right">Số nhà:</label>
                                </div>
                                <div class="col-8">
                                    @if ($paradigm_id == 9)
                                    <input type="text" class="form-control" name="apartment_number" value="" placeholder="K111/12" required>
                                    @else
                                    <label for="" class="col-form-label">{{$householdInformation->apartment_number}}</label>
                                    <input type="text" class="form-control" name="apartment_number" value="{{$householdInformation->apartment_number ?? old('apartment_number')}}" placeholder="K111/12" required hidden>
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
                @else

                <div class="col-lg-6">
                        <div class="form-group">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <label for="" class=" col-form-label float-right">Khu KTX:</label>
                                </div>
                                <div class="col-8">
                                    <select name="dormitory_id" class="custom-select select" id="select-dor">
                                        <option></option>
                                        @if ($dors && count($dors) > 0)
                                            @foreach ($dors as $dor)
                                                <option class="option_dor" value="{{$dor->id}}" {{isset($params['dormitory_id']) ? $params['dormitory_id'] == $dor->id ? 'selected' : '' : ''}}>{{$dor->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>


                @endif
        		<div class="col-lg-6">
                        <div class="form-group">
                            <div class="row align-items-center">
                                <div class="col-4 float-right">
                                    <label for="" class="col-form-label float-right">Tên người nộp:</label>
                                </div>
                                <div class="col-8">
                                    @if ($paradigm_id == 9 || $paradigm_id == 7)
                                    <input type="text" class="form-control" id="input_fullname" name="fullname" value="" required onkeyup="validateForm()" onchange="validateForm()">
                                    @else
                                    <input type="text" class="form-control" id="input_fullname" name="fullname" value="{{$householdInformation->fullname ?? old('fullname')}}" required onkeyup="validateForm()" onchange="validateForm()">
                                    @endif
                                    @if ($errors->first('fullname'))
                                        <span class="text-danger k-error">{{ $errors->first('fullname') }}</span>
                                    @endif
                                    <span class="text-danger k-error" id="message_fullname"></span>
                                </div>
                            </div>
                        </div>
        		</div>

        		<div class="col-lg-6">
                        <div class="form-group">
                            <div class="row align-items-center">
                                <div class="col-4 float-right">
                                    <label for="" class="col-form-label float-right">Loại tiền:</label>
                                </div>
                                <div class="col-8">
                                   	<select name="type_price_id" class="custom-select select" id="select-type_price" required>
                                        <option></option>
                                        @if ($type_prices && count($type_prices) > 0)
                                            @foreach ($type_prices as $type_price)
                                                <option class="option_type_price" value="{{$type_price->id}}" {{isset($params['type_price_id']) ? $params['type_price_id'] == $type_price->id ? 'selected' : '' : ''}}>{{$type_price->type}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
        		</div>
        		<div class="col-lg-6">
                        <div class="form-group">
                            <div class="row align-items-center">
                                <div class="col-4 float-right">
                                    <label for="" class="col-form-label float-right">Nội dung:</label>
                                </div>
                                <div class="col-8">
                                   	<textarea type="text" class="form-control" name="content_bill_debt_month" required onkeyup="validateForm()" onchange="validateForm()">{{old('content_bill_debt_month')}}</textarea>
                                   	@if ($errors->first('content_bill_debt_month'))
                                        <span class="text-danger k-error">{{ $errors->first('content_bill_debt_month') }}</span>
                                    @endif
                                    <span class="text-danger k-error" id="message_content_bill_debt_month"></span>
                                </div>
                            </div>
                        </div>
        		</div>
                @if ($paradigm_id != 7)
        		<div class="col-lg-6">
                        <div class="form-group">
                            <div class="row align-items-center">
                                <div class="col-4 float-right">
                                    <label for="" class="col-form-label float-right">Nội dung nợ truy thu/bổ sung:</label>
                                </div>
                                <div class="col-8">
                                   	<textarea type="text" class=" form-control" name="content_bill_debt_additional_arrears" onkeyup="validateForm()" onchange="validateForm()">{{old('content_bill_debt_additional_arrears')}}</textarea>
                                   	@if ($errors->first('content_bill_debt_additional_arrears'))
                                        <span class="text-danger k-error">{{ $errors->first('content_bill_debt_additional_arrears') }}</span>
                                    @endif
                                    <span class="text-danger k-error" id="message_content_bill_debt_additional_arrears"></span>
                                </div>
                            </div>
                        </div>
        		</div>
                @endif
        		<div class="col-lg-6">
                        <div class="form-group">
                            <div class="row align-items-center">
                                <div class="col-4 float-right">
                                    <label for="" class="col-form-label float-right">Hình thức thanh toán:</label>
                                </div>
                                <div class="col-8">
                                   	<select name="pay_method_id" id="pay_method_id_select" class="custom-select" onchange="getInputCollect(this.value)">
                                   		
                                   	
                                   	@if ($payMethods && count($payMethods) > 0)
                                        @foreach ($payMethods as $payMethod)
                                            <option class="option_payMethod" value="{{$payMethod->id}}">{{$payMethod->title}}</option>
                                        @endforeach
                                    @endif
                                    </select>
                                </div>
                            </div>
                        </div>
        		</div>
        		<div class="col-lg-6" id="input_price_transfer">
                        <div class="form-group">
                            <div class="row align-items-center">
                                <div class="col-4 float-right">
                                    <label for="" class="col-form-label float-right">Chuyển khoản:</label>
                                </div>
                                <div class="col-8">
                                    <input type="number" min="1000" value="" class="form-control" name="price_transfer" id="price_transfer" required onkeyup="sumPriceCollect()" onchange="sumPriceCollect()">
                                </div>
                            </div>
                        </div>
        		</div>

        		<div class="col-lg-6" id="input_price_cash">
                        <div class="form-group">
                            <div class="row align-items-center">
                                <div class="col-4 float-right">
                                    <label for="" class="col-form-label float-right">Tiền mặt:</label>
                                </div>
                                <div class="col-8">
                                    <input type="number" value="" min="1000" class="form-control" name="price_cash" id="price_cash" required onkeyup="sumPriceCollect()" onchange="sumPriceCollect()">
                                </div>
                            </div>
                        </div>
        		</div>

        		<div class="col-lg-6">
                        <div class="form-group">
                            <div class="row text-right">
                                <div class="col-12 float-right">
                                    <label for="" class="col-form-label">Tổng tiền: <span id="label_sum_price">0</span> đồng</label>
                                </div>
                                <div class="col-12 float-right">
                                    <label for="" class="col-form-label">Bằng chữ: <span id="label_sum_word">Năm trăm nghàn</span> đồng</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row align-items-center">
                                <div class="col-12">
                                <input type="text" name="apartment_id" value="{{$householdInformation->apartment_id ?? 0}}" hidden>
                                <input type="text" name="room_id" value="{{$householdInformation->room_id ?? 0}}" hidden>
                                @if($paradigm_id != 9)
                                <input type="text" name="district_id" value="{{$householdInformation->district_id ?? 0}}" hidden>
                                <input type="text" name="ward_id" value="{{$householdInformation->ward_id ?? 0}}" hidden>
                                @endif
                        		<input type="text" name="paradigm_id" value="{{$paradigm_id ?? 0}}" hidden>
                                <input type="text" data-id="household_type" name="household_type" value="{{$household_type ?? 0}}" hidden>
                        		@if ($paradigm_id !=7 && $paradigm_id != 9)
                                <input type="text" name="household_information_id" value="{{$householdInformation->id}}" hidden>
                                @endif
                        		<input type="text" name="url" value="{{url()->full()}}" hidden>
                                <button type="submit" id="submit_collect" class="btn btn-primary float-right" disabled>Xác nhận thu tiền</button>
                                </div>
                            </div>
                        </div>
        		</div>
            </div>
        </form>
    </fieldset>
</div>