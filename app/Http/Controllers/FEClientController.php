<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Http;
use App\Models\ThanhToanMomo;
use Illuminate\Http\Response;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class FEClientController extends Controller
{
    function home(){
        return view('layouts.fe.trangchu');
    }
    function thoiKhoaBieu(){
        return view('layouts.fe.thoikhoabieu');
    }
    function thongTinCaNhan(){
        return view('layouts.fe.thongtincanhan');
    }
    function dongHocPhi(Request $request){
        if($request->all()){
            echo 'OK';
        }

        return view('layouts.fe.donghocphi');
    }
    function dangKyHocPhan(){
        // $url=env('SERVER_URL')."/api/danh-sach-dang-ky-mon-cua-sinh-vien/2";
        // $ch=curl_init($url);
        // curl_setopt($ch, CURLOPT_URL, $url);

        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        // curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        // $data=curl_exec($ch);

        // curl_close($ch);
        // dd($data);
        // $data=Http::get(env('SERVER_URL')."/api/danh-sach-dang-ky-mon-cua-sinh-vien/2");
        // dd($data->json());
        return view('layouts.fe.dangkyhocphan');
    }
    function xemDiem(){
        return view('layouts.fe.xemdiem');
    }
    function xuLyDongHocPhiMoMoQR(Request $request){
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Đóng tiền học phí nè";
        $amount = "50000";
        $orderId = time() ."";
        $redirectUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
        $ipnUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
        $extraData = "";


        // if (!empty($_POST)) {
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
            $requestType = "captureWallet";
            // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
            //before sign HMAC SHA256 signature
            // $rawHash =
            // "accessKey=" . $accessKey .
            // "&amount=" . $amount .
            // "&extraData=" . $extraData .
            // "&ipnUrl=" . $ipnUrl .
            // "&orderId=" . $orderId .
            // "&orderInfo=" . $orderInfo .
            // "&partnerCode=" . $partnerCode .
            // "&redirectUrl=" . $redirectUrl .
            // "&requestId=" . $requestId .
            // "&requestType=" . $requestType;

            $rawHash =
            "accessKey=" . $accessKey .
            "&amount=" . $amount .
            "&extraData=" . $extraData .
            "&orderId=" . $orderId .
            "&orderInfo=" . $orderInfo .
            "&partnerCode=" . $partnerCode .
            "&requestId=" . $requestId .
            "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
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
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);  // decode json
           // dd($jsonResult);
            //Just a example, please check more in there

            return Redirect::to($jsonResult['payUrl']);
        // }
    }
    public function xuLyDongHocPhiPayPal(Request $request){
        //dd($request->all());
        $provider = new PayPalClient;
        $config = [
            'mode'    => 'sandbox',
            'sandbox' => [
                'client_id'         => env('PAYPAL_SANDBOX_CLIENT_ID'),
                'client_secret'     => env('PAYPAL_SANDBOX_CLIENT_SECRET'),
                'app_id'            => 'APP-80W284485P519543T',
            ],

            'payment_action' => 'Sale',
            'currency'       => 'USD',
            'notify_url'     => 'https://e731-125-235-239-91.ngrok-free.app/api/xu-ly-dong-hoc-phi-paypal',
            'locale'         => 'en_US',
            'validate_ssl'   => true,
        ];
        //dd($config);
        $hocPhi=$request->hoc_phi;

        $X_RapidAPI_Key='173ffdb7f4mshd1984723305752bp151783jsnccc3c3a9419d';
        $X_RapidAPI_Host='currency-converter-by-api-ninjas.p.rapidapi.com';
        // $query=array(
        //     'have'=>"VND",
        //     'want'=>"USD",
        //     'amount'=>$hocPhi
        // );

        $url="https://currency-converter-by-api-ninjas.p.rapidapi.com/v1/convertcurrency?have=VND&want=USD&amount=".$hocPhi;
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(

            'X-RapidAPI-Key: ' . $X_RapidAPI_Key,
            'X-RapidAPI-Host: ' . $X_RapidAPI_Host)
        );
        $dataExec=curl_exec($ch);
        $data=json_decode($dataExec);

        $provider->setApiCredentials($config);
        $paypalToken=$provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('xu-ly-dong-hoc-phi-paypal',['type'=>$request->type,"id"=>$request->id]),
                "cancel_url" => route('cancel-dong-hoc-phi'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $data->new_amount,
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return response()->json([
                        'link'=>$links['href']
                    ]);
                }
            }

            return redirect()
                ->route('createTransaction')
                ->with('error', 'Something went wrong.');

        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }

    }
    function huyDongHocPhi(Request $request){
        return view('layouts.fe.camondonghocphi');
    }
    function hienThiTrangCamOnDongHocPhi(Request $request){
        return view('layouts.fe.camondonghocphi');
    }
    function luuThongTinDangKy(Request $request){
        if(isset($request['token'])==false){
            return redirect()->route('trang-chu');
        }
        //dd($request->all());
        $ma_sv=session()->get('ma_sv');
        $config = [
            'mode'    => 'sandbox',
            'sandbox' => [
                'client_id'         => env('PAYPAL_SANDBOX_CLIENT_ID'),
                'client_secret'     => env('PAYPAL_SANDBOX_CLIENT_SECRET'),
                'app_id'            => 'APP-80W284485P519543T',
            ],

            'payment_action' => 'Sale',
            'currency'       => 'USD',
            'notify_url'     => 'https://e731-125-235-239-91.ngrok-free.app/api/xu-ly-dong-hoc-phi-paypal',
            'locale'         => 'en_US',
            'validate_ssl'   => true,
        ];
        $provider = new PayPalClient;
        $provider->setApiCredentials($config);
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        //dd($response);
        //dd($response);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            //Xử lí thêm trong đây
            $data=json_decode(json_encode($response));
            //dd($data);
            $rawHash="payment_id=" . $data->id . "&payer_email_address=" . $data->payer->email_address . "&payer_id=" . $data->payer->payer_id . "&gross_amount=" . $data->purchase_units[0]->payments->captures[0]->seller_receivable_breakdown->gross_amount->value . "&paypal_fee=". $data->purchase_units[0]->payments->captures[0]->seller_receivable_breakdown->paypal_fee->value . "&net_amount=" . $data->purchase_units[0]->payments->captures[0]->seller_receivable_breakdown->net_amount->value . "&currency_code=" . $data->purchase_units[0]->payments->captures[0]->amount->currency_code . "&id_hoc_phi=" . $request->id . "&ma_sv=" . $ma_sv . "&type=" . $request->type;
            $signature=hash_hmac("sha256",$rawHash,env('PAYPAL_LIVE_CLIENT_SECRET'));
            //dd($rawHash);
            $data = array('payment_id' => $data->id,
                'payer_email_address' => $data->payer->email_address,
                "payer_id" =>  $data->payer->payer_id,
                'gross_amount' => $data->purchase_units[0]->payments->captures[0]->seller_receivable_breakdown->gross_amount->value,
                'paypal_fee' => $data->purchase_units[0]->payments->captures[0]->seller_receivable_breakdown->paypal_fee->value,
                'net_amount' => $data->purchase_units[0]->payments->captures[0]->seller_receivable_breakdown->net_amount->value ,
                'currency_code' => $data->purchase_units[0]->payments->captures[0]->amount->currency_code,
                'id_hoc_phi' => $request->id,
                'type'=>$request->type,
                'ma_sv' => $ma_sv,
                'signature' => $signature);
            $url=env('SERVER_URL')."/api/xu-ly-dong-hoc-phi-paypal";
            $result=$this->execPostRequest($url,json_encode($data));
            $resultJson=json_decode($result);
           // dd($resultJson);
            if($resultJson->status==1){
                return redirect()
                ->route('cam-on-dong-hoc-phi')
                ->with('success', 'Đóng học phí thành công.');
            }else{
                return redirect()
                ->route('cam-on-dong-hoc-phi')
                ->with('error', 'Lỗi hệ thống!.');
            }

        } else {
            return redirect()
                ->route('trang-chu')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    function xuLyDongHocPhiVNPay(Request $request){

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $vnp_Returnurl = route('luu-thong-tin-dong-hoc-phi-vnpay',['id_hoc_phi'=>$request->id,'type'=>$request->type,'ma_sv'=>session()->get('ma_sv')]);
        //Config input format
        //Expire
        $startTime = date("YmdHis");
        $expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));
        $vnp_TxnRef = rand(1,10000); //Mã giao dịch thanh toán tham chiếu của merchant
        $vnp_Amount = $request->hoc_phi; // Số tiền thanh toán
        $vnp_Locale = "vn"; //Ngôn ngữ chuyển hướng thanh toán
        $vnp_BankCode = "VNBANK"; //Mã phương thức thanh toán
        $vnp_IpAddr = $request->ip(); //IP Khách hàng thanh toán

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => env('VNP_TMNCODE'),
            "vnp_Amount" => $vnp_Amount*100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD:". $vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate"=>$expire
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

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

        $vnp_Url = env('VNP_URL') . "?" . $query;
        if (null!==env('VNP_HASHSECRET')) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, env('VNP_HASHSECRET'));//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return response()->json(['link'=>$vnp_Url],201);
    }
    function luuThongTinDongHocPhiVNPay(Request $request){
        //dd($request->all());
        $url=env('SERVER_URL')."/api/xu-ly-dong-hoc-phi-vnpay";
        $inputData = array();
        $returnData = array();
        foreach ($request->all() as $key => $value) {
                    if (substr($key, 0, 4) == "vnp_") {
                        $inputData[$key] = $value;
                    }
                }
        //dd($inputData);
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }
        $inputDataSend=$inputData;
        $queryString=$hashData."&vnp_SecureHash=".$vnp_SecureHash;
        //dd($queryString);
        $secureHash = hash_hmac('sha512', $hashData, env('VNP_HASHSECRET'));
        $vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
        $vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
        $vnp_Amount = $inputData['vnp_Amount']/100; // Số tiền thanh toán VNPAY phản hồi
        //dd($secureHash);
        if($secureHash==$request->vnp_SecureHash){
            // $Status = 0; // Là trạng thái thanh toán của giao dịch chưa có IPN lưu tại hệ thống của merchant chiều khởi tạo URL thanh toán.
            $orderId = $inputData['vnp_TxnRef'];
            $vnp_RequestId = rand(1,10000); // Mã truy vấn
            $vnp_Command = "querydr"; // Mã api
            $vnp_TxnRef = $request->vnp_TxnRef; // Mã tham chiếu của giao dịch
            $vnp_OrderInfo = "Query transaction"; // Mô tả thông tin
            //$vnp_TransactionNo= ; // Tuỳ chọn, Mã giao dịch thanh toán của CTT VNPAY
            $vnp_TransactionDate = $request->vnp_PayDate; // Thời gian ghi nhận giao dịch
            $vnp_CreateDate = date('YmdHis'); // Thời gian phát sinh request
            $vnp_IpAddr = $request->ip(); // Địa chỉ IP của máy chủ thực hiện gọi API


            $datarq = array(
                "vnp_RequestId" => $vnp_RequestId,
                "vnp_Version" => "2.1.0",
                "vnp_Command" => $vnp_Command,
                "vnp_TmnCode" => env('VNP_TMNCODE'),
                "vnp_TxnRef" => $vnp_TxnRef,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                //$vnp_TransactionNo= ;
                "vnp_TransactionDate" => $vnp_TransactionDate,
                "vnp_CreateDate" => $vnp_CreateDate,
                "vnp_IpAddr" => $vnp_IpAddr
            );

            $format = '%s|%s|%s|%s|%s|%s|%s|%s|%s';

            $dataHash = sprintf(
                $format,
                $datarq['vnp_RequestId'], //1
                $datarq['vnp_Version'], //2
                $datarq['vnp_Command'], //3
                $datarq['vnp_TmnCode'], //4
                $datarq['vnp_TxnRef'], //5
                $datarq['vnp_TransactionDate'], //6
                $datarq['vnp_CreateDate'], //7
                $datarq['vnp_IpAddr'], //8
                $datarq['vnp_OrderInfo']//9
            );
            //dd($dataHash);
            $checksum = hash_hmac('SHA512', $dataHash, env('VNP_HASHSECRET'));
            //dd($checksum);
            $datarq["vnp_SecureHash"] = $checksum;
            $txnData = $this->callAPI_auth("POST", env('API_URL'), json_encode($datarq));
            $ispTxn = json_decode($txnData, true);
            //dd($ispTxn);
            //dd($request->all());
            if($ispTxn["vnp_ResponseCode"]=="00"){
                $jsonResult=$this->execPostRequest($url,json_encode($request->all()));
                $jsonDecode=json_decode($jsonResult);
                if($jsonDecode->status==1){
                    return view('layouts.fe.camondonghocphi');
                }
                else{
                    if($jsonDecode->status==3){
                        return redirect()->route('dong-hoc-phi')->with('error_parameter_request',"Lỗi tham số");
                    }
                    else{
                        return redirect()->route('dong-hoc-phi')->with('error_server',"Lỗi phía server");
                    }
                }
            }
        }

    }
    function callAPI_auth($method, $url, $data)
    {
        $curl = curl_init();
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // EXECUTE:
        $result = curl_exec($curl);
        if (!$result) {
            die("Connection Failure");
        }
        curl_close($curl);
        return $result;
    }
    function xuLyDongHocPhiMoMoATM(Request $request){
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = "10000";
        $orderId = time() ."";
        $redirectUrl = "http://127.0.0.1:8001/cam-on-dong-hoc-phi";
        $ipnUrl = "https://e731-125-235-239-91.ngrok-free.app/api/xu-ly-dong-hoc-phi-momo";
        $extraData = "";


        // if (!empty($_POST)) {
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
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);  // decode json
            //dd($jsonResult);
            //Just a example, please check more in there

    // header('Location: ' . $jsonResult['payUrl']);
            return Redirect::to($jsonResult['payUrl']);
        // }
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
        return $result;
    }


    function chonLopDangKyMon(Request $request){
        return view('layouts.fe.chonlophocphandangky');
    }
    function dangNhap(){
        return view('layouts.fe.dangnhap');
    }

    function xuLyDangNhap(Request $request){
        $url=env('SERVER_URL')."/api/login-sinh-vien?tai_khoan=".$request->tai_khoan."&mat_khau=".$request->mat_khau;
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        //curl_setopt($ch, CURLOPT_HEADER, TRUE);
        //curl_setopt($ch, CURLOPT_NOBODY, TRUE);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $head = curl_exec($ch);
        curl_close($ch);
        $data=json_decode($head);
        //dd($data->sinh_vien->id);
        if($data->token!=null){
            // $response = new Response('Set Cookie');
            // $response=redirect()->route('trang-chu')->withCookie(cookie('access_token', $data->token, 60));
            session()->put('access_token',$data->token);
            session()->put('ma_sv', $data->sinh_vien->ma_sv);
            //$response->withCookie(cookie('id_sinh_vien',$data->sinh_vien->id, 60));
            return redirect()->route('trang-chu');
        }
        return redirect()->route('dang-nhap');
    }
    function logOut(Request $request){
        // $accessToken = $request->cookie('access_token');
        // $id_sinh_vien=$request->cookie('id_sinh_vien');
        $accessToken = session()->get('access_token');
        $ma_sv=session()->get('ma_sv');
        $url=env('SERVER_URL')."/api/logout?ma_sv=".$ma_sv;
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        // curl_setopt($ch, CURLOPT_POSTFIELDS,
        //     "id=".$request->id_sinh_vien);
        curl_setopt($ch,CURLOPT_HTTPHEADER,array("Authorization: Bearer $accessToken"));
        $head=curl_exec($ch);
        //dd($head);
        curl_close($ch);
        $data=json_decode($head);
        //dd($data);
        if($data->code=201){
            session()->forget('ma_sv');
            session()->forget('access_token');
            // $response =response('Goodbye_token')->cookie('access_token', '', 0);
            // $response->cookie('id_sinh_vien', '', 0);
            return redirect()->route('dang-nhap');
        }
    }
}
