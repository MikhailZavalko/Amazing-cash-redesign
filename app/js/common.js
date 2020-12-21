$(function() {

	/* Mask phone input */
	$('.faq-name').click(function() {
		$(this).toggleClass('active')
		.next()[$(this)
		.next()
		.is(':hidden') ? "slideDown" : "slideUp"](400);
	});
	/* Mask phone input */

	/* Owl-carousel */
	$('.owl-carousel').owlCarousel({
		items: 1,
		loop: true,
		smartSpeed: 700,
		dots: true,
		nav: true,
		navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
		responsiveClass: true,
	});
	/* Owl-carousel */

	/* sameHeight */
	$('.same1').sameHeight();
	$('.same2').sameHeight();
	$('.same3').sameHeight();
	$('.same4').sameHeight();
	$('.same5').sameHeight();
	$('.same6').sameHeight();
	$('.same7').sameHeight();
	/* sameHeight */

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



	/* CLOSE SUCCESS OPEN FORM */
	$('.close-popup').on('click', function (e) {
		e.preventDefault();
		$(this).closest('.success').removeClass('visible');
	})
	/* CLOSE SUCCESS OPEN FORM */



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
			th.trigger("reset");
			setTimeout(function() {
				// Done Functions
				$(".success").removeClass("visible");
				$.magnificPopup.close();
			}, 60000);
		});
		return false;
	});
	/* E-mail Ajax Send */



});


/* scroll menu function */
function scrollMenu(selector, id){
	$(selector).scrollspy({
		min: $(selector).position().top-50,
		max: ($(selector).position().top + $(selector).height()),
		onEnter: function(element, position) {
			$(".menu__item_active").removeClass("menu__item_active");
			$(".menu__item a[data-num="+id+"]").parent().addClass("menu__item_active");
		}
	});
}
jQuery(document).ready(function(){
	$('a[href^="#"].anchor').bind("click", function(e){
		var anchor = $(this);
		$('html, body').stop().animate({scrollTop: ($(anchor.attr('href')).offset().top - 35)}, 1000);
		e.preventDefault();
	});return false;
});
/* scroll menu function */
