@extends('layout.master')
@section('title', '专变终端')

{{--@section('header-tab')--}}
    {{--@include('components.headerTab')--}}
{{--@endsection--}}

{{--@section('header-nav')--}}
    {{--@include('components.headerNav',['activeIndex'=>1,'lang'=>$data['lang']])--}}
{{--@endsection--}}

@section('custom-style')
    <link href="{{asset('/vendors/sidebar/sidebar-menu.css')}}" rel="stylesheet">
    <style>
        .even .btn{
            /*margin:0 0 ;*/
            padding: 0 10px 0 10px;
            margin-bottom: 2px;
        }
        .info_module{
            background-color: #EDEDED;
            padding: 10px 10px;
            display: none;
        }
        .conf_value{
            vertical-align: top;
            width: 500px;
            padding: 0;
            height: 2.2rem;
            background-color:rgba(0,0,0,0);
            border: none;
            padding-right: 20px;
        }
        .last_conf_value{
            vertical-align: top;
            width: 200px;
            padding: 0;
            height: 2.2rem;
            background-color:rgba(0,0,0,0);
            border: none;
            padding-right: 20px;
        }
        .info_title{
            display: block;
            font-size: 1.7rem;
            color: coral;
        }
        .modify-cdb{
            display: none;
        }
    </style>
