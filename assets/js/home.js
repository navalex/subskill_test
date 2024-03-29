const $ = require('jquery');

var jQueryBridget = require('jquery-bridget');
var Masonry = require('masonry-layout');
var imagesLoaded = require('imagesloaded');
var PostLoading = true;
var category = undefined;

jQueryBridget( 'masonry', Masonry, $ );
imagesLoaded.makeJQueryPlugin( $ );


function add_articles(offset) {
	let $grid = $('.articles-grid');
	let url = $grid.data('ajaxurl') + '/' + offset;

	if (category !== undefined) {
		console.log('cat', category);
		url += '/' + category;
	}

	$('.loader').removeClass('d-none');

	setTimeout(function () {
		$.get(url, (html) => {
			$grid.append(html).imagesLoaded(() => {
				$('.loader').addClass('d-none');
				$('.grid-item.d-none').removeClass('d-none');
				$grid.masonry("reloadItems").masonry("layout");
			});

			PostLoading = true;
		}).fail(() => {
			PostLoading = false;
			$('.loader').addClass('d-none');
		})
	}, 500);
}

$(document).ready(() => {
	var offset = 0;

	$('.articles-grid').masonry({
		itemSelector: '.grid-item',
		columnWidth: '.grid-sizer',
		percentPosition: true
	});

	add_articles(offset);

	$(window).scroll(function() {
		if(PostLoading && $(window).scrollTop() + $(window).height() + 10 > $(document).height()) {
			PostLoading = false;
			offset += 10;
			add_articles(offset);
		}
	});

	$('.btn-category-select button').click(function () {
		var cat_id = $(this).data('postid');

		if (cat_id === 'all')
			category = undefined;
		else {
			category = cat_id;
		}

		$('.articles-grid .grid-item').remove();
		$('.articles-grid').css('height', 0);
		offset = 0;
		add_articles(offset);
	});
});
