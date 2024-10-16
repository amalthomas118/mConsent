<?php

$id = $post->ID;

// Post type 
$args = array(
    'post_type' => 'cards',
    'post_status' => 'publish',
    'posts_per_page' => -1, // Fetch all posts at once
    'orderby' => 'name',
    'order' => 'ASC',
);


$query = new WP_Query($args);


// Categories
$card_categories = get_categories(array(
    'taxonomy' => 'card_category',
    'hide_empty' => true,
    'orderby' => 'name',
    'order' => 'ASC',
));

?>

<div class="post-list-page">
    <div class="container container-1160">

        <?php

        if (!empty($card_categories)) {

        ?>
            <div class="post-filter-tab">
                <ul id="myBtnContainer">
                    <li><a href="#all" class="link-btn active" onclick="filterSelection( 'all' )">All</a></li>
                    <?php
                    // Loop the categories for the tabs
                    foreach ($card_categories as $categories) { ?>
                        <li>
                            <a href="#<?php echo $categories->slug; ?>" class="link-btn " onclick="filterSelection( '<?php echo $categories->slug; ?>' )">
                                <?php echo $categories->name; ?>
                            </a>
                        </li>
                    <?php  } ?>

                    <li>
                        <div class="input-group">
                            <input class="form-control my-0 py-1 amber-border" type="text" id="myFilter" onkeyup="myFunction()" aria-label="Search">
                            <div class="input-group-append">
                                <span class="input-group-text amber lighten-3" id="basic-text1">
                                    <img src="<?php echo get_template_directory_uri() . '/assets/images/search_icon.png' ?>" />
                                </span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

        <?php } ?>
        <div class="post-list-section">
            <div class="row reset-margin">
                <div class="col-sm-12 list-right-sidebar reset-padding">
                    <div id="myItems" class="row reset-margin">

                        <?php
                        if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();
                                $title = get_the_title();
                                $desc = get_field('desc') ?: '';
                                $image_arr = get_field('featured_image') ?: 'null';
                                $image_url = $image_arr['url'];
                                $date = get_the_date('jS M Y');
                                $post_link = get_post_permalink();

                            // Get the categories for the current post
                            $categories = get_the_terms(get_the_ID(), 'card_category');
                            // Prepare a string of category slugs
                            $category_slugs = '';
                            if ($categories && !is_wp_error($categories)) {
                                $category_slugs = implode(' ', wp_list_pluck($categories, 'slug'));
                            }

                        ?>

                                <div class="card-block col-lg-4 col-md-6 col-sm-12 reset-padding blog " data-id="<?php echo esc_attr($category_slugs); ?>">
                                    <div class="card" onclick="location.href='<?php echo esc_url($post_link); ?>'">
                                        <div class="card-img">
                                            <img class="card-img-top" src="<?php echo $image_url ?>" alt="Card image" style="width:100%">
                                            <div class="time-stamped"><?php echo $date; ?></div>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title"><a href="<?php echo $post_link ?>"><?php echo $title; ?></a></h4>
                                            <p class="card-text"><?php echo $desc; ?></p>
                                        </div>
                                    </div>
                                </div>

                        <?php
                            }
                        }
                        ?>
                    </div>
                    <nav aria-label='Page navigation example'>
                        <ul class='page-navigation' id="pagination">

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>