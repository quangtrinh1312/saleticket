<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\TicketType;
use Illuminate\Http\Request;
use App\Models\Ticker;

class TicketTypeRepository extends AbstractRepository
{
    public function getModel()
    {
        return TicketType::class;
    }

    public function getTicketByActive() {
    	return $this->model->where('is_actived', 1)->get();
    }

    public function getListPaginatesByUserID($user_id, $paginate) {

        return $this->model->where('user_id', $user_id)->orderBy('id', 'DESC')->paginate($paginate);

    }

    public function getTicketsByParams($user_id, $params) {
        $tickets = Ticker::where('user_id', $user_id);

        if (isset($params['from_date']) && $params['from_date'] != null ) {
            $from_datetime =  Carbon::createFromFormat('Y-m-d H:i:s',  strval($params['from_date'].' 00:00:00'))
                                ->addHours($params['from_time_hour'])
                                ->addMinutes($params['from_time_minute'])
                                ->toDateTimeString();
        
            $tickets->where('created_at', '>=', $from_datetime);
        }

        if (isset($params['to_date']) && $params['to_date'] != null ) {
            $to_datetime =  Carbon::createFromFormat('Y-m-d H:i:s',  strval($params['to_date'].' 00:00:00'))
                                ->addHours($params['to_time_hour'])
                                ->addMinutes($params['to_time_minute'])
                                ->toDateTimeString();
            
            $tickets->where('created_at', '<=', $to_datetime);
        }

        if (isset($params['status']) && $params['status'] != null) {
            $tickets->where('status_id', $params['status']);
        }

        return $tickets->paginate(20);
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
        $data = $data->paginate(50);

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
}
