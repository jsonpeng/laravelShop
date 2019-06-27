<?php $products = products(0,100000);?>
<div class="form-group col-sm-12">
    {!! Form::label('product_id', '评论商品:') !!}
    <select name="product_id" class="form-control">
        @foreach($products as $product)
            <option value="{!! $product->id !!}" @if(isset($productEval) && $productEval->product_id==$product->id) selected="selected" @endif>{!! $product->name !!}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-12">
    <label for="content">评论内容<span class="bitian">(必填):</span></label>
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('all_level', '总体评价:') !!}
    <select name="all_level" class="form-control">
        <option value="1" @if(isset($productEval) && $productEval->all_level=='1') selected="selected" @endif>1</option>
        <option value="2" @if(isset($productEval) && $productEval->all_level=='2') selected="selected" @endif>2</option>
        <option value="3" @if(isset($productEval) && $productEval->all_level=='3') selected="selected" @endif>3</option>
        <option value="4" @if(isset($productEval) && $productEval->all_level=='4') selected="selected" @endif>4</option>
        <option value="5" @if(isset($productEval) && $productEval->all_level=='5') selected="selected" @endif>5</option>
    </select>
</div>

<div class="form-group col-sm-12">
    <label for="zan">点赞数</label>
    {!! Form::number('zan', null, ['class' => 'form-control']) !!}
</div>

@if(isset($productEval))
    {!! Form::hidden('user_id', null, ['class' => 'form-control']) !!}
@else
    {!! Form::hidden('user_id', 1, ['class' => 'form-control']) !!}
    {!! Form::hidden('service_level', 1, ['class' => 'form-control']) !!}
    {!! Form::hidden('logistics_level', 1, ['class' => 'form-control']) !!}
    {!! Form::hidden('overall_level', 1, ['class' => 'form-control']) !!}
@endif

{{-- <div class="form-group col-sm-12">
    <label for="attach">更多:</label>
    
</div> --}}
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('productEvals.index') !!}" class="btn btn-default">取消</a>
</div>
