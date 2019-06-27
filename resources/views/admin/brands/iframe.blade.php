@extends('admin.layouts.app_tem')

@section('content')
<section class="content-header mb10-xs">
    <h1 class="pull-left">品牌列表</h1>
    <div>(共{!! $brands_num !!}条记录)</div>
</section>

<div class="content pdall0-xs">
    <div class="clearfix"></div>

    <!-- /.box -->

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">
            <table class="table table-responsive" id="products-table">
                <thead>
                    <th>品牌名称</th>
                    <th>简介</th>
                    <th>排序</th>
                    <th>品牌LOGO</th>
                </thead>
                <tbody id="products-tbody">
                    @foreach($brands as $brand)
                        <tr data-weblink="{{ route('front.mobile.brand',$brand->id) }}" data-minilink="../brands/list?brand_id={{ $brand->id }}">
                            <td>{!! $brand->name !!}</td>
                            <td>{!! $brand->intro !!}</td>
                            <td>{!! $brand->sort !!}</td>
                            <td> <img src="{!! $brand->image !!}" style="max-width: 100%; max-height: 25px;"> </td>
            
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="pull-left" style="margin-top:15px;">
            <input type="button" class="btn btn-primary"  value="确定" id="product_enter"></div>
    </div>
     <div class="tc">
        <?php echo $brands->appends('')->render(); ?></div>
</div>
@endsection


@section('scripts')
<script type="text/javascript">

        //单选商品
        $('#products-tbody >tr').click(function(){
    
                $('#products-tbody >tr').each(function(){
                    if($(this).hasClass('trSelected')){
                        $(this).removeClass('trSelected');
                    }
                });
               $(this).toggleClass('trSelected');
       
        });

        //确定
        $('#product_enter').click(function(){
            var selected=$('#products-tbody >tr').hasClass('trSelected');
            if(!selected){
               layer.alert('请选择品牌', {icon: 2}); 
               return false;
            }
            $('#products-tbody >tr').each(function(){
                if(!$(this).hasClass('trSelected')){
                    $(this).remove();
                }
            });
            var tabHtml=$('#products-tbody').html();
            javascript:window.parent.call_back_by_one(tabHtml.replace(/选择/,'购买数量'),'banner_link');
        });
</script>
@endsection