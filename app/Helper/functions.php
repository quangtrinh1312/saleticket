<?php

use App\Models_12345\Apartment;
use App\Models_12345\DetailPrice;
use App\Models_12345\User;
use App\Models_12345\Room;
use App\Models_12345\Year;
use App\Models_12345\TypePrice;
use App\Models\Ward;
use App\Models\Ticker;
use App\Models\TickerGroup;
use App\Models\Config;
use Bluerhinos\phpMQTT;
use App\Models\PaymentMethod;
use App\Models_12345\Month;

if (!function_exists('getMonth')) {

	function getMonth() {

		$months	= new Month;

		$months = $months->get();

		return $months;

	}

}

if (!function_exists('getYear')) {

	function getYear() {

		$years	= new Year;

		$years = $years->get();

		return $years;

	}

}

if (!function_exists('getTypePrice')) {

	function getTypePrice() {

		$type_price	= new TypePrice;

		$type_price = $type_price->get();

		return $type_price;

	}

}

if (!function_exists('getApartment')) {

	function getApartment() {

		$apartments	= new Apartment;

		$apartments = $apartments->withTrashed()->get();

		return $apartments;

	}

}

if (!function_exists('getDetailPriceByUserID')) {

	function getDetailPriceByUserID($user_room_id = null, $user_id, $code_room) {


		$detail_prices	= new DetailPrice;

		$detail_prices = $detail_prices->select('user_id', 'user_room_id', 'code_room', 'year_id', 'month_id', 'type_policy_id', 'policy_id', 'type_price_id', 'picre_after_confirm');

		if (isset($user_room_id) && $user_room_id != null) {

			$detail_prices->where('user_room_id', $user_room_id);

		}

		$detail_prices->where('code_room', $code_room);

		$detail_prices = $detail_prices->where('user_id', $user_id)
		->groupBy('user_id', 'user_room_id', 'code_room', 'year_id', 'month_id', 'type_policy_id', 'policy_id', 'type_price_id', 'picre_after_confirm')
		->get();

		$sum_price = getSumPrice($detail_prices);

		return $sum_price;

	}

}

if (!function_exists('getDetailPriceByID')) {

	function getDetailPriceByID($id) {

		$detail_price	= new DetailPrice;

		$detail_price = $detail_price->where('id', $id)->first();

		return $detail_price;

	}

}

if (!function_exists('getSumPrice')) {

	function getSumPrice($detail_prices) {

		$sum_price = 0;

		$part_price_sum = 0;

		foreach ($detail_prices as $key => $value) {

			$detail_price = getDetailPriceByCodeRoomUserIDMonthIDYearIDFull($value);

			$part_price_sum = getSumPartPrice($detail_price->user_room_id, $detail_price->user_id, $detail_price->month_id, $detail_price->year_id, $detail_price->policy_id, $detail_price->type_price_id, $detail_price->type_policy_id, $detail_price->code_room, $detail_price->picre_after_confirm);
			
			if ($detail_price->status != 1) {
				if ($detail_price->policy_id != 0) {
					$sum_price = $sum_price + $detail_price->price_after_policy - $part_price_sum;
				}
				else if ($detail_price->price_after != 0)
				{
					$sum_price = $sum_price + $detail_price->price_after - $part_price_sum;
				}
				else
				{
					$sum_price = $sum_price + $detail_price->price_default - $part_price_sum;
				}
			}

		}

		

		return $sum_price;

	}

}

if (!function_exists('getSumPartPrice')) {

	function getSumPartPrice($user_room_id, $user_id, $month_id, $year_id, $policy_id, $type_price_id, $type_policy_id, $code_room, $picre_after_confirm) {

		$detail_price = new DetailPrice;

		$detail_price = $detail_price->select('user_id', 'user_room_id', 'code_room', 'year_id', 'month_id', 'type_policy_id', 'policy_id', 'type_price_id', 'picre_after_confirm');

		$detail_price->where([

			'user_room_id' => $user_room_id,
			'user_id' => $user_id,
			'month_id' => $month_id,
			'year_id' => $year_id,
			'policy_id' => $policy_id,
			'type_price_id' => $type_price_id,
			'type_policy_id' => $type_policy_id,
			'code_room' => $code_room,
			'picre_after_confirm' => $picre_after_confirm

		]);

		$detail_price = $detail_price->selectRaw('sum(part_price) as sum_price_part')
		->groupBy('user_id', 'user_room_id', 'code_room', 'year_id', 'month_id', 'type_policy_id', 'policy_id', 'type_price_id', 'picre_after_confirm')
		->first();

		return $sum_price = $detail_price->sum_price_part;
	}

}

