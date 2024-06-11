@extends('admins.layouts.master')

@section('title')
    Bán vé
@endsection

@section('style')
<style>


.content-detail__qty{
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
    margin:0;
    padding:0; 
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
<div class="content">
    <div class="card mb-3">
        <div class="container mb-2">
            <div class="row">
                <div class="col-6 d-flex">
                    <div class="col-3 mt-2 text-center text-uppercase p-1 bg-primary text-light" style="width: 130px; border-radius: 5px 5px 0 0;">
                        <a href="#" class="text-light">Soát vé</a>
                    </div>
                </div>
            </div>
            <form action="" method="POST" onsubmit="return false">
            @method('POST')
            @csrf
            <div class="d-flex" id="mbl_ticket_box">
                <div class="col-12 pl-0" id="mbl_ticket_sell_box">
                    <div class="p-1 pl-2 bg-primary text-light mbl_ttbv" style="border-radius: 0 5px 0 0;">Thông tin soát vé</div>
                    <div class="ml-3" id="_1">
                        <div class="row mt-1">
                            <div class="col-10 text-center">
                                <input type="text" name="cus_name" class="form-control" id="ticket_check">
                            </div>
                            <div class="col-2 text-center">
                                <button type="submit" name="cus_name" class=" form-control btn btn-primary" id="">Soát vé</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>

        <div class="container mb-3">
            <div class="mt-3">
                <div class="p-1 pl-2 bg-primary text-light" style="border-radius: 5px 5px 0 0;">
                    <span>Kết quả soát vé</span>
                </div>
                <div id="list_ticket_table">
                    
                </div>
            </div>
        </div>
        <!-- @include('admins.layouts.footer') -->
    </div>
</div>
@include('admins.layouts.footer')
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.js"></script>
<script>
    $(document).ready(function() {
    	$('#ticket_check').focus();
    });

    $('#ticket_check').on('change', function() {
    	var ticket_check_code = $('#ticket_check').val();

    	$.ajax({
            type: 'GET',

            data: {
                'ticket_check_code' : ticket_check_code,
            },

            url: '{{route('check.bill', ['username' => Str::slug(Auth::user()->name, '-') ?? ''])}}',

            success: function (data) {
            	$('#list_ticket_table').html(data);
                // console.log(data);
            	$('#ticket_check').val('');
            	$('#ticket_check').focus();
            	setCheckBill(ticket_check_code);
                // var filename = "result.txt";
                // var blob = new Blob([data], {
                //     type: "text/plain;charset=utf-8"
                // });

                // saveAs(blob, filename);
            },
            error: function (error) {

            }
        });
    });

    function setCheckBill(ticket_check_code) {
    	$.ajax({
            type: 'GET',

            data: {
                'ticket_check_code' : ticket_check_code,
            },

            url: '{{route('set.check.bill', ['username' => Str::slug(Auth::user()->name, '-') ?? ''])}}',

            success: function (data) {
            	$('#ticket_check').focus();
            },
            error: function (error) {

            }
        });
    }



    
</script>
@endsection
