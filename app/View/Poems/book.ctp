<?php 
/*
	// Navigation Bar
	//$this->Menu->navigation($role, array('special' => 'book', 'last_page' => $poems));
	
	// Javascript
	$this->start('script_before');
	echo $this->Html->script('turnjs4/jquery-ui-1.8.20.custom.min.js');
	//echo $this->Html->script('turnjs4/jquery.mousewheel.min.js');
	echo $this->Html->script('turnjs4/modernizr.2.5.3.min.js');
	echo $this->Html->script('turnjs4/hash.js');
	$this->end();
*/
?>
<head>
	<title>
		谐调-		Poems	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<?php
		echo $this->Html->css('//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css');
		echo $this->Html->css('custom_bootstrap');
 		echo $this->Html->css('style');
 		echo $this->Html->script('//code.jquery.com/jquery-1.11.2.min.js');
 		echo $this->Html->script('//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js');
 		echo $this->Html->script('turnjs4/jquery-ui-1.8.20.custom.min.js');
		//echo $this->Html->script('turnjs4/jquery.mousewheel.min.js');
		echo $this->Html->script('turnjs4/modernizr.2.5.3.min.js');
		echo $this->Html->script('turnjs4/hash.js');
	?>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div id="canvas">
				<div class="poem-book-nav">
					<?php 
					$book_url = $this->Html->url(array('controller' => 'poems', 'action' => 'book'));
					$last_page = $poems - 1;
					echo'<a href="'.$book_url.'#page/1" class = "btn btn-custom btn-action">诗集首页</a>
				         <a href="'.$book_url.'#page/'.$last_page.'" class = "btn btn-custom btn-action">最新发布</a>';
					?>
				</div>
				<div id="book-zoom">
					<div class="sj-book">
						<div depth="5" class="hard"> <div class="side"></div> </div>
						<div depth="5" class="hard front-side"> <div class="depth"></div> </div>
						<div class="own-size"></div>
						<div class="own-size even"></div>
						<div class="hard fixed back-side p<?php echo $poems+1;?> last-sec"> <div class="depth"></div> </div>
						<div class="hard p<?php echo $poems+2;?> last"></div>
					</div>
				</div>
				<div id="slider-bar" class="turnjs-slider">
					<div id="slider"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

