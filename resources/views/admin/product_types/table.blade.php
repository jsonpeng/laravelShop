<table class="table table-responsive" id="productTypes-table">
    <thead>
        <tr>
            <th>名称</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productTypes as $productType)
        <tr>
            <td>{!! $productType->name !!}</td>
            <td>
                {!! Form::open(['route' => ['productTypes.destroy', $productType->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('productTypes.edit', [$productType->
                        id]) !!}" class='btn btn-default btn-xs'> <i class="glyphicon glyphicon-edit"></i>
                    </a>
                    {!! Form::button(' <i class="glyphicon glyphicon-trash"></i>
                    ', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确认删除?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>