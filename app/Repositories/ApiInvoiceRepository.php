<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Exception;
use SoapClient;

class ApiInvoiceRepository
{
    public function publish($params, $payMethod, $user) {
        $data = array();
        try {
            $soapClient = new SoapClient(rtrim($user->link, '/').'/PublishService.asmx?wsdl');
            $param = array(
                'Account' => $user->account,
                'ACpass' => $user->acpass,
                'xmlInvData' => '
                    <Invoices>
                        <Inv>
                            <key>'.$params['number_bill_string'].'</key>
                            <Invoice>
                                <CusCode>'.$params['number_bill_string'].'</CusCode>
                                <CusTaxCode>'.$params['mst'].'</CusTaxCode>
                                <CusName>'.ucwords($params['cus_name']).'</CusName>
                                <CusAddress>'.$params['address'].'</CusAddress>
                                <PaymentMethod>'.$payMethod.'</PaymentMethod>
                                <Products>
                                    <Product>
                                        <ProdName>'.$params['prod_name'].'</ProdName>
                                        <Amount>'.$params['price'].'</Amount>

                                    </Product>
                                </Products>
                                <Total>'.$params['price'].'</Total>
                                <VATRate>0</VATRate>
                                <VATAmount>0</VATAmount>
                                <Amount>'.$params['price'].'</Amount>
                                <AmountInWords>'.ucfirst(convert_curency_to_words($params['price'])).'</AmountInWords>
                                <Buyer>'.$params['cus_name'].'</Buyer>
                                <CurrencyUnit>VND</CurrencyUnit>
                            </Invoice>
                        </Inv>
                    </Invoices>
                ',
                'username' => $user->username_api,
                'password' => $user->password_api,
                'pattern' => $params['pattern'],
                'serial' => strtoupper($params['serial']),
                'convert' => 0,
            );
            $message = $soapClient->ImportAndPublishInv($param);
            $data['status'] = 200;
            $data['message'] = $message->ImportAndPublishInvResult;
        } catch(Exception $ex) {
            $data['status'] = 400;
            $data['message'] = $ex->getMessage();
        }
        return $data;
    }

    public function replace() {
        $data = array();
        try {
            $soapClient = new SoapClient('https://ttquanlykhaithacnhaadmindemo.vnpt-invoice.com.vn/BusinessService.asmx?wsdl');
            $param = array(
                'Account' => 'ttquanlykhaithacnhaadmin',
                'ACpass' => 'Einv@oi@vn#pt20',
                'xmlInvData' => '
                    <ReplaceInv>
                        <key>BL10-2023-126-20230711-947019842</key>
                        <CusCode>BL10-2023-126-20230711-947019842</CusCode>
                        <CusName>Trần Công Châu</CusName>
                        <CusAddress>Thành phố Đà Nẵng</CusAddress>
                        <Products>
                            <Product>
                                <ProdName>aaa</ProdName>
                                <ProdUnit>tháng</ProdUnit>
                                <ProdQuantity>1</ProdQuantity>
                                <ProdPrice>1231421</ProdPrice>
                                <Amount>1231421</Amount>
                            </Product>
                        </Products>
                        <Total>1231421</Total>
                        <VATRate>0</VATRate>
                        <VATAmount>0</VATAmount>
                        <Amount>1231421</Amount>
                        <AmountInWords>một triệu hai trăm ba mươi một nghìn bốn trăm hai mươi một</AmountInWords>
                        <Buyer>Trần Công Châu</Buyer>
                    </ReplaceInv>
                ',
                'username' => 'ttqlktnhaservice',
                'pass' => '123456aA@',
                'pattern' => '01BLP0-001',
                'serial' => 'KT-23E',
                'convert' => 0,
                'fkey' => 'BL10-2023-126-20230711-947019843',
            );
            $message = $soapClient->ReplaceInv($param);
            $data['status'] = 200;
            $data['message'] = $message;
        } catch(Exception $ex) {
            $data['status'] = 400;
            $data['message'] = $ex->getMessage();
        }
        return $data;
    }

    public function adjust($fkey, $newFkey,$payMethod, $cus_name, $cus_address, $prod_name, $vat, $total_vat, $total_before_vat, $total_price, $adjustType, $pattern, $serial) {
        $data = array();
        try {
            $soapClient = new SoapClient('https://ttquanlykhaithacnhadngadmindemo.vnpt-invoice.com.vn/BusinessService.asmx?wsdl');
            $param = array(
                'Account' => 'ttquanlykhaithacnhadngadmin',
                'ACpass' => 'Einv@oi@vn#pt20',
                'xmlInvData' => '
                    <AdjustInv>
                        <key>'.$newFkey.'</key>
                        <CusCode>'.$newFkey.'</CusCode>
                        <CusName>'.$cus_name.'</CusName>
                        <CusAddress>'.$cus_address.'</CusAddress>
                        <Products>
                            <Product>
                                <ProdName>'.$prod_name.'</ProdName>
                                <Amount>'.$total_price.'</Amount>
                            </Product>
                        </Products>
                        <Total>'.$total_before_vat.'</Total>
                        <VATRate>'.$vat.'</VATRate>
                        <VATAmount>'.$total_vat.'</VATAmount>
                        <Amount>'.$total_price.'</Amount>
                        <AmountInWords>'.convert_curency_to_words($total_price).'</AmountInWords>
                        <Buyer>'.$cus_name.'</Buyer>
                        <CurrencyUnit>VND</CurrencyUnit>
                        <Type>'.$adjustType.'</Type>
                    </AdjustInv>
                ',
                'username' => 'demoservice',
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
            $soapClient = new SoapClient('https://ttquanlykhaithacnhadngadmindemo.vnpt-invoice.com.vn/BusinessService.asmx?wsdl');
            $param = array(
                'Account' => 'ttquanlykhaithacnhadngadmin',
                'ACpass' => 'Einv@oi@vn#pt20',
                'userName' => 'demoservice',
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

    public function getInvViewFkeyNoPay($fkey, $user) {
        $data = array();
        try {
            $soapClient = new SoapClient(rtrim($user->link, '/').'/PortalService.asmx?wsdl');
            $param = array(
                'fkey' => $fkey,
                'userName' => $user->username_api,
                'userPass' => $user->password_api,
            );
            $message = $soapClient->getInvViewFkeyNoPay($param);
            $data['status'] = 200;
            $data['message'] = $message;
        } catch(Exception $ex) {
            $data['status'] = 400;
            $data['message'] = $ex->getMessage();
        }
        return $data['message']->getInvViewFkeyNoPayResult;
    }
}
