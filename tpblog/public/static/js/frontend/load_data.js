$(function(){
	
	if ($('.category-list').length) {
		$.get($('.category-list').data('url'),function(html){
			$('.category-list').html(html)
		})
	}

	if ($('.tag-list').length) {
		$.get($('.tag-list').data('url'), function(html) {
			$('.tag-list').html(html)
		})
	}
})