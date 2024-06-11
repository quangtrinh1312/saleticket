<!-- 

$server = '192.168.100.162';
$port = 1883;
$username = 'user1';
$password = 'Cnpt@123';
$client_id = 'php_mqtt_client';
$check_topic = 'banve/check';
$result_topic = 'banve/result';

while(true) {


        $msg = $mqtt->subscribeAndWaitForMessage($check_topic, 0);
        $result = 0;
        $arr_number_bill = explode(',', $msg);
        $tickets = getTicketsByNumberBillScript($arr_number_bill);
        if (count($tickets) > 0) {
            foreach ($tickets as $key1 => $value1) {
                if ($value1->check == 1) {
                    $mqtt->publish($result_topic, '1');
                    updateCheckbill($value1->id);
                }else{
                    $mqtt->publish($result_topic, '0');
                }
                sleep(2);
            }


        $mqtt->close();
        sleep(2);
    } else {
        Session::put('error', 'Kết nối QrCode thất bại!');
        Session::save();
        sleep(1);
    }
}

return true; -->

