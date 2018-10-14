<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\Auth;
use App\Collector;
use App\Hightransformer;
use App\Hometable;
use App\Lowtransformer;
use App\Meteringbox;
use App\Mixtransformer;
use App\Terminal;
use Illuminate\Http\Request;
use App\Products;
use App\Region;
use App\Std;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index (Request $request)
    {
        $data = array();

        return view('index',['data'=>$data]);
    }
    public function  home (Request $request)
    {
        $data = array();

        return view('home',['data'=>$data]);
    }


    /*   公共api   */
    //检查号段是否重复
    public function checkTableNum(Request $request){
        $data = array();
        $data['status'] = 400;
        $tablenum = $request->input('tablenum');
        $checktable1 = Collector::where('start_table_num','<=',$tablenum)
            ->where('end_table_num','>=',$tablenum)
            ->count();
        $checktable2 = Hometable::where('start_table_num','<=',$tablenum)
            ->where('end_table_num','>=',$tablenum)
            ->count();
        $checktable3 = Lowtransformer::where('start_table_num','<=',$tablenum)
            ->where('end_table_num','>=',$tablenum)
            ->count();
        $checktable4 = Hightransformer::where('start_table_num','<=',$tablenum)
            ->where('end_table_num','>=',$tablenum)
            ->count();
        $checktable5 = Mixtransformer::where('start_table_num','<=',$tablenum)
            ->where('end_table_num','>=',$tablenum)
            ->count();
        $checktable6 = Meteringbox::where('start_table_num','<=',$tablenum)
            ->where('end_table_num','>=',$tablenum)
            ->count();
        $checktable7 = Terminal::where('start_table_num','<=',$tablenum)
            ->where('end_table_num','>=',$tablenum)
            ->count();

//        $totalnum = $checktable1 + $checktable2 + $checktable3 + $checktable4 + $checktable5;
        if($checktable1 > 0){
            $data['msg'] = "号段与集中器表格中号段重复";
        }elseif ($checktable2 >0){
            $data['msg'] = "号段与户表表格中号段重复";
        }elseif ($checktable3 >0){
            $data['msg'] = "号段与低压互感器表格中号段重复";
        }elseif ($checktable4 >0){
            $data['msg'] = "号段与高压互感器表格中号段重复";
        }elseif ($checktable5 >0){
            $data['msg'] = "号段与组合式互感器表格中号段重复";
        }elseif ($checktable6 >0){
            $data['msg'] = "号段与计量箱表格中号段重复";
        }elseif ($checktable7 >0){
            $data['msg'] = "号段与专变终端表格中号段重复";
        }
        else{
            $data['status'] = 200;
        }
        return $data;
    }

    static public function hasAuth($username , $auth){
        if($username == "" || $auth == ""){
            return 0;
        }
        $hasAuth = Auth::where('username',$username)->first();
        if($hasAuth == "") return 0;
        else {
            foreach (explode(';',$hasAuth->auth) as $item){
                if($item == $auth || $item == 'all'){
                    return 1;
                }
            }
            return 0;
        }
    }
}
