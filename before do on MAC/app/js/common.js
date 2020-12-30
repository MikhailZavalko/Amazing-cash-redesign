$(function() {



	/* SHOW/HIDDEN FAQ */
	$('.faq-name').click(function() {
		$(this).toggleClass('active')
		.next()[$(this)
		.next()
		.is(':hidden') ? "slideDown" : "slideUp"](400);
	});
	/* SHOW/HIDDEN FAQ */



	/* Owl-carousel */
	$('.owl-carousel').owlCarousel({
		items: 1,
		loop: true,
		smartSpeed: 700,
		dots: true,
		nav: true,
		navText: ['<img class="img-responsive" src="../img/arrow-left.png">', '<img class="img-responsive" src="../img/arrow-right.png">'],
		responsiveClass: true,
		margin: 50,
	});
	/* Owl-carousel */



	/* Magnific Popup */
	$('.open-form-button').magnificPopup({
		type: 'inline',
		fixedContentPos: false,
		fixedBgPos: true,
		overflowY: 'auto',
		closeBtnInside: true,
		preloader: false,
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-slide-bottom',
		callbacks: {
			beforeOpen: function() {
				var $triggerEl = $(this.st.el),
				newClass = $triggerEl.data("modal-class");
				if (newClass) {
					this.st.mainClass = this.st.mainClass + ' ' + newClass;
				}
			}
		}
	});
	/* Magnific Popup */



	/* E-mail Ajax Send */
	$("form").submit(function(e) {
		e.preventDefault;
		var th = $(this);
		$('.form').addClass('loading');
		$.ajax({
			type: "POST",
			url: "../send.php",
			data: th.serialize()
		}).done(function() {
			$('.form').removeClass('loading');
			$(".success").addClass("visible");
			setTimeout(function() {
				// Done Functions
				th.trigger("reset");
				$(".success").removeClass("visible");
				$.magnificPopup.close();
			}, 3000);
		});
		return false;
	});
	/* E-mail Ajax Send */

});



/* SCROLL FOR HEADER */
var windowHeight = $(window).height();

$(document).ready(function($) {
	$(window).on('scroll touchmove', function () {
		$('.header').toggleClass('scrolled', $(document).scrollTop() > windowHeight);
	}).scroll();
});
	/* SCROLL FOR HEADER */



/* MENU TRIGGER FOR SCROLL */
$(".header-link").click(function () {
	elementClick = $(this).attr("href");
	destination = $(elementClick).offset().top - 50;
	destination = elementClick == '#home' ? destination - 20 : destination;
	$("html,body").stop().animate({ scrollTop: destination }, 1000);
	$(".hamburger").removeClass('is-active');
	$('.menu').removeClass('active');
	return false;
});
	/* MENU TRIGGER FOR SCROLL */