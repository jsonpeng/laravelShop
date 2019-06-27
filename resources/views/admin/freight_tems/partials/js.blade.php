<script>
var select_obj;
var one_times=0;
$('input:radio[name=count_type]').click(function(){
	var type=parseInt($(this).val());
	if($('input:radio[name=count_type]').is(':checked') && one_times!=0){
		       layer.confirm('切换将会清空当前信息.是否切换?', {
                btn: ['确定','取消'] //按钮
                }, function(){
                	switch(type){
						case 0:
						$('#freight_tems_tbody1,#freight_tems_tbody2').empty();
						$('#freight_type_1,#freight_type_2').hide();
						$('#freight_type_0').show();
						break;
						case 1:
						$('#freight_tems_tbody0,#freight_tems_tbody2').empty();
						$('#freight_type_0,#freight_type_2').hide();
						$('#freight_type_1').show();
						break;
						case 2:
						$('#freight_tems_tbody0,#freight_tems_tbody1').empty();
						$('#freight_type_0,#freight_type_1').hide();
						$('#freight_type_2').show();
						break;
					}
					var varify_default=	$('input:radio[name=use_default]').is(':checked');
					if(varify_default){
						$('input:radio[name=use_default]:checked').click();
					}
					 layer.closeAll();
                }, function(){
          			 layer.closeAll();
          			 location.reload();
                });
	}else{
		switch(type){
		case 0:
		$('#freight_tems_tbody1,#freight_tems_tbody2').empty();
		$('#freight_type_1,#freight_type_2').hide();
		$('#freight_type_0').show();
		break;
		case 1:
		$('#freight_tems_tbody0,#freight_tems_tbody2').empty();
		$('#freight_type_0,#freight_type_2').hide();
		$('#freight_type_1').show();
		break;
		case 2:
		$('#freight_tems_tbody0,#freight_tems_tbody1').empty();
		$('#freight_type_0,#freight_type_1').hide();
		$('#freight_type_2').show();
		break;
	}
	var varify_default=	$('input:radio[name=use_default]').is(':checked');
	if(varify_default){
		$('input:radio[name=use_default]:checked').trigger('click');
	}
  }
  one_times=1;

});

$('input:radio[name=use_default]').click(function(){
	if(parseInt($(this).val())==1){
		console.log($('input:radio[name=count_type]').is(':checked'));
		var status=$('input:radio[name=count_type]').is(':checked');
		if(status){
				var type=$('input:radio[name=count_type]:checked').val();
				if(type==0){
					type_num='件';
				}
				if(type==1){
					type_num='克';
				}
				if(type==2){
					type_num='立方米';
				}
				$('#freight_tems_tbody'+type).append('<tr class="all_area"><td>全国<input class="form-control" name="area_list[]" type="hidden" value="全国"><input class="form-control" type="hidden" name="area_ids_list[]" value="1"></td><td><input class="form-control" name="freight_first_count[]" placeholder="'+type_num+'"></td><td><input class="form-control" name="the_freight[]" placeholder="元"></td><td><input class="form-control" name="freight_continue_count[]" placeholder="'+type_num+'"></td><td><input class="form-control" name="freight_continue_price[]" placeholder="元"></td><td><button class="btn btn-danger btn-xs" type="button" onclick="del_freight_item(this)"><i class="glyphicon glyphicon-trash"></i>删除</button></td></tr>');
			}else{
				$('.all_area').remove();
			}
	}else{
		$('.all_area').remove();
	}
});



$('.add_freight_cities').click(function(){
		var type=$(this).data('type');
		var type_num='';
		if(type==0){
			type_num='件';
		}
		if(type==1){
			type_num='克';
		}
		if(type==2){
			type_num='立方米';
		}
		$('#freight_tems_tbody'+type).append('<tr><td><input class="form-control" name="area_list[]" onclick="select_area(this)"><input class="form-control" type="hidden" name="area_ids_list[]" ></td><td><input class="form-control" name="freight_first_count[]" placeholder="'+type_num+'"></td><td><input class="form-control" name="the_freight[]" placeholder="元"></td><td><input class="form-control" name="freight_continue_count[]" placeholder="'+type_num+'"></td><td><input class="form-control" name="freight_continue_price[]" placeholder="元"></td><td><button class="btn btn-danger btn-xs" type="button" onclick="del_freight_item(this)"><i class="glyphicon glyphicon-trash"></i>删除</button></td></tr>');
});

function del_freight_item(obj){
$(obj).parent().parent().remove();
}

function select_area(obj){
	 var url = "/zcjy/cities/frame/select";
	 select_obj=obj;
            layer.open({
                type: 2,
                title: '选择地区',
                shadeClose: true,
                shade: 0.2,
                area: ['60%', '350px'],
                content: url
            });
}

function call_back(list){
	var area_list=[];
	var area_ids=[];
	for(var i=0;i<list.length;i++){
		area_list.push(list[i].name);
		area_ids.push(list[i].id);
	}
	console.log(area_list);
	console.log(area_ids);
   	layer.closeAll('iframe');
	$(select_obj).val(area_list);
	$(select_obj).parent().find('input[type=hidden]').val(area_ids);
}


</script>