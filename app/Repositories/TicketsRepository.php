<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Ticker;
use Illuminate\Http\Request;

class TicketsRepository extends AbstractRepository
{
    public function getModel()
    {
        return Ticker::class;
    }

    public function getListPaginatesByUserID($user_id, $paginate) {

        return $this->model->where('user_id', $user_id)->orderBy('id', 'DESC')->paginate($paginate);

    }

    public function getTicketsByParams($user_id, $params) {
        $tickets = Ticker::where('user_id', $user_id);

        if (isset($params['from_date']) && $params['from_date'] != '') {

            $from_datetime = $params['from_date'];

            if (isset($params['from_time_hour']) && $params['from_time_hour'] != '') {
                $minute = 0;
                if (isset($params['from_time_minute']) && $params['from_time_minute'] != '') {
                    $minute = $params['from_time_minute'];
                }
                $from_datetime =  Carbon::createFromFormat('Y-m-d H:i:s',  strval($params['from_date'].' 00:00:00'))
                                ->addHours($params['from_time_hour'])
                                ->addMinutes($minute)
                                ->toDateTimeString();
                $tickets->where('created_at', '>=', $from_datetime);
            }else{
                $tickets->whereDate('created_at', '>=', $from_datetime);
            }

        }

        if (isset($params['to_date']) && $params['to_date'] != '') {

            $from_datetime = $params['to_date'];

            if (isset($params['to_time_hour']) && $params['to_time_hour'] != '') {
                $minute = 0;
                if (isset($params['to_time_minute']) && $params['to_time_minute'] != '') {
                    $minute = $params['to_time_minute'];
                }
                $from_datetime =  Carbon::createFromFormat('Y-m-d H:i:s',  strval($params['to_date'].' 00:00:00'))
                                ->addHours($params['to_time_hour'])
                                ->addMinutes($minute)
                                ->toDateTimeString();
                $tickets->where('created_at', '<=', $from_datetime);
            }else{
                $tickets->whereDate('created_at', '<=', $from_datetime);
            }

        }

        if (isset($params['status']) && $params['status'] != null) {
            $tickets->where('status_id', $params['status']);
        }

        return $tickets->orderBy('id', 'DESC')->paginate(20);
    }

    public function getTicketsByNumberBill($number_bill) {
        return $this->model->whereIn('number_bill_number', $number_bill)->get();
    }

    public function updateCheckBill($id) {
        return $this->model->where('id', $id)->update(['check' => 2]);
    }

    public function getListPaginatesByParams($params) {
        $data = $this->model->select();
        if (isset($params['date_start']) && $params['date_start'] != '') {

            $data->whereDate('created_at', '>=' , $params['date_start']);

        }

        if (isset($params['date_end']) && $params['date_end'] != '') {

            $data->whereDate('created_at', '<=' , $params['date_end']);

        }

        if (isset($params['month']) && $params['month'] != '') {

            $data->whereMonth('created_at', '<=' , $params['month']);

        }

        if (isset($params['year']) && $params['year'] != '') {

            $data->whereYear('created_at', '<=' , $params['year']);

        }

        if (isset($params['user_id']) && $params['user_id'] != '') {

            $data->where('user_id', $params['user_id']);

        }
        if (isset($params['ticker_group_id']) && $params['ticker_group_id'] != '') {

            $data->where('ticker_group_id', $params['ticker_group_id']);

        }
        $data = $data->orderBy('id', 'DESC')->paginate(50);

        return $data;
    }

    public function getSumByParams($params) {
        $data = $this->model->select();
        if (isset($params['date_start']) && $params['date_start'] != '') {

            $data->whereDate('created_at', '>=' , $params['date_start']);

        }

        if (isset($params['date_end']) && $params['date_end'] != '') {

            $data->whereDate('created_at', '<=' , $params['date_end']);

        }

        if (isset($params['month']) && $params['month'] != '') {

            $data->whereMonth('created_at', '=' , $params['month']);

        }

        if (isset($params['year']) && $params['year'] != '') {

            $data->whereYear('created_at', '=' , $params['year']);

        }

        if (isset($params['user_id']) && $params['user_id'] != '') {

            $data->where('user_id', $params['user_id']);

        }
        $data = $data->sum('price');

        return $data;
    }

    public function getListByArrGroup($arr_id){
        return $this->model->select('prod_name')->selectRaw('COUNT("prod_name") as number')->selectRaw('SUM("price") as price')->whereIn('ticker_group_id', $arr_id)->groupBy('prod_name')->get();
    }

    public function getNumberByParams($params){
        $data = $this->model->select('prod_name')->selectRaw('count("prod_name") as number')->selectRaw('sum("price") as price');
        if (isset($params['date_start']) && $params['date_start'] != '') {

            $data->whereDate('created_at', '>=' , $params['date_start']);

        }

        if (isset($params['date_end']) && $params['date_end'] != '') {

            $data->whereDate('created_at', '<=' , $params['date_end']);

        }

        if (isset($params['month']) && $params['month'] != '') {

            $data->whereMonth('created_at', '<=' , $params['month']);

        }

        if (isset($params['year']) && $params['year'] != '') {

            $data->whereYear('created_at', '<=' , $params['year']);

        }

        if (isset($params['user_id']) && $params['user_id'] != '') {

            $data->where('user_id', $params['user_id']);

        }
        if (isset($params['ticker_group_id']) && $params['ticker_group_id'] != '') {

            $data->where('ticker_group_id', $params['ticker_group_id']);

        }
        $data->groupBy('prod_name');

        return $data->get();
    }
}
