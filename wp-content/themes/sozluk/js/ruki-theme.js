/**
 * Ruki Theme JavaScript
 * Based on the original Ruki theme functionality
 */

(function($) {
    'use strict';

    $(document).ready(function() {

        // Mobile menu toggle
        $('.toggle-menu').on('click', function(e) {
            e.preventDefault();
            $('body').toggleClass('slide-menu-active');
            $('.mobile-navigation').toggleClass('active');
        });

        // Search toggle
        $('.toggle-search').on('click', function(e) {
            e.preventDefault();

            if ($(this).hasClass('icon-cancel')) {
                // Close search
                $('.site-search').removeClass('active');
                $('body').removeClass('search-active');
            } else {
                // Open search
                $('.site-search').addClass('active');
                $('body').addClass('search-active');
                setTimeout(function() {
                    $('.search-field').focus();
                }, 300);
            }
        });

        // Close search on escape key
        $(document).on('keyup', function(e) {
            if (e.keyCode === 27) { // ESC key
                $('.site-search').removeClass('active');
                $('body').removeClass('search-active');
            }
        });

        // Close search when clicking outside
        $('.site-search').on('click', function(e) {
            if (e.target === this) {
                $(this).removeClass('active');
                $('body').removeClass('search-active');
            }
        });

        // Body fade overlay
        $('.body-fade').on('click', function() {
            $('body').removeClass('slide-menu-active');
            $('.mobile-navigation').removeClass('active');
        });

        // Smooth scroll for anchor links
        $('a[href^="#"]').on('click', function(e) {
            var target = $(this.getAttribute('href'));
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 600);
            }
        });

        // Sticky header functionality
        var header = $('.site-header');
        var headerHeight = header.outerHeight();
        var lastScrollTop = 0;

        $(window).on('scroll', function() {
            var scrollTop = $(this).scrollTop();

            if (scrollTop > headerHeight) {
                header.addClass('sticky');

                // Hide/show header on scroll
                if (scrollTop > lastScrollTop && scrollTop > headerHeight * 2) {
                    // Scrolling down
                    header.addClass('header-hidden');
                } else {
                    // Scrolling up
                    header.removeClass('header-hidden');
                }
            } else {
                header.removeClass('sticky header-hidden');
            }

            lastScrollTop = scrollTop;
        });

        // Masonry layout for posts (if needed)
        if ($('.masonry-container').length) {
            $('.masonry-container').imagesLoaded(function() {
                // Simple CSS Grid fallback - no JavaScript masonry needed
                // The CSS grid layout handles this automatically
            });
        }

        // Dropdown menu functionality
        $('.menu-item-has-children').on('mouseenter', function() {
            $(this).find('.sub-menu').addClass('show');
        }).on('mouseleave', function() {
            $(this).find('.sub-menu').removeClass('show');
        });

        // Mobile dropdown toggle
        $('.menu-item-has-children > a').on('click', function(e) {
            if ($(window).width() <= 768) {
                e.preventDefault();
                $(this).next('.sub-menu').slideToggle();
                $(this).parent().toggleClass('active');
            }
        });

        // Form enhancements
        $('.newsletter-form').on('submit', function(e) {
            var email = $(this).find('input[type="email"]').val();
            if (!email || !isValidEmail(email)) {
                e.preventDefault();
                alert('Zəhmət olmasa düzgün e-mail adresi daxil edin.');
            }
        });

        // Email validation
        function isValidEmail(email) {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Back to top button (optional)
        var backToTop = $('<button class="back-to-top" aria-label="Yuxarı qayıt"><i class="icon-up-open"></i></button>');
        $('body').append(backToTop);

        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 500) {
                backToTop.addClass('visible');
            } else {
                backToTop.removeClass('visible');
            }
        });

        backToTop.on('click', function() {
            $('html, body').animate({ scrollTop: 0 }, 600);
        });

        // Lazy loading for images (simple version)
        $('img[data-src]').each(function() {
            var img = $(this);
            img.attr('src', img.data('src')).removeAttr('data-src');
        });

        // Print styles
        window.addEventListener('beforeprint', function() {
            $('body').addClass('printing');
        });

        window.addEventListener('afterprint', function() {
            $('body').removeClass('printing');
        });

    });

    // Window resize handler
    $(window).on('resize', function() {
        // Close mobile menu on resize to desktop
        if ($(window).width() > 768) {
            $('body').removeClass('slide-menu-active');
            $('.mobile-navigation').removeClass('active');
            $('.site-search').removeClass('active');
        }
    });

})(jQuery);