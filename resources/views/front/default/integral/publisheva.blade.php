@extends('front.default.layout.base')

@section('css')
<style>
.weui-uploader__file_status:before {
    content: " ";
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-color: transparent;
}
.zhezhao{
	background-color: rgba(0,0,0,.5);
}
</style>
@endsection

@section('title')
@endsection

@section('content')
	<div class="nav_tip">
	  <div class="img">
	    <a href="/usercenter"><i class="icon ion-ios-arrow-left"></i></a></div>
	  <p class="titile">发表评价</p>
	</div>

	<form id="eval-form">
		<div class="wallet">
			<div class="bg">
				<img src="{{asset('images/trade/wallet.jpg')}}" alt="">
			</div>
			<div class="selfInfo weui-cell" style="background-color:#fff;">
				<div class="weui-cell__bd" style="border-bottom: 0;">
					<div class="Uimg">
						<img  src="{!! $product->image !!}"  onerror="javascript:this.src='/images/trade/n1.jpg';" alt="">
					</div>
					<input type="hidden" name="item_id" value="{!! $input['item_id'] !!}">
					<input type="hidden" name="product_id" value="{!! $product->id !!}">
					<p class="name" style="padding:0 20px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">{!! $product->name !!} @if(!empty($spec)) [{!! $spec->key_name !!}] <input type="hidden" name="spec_id" value="{!! $spec->id !!}"> @else <input type="hidden" name="spec_id" value="0"> @endif</p>
					<ul style="list-style: none" class="starts">
					    <li class="ion-star choose"></li>
					    <li class="ion-star choose"></li>
					    <li class="ion-star choose"></li>
					    <li class="ion-star choose"></li>
					    <li class="ion-star choose"></li>
					    <input type="hidden" name="all_level" value="0" />
					</ul>
					<div class="balance"></div>
				</div>
			</div>

			<div class="function weui-cells">
				<div class="weui-cell">
					<div class="weui-cell__hd">商家服务：</div>
					<div class="weui-cell__bd">
						<ul style="list-style: none" class="merchantService">
						    <li class=" choose" data-type="merchantService"><img src="{{asset('images/trade/smile.png')}}" alt=""></li>
						    <li class=" choose" data-type="merchantService">
						    	<img src="{{asset('images/trade/smile.png')}}" alt="">
						    </li>
						    <li class=" choose" data-type="merchantService">
						    	<img src="{{asset('images/trade/smile.png')}}" alt="">
						    </li>
						    <li class=" choose" data-type="merchantService">
						    	<img src="{{asset('images/trade/smile.png')}}" alt="">
						    </li>
						    <li class=" choose" data-type="merchantService">
						    	<img src="{{asset('images/trade/smile.png')}}" alt="">
						    </li>
					        <input type="hidden" name="service_level" value="0" />
						</ul>
					</div>
				</div>
				<div class="weui-cell">
					<div class="weui-cell__hd">物流速度：</div>
					<div class="weui-cell__bd">
						<ul style="list-style: none" class="speed">
						    <li class=" choose" data-type="speed">
						    	<img src="{{asset('images/trade/smile.png')}}" alt="">
						    </li>
						    <li class=" choose" data-type="speed">
						    	<img src="{{asset('images/trade/smile.png')}}" alt="">
						    </li>
						    <li class=" choose" data-type="speed">
						    	<img src="{{asset('images/trade/smile.png')}}" alt="">
						    </li>
						    <li class=" choose" data-type="speed">
						    	<img src="{{asset('images/trade/smile.png')}}" alt="">
						    </li>
						    <li class=" choose" data-type="speed">
						    	<img src="{{asset('images/trade/smile.png')}}" alt="">
						    </li>
						    <input type="hidden" name="logistics_level" value="0" />
						</ul>
					</div>
				</div>
				<div class="weui-cell">
					<div class="weui-cell__hd">整体评价：</div>
					<div class="weui-cell__bd">
						<ul style="list-style: none" class="overall">
						    <li class=" choose" data-type="overall">
						    	<img src="{{asset('images/trade/smile.png')}}" alt="">
						    </li>
						    <li class=" choose" data-type="overall">
						    	<img src="{{asset('images/trade/smile.png')}}" alt="">
						    </li>
						    <li class=" choose" data-type="overall">
						    	<img src="{{asset('images/trade/smile.png')}}" alt="">
						    </li>
						    <li class=" choose" data-type="overall">
						    	<img src="{{asset('images/trade/smile.png')}}" alt="">
						    </li>
						    <li class=" choose" data-type="overall">
						    	<img src="{{asset('images/trade/smile.png')}}" alt="">
						    </li>
						    <input type="hidden" name="overall_level" value="0" />
						</ul>
					</div>
				</div>
			</div>


			
			{{-- 上传图片 --}}
			<div class="weui-cells weui-cells_form">
			  <div class="weui-cell">
			    <div class="weui-cell__bd">
			      <div class="weui-uploader">
			        <div class="weui-uploader__hd">
			          <p class="weui-uploader__title">图片上传</p>
			          <div class="weui-uploader__info">0/6</div>
			        </div>
			        <div class="weui-uploader__bd">
			          <ul class="weui-uploader__files attach" id="uploaderFiles">
			          
			          </ul>
			          <div class="weui-uploader__input-box clickbox">
			            <a  class="weui-uploader__input type_files" href="javascript:;"> </a>
			          </div>
			        </div>
			      </div>
			    </div>
			  </div>
			</div>

			<div class="evaluate">
				<div class="weui-cell">
					<div class="weui-cell__bd">
						<textarea name="content" id="pushWords" maxlength="200"></textarea>
						<p class="wordLimit"><span>0</span>/200</p>
					</div>
				</div>
				<div class="weui-cell">
					<div class="weui-cell__bd"><input type="checkbox" name="anonymous" />匿名评价</div>
					<div class="weui-cell__ft"></div>
				</div>
			</div>

			<div class="btn_bottom">提交评价</div>

		</div>
	</form>

	<div id="upload-item" style="display: none;">
			  <li class="weui-uploader__file weui-uploader__file_status zhezhao" style="background-image:url(./images/pic_160.png);position: relative;">
			  		  <p class="delete_pic" style="background-color:#999;color:#fff;width:15px;height:15px;border-radius:50%;position: absolute;right:0;top:0;font-size:12px;line-height: 16px;text-align: center;" onclick="$(this).parent().remove();">×</p>
		              <div class="weui-uploader__file-content">50%</div>
		              <input type="hidden" name="url[]" value="图片" />
		              <input type="hidden" name="type[]" value="图片" />
		      </li>
	</div>
