@extends('admins.layouts.master')

@section('title')
    Loại vé
@endsection

@section('style')
<style>

label {
    margin: 0;
    padding: 0;
}

.input-box {
    width: 231px;
    padding-left: .5rem;
}

.form-input {
    width: 100%;
    height: 31px;
    /* background: rgb(246, 246, 246);
    border: 1px solid #00000033; */
    border-radius: 0;
    padding: 0 0 0 .5rem;
}

.table-wrapper::-webkit-scrollbar {
    width: 0;
    height: .5rem;
}

table th,
table td {
    text-align: center;
    white-space: nowrap;
}

table th {
    position: sticky;
}


    @media only screen and (min-width: 62em) and (max-width: 74.9375em) {
        .input-box {
            width: 200px;
        }

    }

    @media only screen and (max-width: 61.89em) {
        .input-box {
            flex: 1;
        }

        .label-box {
            width: 150px;
        }
    }


</style>
@endsection

@section('content')

    @include('admins.layouts.header')

    <div class="container-fluid" style="flex:1;">

        @livewire('ticket-type.ticket-type-search')

        @livewire('ticket-type.ticket-type-list')

    </div>

    @livewire('ticket-type.ticket-type-crud')

    @include('admins.layouts.footer')

@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection