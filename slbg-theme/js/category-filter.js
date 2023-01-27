jQuery(function ($) {
    $('.category-link').click(function () {
        let category_id = $(this).data('cat-id');
        let ajax_url = cfScriptData.ajaxUrl;
        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: {
                action: 'load_category_posts',
                category_id: category_id
            },
            success: function (response) {
                $('#blog-main-container').html(response);
            }
        });
    });
});
