@extends('front.default.layout.base')

@section('css')
	<link href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css" rel="stylesheet">
@endsection

@section('title')
@endsection

@section('content')
	<div class="messageCenter">
		<div class="nav_tip">
		  <div class="img">
		    <a href="javascript:history.back(-1)"><i class="icon ion-ios-arrow-left"></i></a></div>
		  <p class="titile">通知消息</p>
		</div>
		<div class="weui-cells">
		
			@foreach ($messages as $message)
				<div class="weui-cell weui-cell_swiped">
				  <div class="weui-cell__bd">
				    <div class="weui-cell">
				      <div class="weui-cell__bd">
				        <p>{!! $message->data['type'] !!}</p>
				      </div>
				      <div class="weui-cell__ft">{!! $message->currentTime !!}</div>
				    </div>
				    <div class="messageTxt">{!! $message->data['content'] !!}</div>
				  </div>
				  <div class="weui-cell__ft">
				    <a class="weui-swiped-btn weui-swiped-btn_warn delete-swipeout" data-id="{!! $message->id !!}" href="javascript:">删除</a>
				    <a class="weui-swiped-btn weui-swiped-btn_default close-swipeout" href="javascript:">关闭</a>
				  </div>
				</div>
			@endforeach

		</div>

	</div> 
@endsection


@section('js')
	<!-- jqWeui --> 
	<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>
	<script>
		$('.weui-cell_swiped').swipeout();

		$('.delete-swipeout').click(function () {
			var that = this;
			$.zcjyRequest('/ajax/message/delete',function(res){
				if(res){
						$(that).parents('.weui-cell').remove();
				}
			},{id:$(that).data('id')});
		})
		$('.close-swipeout').click(function () {
		  $(this).parents('.weui-cell').swipeout('close');
		})
		
	</script>

@endsection