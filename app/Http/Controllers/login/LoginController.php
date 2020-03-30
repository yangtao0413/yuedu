<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Validation\Rule;
class LoginController extends Controller
{
    public function register(){
        return view('Login/register');
    }
    public function registerto(\App\Http\Requests\Rule $request){
        // $data = $_POST;
        
        $info = $request->input();
        // dd($info);
        unset($info['_token']);
        unset($info['password2']);//过滤掉确认密码  
        if ($info['password'] != $info['password']){
        // }else{
        //     unset($data['password2']);
        //     $data['password'] = md5($data['password']);
        }
        $res=User::insert($info);
        if ($res){
            return redirect("/Login/login");
        }else{
            return redirect("/Login/register");
        }

    }
    public function Login(){
        return view('Login/login');
    }
    public function Loginto(Request $request){
        $info = $request->all();
        $res=User::where(['tel'=>$info['tel']])->first();
        // $info['password'] = md5($info['password']);
        if(!empty($res)){ 
            if($info['password'] != $res->password){
                return redirect('/Login/login')->with('msg','密码错误');
            }else{
                session(['user'=>$res]);
                return redirect('/index');
            }
        }else{
            return redirect('/Login/login')->with('msg','用户名错误');
            
        }       
    }
    // public function Loginto(){
    //     $data=\request()->all();
    //     $tel=\request()->post("tel");
    //     //dd($tel);
    //     unset($data['_token']);
    //     $res=User::where('tel',$data['tel'])->first();
    //         if ($res){
    //             if ($res['password']==md5($data['password'])){
    //                 return view("/Index/index",['tel'=>$tel]);
    //             }else{
    //                 return redirect("/Login/login");
    //             }
    //         }else{
    //             return redirect("/Login/login");
    //         }

    // }







    public function qrcode(Request $request){
        $url = storage_path('app/public/phpqrcode.php');
        include($url);
        // include '/phpqrcode.php';
        //区分是谁登录的，生成一个唯一的用户标识 
        $uid = uniqid();         
        // echo $uid;die;
        $url = "http://readzhaohe.dongjiayi.top/index/qrcode?uid = ".$uid;
        $obj = new QrCode();
        $obj->png($url,'./1.png');

        // return view('Index.qrcode');
    }
    /*点击退出*/ 
    public function quit(){
        session(['user'=>null]);
        return redirect('/');
    }

     public function curlPost($url, $data, $method)
    {
        $ch = curl_init(); //1.初始化
        curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//3.请求方式
    //4.参数如下
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Encoding: gzip, deflate'));//gzip解压内容
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
        if ($method == "POST") {//5.post方式的时候添加数据
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);//6.执行
        if (curl_errno($ch)) {//7.如果出错
            return curl_error($ch);
        }
        curl_close($ch);//8.关闭
        return $tmpInfo;
    }
}
