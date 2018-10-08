<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;
use App\Collector;
use App\Vender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Psy\Util\Json;

class DBTable1Controller extends Controller
{
    public function index (Request $request)
    {
        $data = array();
        $data['collector'] = Collector::all();
        $data['vender'] = Vender::all();
        //取最大的tablenum
        $data['maxnum'] = Collector::max('end_table_num');
//        return $data;
        return view('qsdb.table1',['data'=>$data]);
    }
    public function postdata(Request $request){
        $data = array();
        $data['status'] = 400;
        $data['msg'] = '未知错误';
        $newcollect = new Collector();
        try{
            $newcollect->vender_name = $request->input('vender');
            $newcollect->region = $request->input('region');
            $newcollect->company = $request->input('company');
            $newcollect->project = $request->input('project');
            $newcollect->type = $request->input('type');
            $newcollect->num = $request->input('num');
            $newcollect->start_table_num = $request->input('tablenum');
            if($request->input('num') == 1){
                $newcollect->end_table_num = $request->input('tablenum');
            }else{
                $temp1 = substr($request->input('tablenum'),0,10);
                $temp2 = substr($request->input('tablenum'),10,12);
                $temp3 = $temp2 + ($request->input('num') - 1);
                $newcollect->end_table_num = $temp1 . $temp3;
            }
            $newcollect->contacts = $request->input('contacts');
            $newcollect->created_at = strtotime($request->input('date'));
            if($newcollect->save()){
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
