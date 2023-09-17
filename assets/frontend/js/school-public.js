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
	// // customer login
	// $("#login-form").validate({
	// 	rules: {
	// 		email: {
	// 			required: true,
	// 			email: true,
	// 		},
	// 		password: {
	// 			required: true,
	// 			minlength: 5,
	// 		},
	// 	},
	// 	messages: {
	// 		password: {
	// 			required: "Please provide a password",
	// 			minlength: "Password must be at least 8 characters",
	// 		},
	// 		email: "Please enter a valid email address",
	// 	},
	// 	submitHandler: function (form) {
	// 		form = $(form).serialize();
	// 	},
	// });
});
