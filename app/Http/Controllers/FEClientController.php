<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Http;
use App\Models\ThanhToanMomo;
use Illuminate\Http\Response;

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
        // $url="http://127.0.0.1:8000/api/danh-sach-dang-ky-mon-cua-sinh-vien/2";
        // $ch=curl_init($url);
        // curl_setopt($ch, CURLOPT_URL, $url);

        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        // curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        // $data=curl_exec($ch);

        // curl_close($ch);
        // dd($data);
        // $data=Http::get("http://127.0.0.1:8000/api/danh-sach-dang-ky-mon-cua-sinh-vien/2");
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
    function luuThongTinDangKy(Request $request){
        if ($request->all()) {
            try {
                // dd($request->ip());
                //dd($referer = $request->header('Referer'));
                //dd($userAgent = $request->header('User-Agent'));
                //dd($cookie = $request->header('Cookie'));
                if($request->resultCode==0){
                    //dd($request->all());
                    $thanh_toan_momo=ThanhToanMomo::create([
                        "orderId"=>$request->orderId,
                        "requestId"=>$request->requestId,
                        "amount"=>$request->amount,
                        "orderInfo"=>$request->orderInfo,
                        "orderType"=>$request->orderType,
                        "transId"=>$request->transId,
                        "resultCode"=>$request->resultCode,
                        "message"=>$request->message,
                        "payType"=>$request->payType,
                        "responseTime"=>$request->responseTime,
                        "extraData"=>$request->extraData,
                        "signature"=>$request->signature,
                    ]);

                    return "Thanh toán thành công";


                }
                else {
                    return "Not OK";
                }
            } catch (\Throwable $th) {
                return 'ERROR';
            }
        }
    }

    function xuLyDongHocPhiMoMoATM(Request $request){
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Đóng tiền học phí nè";
        $amount = "50000";
        $orderId = time() ."";
        $redirectUrl = "http://127.0.0.1:8000/cam-on-dong-hoc-phi";
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
            $requestType = "payWithATM";
            // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
            //before sign HMAC SHA256 signature
            $rawHash =
            "accessKey=" . $accessKey .
            "&amount=" . $amount .
            "&extraData=" . $extraData .
            "&ipnUrl=" . $ipnUrl .
            "&orderId=" . $orderId .
            "&orderInfo=" . $orderInfo .
            "&partnerCode=" . $partnerCode .
            "&redirectUrl=" . $redirectUrl .
            "&requestId=" . $requestId .
            "&requestType=" . $requestType;
            // $rawHash =
            // "accessKey=" . $accessKey .
            // "&amount=" . $amount .
            // "&extraData=" . $extraData .
            // "&orderId=" . $orderId .
            // "&orderInfo=" . $orderInfo .
            // "&partnerCode=" . $partnerCode .
            // "&requestId=" . $requestId .
            // "&requestType=" . $requestType;
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
        $url="http://127.0.0.1:8000/api/login-sinh-vien?tai_khoan=".$request->tai_khoan."&mat_khau=".$request->mat_khau;
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
            $response = new Response('Set Cookie');
            $response=redirect()->route('trang-chu')->withCookie(cookie('access_token', $data->token, 60));
            $response->withCookie(cookie('id_sinh_vien',$data->sinh_vien->id, 60));
            return $response;
        }
        return redirect()->route('dang-nhap');
    }
    function logOut(Request $request){
        $accessToken = $request->cookie('access_token');
        $id_sinh_vien=$request->cookie('id_sinh_vien');
        $url="http://127.0.0.1:8000/api/logout?id=".$id_sinh_vien;
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
            $response =response('Goodbye_token')->cookie('access_token', '', 0);
            $response->cookie('id_sinh_vien', '', 0);
            return redirect()->route('dang-nhap');
        }
    }
}
