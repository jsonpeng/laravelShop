@extends('front.default.layout.base')

@section('css')
    <style>
        .weui-grid{width: 25%;}
       	.credit-body .g-content .info .weui-flex__item{font-size: 13px;}
       	.credit .credit-body .g-title .weui-flex__item:last-child{flex: 3;}
       	.credit .credit-body .g-content{background-color: #fff;}
       	.credit .credit-body>div:nth-child(even){background-color:#fbfcfb;}
    </style>
@endsection

@section('content')
<div class="nav_tip">
  <div class="img">
    <a href="javascript:history.back(-1)"><i class="icon ion-ios-arrow-left"></i></a></div>
  <p class="titile">意见反馈</p>
</div>
  
<form id="feedback-form">
  <div class="weui-cell">
    <div class="suggest">
        <div class="title">您的反馈是：</div>
        <div class="radios">
          <input name="type" id="problem" type="radio" value="反映问题" /> 
          <label for="problem">反映问题</label>
          <input name="type" id="problem1" type="radio" value="提出建议" /> 
          <label for="problem1">提出建议</label>
          <input name="type" id="problem2" type="radio" value="其他" /> 
          <label for="problem2">其他</label>
        </div>
        <div class="title">意见反馈：</div>
        <textarea name="content" id="pushSuggest" maxlength="400" placeholder="请输入遇到的问题或建议..."></textarea>
        <div class="wordsNum"><span>0</span>/400</div>
    </div>
  </div>

  <div class="weui-cell">
      <div class="contact_phone weui-cell__bd">
          <span>联系电话：</span><input type="text" name="tel" placeholder="请输入您的联系电话">
      </div>
  </div>

  <div class="btn_bottom">确认提交</div>
</form>
@endsection



@section('js')
  <script type="text/javascript" src="{{ asset('vendor/layer/layer.js') }}"></script>
  <script type="text/javascript">
      $('.btn_bottom').click(function(){
          $.zcjyRequest('/ajax/submit_feedback',function(res){
            if(res){
              alert(res);
              history.back(-1);
            }
        },$('#feedback-form').serialize());
      });
  </script>
@endsection