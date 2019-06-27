@section('scripts')
<script type="text/javascript">
	$(function(){
		$('select[name=link_type]').change(function(){
				layer.closeAll();
				if($(this).val() == 'product'){
					addProductMenuFunc(5);
				}
				else if($(this).val() == 'cat'){
					addCatMenuFunc();
				}
				else if($(this).val() == 'brand'){
					openMenuLink('/zcjy/brands/iframe','品牌');
				}
				else if($(this).val() == 'custom'){
					$('.web_link,.mini_link').find('input').val('');
					$('.web_link,.mini_link').find('input').removeAttr('readonly');
					$('.web_link,.mini_link').show(500);
				}
				else{
					$('.web_link,.mini_link').hide(500);
					$('.web_link,.mini_link').find('input').val('');
				}
		});
		$('select[name=link_type]').click(function(){
			$(this).trigger('change');
		})
	});
</script>
@endsection