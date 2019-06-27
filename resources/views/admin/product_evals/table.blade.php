<table class="table table-responsive" id="categories-table">
    <thead>
        <th>评论商品</th>
        <th class="hidden-xs">评论内容</th>
        <th>总体评价(12345五个等级)</th>
        <th>评论人</th>
        <th colspan="3" class="hidden-xs">操作</th>
        <th class="visible-xs">操作</th>
    </thead>
    <tbody>
    @foreach($productEvals as $eval)
        <tr>
            <td> {!! $eval->productName !!}</td>
            <td class="hidden-xs">{!! $eval->content !!}</td>
            <td>{!! $eval->all_level !!}</td>
            <td>{!! $eval->userName !!}</td>
            <td>
                {!! Form::open(['route' => ['productEvals.destroy', $eval->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                  {{--   <a href="{!! route('productEvals.edit', [$eval->id]) !!}" class='btn btn-default btn-xs' title="编辑"><i class="glyphicon glyphicon-edit"></i></a> --}}
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'title' => '删除', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确认要删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>