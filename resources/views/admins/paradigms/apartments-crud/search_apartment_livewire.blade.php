<div>
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Tìm kiếm</legend>
        <form wire:submit.prevent="search">
            <div class="form-group">
                <div class="row align-items-center">
                    <div class="col-2">
                        <label for="apartment" class="float-right col-form-label">Tên chung cư</label>
                    </div>
                    <div class="col-7">
                        <input type="text" name="name" class="form-control form-control-sm" wire:model.lazy="apartmentName">
                        <input type="text" name="paradigm_id" wire:model.lazy="paradigmId" hidden>
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-success btn-sm" id="">
                            <i class="fa-solid fa-magnifying-glass mr-1"></i>
                            Tìm kiếm
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </fieldset>
</div>
