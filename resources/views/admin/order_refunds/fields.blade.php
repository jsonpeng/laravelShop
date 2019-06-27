<form id="refundForm">
<!-- The time line -->
<ul class="timeline">
    <!-- timeline time label -->
    <li class="time-label">
        <span class="bg-red">
            {{ $orderRefund->created_at }}
        </span>
    </li>
    <!-- /.timeline-label -->
    <!-- timeline item -->
    <li>
        <i class="fa fa-user bg-blue"></i>
        <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> {{ $orderRefund->created_at }} </span>
            <h3 class="timeline-header">用户提交申请</h3>
            <div class="timeline-body row">
                <!-- Item Id Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('item_id', '商品信息:') !!}
                    <div>{{ $orderRefund->item->pic }}</div>
                    <div>{{ $orderRefund->item->name }} {{ $orderRefund->item->key_name }}</div>
                </div>

                <!-- Order Id Field -->
                <div class="form-group col-sm-4">
                    {!! Form::label('order_id', '订单编号') !!}
                    <div>{{ $orderRefund->order->snumber }}</div>
                </div>

                <!-- User Id Field -->
                <div class="form-group col-sm-4">
                    {!! Form::label('user_id', '用户:') !!}
                    <div>{{ $orderRefund->user->nickname }}</div>
                </div>

                <!-- Type Field -->
                <div class="form-group col-sm-4">
                    {!! Form::label('type', '售后类型:') !!}
                    @if($orderRefund->type == 0)
                        <div>退款</div>
                    @elseif($orderRefund->type == 1)
                        <div>退款退货</div>
                    @else
                        <div>换货</div>
                    @endif
                </div>

                <!-- Is Receive Field -->
                <div class="form-group col-sm-4">
                    {!! Form::label('is_receive', '买家是否已收到货:') !!}
                    @if($orderRefund->is_receive == 0)
                    <div>未收到货</div>
                    @else
                    <div>已收到货</div>
                    @endif
                </div>

                <div class="form-group col-sm-4">
                    {!! Form::label('is_receive', '申请时间:') !!}
                    <div>{{ $orderRefund->created_at }}</div>
                </div>

                <!-- Reason Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('reason', '申请售后原因:') !!}
                    <div>{{ $orderRefund->reason }}</div>
                </div>

                <!-- Describe Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('describe', '问题描述:') !!}
                    <div>{{ $orderRefund->describe }}</div>
                </div>

                <div class="form-group col-sm-12">
                    {!! Form::label('remark', '审核备注:') !!}
                    <div>{{ $orderRefund->remark }}</div>
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
                    <!-- Refund Money Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('refund_money', '退款金额:') !!}
                        {!! Form::text('refund_money', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Refund Deposit Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('refund_deposit', '退还余额:') !!}
                        {!! Form::text('refund_deposit', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Refund Credit Field -->
                    <div class="form-group col-sm-4">
                        {!! Form::label('refund_credit', '退还'.getSettingValueByKeyCache('credits_alias').':') !!}
                        {!! Form::number('refund_credit', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Remark Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::label('remark', '审核备注:') !!}
                        {!! Form::textarea('remark', null, ['class' => 'form-control', 'rows' => 5]) !!}
                    </div>

                    <div class="form-group col-sm-12">
                        <a class="btn btn-primary btn-xs" onclick="authOK()">审核通过</a>
                        <a class="btn btn-danger btn-xs" onclick="authFail()">审核不通过</a>
                    </div>
                @endif


                @if ($orderRefund->status == 1)
                    
                    <!-- 仅退款 -->
                    @if($orderRefund->type == 0)
                        <!-- Refund Money Field -->
                        <div class="form-group col-sm-4">
                            {!! Form::label('refund_money', '退款金额:') !!}
                            {!! Form::text('refund_money', null, ['class' => 'form-control']) !!}
                        </div>

                        <!-- Refund Deposit Field -->
                        <div class="form-group col-sm-4">
                            {!! Form::label('refund_deposit', '退还余额:') !!}
                            {!! Form::text('refund_deposit', null, ['class' => 'form-control']) !!}
                        </div>

                        <!-- Refund Credit Field -->
                        <div class="form-group col-sm-4">
                            {!! Form::label('refund_credit', '退还'.getSettingValueByKeyCache('credits_alias').':') !!}
                            {!! Form::number('refund_credit', null, ['class' => 'form-control']) !!}
                        </div>

                        <!-- Remark Field -->
                        <div class="form-group col-sm-12">
                            {!! Form::label('remark', '审核备注:') !!}
                            {!! Form::textarea('remark', null, ['class' => 'form-control', 'rows' => 5]) !!}
                        </div>
                        <div class="form-group col-sm-12">
                            {!! Form::label('remark', '退款操作:') !!}
                            <div>原路返还</div>
                            <div>返还到余额</div>
                        </div>
                    @elseif($orderRefund->type == 1)
                        <!-- 需要寄回货物 -->
                        @if ($orderRefund->return_status == 0)
                            <!-- 买家未发货 -->
                            <div class="form-group col-sm-12">
                                {!! Form::label('remark', '当前状态:') !!}
                                <div>等待买家发货</div>
                            </div>
                        @elseif ($orderRefund->return_status == 1)
                            <!-- 买家已发货 -->
                            <div class="form-group col-sm-12">
                                <div>买家已发货</div>
                                <div>物流公司: {{ $orderRefund->return_delivery_company }}</div>
                                <div>物流单号: {{ $orderRefund->return_delivery_no }}</div>
                                <div>快递费用: {{ $orderRefund->return_delivery_money }}</div>
                                <div class="btn btn-primary">确认收货</div>
                            </div>
                        @elseif ($orderRefund->return_status == 2)
                            <!-- 退钱 -->
                            <!-- Refund Money Field -->
                            <div class="form-group col-sm-4">
                                {!! Form::label('refund_money', '退款金额:') !!}
                                {!! Form::text('refund_money', null, ['class' => 'form-control']) !!}
                            </div>

                            <!-- Refund Deposit Field -->
                            <div class="form-group col-sm-4">
                                {!! Form::label('refund_deposit', '退还余额:') !!}
                                {!! Form::text('refund_deposit', null, ['class' => 'form-control']) !!}
                            </div>

                            <!-- Refund Credit Field -->
                            <div class="form-group col-sm-4">
                                {!! Form::label('refund_credit', '退还'.getSettingValueByKeyCache('credits_alias').':') !!}
                                {!! Form::number('refund_credit', null, ['class' => 'form-control']) !!}
                            </div>

                            <!-- Remark Field -->
                            <div class="form-group col-sm-12">
                                {!! Form::label('remark', '审核备注:') !!}
                                {!! Form::textarea('remark', null, ['class' => 'form-control', 'rows' => 5]) !!}
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('remark', '退款操作:') !!}
                                <div>原路返还</div>
                                <div>返还到余额</div>
                            </div>
                        @endif
                    @else
                        <!-- 需要寄回货物 -->
                        @if ($orderRefund->return_status == 0)
                            <!-- 买家未发货 -->
                            <div class="form-group col-sm-12">
                                {!! Form::label('remark', '当前状态:') !!}
                                <div>等待买家发货</div>
                            </div>
                        @elseif ($orderRefund->return_status == 1)
                            <!-- 买家已发货 -->
                            <div class="form-group col-sm-12">
                                <div>买家已发货</div>
                                <div>物流公司: {{ $orderRefund->return_delivery_company }}</div>
                                <div>物流单号: {{ $orderRefund->return_delivery_no }}</div>
                                <div>快递费用: {{ $orderRefund->return_delivery_money }}</div>
                                <div class="btn btn-primary">确认收货</div>
                            </div>
                        @else
                            <!-- 卖家已收货 -->
                            <!-- Seller Delivery Company Field -->
                            <div class="form-group col-sm-12">
                                {!! Form::label('seller_delivery_company', '卖家重新发货物流公司:') !!}
                                {!! Form::text('seller_delivery_company', null, ['class' => 'form-control']) !!}
                            </div>

                            <!-- Seller Delivery No Field -->
                            <div class="form-group col-sm-12">
                                {!! Form::label('seller_delivery_no', '卖家重新发货物流单号:') !!}
                                {!! Form::text('seller_delivery_no', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-sm-12">
                                <div class="btn btn-primary">确认发货</div>
                            </div>
                        @endif
                    @endif
                @endif

                <!-- 此条件只有换货流程有-->
                @if ($orderRefund->status == 2)
                    <div class="form-group col-sm-12">
                        <div>卖家已发货</div>
                        <div>物流公司: {{ $orderRefund->seller_delivery_company }}</div>
                        <div>物流单号: {{ $orderRefund->seller_delivery_no }}</div>
                        <div class="btn btn-primary">确认服务已完成</div>
                    </div>
                @endif

                @if ($orderRefund->status == 3)
                    <div class="form-group col-sm-12">
                        <div>订单已处理完成</div>
                    </div>
                @endif
            </div>
        </div>
    </li>
    <!-- END timeline item -->

    <!-- timeline item -->
    <li>
        <i class="fa fa-comments bg-yellow"></i>
        <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>
            <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
            <div class="timeline-body">
                Take me to your leader!
                Switzerland is small and neutral!
                We are more like Germany, ambitious and misunderstood!
            </div>
            <div class="timeline-footer">
                <a class="btn btn-warning btn-flat btn-xs">View comment</a>
            </div>
        </div>
    </li>
    <!-- END timeline item -->
    
</ul>
</form>