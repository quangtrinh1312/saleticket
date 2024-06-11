<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roleNameModalLongTitle">Modal title</h5>
                <input type="hidden" id="roleId" name="roleId" value="">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover table-dark table-striped mb-1 table-bordered" id="permissionTable">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">STT</th>
                            <th scope="col" class="text-center">Quyền hạn</th>
                            <th scope="col" class="text-center">Thao tác <input type="checkbox" id="all_checkbox" onclick="switchAllCheck()"></th>
                        </tr>
                    </thead>
                    <tbody id="list_permission_table_data">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveChangePermission()">Save changes</button>
            </div>
        </div>
    </div>
</div>