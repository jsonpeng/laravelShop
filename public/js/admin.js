//常用字符串
$('input[type=text]').attr('maxlength',191);
//常用手机号
//$('input[name=service_tel]').numberInputLimit(11);
//分类等级
$('input[name=category_level]').numberInputLimit(1);
//百分比
$('input[name=consume_credits],input[name=credits_max],#value').numberInputLimit(3);
//价格数字
$('input[name=price],input[name=sort],input[name=product_num],input[name=inventory_default],input[name=buy_limit],input[name=expire_hour],input[name=member],input[name=market_price],input[name=freight_free_limit],input[name=cost],input[name=records_per_page],input[name=inventory_warn],input[name=given],input[name=max_count],input[name=base],input[name=sales_count],input[name=inventory],input[name=weight],input[name=amount],input[name=discount]').numberInputLimit(8);
$('input[name=image]').attr('maxlength',512);
//图片长度限制提示
$('input[name=image]').imgInputLimit(512);

function serchKuaiDi(name,number){
    var url='https://m.kuaidi100.com/index_all.html?type='+name+'&postid='+number;
    var title=name+'单号'+number+'历史记录';
    if($(window).width()<479){
    layer.open({
        type: 2,
        title:title,
        shadeClose: true,
        shade: 0.8,
        area: ['100%', '100%'],
        content: url, 
    });
    return false;
    }
    layer.open({
        type: 2,
        title:title,
        shadeClose: true,
        shade: 0.8,
        area: ['60%', '680px'],
        content: url, 
    });
}

/**
 * [打开功能菜单]
 * @param  {[type]} link  [description]
 * @param  {String} title [description]
 * @return {[type]}       [description]
 */
function openMenuLink(link,type=""){
    var title = '请选择' + type;
    if($(window).width()<479){
    layer.open({
        type: 2,
        title:title,
        shadeClose: true,
        shade: 0.8,
        area: ['100%', '100%'],
        content: link, 
    });
    return false;
    }
    layer.open({
        type: 2,
        title:title,
        shadeClose: true,
        shade: 0.8,
        area: ['60%', '680px'],
        content: link, 
    });
}


 /**商品选择菜单
  *type不带参数 多选商品列表
  *type=1 商品列表   单选 不可选已经参加活动的商品
  *type=2 商品关系列表 不可选
  *type=3 订单添加商品 多选 可选已经参加活动的商品
  *type=4 优惠券添加商品 多选 可选已经参加活动的商品
  *type=5 单选商品 返回商品的链接
  */
function addProductMenuFunc(type='',prom_id='',team_sale=false){
    var frame_title='选择商品';
    if(type==2){
        frame_title='活动关联商品列表';
    }
    type=type==''?'':'?type='+type;
    prom_id=prom_id==''?'':'&prom_id='+prom_id;
    team_sale=team_sale==''?'':'&team_sale='+team_sale;
    var url = "/zcjy/products/searchGoodsFrame"+type+prom_id+team_sale;
    console.log($(window).width());
    console.log(url);
    if($(window).width()<479){
    layer.open({
        type: 2,
        title:frame_title,
        shadeClose: true,
        shade: 0.8,
        area: ['100%', '100%'],
        content: url, 
    });
    return false;
    }
    layer.open({
        type: 2,
        title:frame_title,
        shadeClose: true,
        shade: 0.8,
        area: ['60%', '680px'],
        content: url, 
    });
    return false;
}


 /**分类选择菜单
  */
function addCatMenuFunc(){
    var frame_title='选择分类信息';

    var url = "/zcjy/categories/searchCatsFrame";
    console.log($(window).width());
    console.log(url);
    if($(window).width()<479){
    layer.open({
        type: 2,
        title:frame_title,
        shadeClose: true,
        shade: 0.8,
        area: ['100%', '100%'],
        content: url, 
    });
    return false;
    }
    layer.open({
        type: 2,
        title:frame_title,
        shadeClose: true,
        shade: 0.8,
        area: ['60%', '680px'],
        content: url, 
    });
    return false;
}



/**
 * 添加用户功能菜单
 */
function addUserMenuFunc(){
    var url='/zcjy/frame/givenUserList';
    console.log($(window).width());
    if($(window).width()<479){
    layer.open({
        type: 2,
        title:'请选择用户',
        shadeClose: true,
        shade: 0.8,
        area: ['100%', '100%'],
        content: url, 
    });
    return false;
    }
    layer.open({
        type: 2,
        title:'请选择用户',
        shadeClose: true,
        shade: 0.8,
        area: ['60%', '680px'],
        content: url, 
    });
    return false;
}

//判断字符串中是否包含某个字符
function isContains(str, substr) {
    if(str.indexOf(substr) >= 0 ) 
    { 
        return true;
    }else{
        return false;
    }
}

