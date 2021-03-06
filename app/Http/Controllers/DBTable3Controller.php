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
use App\Lowtransformer;
use App\Vender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Psy\Util\Json;

class DBTable3Controller extends Controller
{
    public function index (Request $request)
    {
        $data = array();
        if($request->has('date')){
            $date = $request->input('date');
            $starttime = strtotime(explode('-',$date)[0]);
            $endtime = strtotime(explode('-',$date)[1]);
            $data['lowtransformer'] = Lowtransformer::where('created_at','>=',date("Y-m-d", $starttime))
                ->where('created_at','<=',date("Y-m-d",$endtime))
                ->get();
//            return $starttime ."  " . $endtime;
        }elseif($request->has('tablenum')){
            $tablenum = $request->input('tablenum');
            $data['lowtransformer'] = Lowtransformer::where('start_table_num','<=',$tablenum)
                ->where('end_table_num','>=',$tablenum)
                ->get();
        }else{
            $data['lowtransformer'] = Lowtransformer::all();
        }

        //取最大的tablenum
        $data['maxnum'] = Lowtransformer::max('end_table_num');
        $temp1 = substr($data['maxnum'],0,10);
        $temp2 = substr($data['maxnum'],10,12);
        $temp3 = $temp2 + 1;
        $data['maxnum'] = $temp1 . $temp3;
//        return $data;
        return view('qsdb.table3',['data'=>$data]);
    }
    public function postdata(Request $request){
        $data = array();
        $data['status'] = 400;
        $data['msg'] = '未知错误';
        $id = $request->input('id');
        if($id == -1){//新增操作
            $newdata = new Lowtransformer();
        }else{
            $newdata = Lowtransformer::find($id);
        }
        try{
            $newdata->vender_name = $request->input('vender');
            $newdata->model = $request->input('model');
            $newdata->variable = $request->input('variable');
            $newdata->accuracy = $request->input('accuracy');
            $newdata->region = $request->input('region');
            $newdata->company = $request->input('company');
            $newdata->project = $request->input('project');
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
    public function delete(Request $request){
        $data  = array();
        $data['status'] = 400;
        $data['msg'] = '未知错误';
        $id = $request->input('id');
        try {
            Lowtransformer::where('id', $id)->delete();
            $data['status'] = 200;
            $data['msg'] = '删除成功';
        } catch (\Illuminate\Database\QueryException $ex) {
            $data['msg'] = "数据库错误" . $ex->getMessage();
        }
        return $data;
    }
    public function modify(Request $request){
        $data  = array();
        $data['status'] = 400;
        $data['msg'] = '未知错误';
        $id = $request->input('id');
        try {
            $data['data'] = Lowtransformer::find($id);
            $data['status'] = 200;
            $data['msg'] = '获取成功';
        } catch (\Illuminate\Database\QueryException $ex) {
            $data['msg'] = "数据库错误" . $ex->getMessage();
        }
        return $data;
    }
}
