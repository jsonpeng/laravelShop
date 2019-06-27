<table class="table table-responsive" id="customerServices-table">
    <thead>
        <tr>
        <th>名称</th>
        <th>客服平台</th>
        <th>职位</th>
        <th>联系方式</th>
        <th>是否显示</th>
        <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($customerServices as $customerService)
        <tr>
            <td>{!! $customerService->name !!}</td>
            <td>{!! $customerService->Platforms !!}</td>
            <td>{!! $customerService->Jobs !!}</td>
            <td>{!! $customerService->commit !!}</td>
            <td>{!! $customerService->WhetherShow !!}</td>
            <td>
                {!! Form::open(['route' => ['customerServices.destroy', $customerService->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                 {{--    <a href="{!! route('customerServices.show', [$customerService->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> --}}
                    <a href="{!! route('customerServices.edit', [$customerService->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>