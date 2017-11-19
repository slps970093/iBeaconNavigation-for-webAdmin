<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{ $title }}－管理者與網站名稱管理</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/popper.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/vue.min.js') }}"></script> 
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            @font-face {
              font-family: NotoSansCJK;
              src: url(../fonts/NotoSansCJKsc-Light.otf) format("opentype");
            }
            body{
                font-family: 'NotoSansCJK';
                background-color: rgba(124, 124, 124, 0.68);
                color:#000000;
            }
        </style>
    </head>
    <body>
        @section('navbar')
          @include('nav.adminnav',['title' => $title])
        @show
        <div class="container">
            <!-- Create User Data Model -->
            <div class="modal" tabindex="-1" role="dialog" id="createModel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">新增管理者資料</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="createForm">
                  <div class="modal-body">
                    <label for="username">管理者帳號</label>
                    <input type="text" name="username" class="form-control"><br>
                    <label for="password">管理者密碼</label>
                    <input type="password" name="password" class="form-control"><br>
                    <label for="name">管理者名稱</label>
                    <input type="text" name="name" class="form-control"><br>
                    <label for="email">信箱</label>
                    <input type="email" name="email" class="form-control"><br>
                  </div>
                  <div class="modal-footer">
                    <!--
                    <button type="button" class="btn btn-primary">Save changes</button>
                    -->
                    <input type="submit" class="btn brn-primary" value="Save changes">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Update User Data Model --> 
            <div class="modal" tabindex="-1" role="dialog" id="updateModel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">更新管理者資料</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="updateFrom">
                  <div class="modal-body">
                    {{ method_field('patch') }}
                    <input type="hidden" name="id">
                    <label for="username">管理者帳號</label>
                    <input type="text" name="username" class="form-control"><br>
                    <label for="name">管理者名稱</label>
                    <input type="text" name="name" class="form-control"><br>
                    <label for="email">信箱</label>
                    <input type="email" name="email" class="form-control"><br>
                  </div>
                  <div class="modal-footer">
                    <!--
                    <button type="button" class="btn btn-primary">Save changes</button>
                    -->
                    <input type="submit" class="btn brn-primary" value="Save changes">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Setting User Password Data Model --> 
            <div class="modal" tabindex="-1" role="dialog" id="passwordModel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">更改管理者密碼</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="passwordSetForm">
                  <div class="modal-body">
                    {{ method_field('patch') }}
                    <input type="hidden" name="id">
                    <label for="password">管理者密碼</label>
                    <input type="password" name="password" class="form-control"><br>
                  </div>
                  <div class="modal-footer">
                    <!--
                    <button type="button" class="btn btn-primary">Save changes</button>
                    -->
                    <input type="submit" class="btn brn-primary" value="Save changes">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Delete User Data Model --> 
            <div class="modal" tabindex="-1" role="dialog" id="deleteModel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">刪除管理者資料</h5>
                    <input type="hidden" name="id">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="deleteFrom">
                  <div class="modal-body">
                    {{ method_field('delete') }}
                    <p>你確定要刪除這筆資料?</p>
                    <hr>
                    <div id="myDeleteData">
                      <table class="table">
                        <tr>
                          <td>管理者名稱</td>
                          <td>@{{ username }}</td>
                        </tr>
                        <tr>
                          <td>用戶名稱</td>
                          <td>@{{ name }}</td>
                        </tr>
                        <tr>
                          <td>電子信箱</td>
                          <td>@{{ email }}</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <!--
                    <button type="button" class="btn btn-primary">Save changes</button>
                    -->
                    <input type="submit" class="btn brn-primary" value="Save changes">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="modal" tabindex="-1" role="dialog" id="websiteModel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">修改網站標題</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="websiteForm">
                  <div class="modal-body">
                    {{ method_field('patch') }}
                    <label for="title">網站標題</label>
                    <input type="text" name="title" class="form-control">
                  </div>
                  <div class="modal-footer">
                    <input type="submit" class="btn btn-default" value="Save changes">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div id="msg">
                      <div v-show="ajaxSuccess" class="alert alert-success" role="alert">
                        操作順利完成，稍後將重新整理頁面
                      </div>
                    </div>
                    <button type="button" onclick="model_create();" class="btn btn-default">新增管理者資料</button>
                    <button type="button" onclick="model_website()" class="btn btn-default">網站標題修改</button>
                    <table class="table">
                        <tr>
                            <td>使用者帳戶名稱</td>
                            <td>電子信箱</td>
                            <td>管理者名稱</td>
                            <td>更改密碼</td>
                            <td>修改用戶資料</td>
                            <td>刪除用戶資料</td>
                        </tr>
                        @foreach($result as $row)
                        <tr>
                            <td>{{ $row->username }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->name }}</td>
                            <td><button type="button" onclick="model_setting_password({{ $row->id }});" class="btn btn-default">更改密碼</button></td>
                            <td><button type="button" onclick="model_update({{ $row->id }});" class="btn btn-default">修改</button></td>
                            <td>
                            @if($row->id != 1)
                              <button type="button" onclick="model_delete({{ $row->id }});" class="btn btn-default">刪除</button>@endif</td>
                        </tr>
                        @endforeach
                    </table>
                    {{ $result->links() }}
                </div>
                <div class="col-md-2"></div>
            </div>
            <script type="text/javascript">
                var msg_Vue = new Vue({
                  el: '#msg',
                  data:{
                    'ajaxSuccess': false
                  }
                })
                var Vue_mydelete = new Vue({
                  el: '#myDeleteData',
                  data: {
                    'username': '正在載入資料中...請稍後...',
                    'name': '正在載入資料中...請稍後...',
                    'email': '正在載入資料中...請稍後...'
                  }
                });
                var ajax_action,data_id;
                $.validator.setDefaults({
                    submitHandler: function() {
                      debug: true
                      switch(ajax_action){
                        case 'create':
                          ajax_create();
                          break;
                        case 'resetpassword':
                          ajax_setting_password();
                          break;
                        case 'update':
                          ajax_update();
                          break;
                        case 'delete':
                          ajax_delete();
                          break;
                        case 'website':
                          ajax_website_update();
                          break;
                      }
                    }
                });
                function model_create(){
                    ajax_action = 'create';
                    $('#createModel').modal({
                        keyboard: true
                    })
                    $('#createForm').validate({
                      rules:{
                        'username': 'required',
                        'password': 'required',
                        'name': 'required',
                        'email': 'required'
                      },messages:{
                        'username': '必要資訊',
                        'password': '必要資訊',
                        'name': '必要資訊',
                        'email': '必要資訊'
                      }
                    });
                }
                function model_update(id){
                  data_id = id
                  ajax_action = 'update';
                  cleanForm();
                  ajax_read(id);
                  $('#updateModel').modal({
                      keyboard: true
                  })
                  $('#updateFrom').validate({
                    rules:{
                      'username': 'required',
                      'name': 'required',
                      'email': 'required'
                    },messages:{
                      'username': '必要資訊',
                      'name': '必要資訊',
                      'email': '必要資訊'
                    }
                  });
                }
                function model_setting_password(id){
                  data_id = id;
                  ajax_action = 'resetpassword';
                  cleanForm();
                  ajax_read(id);
                  $('#passwordModel').modal({
                      keyboard: true
                  })
                  $('#passwordSetForm').validate({
                    rules:{
                      'password': 'required'
                    },messages:{
                      'password': '必要資訊'
                    }
                  });
                }
                function model_delete(id){
                    data_id = id;
                    ajax_action = 'delete';
                    cleanForm();
                    ajax_read(id);
                    $('#deleteModel').modal({
                        keyboard: true
                    })
                    $('#deleteFrom').validate({
                    rules:{
                      'id': 'required'
                    },messages:{
                      'id': '必要資訊'
                    }
                  });
                }
                function model_website(){
                  ajax_action = 'website';
                  ajax_read_webname();
                  $('#websiteModel').modal({
                     keyboard: true
                  });
                  $('#websiteForm').validate({
                    rules:{
                      'title': 'required'
                    },messages:{
                      'title': '必要資訊'
                    }
                  });
                }
                function ajax_create(){
                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  });
                  $.ajax({
                    type: 'post',
                    url: '{{ url('users') }}',
                    data: $('#createForm').serialize(),
                    success: function(){
                      $('#createModel').modal('hide');
                      Vue.set(msg_Vue,'ajaxSuccess',true);
                      setTimeout("location.reload()",5000);
                    },
                    error: function(){
                      alert("新增資料時發生錯誤，重新整理頁面後在試一次！");
                      location.reload();
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
                    type: 'post',
                    url: '{{ url('users') }}/'+data_id,
                    data: $('#updateFrom').serialize(),
                    success: function(){
                      $('#updateModel').modal('hide');
                      Vue.set(msg_Vue,'ajaxSuccess',true);
                      setTimeout("location.reload()",5000);
                    },
                    error: function(){
                      alert("更新資料時發生錯誤，重新整理頁面後在試一次！");
                      location.reload();
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
                    type: 'post',
                    url: '{{ url('users') }}/'+data_id,
                    data: $('#deleteFrom').serialize(),
                    success: function(){
                      $('#deleteModel').modal('hide');
                      Vue.set(msg_Vue,'ajaxSuccess',true);
                      setTimeout("location.reload()",5000);
                    },
                    error: function(){
                      alert("刪除資料時發生錯誤，重新整理頁面後在試一次！");
                      location.reload();
                    }
                  })
                }
                function ajax_setting_password(){
                  $.ajaxSetup({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                  });
                  $.ajax({
                    type: 'post',
                    url: '{{ url('users/password') }}/'+data_id,
                    data: $('#passwordSetForm').serialize(),
                    success: function(){
                      $('#passwordModel').modal('hide');
                      Vue.set(msg_Vue,'ajaxSuccess',true);
                      setTimeout("location.reload()",5000);
                    },
                    error: function(){
                      alert("更新密碼時發生錯誤，重新整理頁面後在試一次！");
                      location.reload();
                    }
                  })
                }
                function ajax_read(id){
                  $.ajax({
                    type: 'get',
                    url: '{{ url('users') }}/'+id,
                    success: function(data){
                      var name,username,email;
                      data_id = data['id'];
                      username = data['username'];
                      name = data['name'];
                      email = data['email'];
                      $("input[name=id]").val(data_id);
                      $("input[name=username]").val(username);
                      $("input[name=name]").val(name);
                      $("input[name=email]").val(email);
                      Vue.set(Vue_mydelete,'username',username);
                      Vue.set(Vue_mydelete,'name',name);
                      Vue.set(Vue_mydelete,'email',email);
                    },
                    error: function(){
                      alert('讀取資料發生錯誤，將重新整理頁面，在試一次');
                      location.reload();
                    }
                  })
                }
                function cleanForm(){
                    $("input[name=id]").val("");
                    $("input[name=username]").val("");
                    $("input[name=password]").val("");
                    $("input[name=name]").val("");
                    $("input[name=email]").val("");
                }
                function ajax_read_webname(){
                  $.ajax({
                    type: 'get',
                    url: '{{ url('website') }}',
                    success: function(data){
                      $("input[name=title]").val(data['title']);
                    },
                    error: function(){
                      alert("讀取資料發生錯誤！");
                      location.reload();
                    }
                  })
                }
                function ajax_website_update(){
                  $.ajaxSetup({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                  });
                  $.ajax({
                    type: 'post',
                    url: '{{ url('website') }}',
                    data: $('#websiteForm').serialize(),
                    success: function(){
                      Vue.set(msg_Vue,'ajaxSuccess',true);
                      setTimeout("location.reload()",5000);
                      $('#websiteModel').modal('hide');
                    },
                    error: function(){
                      alert("網站資訊修改失敗，將重新整理頁面，在試一次！");
                      location.reload();
                    }
                  })
                }
            </script>
        </div>
        @section('footer')
          @include('footer.footer')
        @show
    </body>
</html>