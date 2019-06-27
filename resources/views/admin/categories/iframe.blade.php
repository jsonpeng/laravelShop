@extends('admin.layouts.app_tem')

@section('content')
<section class="content-header mb10-xs">
    <h1 class="pull-left">分类列表</h1>
    <div>(共{!! count($categories) !!}条记录)</div>
</section>

<div class="content pdall0-xs">
    <div class="clearfix"></div>

    <!-- /.box -->

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">
            <table class="table table-responsive" id="products-table">
                <thead>
                    <th>名称</th>
                    <th class="hidden-xs">别名</th>
                    <th class="hidden-xs">排序</th>
                    <th>图片</th>
                    <th class="hidden-xs">推荐</th>
                    <th>状态</th>
                </thead>
                <tbody id="products-tbody">
                    @foreach($categories as $category)
                        <tr data-weblink="{{ route('front.mobile.catlevel'.$category->level,$category->id) }}" data-minilink="../category/categoty?level={{ $category->level }}&cat_id={{ $category->id }}">
                            <td>@for ($i = 1; $i < $category->level; $i++) &nbsp;&nbsp;&nbsp;&nbsp; @endfor {!! $category->name !!}</td>
                            <td class="hidden-xs">{!! $category->slug !!}</td>
                            <td class="hidden-xs">{!! $category->sort !!}</td>
                            <td> <img src="{!! $category->image !!}" style="max-width: 100%; max-height: 25px;"> </td>
                            <td class="hidden-xs"> @if($category->recommend == 1) <span class="label label-success">是</span> @else 否 @endif</td>
                            <td>  <span class="btn btn-{!! $category->status=='上线'?'success':'danger' !!} btn-xs" >{!! $category->status !!}</span></td>
            
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="pull-left" style="margin-top:15px;">
            <input type="button" class="btn btn-primary"  value="确定" id="product_enter"></div>
    </div>

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
               layer.alert('请选择分类', {icon: 2}); 
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