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

    <div class="wrap">
        <main id="main" class="site-main no-page-numbers">
            <div id="primary" class="content-area flex-grid masonry cols-3 break-2-split-2-1" data-thumbnail="uncropped" data-posts="15" data-style="default">
                <div id="masonry-container" class="masonry-container">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" class="flex-box has-meta-after-title has-meta-before-title has-excerpt has-read-more has-meta-read-time default post type-post status-publish format-standard has-post-thumbnail hentry">

                        <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', array('class' => 'wp-post-image')); ?>
                            </a>
                        </div>
                        <?php endif; ?>

                        <header class="entry-header">
                            <div class="entry-meta before-title">
                                <ul class="author-category-meta">
                                    <li class="category-prepend">
                                        <span class="screen-reader-text">Posted</span>
                                        <i>in</i>
                                    </li>
                                    <li class="category-list">
                                        <ul class="post-categories">
                                            <?php
                                            $categories = get_the_category();
                                            if ($categories) :
                                                foreach($categories as $category) :
                                            ?>
                                            <li class="cat-slug-<?php echo $category->slug; ?> cat-id-<?php echo $category->term_id; ?>">
                                                <a href="<?php echo get_category_link($category->term_id); ?>" class="cat-link-<?php echo $category->term_id; ?>"><?php echo $category->name; ?></a>
                                            </li>
                                            <?php endforeach; endif; ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                            <h3 class="entry-title">
                                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                            </h3>

                            <div class="entry-meta after-title">
                                <ul>
                                    <li class="entry-author-meta">
                                        <span class="screen-reader-text">Posted by</span><i>by</i>
                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a>
                                    </li>
                                    <li class="entry-date">
                                        <time datetime="<?php echo get_the_date('Y-m-d'); ?>">
                                            <?php echo get_the_date(); ?>
                                        </time>
                                    </li>
                                    <li class="entry-read-time">
                                        <?php echo ceil(str_word_count(get_the_content()) / 200); ?> <span>min</span>
                                    </li>
                                </ul>
                            </div>
                        </header>

                        <div class="entry-content">
                            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                        </div>

                        <div class="entry-read-more">
                            <a href="<?php the_permalink(); ?>" class="button read-more">Continue reading</a>
                            <div class="entry-comment-count">
                                <?php comments_number('0 Comments', '1 Comment', '% Comments'); ?>
                            </div>
                        </div>

                    </article>
                    <?php endwhile; else: ?>
                    <p>Hələ heç bir məqalə yayımlanmayıb.</p>
                    <?php endif; ?>
                </div>

                <!-- Pagination -->
                <?php if (get_next_posts_link() || get_previous_posts_link()) : ?>
                <div class="pagination-container">
                    <?php
                    echo paginate_links(array(
                        'prev_text' => '‹ Əvvəlki',
                        'next_text' => 'Növbəti ›',
                        'type' => 'list'
                    ));
                    ?>
                </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-logo">
                        <span class="logo-s">s</span><span class="logo-o1">ö</span><span class="logo-z">z</span><span class="logo-l">l</span><span class="logo-u">ü</span><span class="logo-k">k</span>
                    </div>
                </div>
                <div class="footer-section">
                    <h4>Başlıq</h4>
                    <ul>
                        <li><a href="#">Haqqımızda</a></li>
                        <li><a href="#">Əlaqə</a></li>
                        <li><a href="#">Gizlilik</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Sözlükər</h4>
                    <ul>
                        <li><a href="#">Adlar</a></li>
                        <li><a href="#">Terminlər</a></li>
                        <li><a href="#">Orfoqrafiya</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Orfoqrafiya lüğəti</h4>
                    <ul>
                        <li><a href="#">Yazım qaydaları</a></li>
                        <li><a href="#">İmla</a></li>
                        <li><a href="#">Tələffüz</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© Copyright 2023</p>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>