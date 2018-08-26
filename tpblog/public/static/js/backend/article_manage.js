$(function(){
	$('.btn-delete').on('click' ,function() {
		if (!confirm('确定要删除吗')) {
			return false;
		}
	})
	// 检查标题
	// 检查内容

	var editor = editormd("editormd", {
		width   : "100%",
		height  : 400,
		syncScrolling : "single",
		path    : "/static/libs/editormd/lib/"
	});

});