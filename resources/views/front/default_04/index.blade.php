@extends('front.default.layout.base')

@section('css')

@endsection

@section('title')
@endsection

@section('content')
  <h1>新会员商城</h1>
@endsection


@section('js')
<script type="text/javascript">
    $(document).ready(function(){

        //秒杀倒计时
        @if(funcOpen('FUNC_FLASHSALE') && $flashSaleProduct->count())
            var end_time='{!! $time !!}';
            startShowCountDown(end_time,'#count_timer','flashsale_index');
        @endif

        //无限加载
        var fireEvent = true;
        var working = false;

        $(document).endlessScroll({

            bottomPixels: 250,

            fireDelay: 10,

            ceaseFire: function(){
              if (!fireEvent) {
                return true;
              }
            },

            callback: function(p){

              if(!fireEvent || working){return;}

              working = true;

              //加载函数
              $.ajaxSetup({ 
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              $.ajax({
                url:"/api/products?skip=" + $('.scroll-post').length + "&take=18",
                type:"GET",
                success:function(data){
                  working = false;
                  var all_product=data.data;
                  if (all_product.length == 0) {
                    fireEvent = false;
                    $('#shopinfo').show();
                    return;
                  }
                  for (var i = all_product.length - 1; i >= 0; i--) {
                    $('.scroll-container').append(
                      "<a class='product-item2 scroll-post' href='/product/" + all_product[i].id + "'>\
                          <div class='img'>\
                              <img src='" + all_product[i].image + "'>\
                          </div>\
                          <div class='title'>" + all_product[i].name + "</div>\
                          <div class='price'>¥" + all_product[i].price + " <span class='buynum'> " + all_product[i].sales_count + "人购买</span></div>\
                      </a>"
                    );
                  }
                  }
              });
            }
        });
    });


    $('.price-btn').click(function(){
        var id=$(this).data('id');
        var status=$(this).data('status');
        var that=this;
        if(!status){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:'/api/userGetCoupons/'+id,
                type:'post',
                success:function(data){
                    if(data.code==0){
                        layer.open({
                        content:data.message
                        ,skin: 'msg'
                        ,time: 2 
                      });
                    $(that).text('已领取');
                    $(that).data('status',true);
                    $(that).attr("style","background-color:#ddd !important;");
                    }else{
                    layer.open({
                        content:data.message
                        ,skin: 'msg'
                        ,time: 2 
                      });
                    }
                }
            });
        }else{
            return false;
        }

     });

    /**
     * 没有活动提示
     * @return {[type]} [description]
     */
     function noHuodong(){
        layer.open({
          content: '当前没有优惠活动'
          ,skin: 'msg'
          ,time: 2 //2秒后自动关闭
        });
     }
</script>
@endsection