if (!function_exists('moneyLeftToPay')) {

	function moneyLeftToPay($value) {

		if ($value->price_after_policy != 0) 
		{

			$result = $value->price_after_policy - getSumPartPrice($value->user_room_id, $value->user_id, $value->month_id, $value->year_id, $value->policy_id, $value->type_price_id, $value->type_policy_id, $value->code_room, $value->picre_after_confirm);

		}
		else if ($value->price_after != 0) 
		{

			$result = $value->price_after - getSumPartPrice($value->user_room_id, $value->user_id, $value->month_id, $value->year_id, $value->policy_id, $value->type_price_id, $value->type_policy_id, $value->code_room, $value->picre_after_confirm);

		}
		else 
		{

			$result = $value->price_default - getSumPartPrice($value->user_room_id, $value->user_id, $value->month_id, $value->year_id, $value->policy_id, $value->type_price_id, $value->type_policy_id, $value->code_room, $value->picre_after_confirm);

		}

		return $result;

	} 
}

if (!function_exists('getDetailPriceByCodeRoomUserIDMonthIDYearID')) {

	function getDetailPriceByCodeRoomUserIDMonthIDYearID($data, $type_price_id = null) {

		$detail_prices = new DetailPrice;

		$detail_prices = $detail_prices->select('user_id', 'user_room_id', 'code_room', 'year_id', 'month_id', 'type_policy_id', 'policy_id', 'type_price_id', 'picre_after_confirm');

		$detail_prices->where([

			'user_id' => $data->user_id,
			'month_id' => $data->month_id,
			'year_id' => $data->year_id,
			'code_room' => $data->code_room

		]);

		if ($type_price_id != null) {

			$detail_prices->where('type_price_id', $type_price_id);

		}

		$detail_prices->where('status', '!=', '1');

		$detail_prices->where('type_policy_id', '!=', '2');

		$detail_prices->groupBy('user_id', 'user_room_id', 'code_room', 'year_id', 'month_id', 'type_policy_id', 'policy_id', 'type_price_id', 'picre_after_confirm');

		$detail_prices = $detail_prices->get();

		return $detail_prices;


	}

}

if (!function_exists('getDetailPriceByCodeRoomUserIDMonthIDYearIDFull')) {

	function getDetailPriceByCodeRoomUserIDMonthIDYearIDFull($detail_price) {

		$detail_prices = new DetailPrice;

		$detail_prices = $detail_prices->select();

		$detail_prices->where([
            'code_room' => $detail_price->code_room,
            'user_id' => $detail_price->user_id,
            'month_id' => $detail_price->month_id,
            'year_id' => $detail_price->year_id,
            'policy_id' => $detail_price->policy_id,
            'type_price_id' => $detail_price->type_price_id,
            'type_policy_id' => $detail_price->type_policy_id,
            'user_room_id' => $detail_price->user_room_id,
            'picre_after_confirm' => $detail_price->picre_after_confirm
        ]);

		$detail_prices = $detail_prices->first();

		return $detail_prices;


	}

}
 
if (!function_exists('getUserByUserID')) {

	function getUserByUserID($user_id) {

		$user = new User;

		$user = $user->where('id', $user_id)->first();

		return $user;

	}

}

if (!function_exists('getRoomByName')) {

	function getRoomByName($name) {

		$room = new Room;

		$room = $room->where('name', $name)->first();

		return $room;

	}

}

if (!function_exists('getListTypePrice')) {

	function getListTypePrice() {

		$type_prices = new TypePrice;

		$type_prices = $type_prices->get();

		return $type_prices;

	}

}

