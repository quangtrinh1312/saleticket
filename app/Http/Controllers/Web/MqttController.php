<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Auth;
use soapClient;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use App\Models\StatusTicker;
use Illuminate\Http\Request;
use Meng\AsyncSoap\Guzzle\Factory;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Laminas\Diactoros\StreamFactory;
use Laminas\Diactoros\RequestFactory;
use App\Repositories\TicketsRepository;
use App\Repositories\TicketTypeRepository;
use App\Repositories\ApiVinCaRepository;
use App\Repositories\PayMethodRepository;
use App\Repositories\ApiInvoiceRepository;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Storage;
use App\Repositories\ConfigRepository;
use Bluerhinos\phpMQTT;
use Illuminate\Support\Facades\Session;

class MqttController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $userRepository, $ticKetRepository, $payMethodRepository, $apiInvoiceRepository, $apiVinCaRepository, $configRepo, $ticketTypeRepository;

    public function __construct(UserRepository $userRepository, 
                                TicketsRepository $ticKetRepository,
                                PayMethodRepository $payMethodRepository,
                                ApiInvoiceRepository $apiInvoiceRepository,
                                ApiVinCaRepository $apiVinCaRepository,
                                ConfigRepository $configRepo,
                                TicketTypeRepository $ticketTypeRepository) {

        $this->userRepository = $userRepository;
        $this->ticKetRepository = $ticKetRepository;
        $this->payMethodRepository = $payMethodRepository;
        $this->apiInvoiceRepository = $apiInvoiceRepository;
        $this->apiVinCaRepository = $apiVinCaRepository;
        $this->configRepo = $configRepo;
        $this->ticketTypeRepository = $ticketTypeRepository;
        $this->create();

    }

    public function index()
    {
        // $server = '192.168.100.162';
        // $port = 1883;
        // $username = 'user1';
        // $password = 'Cnpt@123';
        // $client_id = 'php_mqtt_client';
        // $check_topic = 'banve/check';
        // $result_topic = 'banve/result';

        // while(true) {
        //     $mqtt = new phpMQTT($server, $port, $client_id);
        //     if ($mqtt->connect(true, NULL, $username, $password)) {
        //         // while ($mqtt->proc()) {
        //         //     $msg = $mqtt->subscribeAndWaitForMessage($check_topic, 0);
        //         //     $result = 0;
        //         //     $arr_number_bill = explode(',', $msg);
        //         //     $tickets = $this->ticKetRepository->getTicketsByNumberBill($arr_number_bill);
        //         //     if ($tickets) {
        //         //         foreach ($tickets as $key1 => $value1) {
        //         //             if ($value1->check == 1) {
        //         //                 $mqtt->publish($result_topic, '1');
        //         //                 $this->ticKetRepository->updateCheckBill($value1->id);
        //         //             }else{
        //         //                 $mqtt->publish($result_topic, '0');
        //         //             }
        //         //             sleep(2);
        //         //         }
        //         //     }else{
        //         //         $mqtt->publish($result_topic, '0');
        //         //         sleep(5);
        //         //     }
        //         // }

        //         $msg = $mqtt->subscribeAndWaitForMessage($check_topic, 0);
        //         $result = 0;
        //         $arr_number_bill = explode(',', $msg);
        //         $tickets = $this->ticKetRepository->getTicketsByNumberBill($arr_number_bill);
        //         if (count($tickets) > 0) {
        //             foreach ($tickets as $key1 => $value1) {
        //                 if ($value1->check == 1) {
        //                     $mqtt->publish($result_topic, '1');
        //                     $this->ticKetRepository->updateCheckBill($value1->id);
        //                 }else{
        //                     $mqtt->publish($result_topic, '0');
        //                 }
        //                 sleep(2);
        //             }
        //         }else{
        //             $mqtt->publish($result_topic, '0');
        //             sleep(2);
        //         }

        //         $mqtt->close();
        //         sleep(2);
        //     } else {
        //         Session::put('error', 'Kết nối QrCode thất bại!');
        //         Session::save();
        //         sleep(1);
        //     }
        // }

        // return true;
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $server = '192.168.100.162';
        $port = 1883;
        $username = 'user1';
        $password = 'Cnpt@123';
        $client_id = 'php_mqtt_client';
        $check_topic = 'banve/check';
        $result_topic = 'banve/result';

        while(true) {
            $mqtt = new phpMQTT($server, $port, $client_id);
            if ($mqtt->connect(true, NULL, $username, $password)) {
                // while ($mqtt->proc()) {
                //     $msg = $mqtt->subscribeAndWaitForMessage($check_topic, 0);
                //     $result = 0;
                //     $arr_number_bill = explode(',', $msg);
                //     $tickets = $this->ticKetRepository->getTicketsByNumberBill($arr_number_bill);
                //     if ($tickets) {
                //         foreach ($tickets as $key1 => $value1) {
                //             if ($value1->check == 1) {
                //                 $mqtt->publish($result_topic, '1');
                //                 $this->ticKetRepository->updateCheckBill($value1->id);
                //             }else{
                //                 $mqtt->publish($result_topic, '0');
                //             }
                //             sleep(2);
                //         }
                //     }else{
                //         $mqtt->publish($result_topic, '0');
                //         sleep(5);
                //     }
                // }

                $msg = $mqtt->subscribeAndWaitForMessage($check_topic, 0);
                $result = 0;
                $arr_number_bill = explode(',', $msg);
                $tickets = $this->ticKetRepository->getTicketsByNumberBill($arr_number_bill);
                if (count($tickets) > 0) {
                    foreach ($tickets as $key1 => $value1) {
                        if ($value1->check == 1) {
                            $mqtt->publish($result_topic, '1');
                            $this->ticKetRepository->updateCheckBill($value1->id);
                        }else{
                            $mqtt->publish($result_topic, '0');
                        }
                        sleep(2);
                    }
                }else{
                    $mqtt->publish($result_topic, '0');
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

        return true;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