@endsection
{{--@section('index-nav')--}}
{{--@include('components.indexNav')--}}
{{--@endsection--}}
@section('content')
    <div class="container body">
        <div class="main_container">
                @include('components.indexNav',['activeIndex'=>0,'activeIndexSecend'=>0])
                @include('components.headerNav',['activeIndex'=>1])
                <div class="right_col" role="main">
                    <div class="">
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>专变终端 <small>在这里查询、处理专变终端</small></h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                            {{--<li><a class="close-link"><i class="fa fa-close"></i></a>--}}
                                            {{--</li>--}}
                                            <li><a class="add-link" data-toggle="modal" data-target="#addModel"><i class="fa fa-plus-circle"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="condition">
                                            <div class="form-group">
                                                <form class="form-horizontal">
                                                    <fieldset>
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <div class="input-prepend input-group">
                                                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                                                    <input type="text" style="width: 200px" name="reservation" id="reservation" class="form-control" value="01/01/2018 - 10/06/2018" />
                                                                    <button type="button" class="btn btn-info" id="pick_time">开始查询</button>
                                                                    <button type="button" class="btn btn-danger" name="clear_time">清除时间</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <div class="input-prepend input-group">
                                                                    <input type="text" style="width: 238px" name="table_num" id="table_num" class="form-control" placeholder="输入22位号段查询" />
                                                                    <button type="button" class="btn btn-info" id="search_tablenum">开始查询</button>
                                                                    <button type="button" class="btn btn-danger" name="clear_time">清除查询</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                        <table id="datatable-buttons" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>号段</th>
                                                <th>厂家</th>
                                                <th>单位</th>
                                                <th>申请单位</th>
                                                <th>工程名称</th>
                                                <th>数量</th>
                                                <th>联系人</th>
                                                <th>日期</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data['terminal'] as $item)
                                                <tr>
                                                    <td>{{$item->start_table_num}}</td>
                                                    <td>{{$item->vender_name}}</td>
                                                    <td>{{$item->region}}</td>
                                                    <td>{{$item->company}}</td>
                                                    <td>{{$item->project}}</td>
                                                    <td>{{$item->num}}</td>
                                                    <td>{{$item->contacts}}</td>
                                                    <td>{{substr($item->created_at,0,10)}}</td>
                                                    <td class=" ">
                                                        <button type="button" data-content="{{$item->id}}" class="btn btn-round btn-primary" name="modify" >修改</button>
                                                        <button type="button" data-content="{{$item->id}}" class="btn btn-round btn-danger" name="delete">删除</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /page content -->
        </div>
    </div>
    <div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">专变终端</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label>号段</label>
                            <input type="text" class="form-control" style="display: none" name="tableid" id="tableid" value="-1">
                            <input type="text" class="form-control" name="tablenum" id="tablenum" placeholder="请输入22位号段码，注意不能重复" value="{{$data['maxnum']}}">
                            <label class="error" for="tablenum"></label>
                        </div>
                        <div class="form-group">
                            <label>日期</label>
                            <fieldset>
                                <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="single_cal1" placeholder="First Name" aria-describedby="inputSuccess2Status">
                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                            <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <label class="error" for="contacts"></label>
                        </div>
                        <div class="form-group">
                            <label>厂家</label>
                            <select class="form-control show-tick selectpicker" id="vender" name="vender">
                                <option value="-1">请选择厂家</option>
                                @foreach($data['vender'] as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            <label class="error" for="vender"></label>
                        </div>
                        <div class="form-group">
                            <label>单位</label>
                            <select class="form-control show-tick selectpicker" id="region" name="region">
                                <option value="0">新城</option>
                                <option value="1">龙泉</option>
                                <option value="2">双流</option>
                                <option value="3">天府</option>
                            </select>
                            <label class="error" for="region"></label>
                        </div>
                        <div class="form-group">
                            <label>业主单位名称</label>
                            <input type="text" class="form-control" name="company" id="company" placeholder="请输入业主单位名称">
                            <label class="error" for="company"></label>
                        </div>
                        <div class="form-group">
                            <label>工程名称</label>
                            <input type="text" class="form-control" name="project" id="project" placeholder="请输入工程名称">
                            <label class="error" for="project"></label>
                        </div>
                        <div class="form-group">
                            <label>数量</label>
                            <input type="number" class="form-control" name="num" id="num" value="1">
                            <label class="error" for="num"></label>
                        </div>
                        <div class="form-group">
                            <label>联系人</label>
                            <input type="text" class="form-control" name="contacts" id="contacts" placeholder="没有可为空">
                            <label class="error" for="contacts"></label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="modify-post">提交更改</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
@endsection
@section('footer')
    @include('components.myfooter')
@endsection
@section('custom-script')
    <script src="{{asset('/vendors/sidebar/sidebar-menu.js')}}"></script>
    <script>
        $('#pick_time').click(function () {
            $(location).attr('href', "/db/table7?date=" + $('#reservation').val());
        });
        $('button[name=clear_time]').click(function () {
            $(location).attr('href', "/db/table7");
        });
        //验证号段是否符合规定
        $('#tablenum').blur(function () {
            var reg = /^\d+$/;
            var num = $('#tablenum');
            if(num.val() === "" || num.val().length !=22){
                setError(num,'tablenum','号段必须是22位整数');
                return;
            }else if(!reg.test(num.val())){
                setError(num,'tablenum','号段必须是22位非重复整数');
                return;
            }else{
                removeError(num,'tablenum');
            }
            var formData = new FormData();
            formData.append('tablenum', num.val());
            $.ajax({
                url: "/db/table1/checkTableNum",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    if(result.status != 200){
                        setError(num,'tablenum',result.msg);
                        return;
                    }else{
                        removeError(num,'tablenum');
                    }
                }
            })

        });
        $('#modify-post').click(function () {
            var tableid = $('input[name=tableid]').val();
            var tablenum = $('input[name=tablenum]').val();
            var single_cal1 = $('input[id=single_cal1]').val();
            var vender = $('select[name=vender] option:selected');
            var region = $('select[name=region] option:selected');
            var company = $('input[name=company]').val();
            var project = $('input[name=project]').val();
            var num = $('input[name=num]').val();
            var contacts = $('input[name=contacts]').val();
            if(vender.val() == -1){
                setError($('select[name=vender]'),'vender','请选择厂家');
                return;
            }else{
                removeError($('select[name=vender]'),'vender');
            }
            if(company == ""){
                setError($('input[name=company]'),'company','请输入业主单位名称');
                return;
            }else{
                removeError($('input[name=company]'),'company');
            }
            if(project == ""){
                setError($('input[name=project]'),'project','请输入工程名称');
                return;
            }else{
                removeError($('input[name=project]'),'project');
            }
            var formData = new FormData();
            formData.append('id', tableid);
            formData.append('tablenum', tablenum);
            formData.append('date', single_cal1);
            formData.append('vender', $.trim(vender.text()));
            formData.append('region', $.trim(region.text()));
            formData.append('company', company);
            formData.append('project', project);
            formData.append('num', num);
            formData.append('contacts', contacts);
            $.ajax({
                url: "/db/table7/postdata",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status,result.msg,null);
                }
            })

        });
        $('.add-link').click(function () {
            //初始化id为新增状态
            $('input').val("");
            $('select[name=vender]').val(-1);
            $('input[name=tableid]').val(-1);
            $('input[name=num]').val(1);
        });
        $('button[name=delete]').click(function () {
            var id = $(this).attr('data-content');
            var formData = new FormData();
            formData.append('id', id);
            $.ajax({
                url: "/db/table7/delete",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status,result.msg,null);
                }
            })
        });
        $('button[name=modify]').click(function () {
            var id = $(this).attr('data-content');
            var formData = new FormData();
            formData.append('id', id);
            $.ajax({
                url: "/db/table7/modify",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    //设置数据
                    if(result.status == 200){
                        $('input[name=tableid]').val(result.data.id);
                        $('input[name=tablenum]').val(result.data.start_table_num);
                        $('#single_cal1').val(result.data.created_at);
                        var vender = "select[name=vender] option:contains("+"'"+result.data.vender_name +"')";
                        var region = "select[name=region] option:contains("+"'"+result.data.region +"')";
                        $(vender).attr('selected', true);
                        $(region).attr('selected', true);
                        $('input[name=company]').val(result.data.company);
                        $('input[name=project]').val(result.data.project);
                        $('input[name=num]').val(result.data.num);
                        $('input[name=contacts]').val(result.data.contacts);
                        $('#addModel').modal('show');
                    }else {
                        checkResult(result.status,result.msg,null);
                    }
                }
            })
        });
        $("#search_tablenum").click(function () {
            var table_num = $('#table_num').val();
            if(table_num == "" || table_num.length !=22){
                swal('','请输入22位号段进行查询','error');
                return;
            }
            $(location).attr('href', "/db/table7?tablenum=" + table_num);
        });
        
    </script>
@endsection