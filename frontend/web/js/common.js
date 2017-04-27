$.fn.extend({
    txtaAutoHeight: function() {
        return this.each(function() {
            var $this = $(this);
            if (!$this.attr('initAttrH')) {
                $this.attr('initAttrH', $this.outerHeight());
            }
            setAutoHeight(this).on('input', function() {
                setAutoHeight(this);
            });
        });

        function setAutoHeight(elem) {
            var $obj = $(elem);
            return $obj.css({
                height: $obj.attr('initAttrH'),
                'overflow-y': 'hidden'
            }).height(elem.scrollHeight);
        }
    }
});

$(function() {
    $("textarea").txtaAutoHeight();
});