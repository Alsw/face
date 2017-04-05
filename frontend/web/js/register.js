jQuery('#signupform-birthday').parent().datepicker({
	"autoclose": true,
	"format": "yyyy-mm-dd",
	'language': 'zh-CN'
});;
jQuery('#signupform-birthday').parent().on('changeDate', function(e) {
	jQuery('#signupform-birthday').val(e.format());
	jQuery('.datepicker-inline').css('display', 'none');
});
jQuery(function() {
	jQuery('.datepicker-inline').css('display', 'none');
	jQuery('#signupform-birthday').css('background', '#fff');
})
jQuery('#signupform-birthday').on('click', function() {
	if (jQuery('.datepicker-inline').css('display') == 'none') {
		jQuery('.datepicker-inline').css('display', 'block');
	} else {
		jQuery('.datepicker-inline').css('display', 'none');
	}
})