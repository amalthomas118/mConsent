<!DOCTYPE html>
<html class="no-js" lang="en-US">

<head>
    <meta charset="UTF-8">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel='stylesheet' id='bootstrap.min-css' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css?ver=6.6.2' media='all' />
    <link rel='stylesheet' id='font-awesome-css' href='<?php echo get_template_directory_uri() . '/assets/css/font-awesome.css' ?>' media='all' />
    <!-- <link rel='stylesheet' id='theme-overwrite-style-css' href='assets/css/theme.css' media='all' /> -->
    <link rel="shortcut icon" type="image/png" href="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SRS web solutions | Task</title>
    <?php wp_head(); ?>
    
</head>


<?php
$logo = get_field('site_logo', 'options');

?>

<body>
    <div class="container-fluid reset-padding">
        <header class="site-header">
            <div class="container container-1280">
                <nav class="site-navigation navbar navbar-expand-md navbar-light bg-light reset-padding">
                    <?php if($logo){ ?>
                    <a href="<?php echo home_url(); ?>" class="navbar-brand">
                        <img src="<?php echo $logo['url']; ?>" alt="CoolBrand" style="width: 185px;">
                    </a>
                    <?php } ?>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                            <?php
                            if (has_nav_menu('primary_menu')) {
                            ?>
                                <?php
                                wp_nav_menu(
                                    array(
                                        'theme_location'  => 'primary_menu',
                                        'menu_id' => 'menu-site-menu',
                                        'menu_class' => 'navbar-nav ml-auto',
                                        'add_a_class'     => 'nav-link',
                                        'container' => 'div',
                                        'container_class' => 'main-nav collapse navbar-collapse',
                                        'container_id' => 'navbarCollapse'
                                    )
                                );
                                ?>
                            <?php
                            } ?>
                </nav>
            </div>
        </header>