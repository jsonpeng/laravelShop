<table class="table table-responsive" id="groupSales-table">
    <thead>
        <tr>
            <th>活动名称</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>价格</th>
            <th>最大销售数量</th>
            <th>已购数量</th>
            <th>订单数量</th>
            <th>商品名称</th>
            <th>推荐</th>
            <th>浏览量</th>
            <th>结束</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($groupSales as $groupSale)
        <tr>
            <td>{!! $groupSale->name !!}</td>
            <td>{!! $groupSale->time_begin !!}</td>
            <td>{!! $groupSale->time_end !!}</td>
            <td>{!! $groupSale->price !!}</td>
            <td>{!! $groupSale->product_max !!}</td>
            <td>{!! $groupSale->buy_num !!}</td>
            <td>{!! $groupSale->order_num !!}</td>
            <td>{!! $groupSale->product_name !!}</td>
            <td>{!! $groupSale->recommend !!}</td>
            <td>{!! $groupSale->view !!}</td>
            <td>{!! $groupSale->is_end !!}</td>
            <td>
                {!! Form::open(['route' => ['groupSales.destroy', $groupSale->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('groupSales.show', [$groupSale->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('groupSales.edit', [$groupSale->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>