function in_array(stringToSearch, arrayToSearch,count_times=false) {
     var i=0;
     var status=false;
     for (s = 0; s < arrayToSearch.length; s++) {
      thisEntry = arrayToSearch[s];
      if (thisEntry == stringToSearch) {
       status=true;
       i++;
      }
     }
        if(count_times){
            return i;
        }
     return status;
}
//根据名称删除一个数组
function delArrayByName(name,array){
    for(var i=0;i<array.length;i++){
        if(array[i]==name){
            array.splice(i,1);
        }
    }
    return array;
}
//多选返回
function call_back_by_many(table_html) {
    var _isInvalid = false;
    var arr = $("#add_spec_product").val();

    $('#product_items').show();
    //加入已经选中的table
    $('#product_items_table').html(table_html);
    layer.closeAll('iframe');

    var html = "";
    //从已经选中的中找出选中的并且遍历
    $('#product_items_table').find('.trSelected').each(function() {
        var spec_id = $(this).data("specid");
        var productname = $(this).data("productname");
        var price = $(this).data("price");
        var keyname = $(this).data("keyname");
        var productid = $(this).data("productid");
        var key_id=productid+'_'+spec_id;
        $('#product_items').find('.items').each(function() {
            if ($(this).data('keyid') == key_id) {
                layer.msg("该商品已经被添加过", {
                    icon: 5
                });
                _isInvalid = true;
                return false;
            }
        });
        if (_isInvalid) {
            _isInvalid = false;
            return;
        }
        /*
        spec_id等于0代表没有规格信息
        */
        html += '<div class="items row"   data-keyid="'+productid+'_'+spec_id+'" data-id="' + spec_id + '" id="item_row_'+spec_id +'" style="border-bottom: 1px solid #f4f4f4"><div class="col-md-4 col-xs-4"><img src="" alt="">' + productname + '</div><div class="col-md-4 col-xs-5">' + keyname + '</div><div class="col-md-2 col-xs-1" id="item_price_' + spec_id + '"><span>' + price + '</span></div><div class="col-md-2 col-xs-2"><div class="btn-group" id="item_" style="padding: 8px;"><a href="javascript:;" class="btn btn-danger btn-xs" id="item_delete_' + spec_id + '"  onclick="delItem(this,' + spec_id + ')"><i class="glyphicon glyphicon-trash" title="确认"></i></a><input type="hidden" name="product_spec[]" value="'+productid+'_'+spec_id+'" /></div></div></div>';


    });
    $('#product_items .box-body').append(html);
 }

 //多选用户返回
 function call_back_by_user(table_html){
     var _isInvalid = false;

    $('#users_items').show();
    //加入已经选中的table
    $('#users_items_table').html(table_html);
    layer.closeAll('iframe');

    var html ="";
    //从已经选中的中找出选中的并且遍历
    $('#users_items_table').find('.trSelected').each(function() {
        var userid = $(this).data("userid");
        var username=$(this).data("name");
        var sex=$(this).data("sex");
        var mobile=$(this).data("mobile");
        $('#users_items').find('.useritem').each(function() {
            console.log($(this).data('userid'));
            if ($(this).data('userid') == userid) {
                layer.msg("该用户已经被添加过", {
                    icon: 5
                });
                _isInvalid = true;
                return false;
            }
        });
        if (_isInvalid) {
            _isInvalid = false;
            return;
        }
        html += '<div class="useritem row" style="border-bottom:1px solid #f4f4f4;line-height:40px" data-userid="'+userid+'"><div class="col-md-2" >'+userid+'</div><div class="col-md-3">'+username+'</div><div class="col-md-2">'+sex+'</div><div class="col-md-3">'+mobile+'</div><div class="col-md-2"><a href="javascript:;" class="btn btn-danger btn-xs" id="item_delete_' + userid + '"  onclick="delItem(this)"><i class="glyphicon glyphicon-trash" title="确认"></i></a><input type="hidden" name="user_ids[]" value="'+userid+'" /></div></div>';
    });
    $('#users_items').append(html);
 }

//单选返回
 function call_back_by_one(table_html,team_sale=false){

        var _isInvalid = false;
        //加入已经选中的table
        $('#product_items_table').html(table_html);
        layer.closeAll('iframe');
        var product_name="";
        var html="";
        var i = 0;
        var product_spec;
        var prom;
        var prices;
        var remarks;
        var img;
        var product_names;

        //从已经选中的中找出选中的并且遍历
        $('#product_items_table').find('.trSelected').each(function() {
            if(team_sale=='banner_link'){
                console.log('weblink');
                console.log($(this).data('weblink'));
                $('input[name=link]').val($(this).data('weblink'));
                $('input[name=mini_link]').val($(this).data('minilink')); 
                $('.web_link,.mini_link').show(500);
            }else{
                var spec_id = $(this).data("specid");
                var productname = $(this).data("productname");
                var price = $(this).data("price");
                var keyname = $(this).data("keyname");
                var productid = $(this).data("productid");
                var productimg=$(this).data("productimg");
                var inventory=$(this).data("inventory");
                var remark=$(this).data("remark");
                prom=$(this).data("prom");
                prices=price;
                remarks=remark;
                img=productimg;
                //等于0代表没有规格信息
                if (spec_id != 0) {
                  product_name =productname+" "+keyname;
                } else {
                  product_name =productname;    
                }
                product_names=product_name;
                product_spec=productid+"_"+spec_id;
                html +='<div style="float: left;margin: 10px auto;" class="selected-group-goods"><div class="goods-thumb"><img style="width: 162px;height: 162px" src="'+productimg+'"></div> <div class="goods-name"> <a target="_blank" href="">'+product_name+'</a> </div> <div class="goods-price">商城价：￥'+price+'库存:'+inventory+'</div></div>';
            }
        });
        if(team_sale=='banner_link'){
           return false;         
         }
         if(prom){
                layer.confirm('该商品已经参加过其他活动，确定保存后将替换该活动？', {
                btn: ['确定','取消'] //按钮
                }, function(){
               layer.closeAll();
                }, function(){
             $('input[name=product_name],input[name=product_spec').val('');
             $('#seleted_one_goods').html('');
                });
            }

        $('input[name=product_name]').val(product_name);
        $('input[name=product_spec]').val(product_spec);
        $('#seleted_one_goods').html(html);

        if(team_sale){
            console.log('团购');
            $('input[name=share_title]').val("我"+prices+"元拼了["+product_names+"]");
            $('input[name=share_des]').val(remarks);
            $('input[name=share_img]').val(img);
            $('input[name=share_img]').parent().find('img').attr('src',img);
        }
}

