<?php get_header(); ?>

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

<?php get_footer(); ?>