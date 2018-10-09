<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;
use App\Collector;
use App\Company;
use App\Hometable;
use App\Vender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Psy\Util\Json;

class DBTable2Controller extends Controller
{
    public function index (Request $request)
    {
        $data = array();
        if($request->has('date')){
            $date = $request->input('date');
            $starttime = strtotime(explode('-',$date)[0]);
            $endtime = strtotime(explode('-',$date)[1]);
            $data['hometable'] = Hometable::where('created_at','>=',date("Y-m-d", $starttime))
                ->where('created_at','<=',date("Y-m-d",$endtime))
                ->get();
//            return $starttime ."  " . $endtime;
        }else{
            $data['hometable'] = Hometable::all();
        }
        $data['vender'] = Company::all();
        //取最大的tablenum
        $data['maxnum'] = Hometable::max('end_table_num');
        $temp1 = substr($data['maxnum'],0,10);
        $temp2 = substr($data['maxnum'],10,12);
        $temp3 = $temp2 + 1;
        $data['maxnum'] = $temp1 . $temp3;
//        return $data;
        return view('qsdb.table2',['data'=>$data]);
    }
    public function postdata(Request $request){
        $data = array();
        $data['status'] = 400;
        $data['msg'] = '未知错误';
        $newdata = new Hometable();
        try{
            $newdata->vender_name = $request->input('vender');
            $newdata->model = $request->input('model');
            $newdata->voltage = $request->input('voltage');
            $newdata->electric = $request->input('electric');
            $newdata->region = $request->input('region');
            $newdata->company = $request->input('company');
            $newdata->project = $request->input('project');
            $newdata->type = $request->input('type');
            $newdata->num = $request->input('num');
            $newdata->start_table_num = $request->input('tablenum');
            if($request->input('num') == 1){
                $newdata->end_table_num = $request->input('tablenum');
            }else{
                $temp1 = substr($request->input('tablenum'),0,10);
                $temp2 = substr($request->input('tablenum'),10,12);
                $temp3 = $temp2 + ($request->input('num') - 1);
                $newdata->end_table_num = $temp1 . $temp3;
            }
            $newdata->contacts = $request->input('contacts');
            $newdata->created_at = strtotime($request->input('date'));
            if($newdata->save()){
                $data['status'] = 200;
                $data['msg'] = '保存成功';
            }
        }catch (\Illuminate\Database\QueryException $ex) {
            $data['msg'] = "数据库错误" . $ex->getMessage();
            return $data;
        }
        return $data;
    }
}