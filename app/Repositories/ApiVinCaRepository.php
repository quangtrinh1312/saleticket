<?php

namespace App\Repositories;

use Exception;
use SoapClient;
use App\Models\Ticker;
use GuzzleHttp\Client;

class ApiVinCaRepository extends AbstractRepository
{
    public function getModel()
    {
        return Ticker::class;
    }

    public function token($user) {

    	$url = rtrim($user->link, '/')."/api/services/hddtws/Authentication/GetToken";

    	$data_string = '{
			"doanhnghiep_mst":"'.$user->mst.'",
			"username": "'.$user->account.'",
			"password": "'.$user->acpass.'"
		}';

        $client = new Client();

        try {
        	$response = $client->post($url, [
                    'body' => $data_string,
                    'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
                ]
        	);
        	$response = json_decode($response->getBody(), true);
        }catch(Exception $e) {
        	$response = [
        		'result' => [
        			'status' => 'error', 
        			'message' => 'Lấy token thất bại!',
        			'access_token' => '',
        		]
        	];
        }
        
        return $response;
    }

    public function 	GuiVaKyBienLaiGocHSM($params, $payMethod, $user) {
    	$result_token = $this->token($user);
    	$token = $result_token['result'] ? $result_token['result']['access_token'] : '';
    	$url = rtrim($user->link, '/')."/api/services/hddtws/QuanLyBienLai/GuiVaKyBienLaiGocHSM";

    	$data_string = '{
		    "doanhnghiep_mst" : "'.$user->mst.'",
		    "ma_hoadon": "'.$params['number_bill_string'].'",
		    "mauso" : "'.$params['pattern'].'",
		    "kyhieu": "'.strtoupper($params['serial']).'",
		    "ngaylap" : "",
		    "dnmua_mst" : "",
		    "dnmua_ten" : "",
		    "dnmua_tennguoimua" : "'.ucwords($params['cus_name']).'",
		    "dnmua_diachi" : "'.$params['address'].'",
		    "dnmua_sdt" : "",
		    "dnmua_email" : "",
		    "thanhtoan_phuongthuc" : "'.$payMethod->id.'",
		    "thanhtoan_phuongthuc_ten" : "'.$payMethod->title.'",
		    "thanhtoan_taikhoan" : "",
		    "thanhtoan_nganhang" : "",
		    "tiente_ma" : "",
		    "tygiangoaite" : "0",
		    "ghichu" : "",
		    "tongtien_covat" : "'.$params['price'].'",
		    "nguoilap": "giaodichvien",
		    "dulieudacthu01" : "",
		    "dulieudacthu02" : "",
		    "dulieudacthu03" : "",
		    "dschitiet" : [
		        {
		            "stt" : "1",
		            "ma" : "",
		            "ten" : "'.$params['prod_name'].'",
		            "donvitinh" : "",
		            "soluong" : "0",
		            "dongia" : "0",
		            "tongtien_cothue" : "'.$params['price'].'"
		        }
		    ]
		}';

        $client = new Client();
        try {
	        $response = $client->post($url, [
	                    'body' => $data_string,
	                    'headers' => [
	                    	'Content-Type' => 'application/json', 
	                    	'Accept' => 'application/json',
	                    	'Authorization' => 'bearer '.$token,
	                    ],
	                ]
	        );
	        $response = json_decode($response->getBody(), true);
        }catch(Exception $e) {
        	$response = [
        		'result' => [
        			'maketqua' => '99',
        			'status' => 'error', 
        			'message' => 'Gửi và kí biên lai gốc thất bại!',
        		] 
        	];
        }
        return $response;
    }
    public function TaiBienLaiPdf($ma_hoadon, $magiaodich, $user) {
    	$result_token = $this->token($user);
    	$token = $result_token['result'] ? $result_token['result']['access_token'] : '';
    	$url = rtrim($user->link, '/')."/api/services/hddtws/TraCuuBienLai/TaiBienLaiPdf";
    	$url_ChuaKy = rtrim($user->link, '/')."/api/services/hddtws/TraCuuBienLai/TaiBienLaiPdfChuaKy";
    	$response_error = [
    		'result' => [
    			'maketqua' => '99',
    			'status' => 'error', 
    			'message' => 'Tải biên lai thất bại!',
    		] 
    	];
    	$data_string = '{
		    "doanhnghiep_mst" : "'.$user->mst.'",
		    "magiaodich": "'.$magiaodich.'",
		    "ma_hoadon": "'.$ma_hoadon.'"
		}';

        $client = new Client();

        try {
	        $response = $client->post($url, [
	                    'body' => $data_string,
	                    'headers' => [
	                    	'Content-Type' => 'application/json', 
	                    	'Accept' => 'application/json',
	                    	'Authorization' => 'bearer '.$token,
	                    ],
	                ]
	        );
	        $response = json_decode($response->getBody(), true);

			if ($response['result']['maketqua'] != '01' && $response['result']['maketqua'] == '06') {
	        	try{
	        		$response = $client->post($url_ChuaKy, [
			                    'body' => $data_string,
			                    'headers' => [
			                    	'Content-Type' => 'application/json', 
			                    	'Accept' => 'application/json',
			                    	'Authorization' => 'bearer '.$token,
			                    ],
			                ]
			        );
			        $response = json_decode($response->getBody(), true);
			        if ($response['result']['maketqua'] != '01') {
			        	$response = $response_error;
			        }
	        	}catch(Exception $ex) {
	        		$response = $response_error;
	        	}
	        }else if ($response['result']['maketqua'] != '01'){
	        	$response = $response_error;
	        }
        }catch(Exception $e) {
        	$response = $response_error;
        }
        return $response;
    }
}
