<table class="table table-responsive" id="productAttrs-table">
    <thead>
        <tr>
            <th>属性名称</th>
            <th>所属模型</th>
            <th class="hidden-xs">是否检索</th>
            <th class="hidden-xs">输入类型</th>
            <th class="hidden-xs">取值范围</th>
            <th class="hidden-xs">排序</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($productAttrs as $productAttr)
        <tr>
            <td>{!! $productAttr->name !!}</td>
            <td>{!! $productAttr->type->name !!}</td>
            <td class="hidden-xs">{!! $productAttr->isIndex !!}</td>
            <td class="hidden-xs">
                @if($productAttr->input_type == 0)
                    手动输入
                @elseif($productAttr->input_type == 1)
                    列表选择
                @else
                    手动多行输入
                @endif
            </td>
            <td class="hidden-xs">{!! $productAttr->values !!}</td>
            <td class="hidden-xs">{!! $productAttr->sort !!}</td>
            <td>
                {!! Form::open(['route' => ['productAttrs.destroy', $productAttr->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
             {{--        <a href="{!! route('productAttrs.show', [$productAttr->id]) !!}" class='btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> --}}
                    <a href="{!! route('productAttrs.edit', [$productAttr->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确认删除?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>