<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
use App\Repositories\TicketGroupRepository;
use App\Repositories\TicketTypeRepository;
use App\Repositories\ApiVinCaRepository;
use App\Repositories\PayMethodRepository;
use App\Repositories\ApiInvoiceRepository;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use App\Repositories\ConfigRepository;
use Bluerhinos\phpMQTT;
use ZipArchive;
use File;
use Response;

class TicKetController extends Controller
{

    protected $userRepository, $ticKetRepository, $payMethodRepository, $apiInvoiceRepository, $apiVinCaRepository, $configRepo,$ticketTypeRepository,  $ticketGroupRepo;

    public function __construct(UserRepository $userRepository, 
                                TicketsRepository $ticKetRepository,
                                PayMethodRepository $payMethodRepository,
                                ApiInvoiceRepository $apiInvoiceRepository,
                                ApiVinCaRepository $apiVinCaRepository,
                                ConfigRepository $configRepo,
                                TicketTypeRepository $ticketTypeRepository,
                                TicketGroupRepository $ticketGroupRepo) {

        $this->userRepository = $userRepository;
        $this->ticKetRepository = $ticKetRepository;
        $this->payMethodRepository = $payMethodRepository;
        $this->apiInvoiceRepository = $apiInvoiceRepository;
        $this->apiVinCaRepository = $apiVinCaRepository;
        $this->configRepo = $configRepo;
        $this->ticketTypeRepository = $ticketTypeRepository;
        $this->ticketGroupRepo = $ticketGroupRepo;
    }

    public function getUser() {

        return Auth::user();

    }

