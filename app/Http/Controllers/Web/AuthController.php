<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\TicketsRepository;
use App\Repositories\PayMethodRepository;
use App\Repositories\ApiInvoiceRepository;
use App\Repositories\ApiVinCaRepository;
use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;
use Laminas\Diactoros\RequestFactory;
use Laminas\Diactoros\StreamFactory;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Session;
use soapClient;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Storage;
use App\Repositories\ConfigRepository;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $userRepository, $ticKetRepository, $payMethodRepository, $apiInvoiceRepository, $apiVinCaRepository, $configRepo;

    public function __construct(UserRepository $userRepository, 
                                TicketsRepository $ticKetRepository,
                                PayMethodRepository $payMethodRepository,
                                ApiInvoiceRepository $apiInvoiceRepository,
                                ApiVinCaRepository $apiVinCaRepository,
                                ConfigRepository $configRepo) {

        $this->userRepository = $userRepository;
        $this->ticKetRepository = $ticKetRepository;
        $this->payMethodRepository = $payMethodRepository;
        $this->apiInvoiceRepository = $apiInvoiceRepository;
        $this->apiVinCaRepository = $apiVinCaRepository;
        $this->configRepo = $configRepo;

    }

    // ham nay check username bang framework va lay ra
    // ten cua nha ban ve de gui den trang chu neu van con session
    public function getLogin() {
        if (Auth::check()) {
            $config = $this->configRepo->getFirt();
            $username = Str::slug($config->name, '-');
            return redirect()->route('get.ticker', ['username' => $username]);
        }
        return view('auths.login.login');
    }
    // ham nay kiem tra dang nhap lay tk mk cua form login va kiem tra
    // 
    public function postLogin(Request $request) {
        $request->flashOnly(['username']);
        $auth = [
            'username' => $request->username,
            'password' => $request->password
        ];
        if (Auth::attempt($auth)) {
            session_start();
            $config = $this->configRepo->getFirt();//get name of header title
            $username = Str::slug($config->name, '-'); //if $config->name is "Hello World", the Str::slug() function will convert it to "hello-world".
            return redirect()->route('get.ticker', ['username' => $username]);
        }
        return redirect()->back()->with('error_login', 'Tên đăng nhập hoặc mật khẩu không chính xác!');
    }

    public function getLogout() {
        Auth::logout();

        return redirect()->route('get.admin.login');
    }

    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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

    public function changePassword(PasswordRequest $request) {
        $user = Auth::user();
        $new_password = $request->new_password;
        $result = $this->userRepository->update($user->id, ['password' => Hash::make($new_password)]);
        $message = 'Thay đổi mật khẩu thành công';
        $success = 1;
        if (!$result) {
            $message = 'Thay đổi mật khẩu thất bại!';
            $success = 0;
        }
        return response()->json([
            'message' => $message,
            'success' => $success
        ]);
    }
}
