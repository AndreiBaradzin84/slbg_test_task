<ol class="list-unstyled">
    <?php
    $categories = get_categories( array(
        'orderby' => 'name',
        'order'   => 'ASC'
    ) );
    foreach( $categories as $category ) {
        echo '<h2><a class="category-link" href="#" data-cat-id="' . $category->term_id . '"><span class="label label-info">' . $category->name . '</span></a></h2>';
    }
    ?>
</ol>
<hr>