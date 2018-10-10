<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\Authmanage;
use App\Company;
use App\Products;
use App\Region;
use App\Std;
use App\Vender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
const AUTH_REGION = "all";
class QSDBAdminController extends Controller
{
    /*  页面显示api  */
    public function index (Request $request)
    {
        $data = array();

        $data['vender'] = Vender::orderBy('updated_at','desc')->paginate(16);
        return view('qsdb.admin',['data'=>$data]);
    }
    public function homeindex(Request $request){
        $data = array();

        $data['vender'] = Company::orderBy('updated_at','desc')->paginate(16);
        return view('qsdb.admin2',['data'=>$data]);
    }
    /*   页面操作api   */
    public function adminAdd(Request $request)
    {
        $data['status'] = 400;
        $data['msg'] = "未知错误";
        if ($request->has('name')) {
            $name = $request->input('name');

            $has_name = Vender::where('name', $name)->count();
            if ($has_name > 0) {
                $data['msg'] = "厂家已存在，请先删除！";
                return $data;
            }
            $newauth = new Vender();

            $newauth->name = $name;

            try {
                if ($newauth->save()) {
                    $data['status'] = 200;
                    $data['msg'] = "操作成功";
                    return $data;
                } else {
                    $data['status'] = 400;
                    $data['msg'] = "数据库错误";
                    return $data;
                }
            } catch (\Illuminate\Database\QueryException $ex) {
                $data['msg'] = "数据库错误" . $ex->getMessage();
                return $data;
            }
        } else {
            $data['msg'] = "参数错误";
            return $data;
        }
    }
    public function adminDelete(Request $request){
        $data['status'] = 400;
        $data['msg'] = "未知错误";
            if($request->has('id')){
                $rid = $request->input('id');
                try {
                    Vender::where('id', $rid)->delete();
                    $data['status'] = 200;
                    $data['msg'] = "删除成功";
                }catch (\Illuminate\Database\QueryException $ex){
                    $data['msg'] = "数据库错误" . $ex->getMessage();
                }
                return $data;
            }else{
                $data['msg'] = "参数错误";
                return $data;
            }
    }
    public function adminhomeAdd(Request $request)
    {
        $data['status'] = 400;
        $data['msg'] = "未知错误";
        if ($request->has('name')) {
            $name = $request->input('name');

            $has_name = Company::where('name', $name)->count();
            if ($has_name > 0) {
                $data['msg'] = "厂家已存在，请先删除！";
                return $data;
            }
            $newauth = new Company();

            $newauth->name = $name;

            try {
                if ($newauth->save()) {
                    $data['status'] = 200;
                    $data['msg'] = "操作成功";
                    return $data;
                } else {
                    $data['status'] = 400;
                    $data['msg'] = "数据库错误";
                    return $data;
                }
            } catch (\Illuminate\Database\QueryException $ex) {
                $data['msg'] = "数据库错误" . $ex->getMessage();
                return $data;
            }
        } else {
            $data['msg'] = "参数错误";
            return $data;
        }
    }
    public function adminhomeDelete(Request $request){
        $data['status'] = 400;
        $data['msg'] = "未知错误";
        if($request->has('id')){
            $rid = $request->input('id');
            try {
                Company::where('id', $rid)->delete();
                $data['status'] = 200;
                $data['msg'] = "删除成功";
            }catch (\Illuminate\Database\QueryException $ex){
                $data['msg'] = "数据库错误" . $ex->getMessage();
            }
            return $data;
        }else{
            $data['msg'] = "参数错误";
            return $data;
        }
    }
}
