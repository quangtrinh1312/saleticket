<div class="row">
	@if ($paradigm_id == 1 || $paradigm_id == 5 || $paradigm_id == 6 || ($paradigm_id == 4 && $household_type == 1))
	<div class="col-lg-4">
		<div class="col-lg-12">
            <div class="form-group">
                <div class="row align-items-center">
                    <div class="col-4">
                        <label for="" class=" col-form-label float-right">Khu chung cư:</label>
                    </div>
                    <div class="col-8">
                        
                        <select class="custom-select select" name="apartment_id" onchange="getRoom()"  id="select-apartment">
                        	<option></option>
                            @if ($apartments && count($apartments) > 0)
                                @foreach ($apartments as $apartment)
                                     <option class="option_apartment" value="{{$apartment->id}}" {{isset($params['apartment_id']) ? $params['apartment_id'] == $apartment->id ? 'selected' : '' : ''}}>{{$apartment->name}}</option>
                                @endforeach
                            @endif
                    	</select>
                    </div>
                </div>
            </div>
        </div>
	</div>

	<div class="col-lg-4">
		<div class="col-lg-12">
            <div class="form-group">
                <div class="row align-items-center">
                    <div class="col-4">
                        <label for="" class="col-form-label float-right">Căn hộ:</label>
                    </div>
                    <div class="col-8">
                        <select class="custom-select select" name="room_id"  id="select-room">
                        	<option></option>
                            @if ($rooms && count($rooms) > 0)
                                @foreach ($rooms as $room)
                                     <option class="option_room" value="{{$room->id}}" {{isset($params['room_id']) ? $params['room_id'] == $room->id ? 'selected' : '' : ''}}>{{$room->name}}</option>
                                @endforeach
                            @endif
                    	</select>
                    </div>
                </div>
            </div>
        </div>
	</div>
	@elseif ($paradigm_id == 2 || $paradigm_id == 3 || $paradigm_id == 8 || ($paradigm_id == 4 && $household_type == 2) || $paradigm_id == 9)

	<div class="col-lg-4">
		<div class="col-lg-12">
	        <div class="form-group">
	            <div class="row align-items-center">
	                <div class="col-4">
	                    <label for="" class=" col-form-label float-right">Quận/huyện:</label>
	                </div>
	                <div class="col-8">
	                    <select class="custom-select select" name="district_id"  id="select-district" onchange="getWard()">
	                        <option value=""></option>
	                        @if ($districts && count($districts) > 0)
	                            @foreach ($districts as $district)
	                                <option class="option_district" value="{{$district->id}}" {{isset($params['district_id']) ? $params['district_id'] == $district->id ? 'selected' : '' : ''}}>{{$district->name}}</option>
	                            @endforeach
	                        @endif
	                    </select>
	                </div>
	            </div>
	        </div>
	    </div>
    </div>

    <div class="col-lg-4">
    	<div class="col-lg-12">
	        <div class="form-group">
	            <div class="row align-items-center">
	                <div class="col-4">
	                    <label for="" class=" col-form-label float-right">Phường/xã:</label>
	                </div>
	                <div class="col-8">
	                    <select name="ward_id" id="select-ward" class="custom-select select">
	                        <option value=""></option>
	                        @if ($wards && count($wards) > 0)
	                            @foreach ($wards as $ward)
	                                <option class="option_ward" value="{{$ward->id}}" {{isset($params['ward_id']) ? $params['ward_id'] == $ward->id ? 'selected' : '' : ''}}>{{$ward->name}}</option>
	                            @endforeach
	                        @endif
	                    </select>
	                </div>
	            </div>
	        </div>
	    </div>
    </div>

    <div class="col-lg-4">
		<div class="col-lg-12">
            <div class="form-group">
                <div class="row align-items-center">
                    <div class="col-4 float-right">
                        <label for="" class="col-form-label float-right">Đường:</label>
                    </div>
                    <div class="col-8">
                        <input type="text" class="form-control" name="street" value="{{$params['street'] ?? ''}}" placeholder="Nguyễn Công Hoan">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
    	<div class="col-lg-12">
            <div class="form-group">
                <div class="row align-items-center">
                    <div class="col-4 float-right">
                        <label for="" class="col-form-label float-right">Số nhà:</label>
                    </div>
                    <div class="col-8">
                        <input type="text" class="form-control" name="apartment_number" value="{{$params['apartment_number'] ?? ''}}" placeholder="K111/12">
                    </div>
                </div>
            </div>
        </div>
    </div>

	@else
	@endif
	<div class="col-lg-4">
		<div class="col-lg-12">
            <div class="form-group">
                <div class="row align-items-center">
                    <div class="col-4">
                        <label for="" class="col-form-label float-right">Tên hộ dân: </label>
                    </div>
                    <div class="col-8">
                        <input type="text" class="form-control" id="" name="fullname" value="{{$params['fullname'] ?? old('fullname')}}" >
                    </div>
                </div>
            </div>
        </div>
	</div>
	<input type="text" data-id="paradigm_id" name="paradigm_id" value="{{$paradigm_id ?? 0}}" hidden>
	<input type="text" data-id="household_type" name="household_type" value="{{$household_type ?? 0}}" hidden>
	<div class="col-lg-12">
        <button type="submit" class="btn btn-success btn-sm float-right" id="">
            <i class="fa-solid fa-magnifying-glass mr-1"></i>
            Tìm kiếm
        </button>
    </div>
</div>