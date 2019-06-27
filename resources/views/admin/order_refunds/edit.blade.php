@extends('admin.layouts.app_shop')

@section('css')
  <style type="text/css">
    .status_des{
      color: #3c8dbc;
      font-weight: bold;
    }
    tr:nth-child(odd){
        background-color: #eee;
    }
    label{font-weight: normal; color: #999;}
    a{cursor: pointer;}
  </style>
@endsection

@section('content')
    <section class="content-header">
        <h1>
            售后申请
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary form">
           <div class="box-body">
               <div class="row">
                   <form id="refundForm">
                    <!-- The time line -->
                    <ul class="timeline">
                        <!-- timeline time label -->
                        <li class="time-label">
                            <span class="bg-red">
                                @if($orderRefund->type == 0)
                                    退款
                                @elseif($orderRefund->type == 1)
                                    退款退货
                                @else
                                    换货
                                @endif
                            </span>
                        </li>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <li>
                            <i class="fa fa-user bg-red"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> {{ $orderRefund->created_at }} </span>
                                <h3 class="timeline-header">用户提交申请</h3>
                                <div class="timeline-body row">
                                    <!-- Item Id Field -->
                                    <div class="form-group col-sm-12">
                                        {!! Form::label('item_id', '商品信息:') !!}
                                        <div>{{ $orderRefund->item->pic }}</div>
                                        <a href="/zcjy/products/{{ $orderRefund->item->product_id }}/edit" target="_blank">{{ $orderRefund->item->name }} {{ $orderRefund->item->key_name }}</a>
                                    </div>
                                    
                                    <div class="form-group col-sm-12" style="margin: 0 -8px;">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td><label>订单编号</label></td>
                                                <td> <a href="/zcjy/orders/{{ $orderRefund->order_id }}" target="_blank">{{ $orderRefund->order->snumber }}</a> </td>
                                            </tr>
                                            <tr>
                                                <td><label>用户</label></td>
                                                <td>{{ $orderRefund->user->nickname }}</td>
                                            </tr>
                                            <tr>
                                                <td><label>售后类型</label></td>
                                                <td>@if($orderRefund->type == 0)
                                                        <div>退款</div>
                                                    @elseif($orderRefund->type == 1)
                                                        <div>退款退货</div>
                                                    @else
                                                        <div>换货</div>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>买家是否已收到货</label></td>
                                                <td>
                                                    @if($orderRefund->is_receive == 0)
                                                    <div>未收到货</div>
                                                    @else
                                                    <div>已收到货</div>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>申请时间</label></td>
                                                <td>
                                                    {{ $orderRefund->created_at }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>

                                    <!-- Reason Field -->
                                    <div class="form-group col-sm-12">
                                        {!! Form::label('reason', '申请售后原因:') !!}
                                        <div style="border: 1px solid #ddd; padding: 10px;">{{ $orderRefund->reason }}</div>
                                    </div>

                                    <!-- Describe Field -->
                                    <div class="form-group col-sm-12">
                                        {!! Form::label('describe', '问题描述:') !!}
                                        <div style="border: 1px solid #ddd; padding: 10px;">{{ $orderRefund->describe }}</div>
                                    </div>

                                    <!-- Refund Money Field -->
                                    <div class="form-group col-sm-3">
                                        {!! Form::label('refund_money', '退款金额:') !!}
                                        {!! Form::text('refund_money', $orderRefund->refund_money, ['class' => 'form-control']) !!}
                                    </div>

                                    <!-- Refund Deposit Field -->
                                    <div class="form-group col-sm-3">
                                        {!! Form::label('refund_deposit', '退还余额:') !!}
                                        {!! Form::text('refund_deposit', $orderRefund->refund_deposit, ['class' => 'form-control']) !!}
                                    </div>

                                    <!-- Refund Credit Field -->
                                    <div class="form-group col-sm-3">
                                        {!! Form::label('refund_credit', '退还'.getSettingValueByKeyCache('credits_alias').':') !!}
                                        {!! Form::number('refund_credit', $orderRefund->refund_credit, ['class' => 'form-control']) !!}
                                    </div>
                                    
                                    <!--
                                    <div class="form-group col-sm-3">
                                        {!! Form::label('refund_type', '退还路径:') !!}
                                        {!! Form::select('refund_type', [0 => '原路返回', 1 => '退款到余额'] , $orderRefund->refund_type, ['class' => 'form-control']) !!}
                                    </div>
                                    -->
                                    
                                    <!-- Remark Field -->
                                    <div class="form-group col-sm-12">
                                        {!! Form::label('remark', '审核备注:') !!}
                                        {!! Form::textarea('remark', $orderRefund->remark, ['class' => 'form-control', 'rows' => 5]) !!}
                                    </div>
                                </div>
                                <div class="timeline-footer row">

                                    @if ($orderRefund->status == -2)
                                        <div class="status_des">用户已取消</div>
                                    @endif

                                    @if ($orderRefund->status == -1)
                                        <div class="status_des">审核不通过</div>
                                    @endif

                                    @if ($orderRefund->status == 0)

                                        <div class="form-group col-sm-12">
                                            <a class="btn btn-primary btn-xs" onclick="authOK()">审核通过</a>
                                            <a class="btn btn-danger btn-xs" onclick="authFail()">审核不通过</a>
                                        </div>
                                    @endif


                                    @if ($orderRefund->status == 1)
                                        
                                        <!-- 仅退款 -->
                                        @if($orderRefund->type == 0)
                                            <div class="form-group col-sm-12">
                                                {!! Form::label('opration', '退款操作:') !!}
                                                <a class="btn btn-primary btn-xs" onclick="confirmRefundMoney()">确认退款</a>
                                            </div>
                                        @elseif($orderRefund->type == 1)
                                            <!-- 需要寄回货物 -->
                                            @if ($orderRefund->return_status == 0)
                                                <!-- 买家未发货 -->
                                                <div class="form-group col-sm-12">
                                                    {!! Form::label('remark', '当前状态:') !!}
                                                    <div class="status_des">等待买家发货</div>
                                                </div>
                                            @elseif ($orderRefund->return_status == 1)
                                                <!-- 买家已发货 -->
                                                <div class="form-group col-sm-12">
                                                    <div>买家已发货</div>
                                                    <div>物流公司: {{ $orderRefund->return_delivery_company }}</div>
                                                    <div>物流单号: {{ $orderRefund->return_delivery_no }}</div>
                                                    <div>快递费用: {{ $orderRefund->return_delivery_money }}</div>
                                                    <div class="btn btn-primary" onclick="confirmDelivery()">确认收货</div>
                                                </div>
                                            @elseif ($orderRefund->return_status == 2)
                                                <!-- 退钱 -->
                                                <div class="form-group col-sm-12">
                                                    {!! Form::label('remark', '退款操作:') !!}
                                                    <a class="btn btn-primary btn-xs" onclick="confirmRefundMoney()">确认退款</a>
                                                </div>
                                            @endif
                                        @else
                                            <!-- 需要寄回货物 -->
                                            @if ($orderRefund->return_status == 0)
                                                <!-- 买家未发货 -->
                                                <div class="form-group col-sm-12">
                                                    {!! Form::label('remark', '当前状态:') !!}
                                                    <div class="status_des">等待买家发货</div>
                                                </div>
                                            @elseif ($orderRefund->return_status == 1)
                                                <!-- 买家已发货 -->
                                                <div class="form-group col-sm-12">
                                                    <div class="status_des">买家已发货</div>
                                                    <div>物流公司: {{ $orderRefund->return_delivery_company }}</div>
                                                    <div>物流单号: {{ $orderRefund->return_delivery_no }}</div>
                                                    <div>快递费用: {{ $orderRefund->return_delivery_money }}</div>
                                                    <div class="btn btn-primary" onclick="confirmDelivery()">确认收货</div>
                                                </div>
                                            @else
                                                <!-- 卖家已收货 -->
                                                <!-- Seller Delivery Company Field -->
                                                <div class="form-group col-sm-12">
                                                    {!! Form::label('seller_delivery_company', '卖家重新发货物流公司:') !!}
                                                    {!! Form::text('seller_delivery_company', $orderRefund->seller_delivery_company, ['class' => 'form-control']) !!}
                                                </div>

                                                <!-- Seller Delivery No Field -->
                                                <div class="form-group col-sm-12">
                                                    {!! Form::label('seller_delivery_no', '卖家重新发货物流单号:') !!}
                                                    {!! Form::text('seller_delivery_no', $orderRefund->seller_delivery_no, ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <div class="btn btn-primary" onclick="confirmDeliverySeller()">确认发货</div>
                                                </div>
                                            @endif
                                        @endif
                                    @endif

                                    <!-- 此条件只有换货流程有-->
                                    @if ($orderRefund->status == 2)
                                        <div class="form-group col-sm-12">
                                            <div class="status_des">卖家已发货</div>
                                            <div>物流公司: {{ $orderRefund->seller_delivery_company }}</div>
                                            <div>物流单号: {{ $orderRefund->seller_delivery_no }}</div>
                                            <div class="btn btn-primary" onclick="finish()">确认服务已完成</div>
                                        </div>
                                    @endif

                                    @if ($orderRefund->status == 3)
                                        <div class="form-group col-sm-12">
                                          @if($orderRefund->seller_delivery_company)
                                            <div>物流公司: {{ $orderRefund->seller_delivery_company }}</div>
                                            <div>物流单号: {{ $orderRefund->seller_delivery_no }}</div>
                                          @endif
                                            <div class="status_des">订单已处理完成</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        
                        @foreach ($refundLogs as $refundLog)
                          <!-- timeline item -->
                          <li>
                              <i class="fa fa-comments bg-blue"></i>
                              <div class="timeline-item">
                                  <span class="time"><i class="fa fa-clock-o"></i> {{ $refundLog->time }}</span>
                                  <h3 class="timeline-header"><a href="#">{{ $refundLog->name }}</a> {{ $refundLog->des }}</h3>
                              </div>
                          </li>
                          <!-- END timeline item -->
                        @endforeach
                        
                        
                    </ul>
                    </form>
               </div>
           </div>
       </div>
   </div>
@endsection



@section('scripts')
  <script type="text/javascript">

    function authOK() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
        url:"/zcjy/refunds/{{ $orderRefund->id }}/update?status=1&message=审核通过",
        type:"GET",
        data:$('#refundForm').serialize(),
        success:function(data){
            if(data.code==0){
               location.reload();
            }else{
              alert(data.message);
            }

        }
      });
    }

    function confirmRefundMoney() {
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
        url:"/zcjy/refunds/{{ $orderRefund->id }}/update?status=3&message=商家执行退款操作，完成售后服务",
        type:"GET",
        data:$('#refundForm').serialize(),
        success:function(data){
            if(data.code==0){
               location.reload();
            }else{
              alert(data.message);
            }

        }
      });
    }

    function authFail() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
        url:"/zcjy/refunds/{{ $orderRefund->id }}/update?status=-1&message=审核不通过",
        type:"GET",
        data:$('#refundForm').serialize(),
        success:function(data){
            if(data.code==0){
               location.reload();
            }else{
              alert(data.message);
            }

        }
      });
    }

    /**
     * 商家确认收货
     * @return {[type]} [description]
     */
    function confirmDelivery() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
        url:"/zcjy/refunds/{{ $orderRefund->id }}/update?return_status=2&message=商家确认收货",
        type:"GET",
        data:$('#refundForm').serialize(),
        success:function(data){
            if(data.code==0){
               location.reload();
            }else{
              alert(data.message);
            }

        }
      });
    }

    /**
     * 商家确认重新发出货物
     * @return {[type]} [description]
     */
    function confirmDeliverySeller() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
        url:"/zcjy/refunds/{{ $orderRefund->id }}/update?status=2&message=商家重新寄出货物",
        type:"GET",
        data:$('#refundForm').serialize(),
        success:function(data){
            if(data.code==0){
               location.reload();
            }else{
              alert(data.message);
            }
        }
      });
    }

    /**
     * 换货流程
     * @return {[type]} [description]
     */
    function finish() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
        url:"/zcjy/refunds/{{ $orderRefund->id }}/update?status=3&message=商家关闭售后订单，完成售后服务",
        type:"GET",
        data:$('#refundForm').serialize(),
        success:function(data){
            if(data.code==0){
               location.reload();
            }else{
              alert(data.message);
            }
        }
      });
    }
  </script>
@endsection