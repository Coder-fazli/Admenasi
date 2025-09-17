/**
 * Sözlük Theme JavaScript
 */

jQuery(document).ready(function($) {
    
    // Smooth scrolling for internal links
    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 100
            }, 1000);
        }
    });
    
    // Add loading state to search form
    $('.search-form').on('submit', function() {
        var button = $(this).find('.search-button');
        var originalText = button.text();
        button.text('Axtarılır...').prop('disabled', true);
        
        // Re-enable after a delay (in case of redirect issues)
        setTimeout(function() {
            button.text(originalText).prop('disabled', false);
        }, 3000);
    });
    
    // Add hover effects to cards
    $('.category-card, .blog-card, .word-card').hover(
        function() {
            $(this).addClass('hovered');
        },
        function() {
            $(this).removeClass('hovered');
        }
    );
    
    // Alphabet navigation active state
    $('.alphabet-letter').on('click', function(e) {
        // Add visual feedback
        $(this).addClass('active').siblings().removeClass('active');
    });
    
    // Search suggestions (if needed in future)
    var searchTimeout;
    $('.search-input').on('input', function() {
        var query = $(this).val();
        
        clearTimeout(searchTimeout);
        
        if (query.length >= 2) {
            searchTimeout = setTimeout(function() {
                // Future: implement live search suggestions
                console.log('Searching for: ' + query);
            }, 500);
        }
    });
    
    // Back to top functionality
    var backToTop = $('<a href="#" class="back-to-top" style="display: none; position: fixed; bottom: 20px; right: 20px; background: #ff8c42; color: white; width: 50px; height: 50px; border-radius: 50%; text-align: center; line-height: 50px; font-weight: bold; text-decoration: none; z-index: 1000; transition: all 0.3s ease;">↑</a>');
    
    $('body').append(backToTop);
    
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            backToTop.fadeIn();
        } else {
            backToTop.fadeOut();
        }
    });
    
    backToTop.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop: 0}, 600);
    });
    
    // Stats counter animation (when in view)
    function animateStats() {
        $('.stats-number').each(function() {
            var $this = $(this);
            var text = $this.text();
            var number = parseInt(text.replace(/\D/g, ''));
            
            if (number && !$this.hasClass('animated')) {
                $this.addClass('animated');
                $this.text('0');
                
                $({countNum: 0}).animate({countNum: number}, {
                    duration: 2000,
                    easing: 'swing',
                    step: function() {
                        $this.text(Math.floor(this.countNum).toLocaleString() + ' söz');
                    },
                    complete: function() {
                        $this.text(number.toLocaleString() + ' söz');
                    }
                });
            }
        });
    }
    
    // Trigger stats animation when section is visible
    $(window).scroll(function() {
        var statsSection = $('.stats-section');
        if (statsSection.length) {
            var sectionTop = statsSection.offset().top;
            var windowBottom = $(window).scrollTop() + $(window).height();
            
            if (windowBottom > sectionTop + 100) {
                animateStats();
            }
        }
    });
    
    // Mobile menu toggle (if needed)
    $('.mobile-menu-toggle').on('click', function() {
        $('.primary-navigation').toggleClass('active');
        $(this).toggleClass('active');
    });
    
    // Form validation
    $('form').on('submit', function(e) {
        var form = $(this);
        var hasErrors = false;
        
        // Check required fields
        form.find('[required]').each(function() {
            var field = $(this);
            if (!field.val().trim()) {
                field.addClass('error');
                hasErrors = true;
            } else {
                field.removeClass('error');
            }
        });
        
        if (hasErrors) {
            e.preventDefault();
            alert('Zəhmət olmasa, bütün tələb olunan sahələri doldurun.');
        }
    });
    
    // Add loading overlay for page transitions
    function showLoading() {
        if (!$('.loading-overlay').length) {
            var overlay = $('<div class="loading-overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.9); z-index: 9999; display: flex; align-items: center; justify-content: center; font-size: 18px; color: #ff8c42;"><div>Yüklənir...</div></div>');
            $('body').append(overlay);
        }
    }
    
    function hideLoading() {
        $('.loading-overlay').remove();
    }
    
    // Show loading on form submit and link clicks
    $('form, a[href^="http"], a[href^="/"]').on('click submit', function(e) {
        // Don't show loading for internal page anchors
        if ($(this).is('a[href^="#"]')) return;
        
        setTimeout(showLoading, 100);
    });
    
    // Hide loading when page loads
    $(window).on('load', function() {
        hideLoading();
    });
    
    // Print functionality
    $('.print-word').on('click', function(e) {
        e.preventDefault();
        var wordCard = $(this).closest('.word-card');
        var content = wordCard.html();
        
        var printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <html>
            <head>
                <title>Söz Çapı</title>
                <style>
                    body { font-family: Arial, sans-serif; padding: 20px; }
                    .word-title { color: #2d3748; margin-bottom: 10px; }
                    .word-meaning { line-height: 1.6; }
                </style>
            </head>
            <body>${content}</body>
            </html>
        `);
        printWindow.document.close();
        printWindow.print();
    });
    
});

// Add CSS for error states and animations
var additionalCSS = `
    .error {
        border-color: #e53e3e !important;
        box-shadow: 0 0 0 3px rgba(229, 62, 62, 0.1) !important;
    }
    
    .hovered {
        transform: translateY(-2px) !important;
    }
    
    @media (max-width: 768px) {
        .back-to-top {
            bottom: 10px !important;
            right: 10px !important;
            width: 40px !important;
            height: 40px !important;
            line-height: 40px !important;
        }
    }
`;

// Inject additional CSS
var style = document.createElement('style');
style.textContent = additionalCSS;
document.head.appendChild(style);