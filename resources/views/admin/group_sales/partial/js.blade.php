<script type="text/javascript">

    $(document).ready(function() {

        $('#datetimepicker_end').datetimepicker({
            format: "yyyy-mm-dd hh:ii",
            language: "zh-CN",
            todayHighlight: true
        });

        $('#datetimepicker_begin').datetimepicker({
            format: "yyyy-mm-dd hh:ii",
            language: "zh-CN",
            todayHighlight: true
        });

    });

       function call_back(table_html){
        var _isInvalid = false;
        //加入已经选中的table
        $('#product_items_table').html(table_html);
        layer.closeAll('iframe');
        var product_name="";
        var html="";
        var i = 0;
        var product_spec;
        var prom;

        //从已经选中的中找出选中的并且遍历
        $('#product_items_table').find('.trSelected').each(function() {
            var spec_id = $(this).data("specid");
            var productname = $(this).data("productname");
            var price = $(this).data("price");
            var keyname = $(this).data("keyname");
            var productid = $(this).data("productid");
            var productimg=$(this).data("productimg");
            var inventory=$(this).data("inventory");
             prom=$(this).data("prom");
    
            //等于0代表没有规格信息
            if (spec_id != 0) {
              product_name =productname+" "+keyname;
            } else {
              product_name =productname;    
            }
            product_spec=productid+"_"+spec_id;
            html +='<div style="float: left;margin: 10px auto;" class="selected-group-goods"><div class="goods-thumb"><img style="width: 162px;height: 162px" src="'+productimg+'"></div> <div class="goods-name"> <a target="_blank" href="">'+product_name+'</a> </div> <div class="goods-price">商城价：￥'+price+'库存:'+inventory+'</div></div>';
         
        });

         if(prom){
                layer.confirm('该商品已经参加过其他活动，确定保存后将替换该活动？', {
                btn: ['确定','取消'] //按钮
                }, function(){
                       layer.msg('好的', {
                    icon: 1,
                    skin: 'layer-ext-moon' 
                    });
                }, function(){
             $('input[name=product_name],input[name=product_spec').val('');
             $('#seleted_one_goods').html('');
                });
            }

        $('input[name=product_name]').val(product_name);
        $('input[name=product_spec]').val(product_spec);
        $('#seleted_one_goods').html(html);
     }


</script>
