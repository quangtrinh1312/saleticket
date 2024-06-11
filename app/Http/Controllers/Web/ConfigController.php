<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ConfigRepository;
use App\Repositories\TicketsRepository;
use App\Repositories\TicketTypeRepository;
use App\Repositories\ApiVinCaRepository;
use App\Repositories\PayMethodRepository;
use App\Repositories\ApiInvoiceRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Session;

class ConfigController extends Controller
{
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
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $params = $request->all();
        unset($params['_method']);
        unset($params['_token']);
        $this->configRepo->update($id, $params);
        Session::put('success', 'Cấu hình thành công!');
        Session::save();
        return redirect()->back();
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
