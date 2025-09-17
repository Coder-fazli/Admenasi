<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <!-- Header with Logo and Navigation -->
    <header class="site-header">
        <div class="container">
            <div class="header-content">
                <a href="<?php echo home_url(); ?>" class="header-logo">
                    <span class="logo-s">s</span><span class="logo-o1">ö</span><span class="logo-z">z</span><span class="logo-l">l</span><span class="logo-u">ü</span><span class="logo-k">k</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="single-post-main">
        <div class="container">
            <div class="post-layout">
                
                <!-- Left Content Area -->
                <div class="post-content-area">
                    
                    <!-- Breadcrumb Navigation -->
                    <nav class="breadcrumb-nav">
                        <a href="<?php echo home_url(); ?>">Əsas səhifə</a>
                        <span class="breadcrumb-separator">›</span>
                        <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>">Bloqlar</a>
                        <span class="breadcrumb-separator">›</span>
                        <span class="current-page"><?php the_title(); ?></span>
                    </nav>
                    
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    
                    <!-- Post Content -->
                    <article class="single-post-article">
                        <header class="post-header">
                            <h1 class="post-title"><?php the_title(); ?></h1>
                            <div class="post-meta">
                                <span class="post-date"><?php echo get_the_date('d.m.Y'); ?></span>
                                <span class="post-author">Müəllif: <?php the_author(); ?></span>
                            </div>
                        </header>
                        
                        <div class="post-content">
                            <?php the_content(); ?>
                        </div>
                        
                        <!-- Post Tags -->
                        <?php if (get_the_tags()) : ?>
                        <div class="post-tags">
                            <h3>Teqlər</h3>
                            <div class="tag-list">
                                <?php 
                                $tags = get_the_tags();
                                $colors = ['orange', 'green', 'pink', 'blue', 'purple'];
                                $i = 0;
                                foreach ($tags as $tag) : 
                                    $color_class = $colors[$i % count($colors)];
                                    $i++;
                                ?>
                                <span class="tag-item <?php echo $color_class; ?>"><?php echo $tag->name; ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                    </article>
                    
                    <?php endwhile; endif; ?>
                    
                    <!-- Comments Section -->
                    <section class="comments-section">
                        <h3>Şərhlər</h3>
                        <div class="comments-list">
                            <!-- Comments will be loaded here -->
                            <div class="comment-item">
                                <div class="comment-avatar">
                                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 40 40'%3E%3Ccircle cx='20' cy='20' r='20' fill='%23ddd'/%3E%3C/svg%3E" alt="Avatar">
                                </div>
                                <div class="comment-content">
                                    <h4 class="comment-author">Fatimə Ağyayeva</h4>
                                    <p class="comment-date">12.11.2023</p>
                                    <p class="comment-text">Bu məqalə çox faydalıdır. Mühümlətdirici olan hissəsi təşəkkürlər</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Comment Form -->
                        <div class="comment-form">
                            <h4>Şərh yazın</h4>
                            <form>
                                <div class="form-row">
                                    <input type="text" placeholder="Ad Soyad" class="form-input">
                                    <input type="email" placeholder="E-mail adres" class="form-input">
                                </div>
                                <textarea placeholder="Şərhinizi yazın" class="form-textarea"></textarea>
                                <button type="submit" class="submit-button">Göndər</button>
                            </form>
                        </div>
                    </section>
                    
                </div>
                
                <!-- Right Sidebar -->
                <aside class="post-sidebar">
                    
                    <!-- Blog Categories Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Bloq kateqoriyaları</h3>
                        <ul class="category-list">
                            <?php 
                            $categories = get_categories();
                            foreach ($categories as $category) : 
                            ?>
                            <li>
                                <a href="<?php echo get_category_link($category->term_id); ?>" class="category-link">
                                    <?php echo $category->name; ?> (<?php echo $category->count; ?>)
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    
                    <!-- Recent Posts Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Digər bəslər</h3>
                        <ul class="recent-posts">
                            <?php 
                            $recent_posts = new WP_Query(array(
                                'posts_per_page' => 5,
                                'post__not_in' => array(get_the_ID())
                            ));
                            if ($recent_posts->have_posts()) :
                                while ($recent_posts->have_posts()) : $recent_posts->the_post();
                            ?>
                            <li class="recent-post-item">
                                <a href="<?php the_permalink(); ?>" class="recent-post-link">
                                    <?php the_title(); ?>
                                </a>
                                <span class="recent-post-date"><?php echo get_the_date('d.m.Y'); ?></span>
                            </li>
                            <?php 
                                endwhile;
                                wp_reset_postdata();
                            endif; 
                            ?>
                        </ul>
                    </div>
                    
                </aside>
                
            </div>
        </div>
    </main>
    
    <!-- Related Posts Section -->
    <section class="related-posts-section">
        <div class="container">
            <h2 class="section-title">Ən yeni bloqlar</h2>
            <div class="related-posts-grid">
                <?php 
                $related_posts = new WP_Query(array(
                    'posts_per_page' => 3,
                    'post__not_in' => array(get_the_ID()),
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));
                if ($related_posts->have_posts()) :
                    while ($related_posts->have_posts()) : $related_posts->the_post();
                ?>
                <article class="related-post-card">
                    <div class="related-post-content">
                        <h3 class="related-post-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <p class="related-post-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        <div class="related-post-meta">
                            <span class="related-post-date"><?php echo get_the_date('d.m.Y'); ?></span>
                            <a href="<?php the_permalink(); ?>" class="related-post-link">Daha ətraflı →</a>
                        </div>
                    </div>
                </article>
                <?php 
                    endwhile;
                    wp_reset_postdata();
                endif; 
                ?>
            </div>
            <div class="related-posts-button">
                <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="all-posts-button">Bütün bloqları fər</a>
            </div>
        </div>
    </section>

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