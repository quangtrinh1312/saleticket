<div class="container shadow mt-4 bg-white">
    <div class="row bg-primary text-light p-1">
        <span>Tìm kiếm</span>
    </div>

    <form wire:submit.prevent="search" class="py-3">

    <div class="row px-2">

        <div class="col-lg-4 col-sm-6 col-12 mt-2">
            <div class="row">
                <div class="col-4 d-flex align-items-center justify-content-sm-end p-sm-0">
                    <label>Thông tin:</label>
                </div>
                <div class="col-8">
                    <input type="text" class="form-control form-input" wire:model.lazy="info">
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-sm-6 col-12 mt-2">
            <div class="row">
                <div class="col-4 d-flex align-items-center justify-content-sm-end p-sm-0">
                    <label>Chức vụ:</label>
                </div>
                <div class="col-8">
                    <select class="form-control crud-input" wire:model.lazy="role">
                        @foreach ($roles as $key => $role)
                        <option value="{{$role->id ?? 0}}">{{$role->name ?? ''}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-12 mt-2">
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-sm btn-primary text-uppercase px-5" style="height:31px">Tìm kiếm</button>
                </div>
            </div>
        </div>
        
    </div>

    </form>
</div>