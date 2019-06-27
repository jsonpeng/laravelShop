<table class="table table-responsive" id="specs-table">
    <thead>
        <tr>
            <th>规格名称</th>
            <th>规格选项</th>
            <th class="hidden-xs">排序</th>
            <th class="hidden-xs">商品模型</th>
            <th colspan="3" class="hidden-xs">操作</th>
            <th class="visible-xs">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($specs as $spec)
        <tr>
            <td>{!! $spec->name !!}</td>
            <td>{!! $spec->selectItems !!}</td>
            <td class="hidden-xs">{!! $spec->sort !!}</td>
            <td class="hidden-xs">{!! $spec->type->name !!}</td>
            <td>
                {!! Form::open(['route' => ['specs.destroy', $spec->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
               {{--      <a href="{!! route('specs.show', [$spec->id]) !!}" class='btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> --}}
                    <a href="{!! route('specs.edit', [$spec->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确认删除?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>