if (!function_exists('getNameTypePriceByID')) {

	function getNameTypePriceByID($id) {

		$type_price = new App\Models\TypePrice;

		$type_price = $type_price->where('id', $id)->withTrashed()->first();

		return $type_price->type ?? '';

	}

}

if (!function_exists('getNameDorByID')) {

	function getNameDorByID($id) {

		$dor = new App\Models\Dormitory;

		$dor = $dor->where('id', $id)->withTrashed()->first();

		return $dor->name ?? '';

	}

}

if (!function_exists('getNameDistrictByID')) {

	function getNameDistrictByID($id) {

		$dor = new App\Models\District;

		$dor = $dor->where('id', $id)->withTrashed()->first();

		return $dor->name ?? '';

	}

}

if (!function_exists('getNameWardByID')) {

	function getNameWardByID($id) {

		$dor = new App\Models\Ward;

		$dor = $dor->where('id', $id)->first();

		return $dor->name ?? '';

	}

}

if (!function_exists('getNameDistrictByID')) {

	function getNameDistrictByID($id) {

		$dor = new App\Models\District;

		$dor = $dor->where('id', $id)->withTrashed()->first();

		return $dor->name ?? '';

	}

}

if (!function_exists('getNameAccountByID')) {

	function getNameAccountByID($id) {

		$dor = new App\Models\Account;

		$dor = $dor->where('id', $id)->withTrashed()->first();

		return $dor->fullname ?? '';

	}

}

if (!function_exists('getNameApartmentByID')) {

	function getNameApartmentByID($id) {

		$dor = new App\Models\Apartment;

		$dor = $dor->where('id', $id)->withTrashed()->first();

		return $dor->name ?? '';

	}

}

if (!function_exists('getNameRoomByID')) {

	function getNameRoomByID($id) {

		$dor = new App\Models\Room;

		$dor = $dor->where('id', $id)->withTrashed()->first();

		return $dor->name ?? '';

	}

}


if (!function_exists('convert_curency_to_words')) {

    function convert_curency_to_words($number)
    {
        $hyphen = ' ';
        $conjunction = '  ';
        $separator = ' ';
        $negative = 'âm ';
        $decimal = ' phẩy ';
        $dictionary = array(
            0 => 'không',
            1 => 'một',
            2 => 'hai',
            3 => 'ba',
            4 => 'bốn',
            5 => 'năm',
            6 => 'sáu',
            7 => 'bảy',
            8 => 'tám',
            9 => 'chín',
            10 => 'mười',
            11 => 'mười một',
            12 => 'mười hai',
            13 => 'mười ba',
            14 => 'mười bốn',
            15 => 'mười năm',
            16 => 'mười sáu',
            17 => 'mười bảy',
            18 => 'mười tám',
            19 => 'mười chín',
            20 => 'hai mươi',
            30 => 'ba mươi',
            40 => 'bốn mươi',
            50 => 'năm mươi',
            60 => 'sáu mươi',
            70 => 'bảy mươi',
            80 => 'tám mươi',
            90 => 'chín mươi',
            100 => 'trăm',
            1000 => 'nghìn',
            1000000 => 'triệu',
            1000000000 => 'tỷ',
            1000000000000 => 'nghìn tỷ',
            1000000000000000 => 'nghìn triệu triệu',
            1000000000000000000 => 'tỷ tỷ'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX) {
            trigger_error(
                'convert_curency_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . convert_curency_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int)($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    if ($remainder >= 10) {
                        $string .= $conjunction . convert_curency_to_words($remainder);
                    } else {
                        $string .= $conjunction . ' lẻ ' . convert_curency_to_words($remainder);
                    }

                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int)($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = convert_curency_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    if ($remainder >= 10) {
                        $string .= convert_curency_to_words($remainder);
                    } else {
                        $string .= ' lẻ ' . convert_curency_to_words($remainder);
                    }
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string)$fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }
}

