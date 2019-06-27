@section('scripts')
    <script type="text/javascript">

      var jifen_alias = '{{ getSettingValueByKeyCache('credits_alias') }}';

        function freezeUser(obj,userid){
          var that=obj;
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
              url:"/zcjy/ajax/freezeuser/"+userid,
              type:"POST",
              success:function(data){
                if(data.code==0){
                       layer.msg(data.message, {icon: 1});
                       $(that).parent().html('<span class="btn label label-danger" onclick="freezeUser(this,'+userid+')">取消冻结</span>');
                }else if(data.code==1){
                        layer.msg(data.message, {icon: 1});
                       $(that).parent().html('<span class="btn label label-success" onclick="freezeUser(this,'+userid+')">冻结用户</span>');
                }else{
                       layer.msg(data.message, {icon: 5});
                }   
              }
          });
        }

      function distributeUser(obj,userid) {
        var that=obj;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:"/zcjy/ajax/distributeUser/"+userid,
            type:"POST",
            success:function(data){
              if(data.code==0){
                layer.msg(data.message, {icon: 1});
                $(that).parent().html('<span class="btn label label-success" onclick="distributeUser(this,'+userid+')">分销用户</span>');
              }else if(data.code==1){
                layer.msg(data.message, {icon: 1});
                $(that).parent().html('<span class="btn label label-warning" onclick="distributeUser(this,'+userid+')">无分销资格</span>');
              }else{
                layer.msg(data.message, {icon: 5});
              } 
            }
        });
      }


     //积分修改操作
     $('#creditsEdit').click(function(){
      var credits=$(this).parent().find('span').text();
      var userid=$(this).data('id');
       layer.open({
        type: 1,
        closeBtn: false,
        shift: 7,
        shadeClose: true,
        content: "<div style='width:350px; padding: 0 15px;'><div style='width:320px;' class='form-group has-feedback'><p>当前"+jifen_alias+"</p><input  class='form-control' type='text'  name='credits' value='"+credits+"' disabled/></div>" +
        "<div style='width:320px;' class='form-group has-feedback'><p>输入"+jifen_alias+"变动</p><input class='form-control' type='number' name='credits_change' value='' /></div>"+
        "<button style='margin-top:5%;width:80%;margin:0 auto;margin-bottom:5%;' type='button' class='btn btn-block btn-primary btn-lg' onclick='updateCredits("+userid+")'>修改</button></div>"
         });
     });

     //积分修改对接
     function updateCredits(userid){
        if($('input[name=credits_change]').val()==null || $('input[name=credits_change]').val()==''){
              layer.open({
                    content: '请输入变动值'
                    ,skin: 'msg'
                  });
            return false;
        }
        var credits=parseFloat($('input[name=credits]').val());

        var credits_change=credits_change<0?-parseFloat(-($('input[name=credits_change]').val())):parseFloat($('input[name=credits_change]').val());
        console.log(credits+":"+credits_change);
        var credits_final=credits+credits_change;
        if(credits_change<0 && credits_final<0){
            layer.open({
              content: '变动不能大于原'+jifen_alias
              ,skin: 'msg'
            });
            return false;
        }
       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:"/zcjy/ajax/user/"+userid+'/credits_change',
            type:"POST",
            data:{
                credits_change:credits_change
            },
            success:function(data){
              if(data.code==0){
                 layer.msg(data.message, {icon: 1});
                 $('#creditsEdit').parent().find('span').text(credits_final);
                 setTimeout(function(){
                    layer.closeAll();
                 },500); 
              }else{
                 layer.msg(data.message, {icon: 5});
              }
            }
          });
     }

     //余额修改操作
     $('#userMoneyEdit').click(function(){
      var user_money=$(this).parent().find('span').text();
      var userid=$(this).data('id');
       layer.open({
        type: 1,
        closeBtn: false,
        shift: 7,
        shadeClose: true,
        content: "<div style='width:350px; padding: 0 15px;'><div style='width:320px;' class='form-group has-feedback'><p>当前余额</p><input  class='form-control' type='text'  name='user_money' value='"+user_money+"' disabled/></div>" +
        "<div style='width:320px;' class='form-group has-feedback'><p>输入余额变动</p><input class='form-control' type='number' name='user_money_change' value='' /></div>"+
        "<button style='margin-top:5%;width:80%;margin:0 auto;margin-bottom:5%;' type='button' class='btn btn-block btn-primary btn-lg' onclick='updateUserMoney("+userid+")'>修改</button></div>"
         });

     });

     function updateUserMoney(userid){
        if($('input[name=user_money_change]').val()==null || $('input[name=user_money_change]').val()==''){
              layer.open({
                    content: '请输入变动值'
                    ,skin: 'msg'
                  });
            return false;
        }
        var user_money=parseFloat($('input[name=user_money]').val());
        var user_money_change=parseFloat($('input[name=user_money_change]').val());
        var user_money_final=user_money+user_money_change;
        if(user_money_change<0 && user_money_final<0){
                  layer.open({
                    content: '变动余额不能大于原余额'
                    ,skin: 'msg'
                  });
            return false;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:"/zcjy/ajax/user/"+userid+'/money_change',
            type:"POST",
            data:{
                money_change:user_money_change
            },
            success:function(data){
              if(data.code==0){
                 layer.msg(data.message, {icon: 1});
                 $('#userMoneyEdit').parent().find('span').text(user_money_final);
                 setTimeout(function(){
                    layer.closeAll();
                 },500); 
              }else{
                 layer.msg(data.message, {icon: 5});
              }
            }
          });
     }
     //send_notices
     //给单个用户发通知消息/给所有用户发通知消息
     $('.authMessage').click(function(){
         $('.message').removeClass('message-active');
         $('.message').attr('disabled','true');
         var type=$(this).data('type');
         if(type == 'group'){
            $.zcjyFrameOpen($('#message_box').html(),'发送消息给当前所有用户',['30%', '280px']);
             $('.authMessageFunc').data('type','group');
         }else{
            var userid=$(this).data('id');
            var username = $(this).data('name');
            $.zcjyFrameOpen($('#message_box').html(),'发送消息给'+username,['30%', '280px']);
            $('.authMessageFunc').data('id',userid);
            $('.authMessageFunc').data('type','single');
         }
     });
    //弹出层input监听输入事件
     $(document).on('keyup','.message-textarea', function() {
          if($(this).val() != ''){
          $('.message').addClass('message-active');
          $('.message').removeAttr('disabled');
        }
        else{
          $('.message').removeClass('message-active');
          $('.message').attr('disabled','true');
        }
     });
     //发送消息
      $(document).on('click','.authMessageFunc', function() {
            $.zcjyRequest('/zcjy/ajax/send_notices',function(res){
              if(res){
                  layer.closeAll();
                  layer.msg(res, {
                    icon: 1,
                    skin: 'layer-ext-moon' 
                    });
              }
          },{content:$('.message-textarea:eq(1)').val(),type:$(this).data('type'),user_id:$(this).data('id')});
      });
    </script>
@endsection