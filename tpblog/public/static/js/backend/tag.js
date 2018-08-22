$(function(){

	$('.btn-delete').on('click' ,function() {
		if (!confirm('确定要删除吗')) {
			return false;
		}
	})

});