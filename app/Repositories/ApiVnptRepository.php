<?php

namespace App\Repositories;

use Exception;
use SoapClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models_12345\TicketObtained;
use App\Http\Requests\RequestResetPass;

class ApiVnptRepository extends AbstractRepository
{
    public function getModel()
    {
        return TicketObtained::class;
    }

    public function publish($fkey, $ticketInfor, $type, $price, $pattern, $serial) {
        $data = array();
        try {
            $soapClient = new SoapClient('https://ttqlktnha-tt78admin.vnpt-invoice.com.vn/PublishService.asmx?wsdl');
            $param = array(
                'Account' => 'ttqlktnhaadmin',
                'ACpass' => 'Einv@oi@vn#pt20',
                'xmlInvData' => '
                    <Invoices>
                        <Inv>
                            <key>'.$fkey.'</key>
                            <Invoice>
                                <CusCode>'.$fkey.'</CusCode>
                                <CusName>'.$ticketInfor.'</CusName>
                                <CusAddress>Thành phố Đà Nẵng</CusAddress>
                                <Products>
                                    <Product>
                                        <ProdName>'.$type.'</ProdName>
                                        <Amount>'.$price.'</Amount>
                                        <Total>'.$price.'</Total>
                                        <VATRate>0</VATRate>
                                        <VATAmount>0</VATAmount>
                                        <IsSum>0</IsSum>
                                    </Product>
                                </Products>
                                <Total>'.$price.'</Total>
                                <VATRate>0</VATRate>
                                <VATAmount>0</VATAmount>
                                <Amount>'.$price.'</Amount>
                                <AmountInWords>Số tiền viết bằng chữ</AmountInWords>
                                <Buyer>'.$ticketInfor.'</Buyer>
                                <Fkey>'.$fkey.'</Fkey>
                                <CurrencyUnit>VND</CurrencyUnit>
                            </Invoice>
                        </Inv>
                    </Invoices>            
                ',
                'username' => 'ttqlktnhaservice',
                'password' => '123456aA@',
                'pattern' => $pattern,
                'serial' => strtoupper($serial),
                'convert' => 0,
            );
            $message = $soapClient->ImportAndPublishInv($param);
            $data['status'] = 200;
            $data['message'] = $message;
        } catch(Exception $ex) {
            $data['status'] = 400;
            $data['message'] = $ex->getMessage();
        }
        return $data;
    }

    public function adjust($fkey, $newFkey, $ticketInfor, $type, $price, $adjustType, $pattern, $serial) {
        $data = array();
        try {
            $soapClient = new SoapClient('https://ttqlktnha-tt78admin.vnpt-invoice.com.vn/BusinessService.asmx?wsdl');
            $param = array(
                'Account' => 'ttqlktnhaadmin',
                'ACpass' => 'Einv@oi@vn#pt20',
                'xmlInvData' => '
                    <AdjustInv>
                        <key>'.$newFkey.'</key>
                        <CusCode>'.$newFkey.'</CusCode>
                        <CusName>'.$ticketInfor.'</CusName>
                        <CusAddress>Thành phố Đà nẵng</CusAddress>
                        <Products>
                            <Product>
                                <ProdName>'.$type.'</ProdName>
                                <Amount>'.$price.'</Amount>
                                <Total>'.$price.'</Total>
                                <VATRate>0</VATRate>
                                <VATAmount>0</VATAmount>
                                <IsSum>0</IsSum>
                            </Product>
                        </Products>
                        <Total>'.$price.'</Total>
                        <VATRate>0</VATRate>
                        <VATAmount>0</VATAmount>
                        <Amount>'.$price.'</Amount>
                        <AmountInWords>Số tiền viết bằng chữ</AmountInWords>
                        <Buyer>'.$ticketInfor.'</Buyer>
                        <Fkey>'.$newFkey.'</Fkey>
                        <CurrencyUnit>VND</CurrencyUnit>
                        <Type>'.$adjustType.'</Type>
                    </AdjustInv>
                ',
                'username' => 'ttqlktnhaservice',
                'pass' => '123456aA@',
                'pattern' => $pattern,
                'serial' => strtoupper($serial),
                'convert' => 0,
                'fkey' => $fkey,
            );
            $message = $soapClient->adjustInv($param);
            $data['status'] = 200;
            $data['message'] = $message;
        } catch(Exception $ex) {
            $data['status'] = 400;
            $data['message'] = $ex->getMessage();
        }
        return $data;
    }

    public function cancel($fkey) {
        $data = array();
        try {
            $soapClient = new SoapClient('https://ttqlktnha-tt78admin.vnpt-invoice.com.vn/BusinessService.asmx?wsdl');
            $param = array(
                'Account' => 'ttqlktnhaadmin',
                'ACpass' => 'Einv@oi@vn#pt20',
                'userName' => 'ttqlktnhaservice',
                'userPass' => '123456aA@',
                'fkey' => $fkey,
            );
            $message = $soapClient->cancelInv($param);
            $data['status'] = 200;
            $data['message'] = $message;
        } catch(Exception $ex) {
            $data['status'] = 400;
            $data['message'] = $ex->getMessage();
        }
        return $data;
    }
}
