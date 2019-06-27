@extends('front.default.layout.base')

@section('css')
    <style>
      .app-wrapper{position: relative;height: 100%;}
      html, body{height: auto;}
      .cat-left>div{
        height:100%;
        display: flex;
        flex-direction:column;
      }
      .cat-left>div a{
        flex:1;
      }
      #scroll02 .scroll-floor:last-child .list-item{
        min-height:900px;
      }
    </style>
@endsection

@section('content')
  <div class="catSearch weui-cell">
      <div class="weui-cell__bd">
          <input type="search" id="searchInput" placeholder="请输入要查找内容">
      </div>
      {{-- <div class="weui-cell__ft"> <i class="iconfont">&#xe612;</i></div> --}}
      <div class="weui-cells searchbar-result" id="searchResult">
      </div>
  </div>
  
  <div class="cat-left">
    <div>
    @foreach($categories as $category)
      <a class="cat-row scroll-nav">{{ $category->name}}</a>
    @endforeach
    </div>
  </div>
  <div class="cat-right" id="scroll02">
    <div class="displayBoard">
        <img src="{{ asset('images/trade/yb1.jpg') }}" alt="">
    </div>
    @foreach($categories as $category)
    <div class="scroll-floor">
      <div class="weui-cells">
        <a class="weui-cell weui-cell_access" href="/category/level1/{{$category->id}}">
            <div class="weui-cell__bd">
                <span style="vertical-align: middle;">{{$category->name}}</span>
            </div>
            <div class="weui-cell__ft">更多</div>
        </a>
      </div>
      <div class="list-item">
        @foreach ($category['children'] as $element)
          <a class="category-list-item" href="/category/level2/{{$element->id}}">
            <div class="img">
                <img class="lazy" data-original="{{ $element->image }}">
            </div>
            <div class="name">{{$element->name}}</div>
          </a>
        @endforeach
      </div>
    </div>
    @endforeach
  </div>
  
  @include(frontView('layout.nav'), ['tabIndex' => 2])
@endsection


@section('js')
  <script src="{{ asset('vendor/doT.min.js') }}"></script>
  <script src="{{ asset('vendor/underscore-min.js') }}"></script>
  <script type="text/template" id="template-search">
      @{{~it:value:index}}
          <a class="weui-cell weui-cell_access" href="/product/@{{=value.id}}">
              <div class="weui-cell__bd weui-cell_primary">
                  <p>@{{=value.name}}</p>
              </div>
          </a>
      @{{~}}
  </script>
  <!-- 商品分类页面的楼层显示效果 -->
  <script src="{{ asset('vendor/jquery.scroll.floor.js') }}"></script>
  <script type="text/javascript">
      scrollFloor({
        floorClass : '.scroll-floor',       //楼层盒子class;默认为'.scroll-floor'
        navClass : '.scroll-nav',           //导航盒子class;默认为'.scroll-nav'
        activeClass : 'active',             //导航高亮class;默认为'active'
        delayTime:300,                      //点击导航，滚动条滑动到该位置的时间间隔;默认为200
        activeTop:10,                      //楼层到窗口的某个位置时，导航高亮（设置该位置）;默认为100
        scrollTop:0                         //点击导航，楼层滑动到窗口的某位置;默认为100
      });
      
      //点击高亮
      $('.scroll-nav').click(function(){
          $('.scroll-nav').removeClass('active');
          $(this).addClass('active');
      });
      // 左侧导航栏高度
      var height1=$(window).height()-92;
      $('.cat-left').height(height1);
      @include('front.common.search.js')
  </script>
@endsection

{{-- @include('front.common.search.js') --}}