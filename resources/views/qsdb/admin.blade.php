@extends('layout.master')
@section('title', '权限管理')

{{--@section('header-tab')--}}
    {{--@include('components.headerTab')--}}
{{--@endsection--}}

{{--@section('header-nav')--}}
    {{--@include('components.headerNav',['activeIndex'=>1,'lang'=>$data['lang']])--}}
{{--@endsection--}}

@section('custom-style')
    <style>
        .even .btn{
            margin:0 0 ;
            padding: 0 10px 0 10px;
        }
        .input-group{
            margin-top: 1rem;
        }
    </style>
@endsection
{{--@section('index-nav')--}}
{{--@include('components.indexNav')--}}
{{--@endsection--}}
@section('content')
    <div class="container body">
        <div class="main_container">
            {{--@section('index-nav')--}}
                @include('components.indexNav',['activeIndex'=>1,'activeIndexSecend'=>0])
            {{--@endsection--}}
{{--            @section('header-nav')--}}
                @include('components.headerNav',['activeIndex'=>1])
            {{--@endsection--}}
            <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                        <div class="x_title">
                                            <h2>厂家管理 <small>在这里新增修改厂家设置</small></h2>
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                                <li><a class="add-link" data-toggle="modal" data-target="#addModel"><i class="fa fa-plus-circle"></i></a>
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="x_content">

                                            {{--<p>Add class <code>bulk_action</code> to table for bulk actions options on row select</p>--}}

                                            <div class="table-responsive">
                                                <table class="table table-striped jambo_table bulk_action">
                                                    <thead>
                                                    <tr class="headings">
                                                        {{--<th>--}}
                                                            {{--<input type="checkbox" id="check-all" class="flat">--}}
                                                        {{--</th>--}}
                                                        <th class="column-title">ID</th>
                                                        <th class="column-title">厂家名称</th>
                                                        <th class="column-title">添加时间</th>
                                                        <th class="column-title"><span class="nobr">Action</span>操作</th>
                                                        <th class="bulk-actions" colspan="4">
                                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                                        </th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @foreach($data['vender'] as $item)
                                                        <tr class="even pointer">
                                                            <td class=" ">{{$item->id}}</td>
                                                            <td class=" ">{{$item->name}}</td>
                                                            <td class=" ">{{$item->updated_at}}</td>
                                                            <td class=" ">
                                                                {{--<button type="button" data-content="{{$item->id}}" class="btn btn-round btn-primary" name="modify">修改</button>--}}
                                                                <button type="button" data-content="{{$item->id}}" class="btn btn-round btn-danger" name="delete">删除</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                <nav>
                                                    {!! $data['vender']->links() !!}
                                                </nav>
                                            </div>


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
                    <h4 class="modal-title" id="myModalLabel">厂家管理</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label>厂家名称</label>
                            <input type="text" class="form-control" placeholder="请输入厂家名称" name="name" id="name">
                            <label class="error" for="name"></label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="modify-auth">提交更改</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
@endsection
@section('footer')
    @include('components.myfooter')
@endsection
@section('custom-script')
    <script>
        $("#modify-auth").click(function () {
            var name = $("input[name='name']");

            if (name.val() === "") {
                setError(name, "name", "不能为空");
                return;
            } else{
                removeError(name, "name");
            }
            var formData = new FormData();
            formData.append('name', name.val());

            $.ajax({
                url: "/qsdb/admin/add",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status,result.msg,$('#addModel'));
                }
            })
        });
        $('button[name="delete"]').click(function () {
            var id = $(this).attr('data-content');
            var formData = new FormData();
            formData.append('id',id);
            $.ajax({
                url: "/qsdb/admin/delete" ,
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
            });
        });
        $('#auth_list').change(function () {
            var auth_info = $("#auth_info");
            var auth_list = $("#auth_list");
            var auth_value = auth_info.html();
            if(auth_list.val() == 0){
                auth_value = "all;";
            }else if(auth_list.val() == 1){
                auth_value += "conf;";
            }else if(auth_list.val() == 2){
                auth_value += "region;";
            }else if(auth_list.val() == 3){
                auth_value += "products;";
            }
            auth_info.html(auth_value);
        });
        function clearAuth() {
            var auth_info = $('#auth_info');
            auth_info.html("");
            $('#auth_list').val(-1);
        }
    </script>
@endsection