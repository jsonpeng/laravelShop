@extends('front.default.layout.base')

@section('css')
<style>
.btn_bottom{border: none;}
.disabled{background-color: #ddd;}
.getCode.disable{color:#ddd;border: 1px solid #ddd;}
</style>
@endsection

@section('content')
<form class="cert-form">
  <div class="nav_tip">
    <div class="img">
      <a href="javascript:history.back(-1)"><i class="icon ion-ios-arrow-left"></i></div></a>
    <p class="titile">实名认证</p>
  </div>

  <div class="real_name weui-cell">
    <div class="weui-cell__bd">
      <p><span>*</span>请填写真实姓名：</p><input type="text" name="name" placeholder="真实姓名">
    </div>
  </div>
  <div class="idCard weui-cell">
    <div class="weui-cell__bd">
      <p><span>*</span>请输入身份证号码：</p><input type="text" name="id_card" placeholder="身份证号码">
    </div>
  </div>

  <div class="phoneNum weui-cell">
    <div class="weui-cell__bd">
      <p><span>*</span>请输入手机号：</p><input type="text" name="mobile" placeholder="手机号">
    </div>
    <div class="weui-cell__ft getCode" data-abled="1">获取验证码</div>
  </div>
  <div class="verificationCode weui-cell">
    <div class="weui-cell__bd">
      <p><span>*</span>请输入验证码：</p><input type="text" name="code">
    </div>
  </div>
  <div class="postImg weui-cell">
    <div class="weui-cell__bd">
        <p><span>*</span>上传身份证照片：</p>
        <div class="idCardImg">
            <div class="cardImgItem">
               <input type="hidden" class="current_src" name="current_image_src[]" value="" />
              <div class=" type_files attach">
                <input type="hidden" name="face_image" value="" />
                <img src="{{ asset('images/trade/front.jpg') }}" alt="">
              </div>
            </div>

            <div class="cardImgItem">
              <input type="hidden" class="current_src" name="current_image_src[]" value="" />
            <div class=" type_files ">
              <input type="hidden" name="back_image" value="" />
              <img src="{{ asset('images/trade/back.jpg') }}" alt="">
            </div>
            </div>

        </div>
    </div>
  </div>

  <div class="weui-cell imgRequire">
     <div class="weui-cell__bd">
        <p>拍摄要求：</p>
        <div class="wrongImg">
            <div class="wrongImgItem">
                <img src="{{ asset('images/trade/require1.jpg') }}" alt="">
            </div>
            <div class="wrongImgItem">
                <img src="{{ asset('images/trade/require2.jpg') }}" alt="">
            </div>
            <div class="wrongImgItem">
                <img src="{{ asset('images/trade/require3.jpg') }}" alt="">
            </div>
            <div class="wrongImgItem">
                <img src="{{ asset('images/trade/require4.jpg') }}" alt="">
            </div>
        </div>
     </div>
  </div>

  <div class="postImg  weui-cell">
    <div class="weui-cell__bd">
        <p><span>*</span>上传手持身份证照片：</p>
        <div class="idCardImg ">
            <input type="hidden" class="current_src" name="current_image_src[]" value="" />
            <div class="cardImgItem handImage type_files">
              <input type="hidden" name="hand_image" value="" />
              <img src="{{ asset('images/trade/hold.jpg') }}" alt="">
            </div>
            <div class="cardImgItem tackphoto type_files">
              <img src="{{ asset('images/trade/camare.jpg') }}" alt="">
            </div>
        </div>
    </div>
  </div>

  <button class="btn_bottom" type="button">提交审核</button>
  
</form>
@endsection


@section('js')
<script type="text/javascript" src="{{ asset('vendor/layer/layer.js') }}"></script>
<script src="{{ asset('vendor/dropzone/dropzone.js') }}"></script>
<script type="text/javascript">
    //表单提交验证
    function formVarified(){
      $('.btn_bottom').removeClass('disabled').removeAttr('disabled');
      $.inputAttr('name,id_card,mobile,code,face_image,back_image,hand_image').each(function(){
          if($.empty($(this).val())){
            //console.log($(this));
            $('.btn_bottom').addClass('disabled').attr('disabled','true');
          }
      });
    }
    formVarified();
    //输入姓名身份证号
    $.inputAttr('name,id_card,mobile,code').keyup(function(){
          formVarified();

    });
    //获取验证码
    $('.getCode').click(function(){
        var mobile = $('input[name=mobile]').val(); 
        if($.empty(mobile)){
          alert('请先输入手机号');
          return false;
        }
        if($(this).data('abled')){
          $.zcjyRequest('/ajax/send_code/auth',function(res){
              if(res){
                  time();
              }
          },{mobile:mobile});
        }
    });
    var wait=60;
    function time() {
            var o = $('.getCode');
            if (wait == 0) {
                o.removeClass('disable');
                o.data("abled",1);   
                o.text("获取验证码");
                wait = 60;
            } 
            else { 
                o.addClass('disable');
                o.data("abled",0); 
                o.text("重新发送(" + wait + ")");
                wait--;
                setTimeout(function() {
                    time()
                }, 1000)
            }
    }
    var click = 1;
    //点击提交审核
    $('.btn_bottom').click(function(){
      if(click){
        click = 0;
        layer.load(1, {shade: [0.8, '#393D49'], time: 60000});
        // $('.btn_bottom').addClass('disabled').attr('disabled','true');
        $.zcjyRequest('/ajax/certs/publish',function(res){
            layer.closeAll();
            click = 1;
            if(res){
              alert(res);
              location.href="/integral/cert_success";
            }
        },$('.cert-form').serialize());
      }
      else{
        alert('正在处理中请勿重复点击!');
      }
    });
    //图片文件上传
    var myDropzone = new Dropzone(document.body, {
        url:'/ajax/uploads',
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        addRemoveLinks:false,
        maxFiles:100,
        autoQueue: true, 
        previewsContainer: ".attach", 
        clickable: ".type_files",
        headers: {
         'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        addedfile:function(file){
            //console.log(file);
        },
        totaluploadprogress:function(progress){
          progress=Math.round(progress);
          $('.type_files').find('a').text(progress+"%");
        },
        queuecomplete:function(progress){
          $('.type_files').find('a').text('上传完毕√');
        },
        success:function(file,data){
          if(data.code == 0){
              click = 1;
              console.log('上传成功:'+data.message.src);
              if(data.message.type == 'image'){
                click_dom.find('img').attr('src',data.message.src);
                click_dom.find('input').val(data.message.src);
                click_dom.parent().find(".current_src").val(data.message.current_src);
                formVarified();
              }
          }
          else{
            alert('文件格式不支持!');
          }
      },
      error:function(){
        console.log('失败');
      }
    });
    var click_dom;
    $('.type_files').click(function(){
      if($(this).hasClass('tackphoto')){
        click_dom = $('.handImage');
      }else{
        click_dom = $(this);
      }
    });
</script>
@endsection