/**
 * The public of the Theme.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 * @package           school
 *
 *                                                              _
 *                                                             | |
 *    __ ___      _____  ___  ___  _ __ ___   ___  ___ ___   __| | ___ _ __
 *   / _` \ \ /\ / / _ \/ __|/ _ \| '_ ` _ \ / _ \/ __/ _ \ / _` |/ _ \ '__|
 *  | (_| |\ V  V /  __/\__ \ (_) | | | | | |  __/ (_| (_) | (_| |  __/ |
 *   \__,_| \_/\_/ \___||___/\___/|_| |_| |_|\___|\___\___/ \__,_|\___|_|
 *
 */

console.log("SchoolAjaxUrl", SchoolAjaxUrl);

// check jquery is exist
if (typeof $ === "undefined") {
	let $ = jQuery;
}

// progress the operation
$(document).ready(function () {
	function slider() {
		$(".slider .slider-item:first-child").addClass("active");
		let active = 0;
		let banners = $(".slider .slider-item");
		let slides = banners.length;
		setInterval(function () {
			++active;
			if ((active = active % slides) < 0) active += slides;
			banners.removeClass("active").eq(active).addClass("active");
		}, 4000);
	}

	// call slider
	slider();

	// menu
	$(document).on("mouseover", ".menu-item-has-children ", function (e) {
		// console.log("e", e);
		let submenu = $(this).find("#submenu");

		let state = submenu.attr("data-state");

		if (state && state == "closed") {
			submenu.attr("data-state", "opened");
		}
	});

	// menu
	$(document).on("mouseout", ".menu-item-has-children ", function (e) {
		// console.log("e", e);
		let submenu = $(this).find("#submenu");

		let state = submenu.attr("data-state");

		if (state && state == "opened") {
			submenu.attr("data-state", "closed");
		}
	});

	$(document).on("click", "#trigger-menu", function (e) {
		e.preventDefault();
		$("#open-menu").toggleClass("hidden");
		$("#close-menu").toggleClass("hidden");
		// $("#hamburger").toggleClass("absolute");
		// $("#hamburger").toggleClass("fixed");

		//
		$("#mobile-navigation").toggleClass("hidden");
		$("#mobile-navigation").toggleClass("fixed");
	});
});
