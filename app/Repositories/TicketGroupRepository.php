<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\TickerGroup;
use Illuminate\Http\Request;

class TicketGroupRepository extends AbstractRepository
{
    public function getModel()
    {
        return TickerGroup::class;
    }

    public function getListPaginatesByUserID($user_id, $paginate) {

        return $this->model->where('user_id', $user_id)->orderBy('id', 'DESC')->paginate($paginate);

    }

    public function getByQr($qr_radom) {
        return $this->model->where('qr_radom', $qr_radom)->first();
    }

    public function getTicketsByParams($params) {
        $tickets = $this->model->select();

        if (isset($params['user_id']) && $params['user_id'] != 0) {
            $tickets->where('user_id', $params['user_id']);
        }

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
        return $tickets->orderBy('id', 'DESC');
    }




}