@endsection


@section('js')
<script type="text/javascript" src="{{ asset('vendor/layer/layer.js') }}"></script>
<script src="{{ asset('vendor/dropzone/dropzone.js') }}"></script>
<script type="text/javascript">
		window.onload=function(){

		@if(app('commonRepo')->productEvalRepo()->varifyHadEvaled($input['item_id']))
				alert('该商品您已评论过了,请勿重复评论!');
				history.back(-1);
		@endif

		var aaa=$('.starts li');
		var balance=['很差','一般','满意','非常满意','无可挑剔'];
		$('.starts li').click(function(event) {
			/* Act on the event */
			var index=$(this).index();
			$('.selfInfo .balance').text('“'+balance[index]+'”');
			$(this).parent().find('input').val(index+1);
		});
		    for(var i=0;i<aaa.length;i++)
		    {
		        aaa[i].index=i;
		        aaa[i].onclick=function(){
		            for(var j=0;j<=this.index;j++)
		            {
		               aaa[j].style.color='#ffd161';
		            }
		            for(var k=this.index+1; k<aaa.length;k++)
		            {
		                aaa[k].style.color='#e6e6e6';
		            }
		        }
		    };
		$('.merchantService > li,.speed li,.overall li').click(function(){
			var index = $(this).index();
			var type = $(this).data('type');
			$('.'+type+' > li').find('img').attr('src','/images/trade/smile.png');
			$('.'+type+' > li').each(function(){
					if(index >= $(this).index()){
						$(this).find('img').attr('src','/images/trade/smile1.png');
					}
			});
			$(this).parent().find('input').val(index+1);
			console.log($(this).parent());
		});
		
		$('#pushWords').keyup(function(){
			var num=$('#pushWords').val().length;
			if(num>200){
				num=200
			}
			$('.evaluate .wordLimit span').html(200-num);
			console.log(num);
		});

		//图片上传验证
		function imgUploadVarify(){
			   if($('.attach > li').length >=6){
                	$('.clickbox').hide();
                }
        		else{
                	$('.clickbox').show();
                }
		}
		var click_dom;
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
			          var dom = $('.attach').append($('#upload-item').html());
			          click_dom = dom.find('li').last();
			          console.log(click_dom);
			          imgUploadVarify();
	        },
	        totaluploadprogress:function(progress){
	          progress=Math.round(progress);
	          click_dom.find('div').text(progress+"%");
	        },
	        queuecomplete:function(progress){
	          click_dom.find('.weui-uploader__file-content').text('√');
	        },
	        success:function(file,data){
	          if(data.code == 0){
	              console.log('上传成功:'+data.message.src);
	              if(data.message.type == 'image'){
	                click_dom.attr('style','background-image:url('+data.message.src+')').removeClass('zhezhao');
	                click_dom.find('input:eq(0)').val(data.message.src);
	                // $('#uploaderFiles').addClass('type_files');
	                $('.weui-uploader__info').text($('.attach > li').length+'/6');
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

	    //提交评价
	    $('.btn_bottom').click(function(){
	    	$.zcjyRequest('/ajax/product_eval/publish',function(res){
	    		if(res){
	    			alert(res);
	    			location.href="/orders";
	    		}
	    	},$('#eval-form').serialize());
	    	console.log($('#eval-form').serialize());
	    });
		};
	</script>

@endsection