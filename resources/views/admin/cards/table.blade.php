<table class="table table-responsive" id="cards-table">
    <thead>
        <tr>
        <th>{{ getSettingValueByKeyCache('credits_alias') }}卡号</th>
        <th>密码</th>
        <th>{{ getSettingValueByKeyCache('credits_alias') }}面额</th>
        <th>使用状态</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($cards as $card)
        <tr>
            <td>{!! $card->number !!}</td>
            <td>{!! $card->password !!}</td>
            <td>{!! $card->num !!}</td>
            <td>{!! $card->status ? '已使用' : '未使用'!!}</td>
            <td>
                {!! Form::open(['route' => ['cards.destroy', $card->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
         {{--            <a href="{!! route('cards.show', [$card->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> --}}
                    <a href="{!! route('cards.edit', [$card->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>