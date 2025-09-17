<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <!-- Header -->
    <header class="ruki-header">
        <div class="container">
            <div class="header-content">
                <!-- Logo -->
                <div class="ruki-logo">
                    <a href="<?php echo home_url(); ?>">
                        <span class="logo-s">s</span><span class="logo-o1">ö</span><span class="logo-z">z</span><span class="logo-l">l</span><span class="logo-u">ü</span><span class="logo-k">k</span>
                    </a>
                </div>
                
                <!-- Navigation Menu -->
                <nav class="ruki-nav">
                    <a href="#" class="nav-item">☰ Menu</a>
                    <a href="#" class="nav-item dropdown">Mövzular <span>▼</span></a>
                    <a href="#" class="nav-item">Sənət & Dizayn</a>
                    <a href="#" class="nav-item dropdown">Gözəllik <span>▼</span></a>
                    <a href="#" class="nav-item">Həyat tərzi</a>
                    <a href="#" class="nav-item">Səyahət</a>
                    <a href="#" class="nav-item dropdown">Mağaza <span>▼</span></a>
                    <a href="#" class="nav-subscribe">Abunə ol</a>
                    <a href="#" class="nav-search">🔍</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <h1 class="newsletter-title">Axtardığın bütün növ sözlər</h1>
                <p class="newsletter-subtitle">Ən son yeniliklər üçün xəbərdarlıq bülletenimə abunə olun</p>
                
                <form class="newsletter-form">
                    <input type="email" class="newsletter-input" placeholder="E-mail adresiniz" required>
                    <button type="submit" class="newsletter-btn">Qeydiyyat</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Masonry Blog Grid -->
    <main class="masonry-main">
        <div class="container">
            <div class="masonry-grid" id="masonry-container">
                
                <?php
                // Get recent posts
                $recent_posts = new WP_Query(array(
                    'posts_per_page' => 12,
                    'post_status' => 'publish'
                ));
                
                if ($recent_posts->have_posts()) :
                    $card_types = ['small', 'medium', 'large'];
                    $card_colors = ['orange', 'green', 'pink', 'blue', 'purple', 'teal'];
                    $illustrations = ['⭐', '🍀', '🌸', '🎯', '🎨', '📚', '✨', '🔥', '💡', '🚀'];
                    $counter = 0;
                    
                    while ($recent_posts->have_posts()) : $recent_posts->the_post();
                        $card_type = $card_types[$counter % count($card_types)];
                        $card_color = $card_colors[$counter % count($card_colors)];
                        $illustration = $illustrations[$counter % count($illustrations)];
                        $categories = get_the_category();
                        $counter++;
                ?>
                
                <article class="blog-card card-<?php echo $card_type; ?> card-<?php echo $card_color; ?>">
                    <a href="<?php the_permalink(); ?>" class="card-link-wrapper">
                        <!-- Card Illustration Area -->
                        <div class="card-image">
                            <div class="card-illustration-bg">
                                <div class="card-illustration-content">
                                    <!-- Professional illustration placeholder -->
                                    <div class="illustration-placeholder">
                                        <?php echo $illustration; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Category Badge -->
                            <?php if ($categories) : ?>
                            <span class="category-badge"><?php echo $categories[0]->name; ?></span>
                            <?php endif; ?>
                            <!-- Read Time -->
                            <span class="read-time">🕐 2 min</span>
                        </div>
                        
                        <!-- Card Content -->
                        <div class="card-body">
                            <h3 class="card-title"><?php the_title(); ?></h3>
                            
                            <div class="card-meta">
                                <span class="author">by <strong><?php the_author(); ?></strong></span>
                                <span class="date"><?php echo get_the_date('j M Y'); ?></span>
                            </div>
                        </div>
                    </a>
                </article>
                
                <?php 
                    endwhile; 
                    wp_reset_postdata();
                else : 
                ?>
                
                <!-- Placeholder cards if no posts exist -->
                <article class="masonry-card card-medium card-orange">
                    <div class="card-illustration">
                        <span class="card-icon">📚</span>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">
                            <a href="#">İlk məqalənizi yazın</a>
                        </h3>
                        <div class="card-excerpt">
                            WordPress admin panelindən yeni məqalə əlavə edin və burada görün.
                        </div>
                        <div class="card-meta">
                            <span class="card-category">Ümumi</span>
                            <span class="card-date"><?php echo date('d M Y'); ?></span>
                        </div>
                        <div class="card-footer">
                            <a href="<?php echo admin_url('post-new.php'); ?>" class="card-link">Məqalə yarat →</a>
                            <div class="card-rating">
                                <span class="rating-stars">⭐⭐⭐⭐⭐</span>
                                <span class="rating-number">5.0</span>
                            </div>
                        </div>
                    </div>
                </article>
                
                <?php endif; ?>
                
            </div>
            
            <!-- Load More Button -->
            <div class="masonry-load-more">
                <button class="load-more-btn" id="load-more">Daha çox məqalə</button>
            </div>
            
        </div>
    </main>

    <!-- Footer -->
    <footer class="masonry-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <span class="logo-s">s</span><span class="logo-o1">ö</span><span class="logo-z">z</span><span class="logo-l">l</span><span class="logo-u">ü</span><span class="logo-k">k</span>
                </div>
                <div class="footer-links">
                    <a href="#">Haqqımızda</a>
                    <a href="#">Əlaqə</a>
                    <a href="#">Gizlilik</a>
                </div>
                <div class="footer-social">
                    <a href="#" class="social-link">📧</a>
                    <a href="#" class="social-link">📱</a>
                    <a href="#" class="social-link">💬</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2023 Sözlük. Bütün hüquqlar qorunur.</p>
            </div>
        </div>
    </footer>

    <!-- Masonry JavaScript -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const grid = document.getElementById('masonry-container');
        const cards = grid.querySelectorAll('.masonry-card');
        
        // Simple masonry layout function
        function layoutMasonry() {
            const containerWidth = grid.offsetWidth;
            const cardWidth = 300; // Fixed card width
            const gap = 20;
            const columns = Math.floor(containerWidth / (cardWidth + gap));
            const columnHeights = new Array(columns).fill(0);
            
            cards.forEach((card, index) => {
                const shortestColumn = columnHeights.indexOf(Math.min(...columnHeights));
                const x = shortestColumn * (cardWidth + gap);
                const y = columnHeights[shortestColumn];
                
                card.style.position = 'absolute';
                card.style.left = x + 'px';
                card.style.top = y + 'px';
                card.style.width = cardWidth + 'px';
                
                columnHeights[shortestColumn] += card.offsetHeight + gap;
            });
            
            // Set container height
            grid.style.height = Math.max(...columnHeights) + 'px';
            grid.style.position = 'relative';
        }
        
        // Layout on load and resize
        layoutMasonry();
        window.addEventListener('resize', layoutMasonry);
        
        // Newsletter form
        const newsletterForm = document.querySelector('.newsletter-form');
        if (newsletterForm) {
            newsletterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Abunəlik tamamlandı! Təşəkkürlər.');
            });
        }
        
        // Load more button
        const loadMoreBtn = document.getElementById('load-more');
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', function() {
                alert('Yeni məqalələr yüklənir...');
            });
        }
    });
    </script>

    <?php wp_footer(); ?>
</body>
</html>