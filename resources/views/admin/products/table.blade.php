<table class="table table-responsive" id="products-table">
    <thead>
        <th>ID</th>
        <th>名称</th>
        <th class="hidden-sm hidden-xs">编号</th>
        <th>分类</th>
        <th>价格</th>
        <th class="hidden-xs">热销</th>
        <th class="hidden-sm hidden-xs">新品</th>
        <th class="hidden-xs">上架</th>
        <th class="hidden-xs">规格</th>
        <th class="hidden-xs">库存</th>
        <th class="hidden-xs">促销</th>
        <th class="hidden-sm hidden-xs">排序</th>
        <th width="120" class="hidden-sm">操作</th>
        <th class="visible-sm">操作</th>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{!! $product->id !!}</td>
            <td>{!! $product->name !!}</td>
            <td class="hidden-sm hidden-xs">{!! $product->sn !!}</td>
            <td>{!! $product->Cat !!}</td>
            <td>{!! $product->price !!}</td>
            <td class="hidden-xs">@if($product->hot == '是') <span class="label label-success">是</span> @else 否 @endif</td>
            <td class="hidden-sm hidden-xs">@if($product->new == '是') <span class="label label-success">是</span> @else 否 @endif</td>
            <td class="hidden-xs">@if($product->isShelf == '是') 是 @else <span class="label label-warning">否</span>  @endif</td>
            <td class="hidden-xs">--</td>
            <td class="hidden-xs">
                @if($product->inventory<=$inventory_warn && $product->inventory != -1)<small class="label label-danger">警</small>@endif
                @if($product->inventory == -1) 无限供应 @else {!! $product->inventory !!} @endif
            </td>
            <td class="hidden-xs">{!! varifyCuXiao($product->prom_type) !!}</td>
            <td class="hidden-sm hidden-xs">{!! $product->sort !!}</td>
            <td>
                {!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <!--a href="{!! route('front.mobile.product', [$product->id]) !!}" class='btn btn-default btn-xs' target="_blank"><i class="glyphicon glyphicon-eye-open"></i></a-->
                    <a href="{!! route('products.edit', [$product->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确认删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
      <?php $items=$product->specs;?>
        @if(count($items)>0)
          <!--有商品规格的商品-->
            @foreach($items as $item)
            <?php $product_item=$item->product()->first();?>
            <tr>
                <td></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;{!! $product_item->name.' '.$item->key_name !!}</td>
                <td class="hidden-sm hidden-xs">{!! $product_item->sn !!}</td>
                <td>{!! $product_item->Cat !!}</td>
                <td>{!! $item->price !!}</td>
                <td class="hidden-xs">@if($product_item->isRecommend == '是') <span class="label label-success">是</span> @else 否 @endif</td>
                <td class="hidden-sm hidden-xs">@if($product_item->new == '是') <span class="label label-success">是</span> @else 否 @endif</td>
                <td class="hidden-xs">@if($product_item->isShelf == '是') 是 @else <span class="label label-warning">否</span>  @endif</td>
                <td class="hidden-xs">{!! $item->key_name !!}</td>
                <td class="hidden-xs">
                    @if($item->inventory<=$inventory_warn && $item->inventory != -1)<small class="label label-danger">警</small>@endif
                    @if($item->inventory == -1) 无限供应 @else {!! $item->inventory !!} @endif
                </td>
                <td class="hidden-xs">{!! varifyCuXiao($item->prom_type) !!}</td>
                <td class="hidden-sm hidden-xs">{!! $product_item->sort !!}</td>
                {{-- <td>
                      {!! Form::open(['route' => ['products.destroy', $product_item->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('front.mobile.product', [$product_item->id]) !!}" class='btn btn-default btn-xs' target="_blank"><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('products.edit', [$product_item->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                         {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('将会删除规格相关的所有产品,确定要删除吗?')"]) !!}
                    </div>
                       {!! Form::close() !!}
                </td> --}}
            </tr>
            @endforeach
       @endif
    @endforeach
    </tbody>
</table>


