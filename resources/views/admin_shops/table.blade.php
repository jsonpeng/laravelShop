<table class="table table-responsive" id="adminShops-table">
    <thead>
        <tr>
            <th>Admin Id</th>
        <th>Shop Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($adminShops as $adminShop)
        <tr>
            <td>{!! $adminShop->admin_id !!}</td>
            <td>{!! $adminShop->shop_id !!}</td>
            <td>
                {!! Form::open(['route' => ['adminShops.destroy', $adminShop->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('adminShops.show', [$adminShop->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('adminShops.edit', [$adminShop->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>