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

	if ($('.hot-article').length) {
		$.get($('.hot-article').data('url'), function(html) {
			$('.hot-article').html(html)
		})
	}

	if ($('.relate-article').length) {
		$.get($('.relate-article').data('url'), function(html) {
			$('.relate-article').html(html)
		})
	}
})