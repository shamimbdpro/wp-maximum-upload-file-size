(function ($) {
    'use strict';

    $(document).ready(function () {
        if (typeof wmufs_admin_notice_ajax_object === 'undefined') {
            return;
        }

        $(document).on('click', '#hideWmufsNotice', function (e) {
            e.preventDefault();

            var $btn = $(this);
            $btn.prop('disabled', true);

            $.ajax({
                url: wmufs_admin_notice_ajax_object.wmufs_admin_notice_ajax_url,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'wmufs_admin_notice_ajax_object_save',
                    data: 1,
                    _ajax_nonce: wmufs_admin_notice_ajax_object.nonce
                },
                success: function (response) {
                    if (response && response.success) {
                        $('.hideWmufsNotice').fadeOut('fast');
                    } else {
                        $btn.prop('disabled', false);
                    }
                },
                error: function () {
                    $btn.prop('disabled', false);
                }
            });
        });
    });
}(jQuery));
