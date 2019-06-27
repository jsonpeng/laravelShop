<table class="table table-responsive" id="stores-table">
    <thead>
        <tr>
        <th>店铺名称</th>
        <th>店铺图片</th>
        <th>排序</th>
        <th>店铺地址</th>
        <th>店铺联系电话</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($stores as $store)
        <tr>
            <td>{!! $store->name !!}</td>
            <td><img src="{!! $store->image !!}"  style="max-width: 100px;height: auto;" /></td>
            <td>{!! $store->sort !!}</td>
            <td>{!! $store->address !!}</td>
            <td>{!! $store->mobile !!}</td>
            <td>
                {!! Form::open(['route' => ['stores.destroy', $store->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                <!--     <a href="{!! route('stores.show', [$store->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> -->
                    <a href="{!! route('stores.edit', [$store->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>