    public function uniqueCode() {
        $randText = mt_rand(000000000, 999999999);
        $uniqueCode = Carbon::now()->format('Ymd').''.$randText;
        return $uniqueCode;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result_tickets = [];
        $price = 0;
        $number = [];
        $quantity = [];
        $prod_name = [];
        $post_vat_price = [];
        $number_string = '0';
        $qr_radom = 'error';
        $params = [];
        $config = $this->configRepo->getFirt();
        $ticket_types = $this->ticketTypeRepository->getTicketByActive();

        //in lai hoa don
        if (Session::has('result_tickets')) $result_tickets = Session::get('result_tickets');
        if (Session::has('price')) $price = Session::get('price');
        if (Session::has('post_vat_price')) $post_vat_price = Session::get('post_vat_price');
        if (Session::has('quantity')) $quantity = Session::get('quantity');
        if (Session::has('prod_name')) $prod_name = Session::get('prod_name');
        if (Session::has('qr_radom')) $qr_radom = Session::get('qr_radom');

        // lay list ve
        $user = $this->getUser(); // lay user dang dang nhap
        $params['date_end'] = Carbon::now()->format('Y-m-d');
        $params['date_start'] = Carbon::now()->format('Y-m-d');
        $params['user_id'] = $user->id;
        $tickets = $this->ticKetRepository->getListPaginatesByParams($params);// list theo thoi gian xuat tu phien hom nay
        $sum_all = $this->ticKetRepository->getSumByParams($params); //tong gia tien da xuat trong phien dang nhap hom nay
        $total_ticket_type = $this->ticKetRepository->getNumberByParams($params);
        // dump($total_ticket_type);
        $sum_number = $total_ticket_type->sum('number');
        $payMethods = $this->payMethodRepository->getLists();
        foreach ($result_tickets as $key => $value) {
            $number[] = $value->number_bill_number;
            $number_string = $number_string.','.$value->number_bill_number;
        }
        $qrCode = QrCode::size(150)->generate(route('get.bill', ['name' => Str::slug($config->name, '-') ?? '', 'number' => $number]));
        // $qrCode_check = QrCode::size(100)->generate(route('check.bill', ['name' => Str::slug($config->name, '-') ?? '', 'number' => $number, 'user_id' => $user->id]));
        $qrCode_check = QrCode::size(190)->generate($qr_radom);
        Session::forget('result_tickets');
        Session::forget('price');
        Session::forget('post_vat_price');
        Session::forget('quantity');
        Session::save();

        return view('admins.tickets.sale.index')->with([
            'tickets' => $tickets,
            'payMethods' => $payMethods,
            'user' => $user,
            'result_tickets' => $result_tickets,
            'price' => $price,
            'qrCode' => $qrCode,
            'qrCode_check' => $qrCode_check,
            'config' => $config,
            'ticket_types' => $ticket_types,
            'post_vat_price' => $post_vat_price,
            'quantity' => $quantity,
            'prod_name' => $prod_name,
            'sum_all' => $sum_all,
            'sum_number' => $sum_number,
            'total_ticket_type' => $total_ticket_type
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $user = $this->getUser();
        $quantity = $request->quantity;
        // dd($request->all());
        $post_vat_price = $request->post_vat_price;
        $prod_name = $request->prod_name;
        $address = $request->address;
        $cus_name = $request->cus_name;
        $ticket_id = $request->ticket_id;
        $mst = $request->mst;
        $price = 0;
        $number = 0;
        $tickets_params = [];
        $config = $this->configRepo->getFirt();
        $ticket_groups_params = [];
        foreach ($quantity as $key => $value1) {
            $ticket_type = $this->ticketTypeRepository->getById($ticket_id[$key]);
            for ($i=0; $i < $value1; $i++) {
                $params = [];
                $params['address'] = $address ?? $config->address;
                $params['number_bill_string'] = 'KH'.($value1 + 1).$this->uniqueCode();
                $params['pattern'] = $ticket_type->pattern ?? '';
                $params['serial'] = $ticket_type->serial ?? '';
                $params['cus_name'] = $cus_name ?? $config->cus_name;
                $params['mst'] = $mst ?? '';
                $params['prod_name'] = $prod_name[$key] ?? $config->prod_name;
                $params['price'] = $post_vat_price[$key] ?? $config->price;
                $params['user_id'] = $user->id;
                $params['payment_method_id'] = $request->payment_method_id ?? 1;
                $tickets_params[] = $params;
            }
            $price = $price + ($post_vat_price[$key] * $value1);
            $number = $value1 + $number;
        }
        $ticket_groups_params['name'] = $cus_name ?? $config->cus_name;
        $ticket_groups_params['number'] = $number;
        $ticket_groups_params['sum'] = $price;
        $ticket_groups_params['user_id'] = $user->id;
        $ticket_groups_params['qr_radom'] = $this->uniqueCode().'G';
        $ticket_groups = $this->ticketGroupRepo->create($ticket_groups_params);
        $sn = 0;
        $result_tickets = [];

        if ($config->api == 'VNPT') {
            foreach ($tickets_params as $key => $value) {
                $value['ticker_group_id'] = $ticket_groups->id;
                $sn = $sn + 1;
                $payMethod = $this->payMethodRepository->getById($value['payment_method_id']);
                $result = $this->apiInvoiceRepository->publish($value, $payMethod->title, $config);

                $accept = strpos($result['message'], 'OK');

                if ($accept === false) {
                    $value['number_bill_number'] = $value['number_bill_string'];
                }else{
                    $value['number_bill_number'] = trim(stristr($result['message'], '_'), '_');
                }

                $result_tickets[] = $this->ticKetRepository->create($value);
            }
        }else if ($config->api == 'VIN-CA') {
            foreach ($tickets_params as $key => $value) {
                $value['ticker_group_id'] = $ticket_groups->id;
                $sn = $sn + 1;
                $payMethod = $this->payMethodRepository->getById($value['payment_method_id']);
                $result = $this->apiVinCaRepository->GuiVaKyBienLaiGocHSM($value, $payMethod, $config);
                // dd($result);
                $accept = $result['result'] ? $result['result']['maketqua'] : '';

                if ($accept != '01') {
                    $value['number_bill_number'] = $value['number_bill_string'];
                }
                else
                {
                    $value['number_bill_number'] = $result['result']['sohoadon'];
                    $value['trading_code'] = $result['result']['magiaodich'];
                }

                $result_tickets[] = $this->ticKetRepository->create($value);
            }
        }
            

        if ($request->check_print == 'on') Session::put('price', $price);
        Session::put('result_tickets', $result_tickets);
        Session::put('post_vat_price', $post_vat_price);
        Session::put('quantity', $quantity);
        Session::put('prod_name', $prod_name);
        Session::put('qr_radom', $ticket_groups_params['qr_radom']);
        Session::put('success', 'Xuất vé thành công!');
        Session::save();

        return redirect()->route('get.ticker', ['username' => Str::slug($config->name, '-')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result_tickets[] = $this->ticKetRepository->getById($id);
        $config = $this->configRepo->getFirt();
        $price = 0;
        $qrCode_check = '';
        $qrCode = '';

        return view('admins.tickets.print_detail')->with([
            'result_tickets' => $result_tickets,
            'config' => $config,
            'price' => $price,
            'qrCode_check' => $qrCode_check,
            'qrCode' => $qrCode
        ]);
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

    public function getBill(Request $request) {
        $config = $this->configRepo->getFirt();
        $arr_number_bill = $request->number;
        $tickets = $this->ticKetRepository->getTicketsByNumberBill($arr_number_bill);
        $hmtl_tickets = [];
        $response = null;
        $url = null;
        if ($config->api == 'VNPT') {
            foreach($tickets as $key => $value) {

                $hmtl_ticket = $this->apiInvoiceRepository->getInvViewFkeyNoPay($value->number_bill_string, $config);
                $hmtl_tickets[] = $hmtl_ticket;
            }
        }else if ($config->api == 'VIN-CA') {
            $url = route('download.bill', ['name' => Str::slug($config->name, '-') ?? '', 'number' => $arr_number_bill]);
        }

        return view('admins.tickets.bill')->with(['hmtl_tickets' => $hmtl_tickets, 'response' => $response, 'url' => $url]);

    }

    public function getDownloadBill(Request $request) {
        $headers = array(
            'Content-Type' => 'application/octet-stream',
        );
        $file = 'invoice.pdf';
        $zipname = 'invoice.zip';
        $files = [];
        $decoded = '';
        $config = $this->configRepo->getFirt();
        $arr_number_bill = $request->number;
        $tickets = $this->ticKetRepository->getTicketsByNumberBill($arr_number_bill);
        if ($config->api == 'VNPT') {
        }else if ($config->api == 'VIN-CA') {
            foreach($tickets as $key => $value) {
                $file_name = 'invoice'.$key.'.pdf';
                $path_file = storage_path('app/public/invoices/'.$file_name);
                if (Storage::exists('public/invoices/'.$file_name)) {
                    Storage::delete('public/invoices/'.$file_name);
                }
                $response = $this->apiVinCaRepository->TaiBienLaiPdf($value->number_bill_string, $value->trading_code, $config);
                if ($response['result']['maketqua'] != '01') {
                    return view('admins.tickets.bill')->with(['hmtl_tickets' => [], 'response' => $response, 'url' => null]);
                }
                $decoded = base64_decode($response['result']['base64pdf'], true);
                Storage::put('public/invoices/'.$file_name, $decoded);
                $files[] = $path_file;
            }
        }
        if (count($tickets) > 1) {
            $path_zip = storage_path('app/public/invoices/'.$zipname);
            if (Storage::exists('public/invoices/'.$zipname)) {
                Storage::delete('public/invoices/'.$zipname);
            }
            $zip = new ZipArchive;
            $zip->open($path_zip, ZipArchive::CREATE);
            foreach ($files as $value) {
              $zip->addFile($value);
            }
            $zip->close();
            return response()->download($path_zip);
        }else{
            file_put_contents($file, $decoded);
            if (file_exists($file)) {
                return response()->download($file);
            }
        }

        return true;
    }

    // public function checkBill(Request $request) {
    //     $user = $this->userRepository->getById($request->user_id);
    //     $result_tickets = [];
    //     $arr_number_bill = $request->number;
    //     $tickets = $this->ticKetRepository->getTicketsByNumberBill($arr_number_bill);
    //     $result_tickets = $tickets->pluck('check', 'number_bill_number')->toArray();
    //     foreach ($tickets as $key1 => $value1) {
    //         $number[] = $value1->number_bill_number;
    //     }
    //     return view('admins.tickets.check-bill')->with(['result_tickets' => $result_tickets, 'tickets' => $tickets, 'number' => $number, 'user' => $user]);

    // }

    public function checkBill(Request $request) {
        $result = 0;
        $user = Auth::user();
        $config = $this->configRepo->getFirt();
        $result_tickets = [];
        $result_content = '';
        $number = [];
        $arr_number_bill = explode(',', $request->ticket_check_code);
        $tickets = $this->ticKetRepository->getTicketsByNumberBill($arr_number_bill);
        if ($tickets) {
            $result_tickets = $tickets->pluck('check', 'number_bill_number')->toArray();
            foreach ($tickets as $key1 => $value1) {
                $number[] = $value1->number_bill_number;
                $result_content = $result_content.''.$result_tickets[$value1->number_bill_number]. PHP_EOL;
            }
        }
        $fileName = "data.txt";
        $path_remove = storage_path('app/public/check_scan/result/'.$fileName);
        if (Storage::exists($path_remove)) {
            unlink($path_remove);
        }
        // Storage::put('public/check_scan/result/'.$fileName, $result_tickets);
        // sleep(1);
        // Storage::put('public/check_scan/result/'.$fileName, 0);
        // $url = Storage::url('app/public/check_scan/result/data.txt');
        return view('admins.tickets.check-bill-scan')->with(['result_tickets' => $result_tickets, 'tickets' => $tickets, 'number' => $number, 'config' => $config]);
    }

    public function setCheckBill(Request $request) {
        $user = Auth::user();
        $arr_number_bill = explode(',', $request->ticket_check_code);
        $tickets = $this->ticKetRepository->getTicketsByNumberBill($arr_number_bill);
        if ($tickets) {
            foreach ($tickets as $key1 => $value1) {
                $this->ticKetRepository->updateCheckBill($value1->id);
            }
        }
    }

    // public function setCheckBill(Request $request) {
    //     $user = $this->userRepository->getById($request->user_id);
    //     $arr_number_bill = $request->number;
    //     $tickets = $this->ticKetRepository->getTicketsByNumberBill($arr_number_bill);
    //     foreach ($tickets as $key1 => $value1) {
    //         $this->ticKetRepository->updateCheckBill($value1->id);
    //     }
    // }
    public function getCheck() {
        $config = $this->configRepo->getFirt();
        return view('admins.tickets.check-scan')->with(['config' => $config]);
    }
    public function getStatistical(Request $request) {
        $year = Carbon::now()->format('Y');
        $params = $request->all();
        if (isset($params['time']) && $params['time'] == 1) {
            unset($params['time2_1_item']);
            unset($params['time2_2_item']);
            $params['date_end'] = $params['date_end'] ?? Carbon::now()->format('Y-m-d');
        }elseif (isset($params['time']) && $params['time'] == 2) {
            if (isset($params['time2']) && $params['time2'] == 1) {
                if (isset($params['time2_1_item']) && $params['time2_1_item'] == 1) {
                    $params['date_start'] = $year.'-01-01';
                    $params['date_end'] = $year.'-03-31';
                }elseif(isset($params['time2_1_item']) && $params['time2_1_item'] == 2){
                    $params['date_start'] = $year.'-04-01';
                    $params['date_end'] = $year.'-06-30';
                }elseif(isset($params['time2_1_item']) && $params['time2_1_item'] == 3){
                    $params['date_start'] = $year.'-07-01';
                    $params['date_end'] = $year.'-09-30';
                }elseif(isset($params['time2_1_item']) && $params['time2_1_item'] == 4){
                    $params['date_start'] = $year.'-10-01';
                    $params['date_end'] = $year.'-12-31';
                }
                unset($params['time2_2_item']);
            }elseif (isset($params['time2']) && $params['time2'] == 2) {
                $params['month'] = $params['time2_2_item'];
                $params['year'] = $year;
                unset($params['date_start']);
                unset($params['date_end']);
            }
            unset($params['time2_1_item']);
        }
        $config = $this->configRepo->getFirt();
        $tickets = $this->ticKetRepository->getListPaginatesByParams($params);
        $sum_all = $this->ticKetRepository->getSumByParams($params);
        $users = $this->userRepository->getLists();
        $total_ticket_type = $this->ticKetRepository->getNumberByParams($params);
        $sum_number = $total_ticket_type->sum('number');
        return view('admins.tickets.statistical.index')->with(['config' => $config, 'tickets' => $tickets, 'users' => $users, 'params' => $params, 'sum_all' => $sum_all, 'total_ticket_type' => $total_ticket_type, 'sum_number' => $sum_number]);
    }

    public function getStat(Request $request) {
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $today = Carbon::now();
        $role_id = 2;
        $params = [];
        $params['from_date'] = $request->from_date;
        $params['from_time_hour'] = $request->from_time_hour;
        $params['from_time_minute'] = $request->from_time_minute;
        $params['to_date'] = $request->to_date;
        $params['to_time_hour'] = $request->to_time_hour;
        $params['to_time_minute'] = $request->to_time_minute;
        $params['user_id'] = $request->user_id;
        $user = $this->getUser();
        $staffs = $this->userRepository->getLists();
        if (!($user->role_id == 1)) {
            $staffs = [];
            $staffs[] = $user;
            $params['user_id'] = $user->id;
        }

        $time = $request->time ?? 0;

        switch ($time) {
            case '1':
                $params['from_date'] = $today->format('Y-m-d');
                $params['to_date'] = $today->format('Y-m-d');
                break;
            case '2':
                $params['from_date'] = $today->subDays(7)->format('Y-m-d');
                $params['to_date'] = Carbon::now()->format('Y-m-d');
                break;
            case '3':
                $params['from_date'] = $today->firstOfMonth()->format('Y-m-d');
                $params['to_date'] = $year.'-'.$month.'-'.cal_days_in_month(CAL_GREGORIAN,(int)$month,(int)$year);
                break;
            case '4':
                $params['from_date'] = $year.'-01-01';
                $params['to_date'] = $year.'-03-'.cal_days_in_month(CAL_GREGORIAN,(int)$month,(int)$year);
                break;
            case '5':
                $params['from_date'] = $year.'-04-01';
                $params['to_date'] = $year.'-06-'.cal_days_in_month(CAL_GREGORIAN,(int)$month,(int)$year);
                break;
            case '6':
                $params['from_date'] = $year.'-07-01';
                $params['to_date'] = $year.'-09-'.cal_days_in_month(CAL_GREGORIAN,(int)$month,(int)$year);
                break;
            case '7':
                $params['from_date'] = $year.'-10-01';
                $params['to_date'] = $year.'-12-'.cal_days_in_month(CAL_GREGORIAN,(int)$month,(int)$year);
                break;
            case '8':
                $params['from_date'] = $year.'-01-01';
                $params['to_date'] = $year.'-12-'.cal_days_in_month(CAL_GREGORIAN,(int)$month,(int)$year);
                break;
            default:
                break;
        }
        $params['swap_stat'] = $request->swap_stat;
        $ticket_groups = $this->ticketGroupRepo->getTicketsByParams($params);
        $ticket_groups1 = $this->ticketGroupRepo->getTicketsByParams($params);
        $tickets = $ticket_groups->paginate(20);
        $sum_number = $ticket_groups1->get()->sum('number') ?? 0;
        $sum_price =$ticket_groups1->get()->sum('sum') ?? 0;
        $arr_id_ticket_group = $ticket_groups1->get()->pluck('id')->toArray();
        $total_ticket_type = $this->ticKetRepository->getListByArrGroup($arr_id_ticket_group);
        $params['time'] = $time;
        return view('admins.tickets.stat.index')->with([
            'user' => $user,
            'tickets' => $tickets,
            'staffs' => $staffs,
            'sum_number' => $sum_number,
            'sum_price' => $sum_price,
            'params' => $params,
            'total_ticket_type' => $total_ticket_type
        ]);
    }

    public function search(Request $request) {
        // dd($request);
        $params = [];

        $params['from_date'] = $request->from_date;
        $params['from_time_hour'] = $request->from_time_hour;
        $params['from_time_minute'] = $request->from_time_minute;
        $params['to_date'] = $request->to_date;
        $params['to_time_hour'] = $request->to_time_hour;
        $params['to_time_minute'] = $request->to_time_minute;
        $params['status'] = $request->status;

        $user = $this->getUser();
        
        $statuses = StatusTicker::all();
        
        $tickets = $this->ticKetRepository->getTicketsByParams($user, $params);

        return view('admins.tickets.stat.index')->with([
            'user' => $user,
            'tickets' => $tickets,
            'statuses' => $statuses,
        ]);
    }
}