if (!function_exists('covert_code_bill')) {
	function covert_code_bill($number) {
		$string = '';
		if ($number < 1) {
			$string = '00000000';
		}else if ($number < 10) {
			$string = '0000000'.$number;
		}
		else if ($number < 100) {
			$string = '000000'.$number;
		}
		else if ($number < 1000) {
			$string = '00000'.$number;
		}
		else if ($number < 10000) {
			$string = '0000'.$number;
		}
		else if ($number < 100000) {
			$string = '000'.$number;
		}
		else if ($number < 1000000) {
			$string = '00'.$number;
		}
		else if ($number < 10000000) {
			$string = '0'.$number;
		}

		return $string;
	}
}

if (!function_exists('updateCheckbill')) {
	function updateCheckbill($id) {
		$ticket = new Ticker();
		$ticket->where('id', $id)->update(['check' => 2]);
		return 1;
	}

} 

if (!function_exists('PaymentMethodInsert')) {
	function PaymentMethodInsert() {

		$data = [
            [
                'title' => 'Tiền mặt',
            ],
            
            [
                'title' => 'Chuyển khoản',
            ],

            [
                'title' => 'Tiền mặt/chuyển khoản',
            ],
        ];

		PaymentMethod::insert($data);

		return true;
	}

} 

if (!function_exists('getTicketsByNumberBillScript')) {
	function getTicketsByNumberBillScript($number_bill) {
		$ticket = new Ticker();
		$ticket = $ticket->whereIn('number_bill_number', $number_bill)->get();
		return $ticket;
	}

}

if (!function_exists('getTicketsByGroup')) {
	function getTicketsByGroup($id) {
		$ticket = new Ticker();
		$ticket = $ticket->where('ticker_group_id', $id)->get();
		return $ticket;
	}

}

if (!function_exists('getGroupByQr')) {
	function getGroupByQr($qr) {
		$group = new TickerGroup();
		$group = $group->where('qr_radom', $qr)->first();
		return $group;
	}

}

if (!function_exists('getConfig')) {
	function getConfig() {
		$ticket = new Config();
		$ticket = $ticket->select()->first();
		return $ticket;
	}

} 

if (!function_exists('mqtt')) {
	function mqtt() {
		$server = '192.168.100.162'; //1
		// $server = 'iot.cnpt.vn'; //1

		// $server = '192.168.100.172'; //2
		// $server = 'iot2.cnpt.vn'; //2
	    $port = 1883;
	    $username = 'user1';
	    $password = 'Cnpt@123';
	    $client_id = 'php_mqtt_client';
	    $check_topic = 'banve/check';
	    $result_topic = 'banve/result';
	    $key = 'stop';

	    while(true) {
	        $mqtt = new phpMQTT($server, $port, $client_id);
	        if ($mqtt->connect(true, NULL, $username, $password)) {
	            while ($mqtt->proc()) {
	            	$msg = $mqtt->subscribeAndWaitForMessage($check_topic, 0);
	            	if (($msg != '') && ($msg != $key)) {
	            		$result_tickets = [0];
	            		$arr_number_bill = explode(',', $msg);
			            $tickets = getTicketsByNumberBillScript($arr_number_bill);
	            		if (strpos($msg, 'G') !== false) {
	            			$ticket_group = getGroupByQr($msg);
            				$tickets = getTicketsByGroup($ticket_group->id);
	            		}
			            if (count($tickets) > 0) {
			                $result_tickets = $tickets->pluck('check', 'number_bill_number')->toArray();
			                if ($tickets[0]->check == 1){
			                	foreach ($tickets as $key1 => $value1){
					                updateCheckbill($value1->id); 
					            }
		                		$mqtt->publish($result_topic, '2', 0);
			                   	break;
			                }else{
			                    $mqtt->publish($result_topic, '1', 0);
			                    break;
			                }
			                sleep(1);
			            }else{
			            	$mqtt->publish($result_topic, '0', 0);
			            }
	            	}
	            }
	            $mqtt->close();
	        } else {
	            Session::put('error', 'Kết nối QrCode thất bại!');
	            Session::save();
	            sleep(1);
	        }
	    }

	    return true;
	}

}

?>