<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //$accessToken=$request->header('Authorization');
        //dd($request);
        $accessToken = session()->get('access_token');
        $id_sinh_vien=session()->get('id_sinh_vien');
        //dd(session()->get('id_sinh_vien'));
        //dd($id_sinh_vien);
        //dd($accessToken);
        if($request->is('dang-nhap')&&($accessToken==null||$id_sinh_vien==null)){
            return $next($request);
        }
        if($accessToken!=null){
            $url=env('SERVER_URL')."/api/check-login?id=".$id_sinh_vien;

            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            //curl_setopt($ch, CURLOPT_HEADER, TRUE);
            //curl_setopt($ch, CURLOPT_NOBODY, TRUE);
            curl_setopt($ch,CURLOPT_HTTPHEADER,array("Authorization: Bearer $accessToken"));

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $head = curl_exec($ch);
            curl_close($ch);
            $data=json_decode($head);
            //dd($data);

            if($request->is('dang-nhap')&&is_null($data)){
                return $next($request);
            }
            if(is_null($data)==false){
                if($request->is('dang-nhap')&&$data->status){
                    return redirect()->route('trang-chu');
                }
                if($data->status)
                    return $next($request);
            }

        }
        return redirect()->route('dang-nhap');
    }
}
