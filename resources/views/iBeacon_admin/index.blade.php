<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{ $title }}－iBeacon推撥管理</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/vue.min.js') }}"></script> 
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            body{
                background-color: rgba(124, 124, 124, 0.68);
                color:#000000;
            }
        </style>
    </head>
    <body>
        @section('navbar')
          @include('nav.adminnav',['title' => $title])
        @show
        <script type="text/javascipt">var location_name = NULL;</script>
        <div class="modal" tabindex="-1" role="dialog" id="createData">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">新增iBeacon景點導覽資訊</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createform">
            <div class="modal-body">
                <label for="name">地區名稱(必要)</label>
                <input type="text" name="name" class="form-control" value="5"><br>
                <label for="title">通知標題(必要/用於裝置端通知標題欄)</label>
                <input type="text" name="title" class="form-control"><br>
                <label for="content">通知內容(非必要/用於裝置端通知內容欄，為空將顯示"點我開啟介紹")</label>
                <input type="text" name="content" class="form-control"><br>
                <label for="mac_address">iBeacon Mac-Address(必要)</label>
                <input type="text" name="mac_address" class="form-control"><br>
                <label for="link">介紹網址(必要)</label>
                <input type="text" name="link" class="form-control"><br>
            </div>
            <div class="modal-footer">
                <!--
                <button type="button" class="btn btn-primary">Save changes</button>-->
                <input type="submit" class="btn btn-primary" value="送出資料">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
            </div>
        </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="updateData">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">更新iBeacon景點導覽資訊</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateform">
            <div class="modal-body">
                <input type="hidden" name="id">
                <input name="_method" type="hidden" value="patch">
                <label for="name">地區名稱(必要)</label>
                <input type="text" name="name" class="form-control" value="2"><br>
                <label for="title">通知標題(必要/用於裝置端通知標題欄)</label>
                <input type="text" name="title" class="form-control"><br>
                <label for="content">通知內容(非必要/用於裝置端通知內容欄，為空將顯示"點我開啟介紹")</label>
                <input type="text" name="content" class="form-control"><br>
                <label for="mac_address">iBeacon Mac-Address(必要)</label>
                <input type="text" name="mac_address" class="form-control"><br>
                <label for="link">介紹網址(必要)</label>
                <input type="text" name="link" class="form-control"><br>
            </div>
            <div class="modal-footer">
                <!--
                <button type="button" class="btn btn-primary">Save changes</button>-->
                <button type="submit" class="btn btn-default">送出</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#createData').modal('hide')">Close</button>
            </div>
            </form>
            </div>
        </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="deleteData">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">刪除iBeacon 景點導覽資訊</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteform">
            <div class="modal-body">
                <input type="hidden" name="id">
                <input name="_method" type="hidden" value="DELETE">
                <p>操作後將不可逆，你確定要刪除 <script type="text/javascript"> document.write(location_name);</script> 這筆資料.</p>
            </div>
            <div class="modal-footer">
                <!--
                <button type="button" class="btn btn-primary">Save changes</button>-->
                <input type="submit" class="btn btn-primary" value="送出資料">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
            </div>
        </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div id="Vue-app">
                        <div v-show="AjaxisSuccess" class="alert alert-success" role="alert">
                        This is a success alert—check it out!
                        </div>
                        <button type="button" class="btn btn-default" data-toggle="model" onclick="model_create()">新增資料</button>
                        <table class="table">
                            <tr>
                                <td>地區名稱</td>
                                <td>通知標題</td>
                                <td>通知內容</td>
                                <td>連結</td>
                                <td>Mac-Address</td>
                                <td>操作</td>
                            </tr>
                            @foreach($result as $row)
                            <tr>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->title }}</td>
                                <td>{{ $row->content }}</td>
                                <td>{{ $row->link }}</td>
                                <td>{{ $row->mac_address }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-secondary" onclick="model_update({{ $row->id }});">修改資料</button>
                                        <button type="button" class="btn btn-secondary" onclick="model_delete({{ $row->id }});">刪除資料</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        {{ $result->links() }}
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript">
    var app = new Vue({
        el: '#Vue-app',
        data:{
            AjaxisSuccess: false
        }
    });
    var data_id = null;
    var web_action = "";
    $.validator.setDefaults({
        debug: true,    //只檢查不送出
        submitHandler: function() {
            switch(web_action){
                case "create":
                    ajax_create();
                    break;
                case "update":
                    ajax_update();
                    break;
                case "delete":
                    ajax_delete();
                    break;
            }
        }
    });
    function ajax_create(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('ibeacon') }}",
            data: $('#createform').serialize(),
            type: 'POST',
            success: function(){
                $("#createData").modal('hide');
                Vue.set(app,'AjaxisSuccess',true);
                setTimeout("location.reload();",5*1000);
            }
        })
    }
    function ajax_update(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('ibeacon') }}/"+data_id,
            data: $('#updateform').serialize(),
            type: 'POST',
            success: function(){
                $("#updateData").modal('hide');
                Vue.set(app,'AjaxisSuccess',true);
                setTimeout("location.reload();",5*1000);
            }
        })
    }
    function ajax_delete(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('ibeacon') }}/"+data_id,
            data: $('#deleteform').serialize(),
            type: 'POST',
            success: function(){
                $("#deleteData").modal('hide');
                Vue.set(app,'AjaxisSuccess',true);
                setTimeout("location.reload();",5*1000);
            }
        })
    }
    //開啟新建視窗
    function model_create(){
        resetForm()
        $('#createData').modal({
            keyboard: true
        })
        web_action = "create";
        //啟用驗證規則
        $("#createform").validate({
            rules:{
                name: "required",
                title: "required",
                mac_address: "required",
                link: "required"
            },messages:{
                name: "重要資訊請務必填寫",
                title: "重要資訊請務必填寫",
                mac_address: "重要資訊請務必填寫",
                link: "重要資訊請務必填寫"
            }
        });
    }
    //開啟更新視窗
    function model_update(id){
        resetForm()
        $('#updateData').modal({
            keyboard: true
        })
        data_id = id;
        ajax_read(id);  // read data
        web_action = "update";  //ajax action (create/update/delete)
        //啟用驗證規則
        $("#updateform").validate({
            rules:{
                name: "required",
                title: "required",
                mac_address: "required",
                link: "required"
            },messages:{
                name: "重要資訊請務必填寫",
                title: "重要資訊請務必填寫",
                mac_address: "重要資訊請務必填寫",
                link: "重要資訊請務必填寫"
            }
        });
    }
    //開啟刪除視窗
    function model_delete(id){
        resetForm()
        $('#deleteData').modal({
            keyboard: true
        })
        ajax_read(id);  // read data
        data_id = id;
        web_action = "delete";
        $("#deleteform").validate({
            rules:{
                id: "required"
            },messages:{
                id: "重要資訊請務必填寫"
            }
        });
    }
    //資料庫取得資料 並顯示與表單頁面上
    function ajax_read(id){
        $.ajax({
            url: "{{ url('ibeacon') }}/"+id,
            type: "GET",
            dataType: "json",
            success: function(json){
                location_name = json[0]['title'];
                $("input[name=id]").val(json[0]['id']);
                $("input[name=name]").val(json[0]['name']);
                $("input[name=title]").val(json[0]['title']);
                $("input[name=content]").val(json[0]['content']);
                $("input[name=mac_address]").val(json[0]['mac_address']);
                $("input[name=link]").val(json[0]['link']);
            },
            error: function(){
                alert("資料取得失敗！將重置頁面，如果多次顯示這個畫面，請聯絡系統管理員");
                location.reload();
            }
        })
    }
    function resetForm(){
        $("input[name=id]").val("");
        $("input[name=name]").val("");
        $("input[name=title]").val("");
        $("input[name=content]").val("");
        $("input[name=mac_address]").val("");
        $("input[name=link]").val("");
    }
</script>
