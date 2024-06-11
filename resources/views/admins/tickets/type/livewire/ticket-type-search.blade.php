<div class="container shadow mt-4 bg-white">
    <div class="row bg-primary text-light p-1">
        <span>Tìm kiếm</span>
    </div>

    <form wire:submit.prevent="search" class="py-3">

    <div class="row px-2">

        <div class="col-lg-3 col-sm-6 col-12 mt-2">
            <div class="row">
                <div class="col-4 d-flex align-items-center justify-content-sm-end p-sm-0">
                    <label>Tên loại vé:</label>
                </div>
                <div class="col-8">
                    <input type="text" class="form-control form-input" wire:model.lazy="name">
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-sm-6 col-12 mt-2">
            <div class="row">
                <div class="col-4 d-flex align-items-center justify-content-sm-end p-sm-0">
                    <label>Giá vé:</label>
                </div>
                <div class="col-8">
                    <input type="text" class="form-control form-input number-separator" wire:model.lazy="price">
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-sm-6 col-12 mt-2">
            <div class="row">
                <div class="col-4 d-flex align-items-center justify-content-sm-end p-sm-0">
                    <label>Mẫu số:</label>
                </div>
                <div class="col-8">
                    <input type="text" class="form-control form-input" wire:model.lazy="pattern">
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-sm-6 col-12 mt-2">
            <div class="row">
                <div class="col-4 d-flex align-items-center justify-content-sm-end p-sm-0">
                    <label>Ký hiệu:</label>
                </div>
                <div class="col-8">
                    <input type="text" class="form-control form-input" wire:model.lazy="serial">
                </div>
            </div>
        </div>
        

    </div>
    <div class="row mt-2">
        <div class="col-12 d-flex justify-content-center">
            <button type="submit" class="btn btn-sm btn-primary text-uppercase rounded-0" style="width:14rem;padding: 3px 0;">Tìm kiếm</button>
        </div>
    </div>

    </form>
</div>