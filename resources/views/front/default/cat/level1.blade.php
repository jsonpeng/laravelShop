@extends('front.default.layout.base')

@section('css')
    <style>
      ul li{
        display: inline-block; height: 40px; line-height: 40px; padding: 0 10px;
      }
      .cat-selector{
        position: fixed;
      }
    </style>
@endsection

@section('content')
    <div class="nav_tip">
      <div class="img">
        <a href="javascript:history.back(-1)"><i class="icon ion-ios-arrow-left"></i></a></div>
      <p class="titile">分类</p>
    </div>
    <div class="cat-selector">
      <ul>
        <li @if($id == $parent_id) class="active" @endif><a href="/category/level1/{{$parent_id}}">全部商品</a></li>
        @foreach ($childrenCats as $element)
          <li @if($id == $element->id) class="active" @endif><a href="/category/level1/{{$element->id}}">{{$element->name}}</a></li>
        @endforeach
      </ul>
    </div>

    <div class="product-wrapper scroll-container" style="margin-top: 0rem;">
      @foreach ($products as $element)
        <a class="product-item2 scroll-post" href="/product/{{$element->id}}">
            <div class="img">
                <img class="lazy" data-original="{{ $element->image }}" src="{{ $element->image }}">
            </div>
            <div class="title">{{$element->name}}</div>
            <div class="price">¥{{$element->price}}@if($element->jifen)+{{ $element->jifen }}{!! getSettingValueByKeyCache('credits_alias') !!}@endif <br><span class="buynum">已售 {{ $element->sales_count }}</span></div>
        </a>
      @endforeach
    </div>

    @include('front.'.theme()['name'].'.layout.shopinfo')
    
    @include(frontView('layout.nav'), ['tabIndex' => 2])

@endsection

@section('js')
  <script type="text/javascript">
    //无限滚动
    
    $(document).ready(function(){

      var fireEvent = true;
      var working = false;

      $(document).endlessScroll({

        bottomPixels: 350,

        fireDelay: 10,

        ceaseFire: function(){
          console.log('下拉Fire');
          if (!fireEvent) {
            return true;
          }

        },

        callback: function(p){
          console.log('下拉');
          if(!fireEvent || working){return;}

          working = true;


          //加载函数
          $.ajaxSetup({ 
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            url:"/api/products_of_cat_with_children/{{ $id }}?skip=" + $('.scroll-post').length + "&take=18",
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
                var jifen_html = all_product[i].jifen ? '+'+all_product[i].jifen + "{!! getSettingValueByKeyCache('credits_alias') !!}" : '';
                $('.scroll-container').append(
                  "<a class='product-item2 scroll-post' href='/product/" + all_product[i].id + "'>\
                      <div class='img'>\
                          <img src='" + all_product[i].image + "'>\
                      </div>\
                      <div class='title'>" + all_product[i].name + "</div>\
                      <div class='price'>¥" + all_product[i].price + jifen_html +"<br><span class='buynum'>已售 " + all_product[i].sales_count + "</span></div>\
                  </a>"
                );
              }
              }
          });

        }

      });

    });
  
  </script>
@endsection