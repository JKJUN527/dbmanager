<?php $__env->startSection('title', '集中器/采集器'); ?>


    



    


<?php $__env->startSection('custom-style'); ?>
    <link href="<?php echo e(asset('/vendors/sidebar/sidebar-menu.css')); ?>" rel="stylesheet">
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
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
    <div class="container body">
        <div class="main_container">
                <?php echo $__env->make('components.indexNav',['activeIndex'=>0,'activeIndexSecend'=>0], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('components.headerNav',['activeIndex'=>1], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="right_col" role="main">
                    <div class="">
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>集中器/采集器 <small>在这里查询、处理集中器/采集器</small></h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                            
                                            
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
                                                <th>业主单位名称</th>
                                                <th>工程名称</th>
                                                <th>类型</th>
                                                <th>数量</th>
                                                <th>联系人</th>
                                                <th>日期</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $data['collector']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($item->start_table_num); ?></td>
                                                    <td><?php echo e($item->vender_name); ?></td>
                                                    <td><?php echo e($item->region); ?></td>
                                                    <td><?php echo e($item->company); ?></td>
                                                    <td><?php echo e($item->project); ?></td>
                                                    <td>
                                                        <?php if($item->type == 0): ?>
                                                            集中器
                                                        <?php else: ?>
                                                            采集器
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e($item->num); ?></td>
                                                    <td><?php echo e($item->contacts); ?></td>
                                                    <td><?php echo e($item->created_at); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <h4 class="modal-title" id="myModalLabel">配置项管理</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label>产品名</label>
                            <input type="text" class="form-control" style="display: none" name="confId" id="confId" value="-1">
                        </div>
                        <div class="form-group">
                                <label>模块名</label>
                        </div>
                        <div class="form-group">
                            <label>配置类型</label>
                            <select class="form-control show-tick selectpicker" id="conf_type" name="conf_type">
                                <option value="-1">请选择配置类型</option>
                                <option value="0">key(配置值，通用key-value)</option>
                                <option value="1">cdb(配置值，用于mysql信息记录)</option>
                                <option value="2">cvm(配置值，用于服务器信息记录)</option>
                            </select>
                            <label class="error" for="conf_type"></label>
                        </div>
                        <div class="keyvalue info_module">
                            <div class="form-group">
                                <label>配置名称</label>
                                <input type="text" class="form-control" placeholder="请输入配置名称" name="key_conf_name" id="key_conf_name">
                                <label class="error" for="key_conf_name"></label>
                            </div>
                            <div class="form-group">
                                <label>配置值</label>
                                <input type="text" class="form-control" placeholder="请输入配置值" name="key_conf_value" id="key_conf_value">
                                <label class="error" for="key_conf_value"></label>
                            </div>
                        </div>
                        <div class="cvm info_module">
                            <div class="form-group">
                                <label>配置名称</label>
                                <input type="text" class="form-control" placeholder="请输入配置名称" value="iplist" disabled>
                            </div>
                            <div class="form-group">
                                <label>配置值导入方式</label>
                                <select class="form-control show-tick selectpicker" id="cvm_inport_type" name="cvm_inport_type">
                                    <option value="-1">请选择配置值导入方式</option>
                                    <option value="0">手动输入,多个IP用分号分隔,固定IP</option>
                                    <option value="1">从四级业务模块id导入,后续会同步更新(推荐)</option>
                                </select>
                                <input type="text" class="form-control" style="margin-top: 1rem;" placeholder="请输入配置值" name="cvm_conf_value" id="cvm_conf_value">
                                <label class="error" for="cvm_conf_value"></label>
                            </div>
                        </div>
                        <div class="cdb info_module">
                            <div class="form-group">
                                <label class="info_title">主库信息，必填</label>
                                <label>db-conf-name</label>
                                <input type="text" class="form-control" placeholder="说明此DB的用途-配置名称" name="cdb_conf_name" id="cdb_conf_name">
                                <label class="error" for="cdb_conf_name"></label>
                                <label>db-name</label>
                                <input type="text" class="form-control" placeholder="此DB的名称" name="cdb_db_name" id="cdb_db_name">
                                <label class="error" for="cdb_db_name"></label>
                                <label>db-ip</label>
                                <input type="text" class="form-control" placeholder="此DB的IP" name="cdb_db_ip" id="cdb_db_ip">
                                <label class="error" for="cdb_db_ip"></label>
                                <label>db-port</label>
                                <input type="text" class="form-control" placeholder="此DB的PORT" name="cdb_db_port" id="cdb_db_port">
                                <label class="error" for="cdb_db_port"></label>
                                <label>db-user</label>
                                <input type="text" class="form-control" placeholder="此DB的用户名" name="cdb_db_user" id="cdb_db_user">
                                <label class="error" for="cdb_db_user"></label>
                                <label>db-pass</label>
                                <input type="text" class="form-control" placeholder="此DB的连接密码" name="cdb_db_pass" id="cdb_db_pass">
                                <label class="error" for="cdb_db_pass"></label>
                            </div>
                            <div class="form-group">
                                <label class="info_title">mysql-db从库信息,没有可为空</label>
                                <label>db-slave-name</label>
                                <input type="text" class="form-control" placeholder="此DB的名称" name="cdb_db_slave_name" id="cdb_db_slave_name">
                                <label class="error" for="cdb_db_slave_name"></label>
                                <label>db-slave-ip</label>
                                <input type="text" class="form-control" placeholder="db-slave-ip" name="cdb_db_slave_ip" id="cdb_db_slave_ip">
                                <label class="error" for="cdb_db_slave_ip"></label>
                                <label>db-slave-port</label>
                                <input type="text" class="form-control" placeholder="db-slave-port" name="cdb_db_slave_port" id="cdb_db_slave_port">
                                <label class="error" for="cdb_db_slave_port"></label>
                                <label>db-slave-user</label>
                                <input type="text" class="form-control" placeholder="db-slave-user" name="cdb_db_slave_user" id="cdb_db_slave_user">
                                <label class="error" for="cdb_db_slave_user"></label>
                                <label>db-slave-pass</label>
                                <input type="text" class="form-control" placeholder="db-slave-pass" name="cdb_db_slave_pass" id="cdb_db_slave_pass">
                                <label class="error" for="cdb_db_slave_pass"></label>
                            </div>
                            <div class="form-group">
                                <label class="info_title">mysql-只读DB信息,没有可为空</label>
                                <label>db-read-slave-name</label>
                                <input type="text" class="form-control" placeholder="此DB的名称" name="cdb_db_read_slave_name" id="cdb_db_read_slave_name">
                                <label class="error" for="cdb_db_read_slave_name"></label>
                                <label>db-read-slave-ip</label>
                                <input type="text" class="form-control" placeholder="db-slave-ip" name="cdb_db_read_slave_ip" id="cdb_db_read_slave_ip">
                                <label class="error" for="cdb_db_read_slave_ip"></label>
                                <label>db-read-slave-port</label>
                                <input type="text" class="form-control" placeholder="db-slave-port" name="cdb_db_read_slave_port" id="cdb_db_read_slave_port">
                                <label class="error" for="cdb_db_read_slave_port"></label>
                                <label>db-read-slave-user</label>
                                <input type="text" class="form-control" placeholder="db-slave-user" name="cdb_db_read_slave_user" id="cdb_db_read_slave_user">
                                <label class="error" for="cdb_db_read_slave_user"></label>
                                <label>db-read-slave-pass</label>
                                <input type="text" class="form-control" placeholder="db-slave-pass" name="cdb_db_read_slave_pass" id="cdb_db_read_slave_pass">
                                <label class="error" for="cdb_db_read_slave_pass"></label>
                            </div>
                            <div class="modify-cdb form-group">
                                <label class="info_title">修改DB配置信息</label>
                                <label>db-name</label>
                                <input type="text" class="form-control" placeholder="此DB的名称" name="modify_db_name" id="modify_db_name">
                                <label class="error" for="modify_db_name"></label>
                                <label>db-ip</label>
                                <input type="text" class="form-control" placeholder="db-ip" name="modify_db_ip" id="modify_db_ip">
                                <label class="error" for="modify_db_ip"></label>
                                <label>db-port</label>
                                <input type="text" class="form-control" placeholder="db-port" name="modify_db_port" id="modify_db_port">
                                <label class="error" for="modify_db_port"></label>
                                <label>db-user</label>
                                <input type="text" class="form-control" placeholder="db-slave-user" name="modify_db_user" id="modify_db_user">
                                <label class="error" for="modify_db_user"></label>
                                <label>db-pass</label>
                                <input type="text" class="form-control" placeholder="db-pass" name="modify_db_pass" id="modify_db_pass">
                                <label class="error" for="modify_db_pass"></label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="modify-conf">提交更改</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <?php echo $__env->make('components.myfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>
    <script src="<?php echo e(asset('/vendors/sidebar/sidebar-menu.js')); ?>"></script>
    <script>
        $('#pick_time').click(function () {
            alert($('#reservation').val());
        });

        $(".main_container .right_col").css('min-height',h + 'px');
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>