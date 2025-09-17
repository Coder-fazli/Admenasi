<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class('home blog wp-custom-logo theme-ruki has-sticky-nav has-sticky-nav-mobile has-custom-header has-loop-header has-pagination'); ?>>

    <!-- fade the body when slide menu is active -->
    <div class="body-fade"></div>

    <header id="site-header" class="site-header logo-left-menu sticky-nav sticky-mobile-nav">

        <!-- mobile header  -->
        <div class="mobile-header mobile-only">
            <div class="toggle toggle-menu mobile-toggle">
                <span><i class="icon-ruki-menu"></i></span><span class="screen-reader-text">Menu</span>
            </div>
            <div class="logo-wrapper">
                <a href="<?php echo home_url(); ?>" class="custom-logo-link" rel="home">
                    <span class="logo-text">
                        <span class="logo-s">s</span><span class="logo-o1">ö</span><span class="logo-z">z</span><span class="logo-l">l</span><span class="logo-u">ü</span><span class="logo-k">k</span>
                    </span>
                </a>
            </div>
            <div class="toggle toggle-search mobile-toggle">
                <span><i class="icon-search"></i></span><span class="screen-reader-text">Search</span>
            </div>
        </div>
        <!-- .mobile header -->

        <div class="container header-layout-wrapper">
            <div class="logo-wrapper">
                <a href="<?php echo home_url(); ?>" class="custom-logo-link" rel="home">
                    <span class="logo-text">
                        <span class="logo-s">s</span><span class="logo-o1">ö</span><span class="logo-z">z</span><span class="logo-l">l</span><span class="logo-u">ü</span><span class="logo-k">k</span>
                    </span>
                </a>
            </div>

            <div class="primary-menu-container">
                <div class="toggle toggle-menu">
                    <span class="has-toggle-text"><i class="icon-ruki-menu"></i>Menu</span>
                </div>

                <nav class="menu-primary-navigation-container">
                    <ul id="primary-nav" class="primary-nav">
                        <li class="menu-item">
                            <a href="<?php echo home_url(); ?>">Ana Səhifə</a>
                        </li>
                        <li class="menu-item menu-item-has-children">
                            <a href="#">Mövzular</a>
                            <ul class="sub-menu">
                                <?php wp_list_categories(array('title_li' => '')); ?>
                            </ul>
                        </li>
                        <li class="menu-item">
                            <a href="#">Sənət & Dizayn</a>
                        </li>
                        <li class="menu-item">
                            <a href="#">Gözəllik</a>
                        </li>
                        <li class="menu-item">
                            <a href="#">Həyat tərzi</a>
                        </li>
                        <li class="menu-item">
                            <a href="#">Səyahət</a>
                        </li>
                        <li class="ruki-subscribe menu-item">
                            <a href="#">Abunə ol</a>
                        </li>
                    </ul>
                </nav>
                <div class="toggle toggle-search">
                    <span class="has-toggle-text"><i class="icon-search"></i>Axtar</span>
                </div>
            </div>
        </div>
    </header>

    <!-- site search -->
    <div class="site-search">
        <span class="toggle-search"><i class="icon-cancel"></i></span>
        <form role="search" method="get" class="search-form" action="<?php echo home_url(); ?>">
            <label for="search-form-sozluk">
                <span class="screen-reader-text">Search for:</span>
            </label>
            <input type="search" id="search-form-sozluk" class="search-field" placeholder="Axtar və Enter basın" value="<?php echo get_search_query(); ?>" name="s" />
            <button type="submit" class="search-submit"><i class="icon-search"></i><span class="screen-reader-text">Search</span></button>
        </form>
    </div>