<!-- Name Field -->
<div class="form-group col-sm-12">
    <label for="name">名称<span class="bitian">(必填):</span></label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>



<!-- email Field -->
<div class="form-group col-sm-12">
    {!! Form::label('email', '邮箱(登录用户名):') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- password Field -->

<div class="form-group col-sm-12">
    {!! Form::label('password', '密码:') !!}
    @if(isset($manager) && !empty($manager))
    {!! Form::text('password', '', ['class' => 'form-control','id'=>'password']) !!}
    @else
    {!! Form::text('password', null, ['class' => 'form-control','id'=>'password']) !!}
    @endif
</div>


<!-- sex Field -->
<input type="hidden" name="type" value="管理员">
<!-- type Field
 {{--    {!! Form::label('type', '管理员类型:') !!}
    {!! Form::select('type', ['管理员' => '管理员'], null , ['class' => 'form-control']) !!} --}}
</div>
 -->

<div class="form-group col-sm-12">
{!! Form::label('roles', '用户角色:') !!}</div>
<div class="form-group">
    <!-- permissions Id Field -->
    @foreach ($roles as $role)
        <div class="form-group col-sm-3">
            <label>
                {!! Form::checkbox('roles[]', $role->id, in_array($role->id, $selectedRoles), ['class' => 'field minimal']) !!}
                {!! $role->name !!}
            </label></br>
        </div>
    @endforeach
</div>


@if(funcOpen('FUNC_MANY_SHOP') && count($shops))
<div class="form-group col-sm-12">
{!! Form::label('shop_id', '管理店铺:') !!}</div>
<div class="form-group">
    <!-- permissions Id Field -->
    @foreach ($shops as $shop)
        <div class="form-group col-sm-3">
            <label>
                {!! Form::checkbox('shop_id[]', $shop->id, in_array($shop->id, $selectedShop), ['class' => 'selectShops']) !!}
                {!! $shop->name !!}
            </label></br>
        </div>
    @endforeach
</div>
@endif
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('managers.index') !!}" class="btn btn-default">取消</a>
</div>
