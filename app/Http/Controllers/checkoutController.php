<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class checkoutController extends Controller
{
    public function vnpay_payment(Request $request){
        $code_card = rand(00,9999);//randum mã đơn hàng để test

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/admin";
        $vnp_TmnCode = "L7QQHQCG";//Mã website tại VNPAY 
        $vnp_HashSecret = "O1DDKYJE367YA0UWXSWN8E822Q7TBDH2"; //Chuỗi bí mật
        
        $vnp_TxnRef = $code_card; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán đơn hàng test";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = 20000 * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
        // $vnp_Bill_Email = $_POST['txt_billing_email'];
        // $fullName = trim($_POST['txt_billing_fullname']);
        // if (isset($fullName) && trim($fullName) != '') {
        //     $name = explode(' ', $fullName);
        //     $vnp_Bill_FirstName = array_shift($name);
        //     $vnp_Bill_LastName = array_pop($name);
        // }
        // $vnp_Bill_Address=$_POST['txt_inv_addr1'];
        // $vnp_Bill_City=$_POST['txt_bill_city'];
        // $vnp_Bill_Country=$_POST['txt_bill_country'];
        // $vnp_Bill_State=$_POST['txt_bill_state'];
        // // Invoice
        // $vnp_Inv_Phone=$_POST['txt_inv_mobile'];
        // $vnp_Inv_Email=$_POST['txt_inv_email'];
        // $vnp_Inv_Customer=$_POST['txt_inv_customer'];
        // $vnp_Inv_Address=$_POST['txt_inv_addr1'];
        // $vnp_Inv_Company=$_POST['txt_inv_company'];
        // $vnp_Inv_Taxcode=$_POST['txt_inv_taxcode'];
        // $vnp_Inv_Type=$_POST['cbo_inv_type'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            // "vnp_ExpireDate"=>$vnp_ExpireDate,
            // "vnp_Bill_Mobile"=>$vnp_Bill_Mobile,
            // "vnp_Bill_Email"=>$vnp_Bill_Email,
            // "vnp_Bill_FirstName"=>$vnp_Bill_FirstName,
            // "vnp_Bill_LastName"=>$vnp_Bill_LastName,
            // "vnp_Bill_Address"=>$vnp_Bill_Address,
            // "vnp_Bill_City"=>$vnp_Bill_City,
            // "vnp_Bill_Country"=>$vnp_Bill_Country,
            // "vnp_Inv_Phone"=>$vnp_Inv_Phone,
            // "vnp_Inv_Email"=>$vnp_Inv_Email,
            // "vnp_Inv_Customer"=>$vnp_Inv_Customer,
            // "vnp_Inv_Address"=>$vnp_Inv_Address,
            // "vnp_Inv_Company"=>$vnp_Inv_Company,
            // "vnp_Inv_Taxcode"=>$vnp_Inv_Taxcode,
            // "vnp_Inv_Type"=>$vnp_Inv_Type
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
            // vui lòng tham khảo thêm tại code demo
    }

    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        // dd($result);
        return $result;
    }

    public function momo_payment(Request $requests){
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua ATM MoMo";
        $amount = "10000";
        $orderId = time() . "";
        $redirectUrl = "http://127.0.0.1:8000/admin";
        $ipnUrl = "http://127.0.0.1:8000/admin";
        $extraData = "";
        // $partnerCode = $_POST["partnerCode"];
        // $accessKey = $_POST["accessKey"];
        // $serectkey = $_POST["secretKey"];
        // $orderId = $_POST["orderId"]; // Mã đơn hàng
        // $orderInfo = $_POST["orderInfo"];
        // $amount = $_POST["amount"];
        // $ipnUrl = $_POST["ipnUrl"];
        // $redirectUrl = $_POST["redirectUrl"];
        // $extraData = $_POST["extraData"];
        $requestId = time() . "";
        $requestType = "payWithATM";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        // dd($signature);
        $data = array('partnerCode' => $partnerCode,
        'partnerName' => "Test",
        "storeId" => "MomoTestStore",
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $redirectUrl,
        'ipnUrl' => $ipnUrl,
        'lang' => 'vi',
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature);
        // dd(json_encode($data));
        $result = $this->execPostRequest($endpoint, json_encode($data));
        // dd($result);
        $jsonResult = json_decode($result, true);  // decode json
        //Just a example, please check more in there
        return redirect()->to($jsonResult['payUrl']);
        // header('Location: ' . $jsonResult['payUrl']);

    }

    protected function config()
    {
        $config = '
                    {
                        "partnerCode": "MOMOBKUN20180529",
                        "accessKey": "klm05TvNBzhg7h7j",
                        "secretKey": "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa"
                    }
                ';
        return json_decode($config, true);
    }

    public function payMomo()
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $array = $this->config();

        $partnerCode = $array["partnerCode"];
        $accessKey = $array["accessKey"];
        $secretKey = $array["secretKey"];
        $orderInfo = "Thanh toán qua MoMo";
        $amount = 20000;
        $orderId = time() . "";
        // $extraData = "merchantName=MoMo Partner";
        $extraData = "";

        $requestId = time() . "";
        $requestType = "captureWallet";
        // $redirectUrl =  route('momo.return');
        $redirectUrl =  "http://127.0.0.1:8000/admin";
        $ipnUrl = "http://api.course-selling.id.vn/api/order/payment-notification";
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        // dd($signature);
        $data = array(
            'partnerCode' => $partnerCode,
            // 'partnerName' => "Test",
            // "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json
        // dd($jsonResult);
        // return $jsonResult;
        return redirect()->to($jsonResult['payUrl']);
    }

    // Phương thức để xử lý kết quả thanh toán từ MoMo
    // public function momoReturn(Request $request)
    // {
    //     http_response_code(200); //200 - Everything will be 200 Oke
    //     $array = $this->config();
    //     try {
    //         $accessKey = $array["accessKey"];
    //         $secretKey = $array["secretKey"];

    //         $partnerCode = $request->input(["partnerCode"]);
    //         $orderId = $request->input(["orderId"]);
    //         $requestId = $request->input(["requestId"]);
    //         $amount = $request->input(["amount"]);
    //         $orderInfo = $request->input(["orderInfo"]);
    //         $orderType = $request->input(["orderType"]);
    //         $transId = $request->input(["transId"]);
    //         $resultCode = $request->input(["resultCode"]);
    //         $message = $request->input(["message"]);
    //         $payType = $request->input(["payType"]);
    //         $responseTime = $request->input(["responseTime"]);
    //         $extraData = $request->input(["extraData"]);
    //         $m2signature = $request->input(["signature"]); //MoMo signature

    //         //Checksum
    //         $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&message=" . $message . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&orderType=" . $orderType . "&partnerCode=" . $partnerCode . "&payType=" . $payType . "&requestId=" . $requestId . "&responseTime=" . $responseTime . "&resultCode=" . $resultCode . "&transId=" . $transId;
    //         $partnerSignature = hash_hmac("sha256", $rawHash, $secretKey);
    //         // dd($request->input(), ['new' => $partnerSignature]);

    //         if ($m2signature == $partnerSignature) {
    //             // dd('=');
    //             if ($resultCode == '0') {
    //                 // Thanh toán thành công
    //                 $data = [
    //                     'Payment_status' => $message,
    //                     'order_id' => $orderId,
    //                     'amount' => $amount,
    //                     'Payment_method' => $payType
    //                 ];
    //                 order::where('order_id', $orderId)->first()->update(['order_status' => 1, 'checkoutUrl' => 'done']);
    //                 // dd(order::where('order_id', $orderId)->first());
    //                 DB::table('logs')->insert(['log' => json_encode($data)]);
    //             } else {
    //                 // Thanh toán thất bại
    //                 $data = [
    //                     'Payment_status' => $message,
    //                     'order_id' => $orderId,
    //                 ];
    //                 DB::table('logs')->insert(['log' => json_encode($data)]);
    //             }
    //         } else {
    //             // Chữ ký không hợp lệ
    //             // dd('!=');
    //             $data = [
    //                 'danger' => "Giao dịch này có thể bị hack, vui lòng kiểm tra chữ ký của bạn và trả lại chữ ký",
    //                 'order_id' => $orderId,
    //             ];
    //             DB::table('logs')->insert(['log' => json_encode($data)]);
    //         }
    //     } catch (\Exception $e) {
    //         DB::table('logs')->insert(['log' => $e->getMessage()]);
    //     }

    //     $debugger = array();

    //     if ($m2signature == $partnerSignature) {
    //         $debugger['rawData'] = $rawHash;
    //         $debugger['momoSignature'] = $m2signature;
    //         $debugger['partnerSignature'] = $partnerSignature;
    //         $debugger['message'] = "Received payment result success";
    //     } else {
    //         $debugger['rawData'] = $rawHash;
    //         $debugger['momoSignature'] = $m2signature;
    //         $debugger['partnerSignature'] = $partnerSignature;
    //         $debugger['message'] = "ERROR! Fail checksum";
    //     }
    //     return view('success', [
    //         'response' => $request->input(),
    //         'debugger' => $debugger
    //     ]);
    // }
}