function loadApp() {
	
	var flipbook = $('.sj-book');

	// Check if the CSS was already loaded
	
	if (flipbook.width()==0 || flipbook.height()==0) {
		setTimeout(loadApp, 10);
		return;
	}
/*
	// Mousewheel

	$('#book-zoom').mousewheel(function(event, delta, deltaX, deltaY) {

		var data = $(this).data(),
			step = 30,
			flipbook = $('.sj-book'),
			actualPos = $('#slider').slider('value')*step;

		if (typeof(data.scrollX)==='undefined') {
			data.scrollX = actualPos;
			data.scrollPage = flipbook.turn('page');
		}

		data.scrollX = Math.min($( "#slider" ).slider('option', 'max')*step,
			Math.max(0, data.scrollX + deltaX));

		var actualView = Math.round(data.scrollX/step),
			page = Math.min(flipbook.turn('pages'), Math.max(1, actualView*2 - 2));

		if ($.inArray(data.scrollPage, flipbook.turn('view', page))==-1) {
			data.scrollPage = page;
			flipbook.turn('page', page);
		}

		if (data.scrollTimer)
			clearInterval(data.scrollTimer);
		
		data.scrollTimer = setTimeout(function(){
			data.scrollX = undefined;
			data.scrollPage = undefined;
			data.scrollTimer = undefined;
		}, 1000);

	});
*/
	// Slider

	$( "#slider" ).slider({
		min: 1,
		max: 100,

		start: function(event, ui) {

			if (!window._thumbPreview) {
				_thumbPreview = $('<div />', {'class': 'thumbnail'}).html('<div></div>');
				setPreview(ui.value);
				_thumbPreview.appendTo($(ui.handle));
			} else
				setPreview(ui.value);

			moveBar(false);

		},

		slide: function(event, ui) {

			setPreview(ui.value);

		},

		stop: function() {

			if (window._thumbPreview)
				_thumbPreview.removeClass('show');
			
			$('.sj-book').turn('page', Math.max(1, $(this).slider('value')*2 - 2));

		}
	});


	// URIs
	
	Hash.on('^page\/([0-9]*)$', {
		yep: function(path, parts) {

			var page = parts[1];

			if (page!==undefined) {
				if ($('.sj-book').turn('is'))
					$('.sj-book').turn('page', page);
			}

		},
		nop: function(path) {

			if ($('.sj-book').turn('is'))
				$('.sj-book').turn('page', 1);
		}
	});

	// Arrows

	$(document).keydown(function(e){

		var previous = 37, next = 39;

		switch (e.keyCode) {
			case previous:

				$('.sj-book').turn('previous');

			break;
			case next:
				
				$('.sj-book').turn('next');

			break;
		}

	});


	// Flipbook

	flipbook.bind(($.isTouch) ? 'touchend' : 'click', zoomHandle);

	flipbook.turn({
		elevation: 50,
		acceleration: !isChrome(),
		autoCenter: true,
		gradients: true,
		duration: 1000,
		pages: <?php echo $poems+2;?>,
		when: {
			turning: function(e, page, view) {
				
				var book = $(this),
					currentPage = book.turn('page'),
					pages = book.turn('pages');

				if (currentPage>3 && currentPage<pages-3) {
				
					if (page==1) {
						book.turn('page', 2).turn('stop').turn('page', page);
						e.preventDefault();
						return;
					} else if (page==pages) {
						book.turn('page', pages-1).turn('stop').turn('page', page);
						e.preventDefault();
						return;
					}
				} else if (page>3 && page<pages-3) {
					if (currentPage==1) {
						book.turn('page', 2).turn('stop').turn('page', page);
						e.preventDefault();
						return;
					} else if (currentPage==pages) {
						book.turn('page', pages-1).turn('stop').turn('page', page);
						e.preventDefault();
						return;
					}
				}

				updateDepth(book, page);
				
				if (page>=2)
					$('.sj-book .p2').addClass('fixed');
				else
					$('.sj-book .p2').removeClass('fixed');

				if (page<book.turn('pages'))
					$('.sj-book .p' + <?php echo $poems+1;?>).addClass('fixed');
				else
					$('.sj-book .p' + <?php echo $poems+1;?>).removeClass('fixed');

				Hash.go('page/'+page).update();
					
			},

			turned: function(e, page, view) {

				var book = $(this);

				if (page==2 || page==3) {
					book.turn('peel', 'br');
				}

				updateDepth(book);
				
				$('#slider').slider('value', getViewNumber(book, page));

				book.turn('center');

			},

			start: function(e, pageObj) {
		
				moveBar(true);

			},

			end: function(e, pageObj) {
			
				var book = $(this);

				updateDepth(book);

				setTimeout(function() {
					
					$('#slider').slider('value', getViewNumber(book));

				}, 1);

				moveBar(false);

			},

			missing: function (e, pages) {

				for (var i = 0; i < pages.length; i++) {
					addPage(pages[i], $(this));
				}

			}
		}
	});


	$('#slider').slider('option', 'max', numberOfViews(flipbook));

	flipbook.addClass('animated');

	// Show canvas

	$('#canvas').css({visibility: ''});
}

// Hide canvas

$('#canvas').css({visibility: 'hidden'});

// Load turn.js

yepnope({
	test : Modernizr.csstransforms,
	yep: ['../js/turnjs4/turn.min.js'],
	nope: ['../js/turnjs4/turn.html4.min.js', '../css/turnjs4/jquery.ui.html4.css', '../css/turnjs4/book-html4.css'],
	both: ['../js/turnjs4/book.js', '../css/turnjs4/jquery.ui.css', '../css/turnjs4/book.css'],
	complete: loadApp
});

</script>
</body>