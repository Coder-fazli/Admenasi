<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Axtarış nəticələri: <?php echo get_search_query(); ?> - <?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
    <style>
        .search-results-page {
            background: #f8f9fa;
            min-height: 100vh;
        }
        
        .search-header {
            background: white;
            padding: 2rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        
        .back-link {
            display: inline-flex;
            align-items: center;
            color: #ff8c42;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .back-link:hover {
            text-decoration: none;
            opacity: 0.8;
        }
        
        .search-title {
            font-size: 2rem;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }
        
        .search-info {
            color: #718096;
        }
        
        .results-container {
            display: grid;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .word-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .word-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
        }
        
        .word-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }
        
        .word-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d3748;
            margin: 0;
        }
        
        .word-category {
            background: rgba(255, 140, 66, 0.1);
            color: #ff8c42;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .word-meaning {
            color: #4a5568;
            line-height: 1.7;
            font-size: 1.1rem;
        }
        
        .no-results {
            text-align: center;
            padding: 4rem 0;
            color: #718096;
        }
        
        .no-results-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
        
        .alphabet-filter {
            background: white;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .filter-title {
            font-size: 0.875rem;
            color: #718096;
            margin-bottom: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .clear-filters {
            background: #e53e3e;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 600;
            display: inline-block;
            margin-top: 1rem;
        }
        
        .clear-filters:hover {
            background: #c53030;
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body <?php body_class(); ?>>

    <div class="search-header">
        <div class="container">
            <a href="<?php echo home_url(); ?>" class="back-link">← Ana səhifəyə qayıt</a>
            <h1 class="search-title">
                <?php 
                $search_query = get_search_query();
                $letter = get_query_var('letter');
                
                if ($letter) {
                    echo '"' . $letter . '" hərfi ilə başlayan sözlər';
                } elseif ($search_query) {
                    echo '"' . $search_query . '" üçün nəticələr';
                } else {
                    echo 'Bütün sözlər';
                }
                ?>
            </h1>
            
            <!-- Search Form -->
            <div style="margin: 2rem 0;">
                <form class="search-form" role="search" method="get" action="<?php echo home_url('/'); ?>">
                    <input type="text" class="search-input" placeholder="Yeni axtarış edin..." value="<?php echo get_search_query(); ?>" name="s">
                    <button type="submit" class="search-button">Axtar</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <?php 
        // Get custom search results
        $sozluk_results = get_query_var('sozluk_results');
        if (!$sozluk_results) {
            $sozluk_results = search_sozluk_words(get_search_query(), get_query_var('letter'));
        }
        
        $result_count = count($sozluk_results);
        ?>
        
        <?php if (get_query_var('letter') || get_search_query()): ?>
            <div class="alphabet-filter">
                <div class="filter-title">Hərflə filtrləmə</div>
                <div class="alphabet-nav">
                    <?php
                    $letters = range('A', 'Z');
                    foreach ($letters as $letter) {
                        $current_letter = get_query_var('letter');
                        $active_class = ($current_letter === $letter) ? 'active' : '';
                        $search_query = get_search_query();
                        
                        $url = add_query_arg(array(
                            'letter' => $letter,
                            's' => $search_query ? $search_query : null
                        ), home_url());
                        
                        echo '<a href="' . $url . '" class="alphabet-letter ' . $active_class . '">' . $letter . '</a>';
                    }
                    ?>
                </div>
                <a href="<?php echo home_url(); ?>" class="clear-filters">Filtrləri təmizlə</a>
            </div>
        <?php endif; ?>
        
        <p class="search-info">
            <?php echo $result_count; ?> nəticə tapıldı
            <?php if (get_query_var('letter')): ?>
                - "<?php echo get_query_var('letter'); ?>" hərfi üçün
            <?php endif; ?>
        </p>

        <?php if (!empty($sozluk_results)): ?>
            <div class="results-container">
                <?php foreach ($sozluk_results as $word): ?>
                    <article class="word-card">
                        <div class="word-header">
                            <h2 class="word-title"><?php echo esc_html($word['word']); ?></h2>
                            <?php if (!empty($word['category_name'])): ?>
                                <span class="word-category"><?php echo esc_html($word['category_name']); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="word-meaning">
                            <?php echo nl2br(esc_html($word['meaning'])); ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-results">
                <div class="no-results-icon">🔍</div>
                <h2>Heç bir nəticə tapılmadı</h2>
                <p>
                    <?php 
                    if (get_search_query()) {
                        echo 'Üzr istəyirik, "' . get_search_query() . '" sorğusu üçün heç bir nəticə tapılmadı.';
                    } elseif (get_query_var('letter')) {
                        echo '"' . get_query_var('letter') . '" hərfi ilə başlayan heç bir söz tapılmadı.';
                    } else {
                        echo 'Heç bir söz tapılmadı.';
                    }
                    ?>
                </p>
                <p><a href="<?php echo home_url(); ?>" class="stats-button">Ana səhifəyə qayıt</a></p>
            </div>
        <?php endif; ?>
    </div>

    <?php wp_footer(); ?>
</body>
</html>