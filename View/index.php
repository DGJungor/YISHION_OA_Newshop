<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/24
 * Time: 16:50
 */

class Index
{
    public function display()
    {
        // ob_start();
        ?>

        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport"
                  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Document</title>


            <link rel="stylesheet" href="./Public/layui/css/layui.css?t=1504112998306" media="all">
            <link rel="stylesheet" href="./Public/Common/css/iF.step.css">


            <script src="./Public/jquery/1.11.3/jquery.js"></script>
            <script src="./Public/layui/layui.js"></script>
            <!--            <script src="./Public/layui/layui.all.js"></script>-->
            <!--  style  -->


            <!-- script   -->

        </head>
        <body>

        <div class="layui-container">

            <div class="layui-row">
                <h1 class="site-h1">新开店铺</h1>
                <hr class="layui-bg-green">
            </div>

            <div class="layui-row">
                <div class="layui-collapse" lay-accordion>
                    <div class="layui-colla-item">
                        <h2 class="layui-colla-title">条件搜索</h2>
                        <div class="layui-colla-content layui-show">

                            <form class="layui-form layui-form-pane" action="">
                                <div class="layui-row layui-col-space15">
                                    <div class="layui-col-md4 ">
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">店铺</label>
                                            <div class="layui-input-block">
                                                <input type="text" name="title" lay-verify=""
                                                       placeholder="请输入店铺名" autocomplete="off" class="layui-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="layui-col-md4 ">
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">办事处</label>
                                            <div class="layui-input-block">
                                                <select name="city" lay-verify="">
                                                    <option value=""></option>
                                                    <option value="1">广东办事处</option>
                                                    <option value="2">四川办事处</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="layui-col-md3 ">
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">状态</label>
                                            <div class="layui-input-block">
                                                <select name="city" lay-verify="">
                                                    <option value=""></option>
                                                    <option value="0">开启</option>
                                                    <option value="1">关闭</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="layui-row layui-col-space15">
                                    <div class="layui-col-md4 ">
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">申报日期</label>
                                            <div class="layui-input-block">
                                                <input id="declare" type="text" name="title" lay-verify=""
                                                       placeholder="请输入申报日期" autocomplete="off" class="layui-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="layui-col-md4 ">
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">开业日期</label>
                                            <div class="layui-input-block">
                                                <input id="open" type="text" name="title" lay-verify=""
                                                       placeholder="请输入开业日期" autocomplete="off" class="layui-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="layui-col-md3 ">
                                        <div class="layui-form-item">

                                            <div class="layui-form-item">
                                                <div class="layui-input-block">
                                                    <button class="layui-btn" lay-submit lay-filter="formDemo">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;搜索&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>

            <div class="layui-row">
                <table id="table"></table>
                <script type="text/html" id="barDemo">
                    <a class="layui-btn layui-btn-primary layui-btn-mini" lay-event="detail">明细</a>
                </script>
            </div>

        </div>



        <script src="./Public/layui/layui.all.js"></script>
        <script>

            layui.use(['laydate', 'table'], function () {
                var laydate = layui.laydate;
                var table = layui.table;

                //执行一个laydate实例
                laydate.render({
                    elem: '#declare' //指定元素
                });

                laydate.render({
                    elem: '#open' //指定元素
                });

                //执行渲染
                table.render({
                    elem: '#table' //指定原始表格元素选择器（推荐id选择器）
                    , url: './index.php?c=Ajax&a=SelectIndex'
                    , request: {
                        pageName: 'page' //页码的参数名称，默认：page
                        , limitName: 'limit' //每页数据量的参数名，默认：limit
                    }
                    , cols: [[ //标题栏
                        {field: 'id', title: 'ID', width: 80}
                        , {field: 'officeCN', title: '办事处', width: 120}
                        , {field: 'sid', title: '店铺编号', width: 130}
                        , {field: 'sname', title: '店铺名', width: 130}
                        , {field: 'declare_date', title: '申报日期', width: 120}
                        , {field: 'open_date', title: '开业日期', width: 120}
                        , {field: 'state', title: '状态', width: 120}
                        , {field: 'step', title: '步骤', width: 120}
                        , {field: 'dep', title: '部门', width: 120}
                        , {fixed: 'right', title: '操作', width: 130, align: 'center', toolbar: '#barDemo'}
                    ]] //设置表头
                    , page: true //开启分页
//                    ,  data: [{id:1}]
                    ,limits: [10,20,30]
                    ,limit: 10
                //,…… //更多参数参考右侧目录：基本参数选项
                });


                //监听工具条
                table.on('tool(demo)', function (obj) {
                    var data = obj.data;
                    if (obj.event === 'detail') {
                        layer.msg('ID：' + data.id + ' 的查看操作');
                    } else if (obj.event === 'del') {
//                        layer.confirm('真的删除行么', function (index) {
//                            obj.del();
//                            layer.close(index);
//                        });
                    } else if (obj.event === 'edit') {
//                        layer.alert('编辑行：<br>' + JSON.stringify(data))
                    }
                });


            });

        </script>

        </body>
        </html>

        <?php
    }
}

?>