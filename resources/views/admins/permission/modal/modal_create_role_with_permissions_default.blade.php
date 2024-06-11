<!-- Modal -->
<div class="modal fade" id="CreateRoleWithPermissionModalLong" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tạo role mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div>
                <center>
                    Tên role: <input type="text" id="newRoleName" name="NewRoleName" value=""
                        placeholder="Tên Role">
                </center>

            </div>
            <div class="modal-body">
                <table class="table table-hover table-dark table-striped mb-1 table-bordered"
                    id="permissionDefaultTable">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">STT</th>
                            <th scope="col" class="text-center">Quyền hạn</th>
                            <th scope="col" class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="list_permission_default_table_data">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveCreateRole()" type="submit">Save
                    changes</button>
            </div>
        </div>
    </div>
</div>
