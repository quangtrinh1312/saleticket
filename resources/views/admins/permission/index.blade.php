@extends('admins.layouts.master')

@section('quyền hạn')
    Quyền hạn
@endsection

@section('style')
    <style>
        #printJS-bill,
        #printJS-bill1 {
            visibility: hidden;
            position: absolute;
            top: -100000px;
        }

        .content {
            position: relative;
        }

        .content-detail__qty {
            display: flex;
            justify-content: start;

        }

        .content-detail__qty .content-detail__qty--btn {

            width: 30px;
            height: 30px;
            background-color: #CCCCCC;
            border: none;
            cursor: pointer;

        }


        .content-detail__qty .input_qty {
            width: 100%;
            text-align: center;
            border: none;
            outline: none;

        }

        .content-detail__qty .input_qty {
            width: 100%;
            text-align: center;
            border: none;

        }

        .content-detail__qty .content-detail__qty--btn i {
            opacity: 0.5;
            font-weight: 600 !important;
            font-size: 16px;
        }

        .content-detail__qty .content-detail__qty--btn:active {
            transform: translate3d(1px, 0px, 1px)
        }


        .content-detail__qty .input_qty[type="number"]::-webkit-inner-spin-button,
        .content-detail__qty .input_qty[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        label {
            margin: 0;
            padding: 0;
        }

        .input-right {
            width: 10rem;
            height: 1.8rem;
            padding-top: 0;
            padding-bottom: 0;
        }

        button.btn-square {
            width: 1.5rem;
            height: 1.5rem;
            font-size: .8rem;
            padding: 0;
        }

        @media only screen and (min-width: 992px) and (max-width: 1199px) {
            .input-right {
                width: 9rem;
            }

        }

        @media only screen and (min-width: 769px) and (max-width: 991px) {
            .input-right {
                width: 25rem;
            }
        }

        @media only screen and (min-width: 576px) and (max-width: 768px) {
            .input-right {
                width: 18rem;
            }
        }

        @media only screen and (max-width: 575px) {
            .input-right {
                width: 40vw;
            }
        }
    </style>
@endsection

@section('content')
    @include('admins.layouts.header')
    <!-- make button possition right -->
    <style>
        .btn-primary {
            float: right;
        }
    </style>

    <div class="container-fluid">

    </div>
    <div class="container-fluid" style="flex:1;">
        <div class="container mt-4">
            @include('admins.permission.crud.pagination')
        </div>
    </div>
    @include('admins.permission.modal.modal_detail_permission')
    @include('admins.permission.modal.modal_create_role_with_permissions_default')
    @include('admins.layouts.footer')
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <script>
        function switchAllCheck() {
            var permissions_id = [];
            //get all id of checkbox
            var oTable = document.getElementById('list_permission_table_data');
            //gets rows of table
            var rowLength = oTable.rows.length;
            //loops through rows
            for (i = 0; i < rowLength; i++) {
                //gets cells of current row
                var oCells = oTable.rows.item(i).cells;
                //gets amount of cells of current row
                var cellLength = oCells.length;
                //loops through each cell in current row
                var j = 2; //cells[2] is checkbox
                // get your cell info here
                permissions_id.push(oCells.item(j).childNodes[0].value);
                //console.log(oCells.item(j).childNodes[0].value);
            }

            let numRow = document.getElementById('list_permission_table_data').rows.length;
            if (document.getElementById('all_checkbox').checked == false) {
                for (var i = 1; i <= rowLength; i++) {
                    let currentElement = document.getElementById('permission_' + i);
                    if (currentElement.checked == true) {
                        currentElement.checked = false;
                    }
                }
            } else {
                for (var i = 1; i <= rowLength; i++) {
                    let currentElement = document.getElementById('permission_' + i);
                    if (currentElement.checked == false) {
                        currentElement.checked = true;
                    }
                }
            }
        }

        function switchCheck() {
            if (document.getElementById('all_checkbox').checked) {
                document.getElementById('all_checkbox').checked = false;
            } else {
                document.getElementById('all_checkbox').checked = true;
            }
        }

        function showCreateRole(allPermissions) {
            clearContentById('list_permission_default_table_data')
            allPermissions = JSON.parse(allPermissions);
            for (var i = 0; i < allPermissions.length; i++) {
                //create a new row
                var newRow = $("<tr>");
                //create a new cell
                var cols = "";
                cols += '<td>' + (i + 1) + '</td>';
                cols += '<td>' + allPermissions[i].name + '</td>';
                //create a new cell with checkbox button
                cols += '<td><input type="checkbox" id="permission_default_' + allPermissions[i].id +
                    '" name="permission_default_' +
                    allPermissions[i].id + '" value="' + allPermissions[i].id + '"' + +'></td>';
                //end of row
                newRow.append(cols);
                $("#list_permission_default_table_data").append(newRow);
            }
        }

        function saveCreateRole() {
            var role_name = document.getElementById('newRoleName').value;
            if (role_name == '') {
                alert('Tên role không được để trống');
                return;
            }
            //do you want to add this role if yes then continue else break this function
            var r = confirm("Do you want to add this role?");
            if (r == false) {
                return;
            }
            let permissions_id = [];
            //gets table
            var oTable = document.getElementById('list_permission_default_table_data');
            //gets rows of table
            var rowLength = oTable.rows.length;
            //loops through rows
            for (i = 0; i < rowLength; i++) {
                //gets cells of current row
                var oCells = oTable.rows.item(i).cells;
                //gets amount of cells of current row
                var cellLength = oCells.length;
                //loops through each cell in current row
                var j = 2; //cells[2] is checkbox
                // get your cell info here
                if (j == 2) {
                    var cellVal = oCells.item(j).childNodes[0].checked;
                    //console.log full html of cell j
                    // console.log(oCells.item(j).childNodes[0]);
                    if (cellVal) {
                        permissions_id.push(oCells.item(j).childNodes[0].value);
                    }
                }
            }
            var role_name = document.getElementById('newRoleName').value;
            //console.log(role_name);
            // send ajax to server
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '{{ route('post.createRoleWithPermission') }}',
                data: {
                    role_name: role_name,
                    permissions_id: permissions_id,
                },
                success: function(data) {
                    //console.log(data);
                }
            });
            //reload page to see new role delay 0.5s
            setTimeout(function() {
                location.href = location.href
            }, 500);
        }

        function showPermission(id, roleName) {
            clearContentById('list_permission_table_data')
            //get ajax to server
            let url = '{{ route('get.getPermissionByRoleId', ':id') }}';
            $.ajax({
                type: 'GET',
                url: url.replace(':id', id),
                data: {
                    'role_id': id,
                },
                success: function(data) {
                    //coppy data[1] to checkList
                    var checkList = JSON.parse(JSON.stringify(data[1]));
                    for (var i = 0; i < checkList.length; i++) {
                        for (var j = 0; j < data[0].length; j++) {
                            if (data[0][j].id == -1) continue;
                            if (checkList[i].id == data[0][j].id) {
                                checkList[i].id = -1;
                                data[0][j].id = -1;
                            }
                        }
                    }
                    //console.log(checkList);
                    //data[0] is list permission of role and [1] is list allPermission
                    for (var i = 0; i < data[1].length; i++) {
                        var newRow = $("<tr>");
                        var cols = "";
                        cols += '<td>' + (i + 1) + '</td>';
                        cols += '<td>' + data[1][i].name + '</td>';
                        cols += '<td>' + '<input type = "checkbox" id="permission_' + data[1][i].id +
                            '" name="permission_' + data[1][i].id + '" value="' + data[1][i].id +
                            '" ' + (checkList[i].id == -1 ? 'checked' : '') + ' >' + '</td>'
                        newRow.append(cols);
                        $("#list_permission_table_data").append(newRow);
                        document.getElementById('roleNameModalLongTitle').innerHTML = roleName;
                        document.getElementById('roleId').value = id;
                    }
                }
            });
            // //convert string to array
            // rolesWithPermission = JSON.parse(rolesWithPermission);
            // allPermissions = JSON.parse(allPermissions);
            // // document.getElementById('roleNameModalLongTitle').value = roleName;
            // for (var i = 0; i < allPermissions.length; i++) {
            //     //create a new row
            //     var newRow = $("<tr>");
            //     //create a new cell
            //     var cols = "";
            //     cols += '<td>' + (i + 1) + '</td>';
            //     cols += '<td>' + allPermissions[i].name + '</td>';
            //     //create a new cell with checkbox button
            //     cols += '<td><input type="checkbox" id="permission_' + allPermissions[i].id + '" name="permission_' +
            //         allPermissions[i].id + '" value="' + allPermissions[i].id + '"' + +'></td>';
            //     //end of row
            //     newRow.append(cols);
            //     $("#list_permission_table_data").append(newRow);
            // }
            // //find if role has permission
            // for (var i = 0; i < allPermissions.length; i++) {
            //     for (var j = 0; j < rolesWithPermission.length; j++) {
            //         if (allPermissions[i].id == rolesWithPermission[j].id) {
            //             document.getElementById('permission_' + allPermissions[i].id).checked = true;
            //         }
            //     }
            // }
            // document.getElementById('roleNameModalLongTitle').innerHTML = roleName;
            // document.getElementById('roleId').value = id;
        }

        function clearContentById(id) {
            document.getElementById(id).innerHTML = '';
        }

        function saveChangePermission() {

            //do you want to save change permission if yes then continue else break this function
            var r = confirm("Do you want to save change permission?");
            if (r == false) {
                return;
            }
            var permissions_id = [];
            //gets table
            var oTable = document.getElementById('list_permission_table_data');
            //gets rows of table
            var rowLength = oTable.rows.length;
            //loops through rows
            for (i = 0; i < rowLength; i++) {
                //gets cells of current row
                var oCells = oTable.rows.item(i).cells;
                //gets amount of cells of current row
                var cellLength = oCells.length;
                //loops through each cell in current row
                var j = 2; //cells[2] is checkbox
                // get your cell info here
                if (j == 2) {
                    var cellVal = oCells.item(j).childNodes[0].checked;
                    //console.log full html of cell j
                    // console.log(oCells.item(j).childNodes[0]);
                    if (cellVal) {
                        permissions_id.push(oCells.item(j).childNodes[0].value);
                    }
                }
            }
            var role_id = document.getElementById('roleId').value;
            //send ajax to server
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '{{ route('post.UpdatePermission') }}',
                data: {
                    role_id: role_id,
                    permissions_id: permissions_id,
                },
                success: function(data) {
                    //  console.log(data); //data[0] is id of role will update on role table, else is list permission of role
                    let table = document.getElementById('list_role_table_data');
                    let rows = table.getElementsByTagName('tr');
                    let rowNum;
                    for (let i = 0; i < rows.length; i++) {
                        let role_id_temp = rows[i].querySelector('input[name="role_id"]');
                        if (role_id_temp.value == data[0]) {
                            rowNum = i + 1;
                            break;
                        }
                    }
                    //console.log(data[1]);
                    let finger = document.getElementById('listPermissionOf_' + rowNum);
                    finger.innerHTML = '';
                    for (let i = 0; i < data[1].length; i++) {
                        let span = document.createElement('span');
                        span.className = 'badge badge-primary mr-1';
                        span.innerHTML = data[1][i].name;
                        // span.style.marginRight = '3px';
                        finger.appendChild(span);
                    }
                }
            });
        }
    </script>
@endsection