function skyAddonsObserver(target, callback) {
    var options = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
    // Set the rootMargin to trigger when the target is 10% past the viewport
    options.rootMargin = options.rootMargin || '10% 0px 0px 0px';
    var observer = new IntersectionObserver(function (entries, observer) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                callback(entry);

                if (!options.loop)
                    observer.unobserve(entry.target); // Unobserve after the first intersection
            }
        });
    }, options);
    observer.observe(target);
}


(function ($, elementor) {
    'use strict';
    var $window = jQuery(window);


var widgetAdvancedAccordion = function ($scope, $) {
    var $advancedAccordion = $scope.find('.sa-advanced-accordion');
    var $settings = $advancedAccordion.data('settings');

    if (!$advancedAccordion.length) {
        return;
    }
    new Accordion('#' + $settings.id, {
        duration: $settings.duration,
        showMultiple: $settings.showMultiple,
        openOnInit: $settings.openOnInit,
        collapse: $settings.collapse,
        elementClass: 'sa-ac-item', // element class {string}
        triggerClass: 'sa-ac-trigger', // trigger class {string}
        panelClass: 'sa-ac-panel', // panel class {string}
        activeClass: 'is-active', // active element class {string}
//            beforeOpen: function (currentElement) {
//                console.log(currentElement);
//            },
//            onOpen: function (currentElement) {
//                console.log(currentElement);
//            },
//            beforeClose: function (currentElement) {
//                console.log(currentElement);
//            },
//            onClose: function (currentElement) {
//                console.log(currentElement);
//            },

    });
};

var widgetAdvancedSkillBars = function ($scope, $) {
    var $advancedSkillBars = $scope.find('.sa-advanced-skills'),
        $items = $scope.find('.sa-skill-item');

    if (!$advancedSkillBars.length) {
        return;
    }

    $items.each(function () {
        var $this = $(this);
        skyAddonsObserver($this[0], function () {
            var bar = $($advancedSkillBars).find(".sa-skill-progress-bar");

            bar.each(function () {
                $(this).css("width", function () {
                    var skillMaxValue = $(this).attr("data-max-value");
                    var skillFillVal = $(this).attr("data-width").slice(0, -1);
                    var result = (skillFillVal * 100) / skillMaxValue;
                    return result + '%';
                });
                $(this).children(".sa-skill-content-wrapper, .sa-skill-value").css({
                    '-webkit-transform': 'scale(1)',
                    '-moz-transform': 'scale(1)',
                    '-ms-transform': 'scale(1)',
                    '-o-transform': 'scale(1)',
                    'transform': 'scale(1)'
                });

                $(this).closest('.sa-skill-item').find('.sa-skill-value').prop('Counter', 0).animate({
                    Counter: $(this).attr("data-width")
                }, {
                    duration: 2600,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text(Math.ceil(now) + '%');
                    }
                });

            });
        }, {
            root: null, // Use the viewport as the root
            rootMargin: '0px', // No margin around the root
            threshold: 0.8 // 80% visibility (1 - 0.8)
        });
    });
};

var widgetAdvancedSlider = function ($scope, $) {
    var $slider = $scope.find('.sa-advanced-slider'),
        $sliderContainer = $slider.find('.swiper'),
        $settings = $slider.data('settings');

    if (!$slider.length) {
        return;
    }

    const Swiper = elementorFrontend.utils.swiper;
    initSwiper();
    async function initSwiper() {
        var swiper = await new Swiper($sliderContainer, $settings);
        if ($settings.pauseOnHover) {
            $($sliderContainer).hover(function () {
                (this).swiper.autoplay.stop();
            }, function () {
                (this).swiper.autoplay.start();
            });
        }
    };

};

var widgetImageCompare = function ($scope, $) {

    var $imageCompare = $scope.find('.sa-image-compare');
    var $settings = $imageCompare.data('settings');
    if (!$imageCompare.length) {
        return;
    }

    var viewers = document.querySelectorAll('#' + $settings.id);

    var options = {

        // UI Theme Defaults

        controlColor: $settings.controlColor, //"#FFFFFF"
        controlShadow: $settings.controlShadow, //true
        addCircle: $settings.addCircle, //false
        addCircleBlur: $settings.addCircleBlur, //false

        // Label Defaults

        showLabels: $settings.showLabels, //true
        labelOptions: {
            before: $settings.labelBefore, //'Before'
            after: $settings.labelAfter, //'After'
            onHover: $settings.labelOptionsonHover //false
        },
        // Smoothing

        smoothing: $settings.smoothing, //true
        smoothingAmount: $settings.smoothingAmount, //100

        // Other options

        hoverStart: $settings.hoverStart, //false,
        verticalMode: $settings.verticalMode, //false
        startingPoint: $settings.startingPoint, //50
        fluidMode: $settings.fluidMode //false
    };
    // Add your options object as the second argument
    viewers.forEach(function (element) {
        var view = new ImageCompare(element, options).mount();
    });
};

    var widgetMomentumSlider = function ($scope, $) {
        var $momentumSlider = $scope.find('.sa-momentum-slider'),
            $settings = $momentumSlider.data('settings'),
            slidersContainer = document.querySelector($settings.id),
            range = $settings.range;

        // Initializing the numbers slider
        var msNumbers = new MomentumSlider({
            el: slidersContainer,
            cssClass: 'ms--numbers',
            range: [1, range],
            rangeContent: function (i) {
                return '0' + i;
            },
            style: {
                transform: [{scale: [0.4, 1]}],
                opacity: [0, 1]
            },
            interactive: false
        });

        // Initializing the titles slider
        var titles = $settings.sliderTitles;
        var msTitles = new MomentumSlider({
            el: slidersContainer,
            cssClass: 'ms--titles',
            range: [0, range - 1],
            rangeContent: function (i) {
                return '<' + $settings.titleTag + ' class="ms-slide-title">' + titles[i] + '</' + $settings.titleTag + '>';
            },
            vertical: true,
            reverse: true,
            style: {
                opacity: [0, 1]
            },
            interactive: false
        });
        // Initializing the links slider
        var sliderAttrs = $settings.sliderAttr;
        var msLinks = new MomentumSlider({
            el: slidersContainer,
            cssClass: 'ms--links',
            range: [0, range - 1],
            rangeContent: function (i) {
                // var buttonLinksTarget = $settings.buttonLinksTarget[i] != false ? 'target="_blank"' : '';
//                return '<a href="'+buttonLinks[i]+'" '+buttonLinksTarget+' class="ms-slide__link sa-link">'+$settings.buttonText+'</a>';
                return '<a ' + sliderAttrs[i] + ' class="ms-slide__link sa-link sa-text-decoration-none">' + $settings.buttonText + '</a>';
            },
            vertical: true,
            interactive: false
        });
        // Get pagination items
        var pagination = document.querySelector('.momentum-slider-pagination');
        var paginationItems = [].slice.call(pagination.children);
        // Initializing the images slider

        var sliderImages = $settings.sliderImages;
        var msImages = new MomentumSlider({
            // Element to append the slider
            el: slidersContainer,
            // CSS class to reference the slider
            cssClass: 'ms--images',
            // Generate the 4 slides required
            range: [0, range - 1],
            rangeContent: function (i) {
                return '<div class="ms-slide__image-container"><div class="ms-slide__image" style="background-image: url(' + sliderImages[i] + ')"></div></div>';
//                return '<div class="ms-slide__image-container"><div class="ms-slide__image"><img src="' + sliderImages[i] + '"></div></div>';
            },
            // Syncronize the other sliders
            sync: [msNumbers, msTitles, msLinks],
            // Styles to interpolate as we move the slider
            style: {
                '.ms-slide__image': {
                    transform: [{scale: [1.5, 1]}]
                }
            },
            // Update pagination if slider change
            change: function (newIndex, oldIndex) {
                if (typeof oldIndex !== 'undefined') {
                    paginationItems[oldIndex].classList.remove('pagination__item--active');
                }
                paginationItems[newIndex].classList.add('pagination__item--active');
            }
        });
        // Select corresponding slider item when a pagination button is clicked
        pagination.addEventListener('click', function (e) {
            if (e.target.matches('.pagination__button')) {
                var index = paginationItems.indexOf(e.target.parentNode);
                msImages.select(index);
            }
        });
    };

var widgetPortionEffect = function ($scope, $) {
    var $portionEffect = $scope.find('.sa-portion-effect');
    var $settings = $portionEffect.data('settings');
    if (!$portionEffect.length) {
        return;
    }
    $portionEffect.find('.sa-side').css('background-image', 'url(' + $settings.image + ')');

};
var readingProgressFancyHorizontal = function ($scope, $) {

    var $readingProgress = $scope.find('.sa-reading-progress.sa-skin-fancy-horizontal');

    if (!$readingProgress.length) {
        return;
    }

    $(document).scroll(function (e) {
        var scrollAmount = $(window).scrollTop();
        var documentHeight = $(document).height();
        var windowHeight = $(window).height();
        var scrollPercent = (scrollAmount / (documentHeight - windowHeight)) * 100;
        var roundScroll = Math.round(scrollPercent);
        $($readingProgress).css("width", scrollPercent + "%");
        $($readingProgress).find("span").text(roundScroll);
    });
};

var readingProgressFancyVertical = function ($scope, $) {

    var $readingProgress = $scope.find('.sa-reading-progress.sa-skin-fancy-vertical');

    if (!$readingProgress.length) {
        return;
    }

    $(document).scroll(function (e) {
        var scrollAmount = $(window).scrollTop();
        var documentHeight = $(document).height();
        var windowHeight = $(window).height();
        var scrollPercent = (scrollAmount / (documentHeight - windowHeight)) * 100;
        var roundScroll = Math.round(scrollPercent);
        $($readingProgress).css("height", scrollPercent + "%");
        $($readingProgress).find("span").text(roundScroll);
    });
};


var readingProgressScrollTop = function ($scope, $) {
    var $readingProgress = $scope.find('.sa-reading-progress');

    if (!$readingProgress.length) {
        return;
    }

    var progressPath = document.querySelector('.sa-reading-progress.sa-skin-scroll-top path');
    var pathLength = progressPath.getTotalLength();
    progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
    progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
    progressPath.style.strokeDashoffset = pathLength;
    progressPath.getBoundingClientRect();
    progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
    var updateProgress = function () {
        var scroll = $(window).scrollTop();
        var height = $(document).height() - $(window).height();
        var progress = pathLength - (scroll * pathLength / height);
        progressPath.style.strokeDashoffset = progress;
    }
    updateProgress();
    $(window).scroll(updateProgress);
    var offset = 50;
    var duration = 550;
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > offset) {
            $($readingProgress).addClass('sa-active-progress');
        } else {
            $($readingProgress).removeClass('sa-active-progress');
        }

    });
    $('.sa-reading-progress.sa-skin-scroll-top').on('click', function (event) {
        event.preventDefault();
        $('html, body').animate({scrollTop: 0}, duration);
        return false;
    })

};

var readingProgressWithCursor = function ($scope, $) {
    var $readingProgress = $scope.find('.sa-reading-progress');

    if (!$readingProgress.length) {
        return;
    }
    document.getElementsByTagName("body")[0].addEventListener("mousemove", function (n) {
        t.style.left = n.clientX + "px",
                t.style.top = n.clientY + "px",
                e.style.left = n.clientX + "px",
                e.style.top = n.clientY + "px",
                i.style.left = n.clientX + "px",
                i.style.top = n.clientY + "px"
    });
    var t = document.querySelector('.sa-reading-progress.sa-skin-with-cursor'),
            e = document.querySelector('.sa-progress-with-cursor-2'),
            i = document.querySelector('.sa-progress-with-cursor-3');
    function n(t) {
        e.classList.add("hover"), i.classList.add("hover")
    }
    function s(t) {
        e.classList.remove("hover"), i.classList.remove("hover")
    }
    s();
    for (var r = document.querySelectorAll(".hover-target"), a = r.length - 1; a >= 0; a--) {
        o(r[a])
    }
    function o(t) {
        t.addEventListener("mouseover", n), t.addEventListener("mouseout", s)
    }

    $(document).ready(function () {
        var progressPath = document.querySelector('.sa-progress-wrap path');
        var pathLength = progressPath.getTotalLength();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
        progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
        progressPath.style.strokeDashoffset = pathLength;
        progressPath.getBoundingClientRect();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
        var updateProgress = function () {
            var scroll = $(window).scrollTop();
            var height = $(document).height() - $(window).height();
            var progress = pathLength - (scroll * pathLength / height);
            progressPath.style.strokeDashoffset = progress;
        }
        updateProgress();
        $(window).scroll(updateProgress);
    });
};

var widgetReadingProgress = function ($scope, $) {
    var $readingProgress = $scope.find('.sa-reading-progress.sa-skin-default');
    var $settings = $readingProgress.data('settings');

    if (!$readingProgress.length) {
        return;
    }

    $($settings.id).progress({size: $settings.size + 'px', wapperBg: $settings.secondaryColor, innerBg: $settings.primaryColor});

};

var widgetNumber = function ($scope, $) {
    var $number = $scope.find('.sa-number'),
        $settings = $number.data('settings');

    if (!$number.length) {
        return;
    }

    if ($settings.animation == 'no') {
        return;
    }

    skyAddonsObserver($scope[0], function () {
        $($number).find('.sa-text').prop('Counter', 0).animate({
            Counter: $settings.number
        }, {
            duration: $settings.time,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });

    }, {
        root: null, // Use the viewport as the root
        rootMargin: '0px', // No margin around the root
        threshold: 0.8 // 80% visibility (1 - 0.8)
    });
};

var widgetLogoCarousel = function ($scope, $) {

    var $logoCarousel = $scope.find('.sa-logo-carousel'),
        $carouselContainer = $logoCarousel.find('.swiper'),
        $settings = $logoCarousel.data('settings');
    // $settingsCarousel = $logoCarousel.data('carousel');

    if (!$logoCarousel.length) {
        return;
    }

    var $tooltips = $logoCarousel.find(' .sa-tippy-tooltip'),
        widgetID = $scope.data('id');

    $tooltips.each(function (index) {
        tippy(this, {
            allowHTML: true,
            theme: 'sa-tippy-' + widgetID
        });
    });

    const Swiper = elementorFrontend.utils.swiper;
    initSwiper();
    async function initSwiper() {
        var swiper = await new Swiper($carouselContainer, $settings);
        if ($settings.pauseOnHover) {
            $($carouselContainer).hover(function () {
                (this).swiper.autoplay.stop();
            }, function () {
                (this).swiper.autoplay.start();
            });
        }

        // if ($settingsCarousel.style == 'border') {
        //     console.log('sd');
        //    swiper.params.spaceBetween = 0;
        // }

    };

};

var widgetLogoGrid = function ($scope, $) {

    var $logoGrid = $scope.find('.sa-logo-grid');

    if (!$logoGrid.length) {
        return;
    }

    var $tooltips = $logoGrid.find(' .sa-tippy-tooltip'),
            widgetID = $scope.data('id');

    $tooltips.each(function (index) {
        tippy(this, {
            allowHTML: true,
            theme: 'sa-tippy-' + widgetID
        });
    });

};

var widgetPdfViewer = function ($scope, $) {
    var $pdfViewer = $scope.find('.sa-pdf-viewer'),
        $settings = $pdfViewer.data('settings'),
        $options = $pdfViewer.data('pdf-settings');

    if (!$pdfViewer.length) {
        return;
    }

    PDFObject.embed($settings.pdfUrl, $settings.id, $options);
};
var widgetContentSwitcher = function ($scope, $) {

    var $contentSwitcher = $scope.find('.sa-content-switcher'),
        $settings = $contentSwitcher.data('settings');

    if (!$contentSwitcher.length) {
        return;
    }

    var switcherToggle = $contentSwitcher.find('.sa-switcher-toggle'),
        checkbox = $($settings.checkbox),
        switcherWrapper = $contentSwitcher.find('.sa-switcher-wrap'),
        contentWrapper = $contentSwitcher.find('.sa-content-wrapper');

    if ($settings.type != 'button') {
        switcherToggle.on('click', function () {
            if (checkbox.is(':checked')) {
                switcherWrapper.find('.sa-switch-item').removeClass('sa-active');
                switcherWrapper.find('.sa-switch-item.sa-secondary').addClass('sa-active');

                contentWrapper.find('.sa-switch-content-item').removeClass('sa-active');
                contentWrapper.find('.sa-switch-content-item.sa-secondary').addClass('sa-active');
            } else {
                switcherWrapper.find('.sa-switch-item').removeClass('sa-active');
                switcherWrapper.find('.sa-switch-item.sa-primary').addClass('sa-active');

                contentWrapper.find('.sa-switch-content-item').removeClass('sa-active');
                contentWrapper.find('.sa-switch-content-item.sa-primary').addClass('sa-active');
            }
        });
    }

    if ($settings.type == 'button') {

        var borderSize = $settings.borderSize || 0,
            tabs = $contentSwitcher.find(".sa-switcher-tabs"),
            selector = $contentSwitcher.find(".sa-switcher-tabs").find("a").length,
            activeItem = tabs.find(".sa-active"),
            activeWidth = activeItem.innerWidth(),
            activeItemPos = $(activeItem).position();

        $contentSwitcher.find(".sa-selector").css({
            left: activeItemPos.left + "px",
            width: (activeWidth + borderSize) + "px"
        });

        $contentSwitcher.find(".sa-switcher-tabs").on("click", "a", function (e) {
            e.preventDefault();

            var id = $(this).data('id');

            switcherWrapper.find(".sa-switcher-tabs a").removeClass("sa-active");
            switcherWrapper.find(this).addClass("sa-active");

            contentWrapper.find('.sa-switch-content-item').removeClass('sa-active');
            contentWrapper.find('#' + id).addClass('sa-active');

            var activeWidth = $contentSwitcher.find(this).innerWidth();
            var itemPos = $contentSwitcher.find(this).position();
            $contentSwitcher.find(".sa-selector").css({
                left: itemPos.left + "px",
                width: (activeWidth + borderSize) + "px",
            });
        });

        if ($('body').hasClass('rtl')) {
             $contentSwitcher.find(".sa-switcher-tabs .sa-selector").css({
                 right: "auto",
             });
        }
        
    }

};
var widgetGlobalCarousel = function ($scope, $) {

    var $carousel = $scope.find('.sa-swiper-global-carousel'),
        $carouselContainer = $carousel.find('.swiper'),
        $settings = $carousel.data('settings');

    if (!$carousel.length) {
        return;
    }

    const Swiper = elementorFrontend.utils.swiper;
    initSwiper();
    async function initSwiper() {
        var swiper = await new Swiper($carouselContainer, $settings);
        if ($settings.pauseOnHover) {
            $($carouselContainer).hover(function () {
                (this).swiper.autoplay.stop();
            }, function () {
                (this).swiper.autoplay.start();
            });
        }

    };

};

var widgetGlorySlider = function ($scope, $) {

    var $glorySlider = $scope.find('.sa-glory-slider'),
        $playerContainer = $glorySlider.find('.sa-glory-player'),
        $thumbsContainer = $glorySlider.find('.sa-glory-thumbs'),
        $playerSettings = $glorySlider.data('player-settings'),
        $thumbsSettings = $glorySlider.data('thumbs-settings');

    if (!$glorySlider.length) {
        return;
    }

    const Swiper = elementorFrontend.utils.swiper;
    initSwiper();
    async function initSwiper() {

        var playerThumbs = await new Swiper($thumbsContainer, $thumbsSettings);

        var player = await new Swiper($playerContainer, $playerSettings);

        player.controller.control = playerThumbs;
        playerThumbs.controller.control = player;

        var testWidth = $glorySlider.find('.sa-glory-player .swiper-slide-active').width();
        $glorySlider.find('.sa-glory-thumbs').width(testWidth);

        player.on('slideChange', function () {
            resetVideos();
        });
    };


    function resetVideos() {
        $($glorySlider).find('.sa-video-player').css('z-index', -1);
        var videos = $($glorySlider).find('.sa-player-iframe');
        Array.prototype.forEach.call(videos, function (video) {
            var src = video.src;
            video.src = src.replace("?autoplay=1", "");
            $($glorySlider).find('.sa-player-iframe').prop("src", "");
        });
    }

    $('.sa-play-button').on('click', function () {
        var videoURL = $(this).data('src').split('?')[0]; // also removed @param
        var sliderWrapper = $(this).closest('.sa-player-wrapper');
        sliderWrapper.find('.sa-player-iframe').attr("src", videoURL + "?autoplay=1");
        sliderWrapper.find('.sa-video-player').css('z-index', 10);

    });

};
var widgetTableOfContents = function ($scope, $) {

    var $tableOfContent = $scope.find('.sa-table-of-contents'),
        $settings = $tableOfContent.data('settings'),
        editMode = Boolean(elementorFrontend.isEditMode());

    if (!$tableOfContent.length) {
        return;
    }

    var sections = [];

    var TOCObj = {
        buildLink: function (e) {
            var specialChars = '!@#$^&%*()+=-[]\/{}|:<>?,.',
                rawText = e,
                url = rawText.replace(/\s+/g, '-').toLowerCase();
            url = url.replace(/[^a-zA-Z0-9_-]/g, '');
            url = url.replace(new RegExp("\\" + specialChars, "g"), "");
            return url;
        },
        scrollEvt: function (hash) {
            $('html, body').animate({
                scrollTop: $('#' + hash).offset().top - 100
            }, $settings.animateTime);
        },
        autoScroll: function () {
            if (window.location.hash) {
                var hash = window.location.hash;
                hash = hash.substring(1);
                this.scrollEvt(hash);
            }
        },
        autoHash: function () {
            const Obj = this;
            var id = false;
            $(window).scroll(function (e) {
                /**
                 * scrollTop retains the value of the scroll top with the reference at the middle of the page
                 */
                var scrollTop = $(this).scrollTop() + ($(window).height() / 2);
                /**
                 * cycle through the values in sections array
                 */

                for (var i in sections) {
                    var section = sections[i];

                    /**
                     * if scrollTop variable is bigger than the top offset of a section in the sections array then 
                     */
                    if (scrollTop > $('#' + section).offset().top) {
                        var scrolled_id = '#' + section;
                    }
                }
                if (scrolled_id !== id) {
                    id = scrolled_id;

                    var rawText = $(id).text();
                    var url = Obj.buildLink(rawText);
                    window.location.hash = url;

                }
            });
        },
        createNav: function () {
            const Obj = this;
            var newLine, title;

            var ToC =
                '<nav role="navigation" class="sa-table-of-contents-wrapper"><ul class="sa-m-0 sa-p-0">';

            $($settings.parentSelector).find($settings.headingSelectors).each(function (index) {
                let el = $(this);
                title = el.text();
                let elementId = $settings.id + '-' + index;
                let linkTitle = Obj.buildLink(title);
                el.attr('id', linkTitle);
                newLine = '<li>' + '<a href="#' + linkTitle + '"  data-toc-target="' + elementId + '">' + title + '</a>' + '</li>';

                ToC += newLine;
                sections.push(linkTitle);
            });

            ToC += '</ul></nav>';

            $($tableOfContent).prepend(ToC);

            $tableOfContent.find('a').on('click', function (e) {
                e.preventDefault();
                let hash = $(this).attr('href').substring(1);
                Obj.scrollEvt(hash);

                if (!$settings.autoHash) {
                    window.location.hash = hash;
                }
            });
        },
        init: function () {
            const Obj = this;
            Obj.createNav();
            $(document).ready(function () {
                Obj.autoScroll();
            });
            if ($settings.autoHash && editMode === false) {
                Obj.autoHash();
            }
        }
    }

    TOCObj.init();


};
var widgetPanelSlider = function ($scope, $) {
    var $panelSlider = $scope.find('.sa-panel-slider'),
        $panelSliderContainer = $panelSlider.find('.swiper'),
        $settings = $panelSlider.data('settings');

    if (!$panelSlider.length) {
        return;
    }
    const Swiper = elementorFrontend.utils.swiper;
    initSwiper();
    async function initSwiper() {

        var sliderThumbs = await new Swiper($panelSliderContainer, $settings);

        if ($settings.pauseOnHover) {
            $($panelSlider).hover(function () {
                sliderThumbs.autoplay.stop();
            }, function () {
                sliderThumbs.autoplay.start();
            });
        }

        var $sliderSettings = $panelSlider.data('slider-settings');

        if ('hover' == $sliderSettings.showContent) {
            $panelSlider.find('.swiper-slide').on('mouseover', function () {
                $(this).siblings().removeClass('sa-active');
                $(this).addClass('sa-active');
            })
            $panelSlider.find('.swiper-slide').on('mouseleave', function () {
                $(this).siblings().removeClass('sa-active');
                $(this).removeClass('sa-active');
            })
        }

        if ('active_hover' == $sliderSettings.showContent) {
            $panelSlider.find('.swiper-slide').on('mouseover', function () {
                $(this).addClass('sa-active');
            })
            $panelSlider.find('.swiper-slide').on('mouseleave', function () {
                if ($(this).hasClass('swiper-slide-active') !== true) {
                    $(this).removeClass('sa-active');
                }
            })
        }

        if ('active' == $sliderSettings.showContent || 'active_hover' == $sliderSettings.showContent) {
            $panelSlider.find('.swiper-slide.swiper-slide-active').siblings().removeClass('sa-active');
            $panelSlider.find('.swiper-slide.swiper-slide-active').addClass('sa-active');

            sliderThumbs.on('slideChangeTransitionEnd', function (e) {
                $panelSlider.find('.swiper-slide.swiper-slide-active').siblings().removeClass('sa-active');
                $panelSlider.find('.swiper-slide.swiper-slide-active').addClass('sa-active');
            });
        }

        if ('always' == $sliderSettings.showContent) {
            $panelSlider.find('.swiper-slide').addClass('sa-active');
        }

    };

};

var widgetFellowSlider = function ($scope, $) {

    var $fellowSlider = $scope.find('.sa-fellow-slider'),
        $fellowContainer = $fellowSlider.find('.sa-fellow.swiper'),
        $itemsContainer = $fellowSlider.find('.sa-fellow-items.swiper'),
        $playerSettings = $fellowSlider.data('player-settings'),
        $listSettings = $fellowSlider.data('playlist-settings');

    if (!$fellowSlider.length) {
        return;
    }

    const Swiper = elementorFrontend.utils.swiper;
    initSwiper();
    async function initSwiper() {

        var playerItems = await new Swiper($itemsContainer, $listSettings);

        var player = await new Swiper($fellowContainer, $playerSettings);

        player.controller.control = playerItems;
        playerItems.controller.control = player;

        if ($playerSettings.pauseOnHover) {
            $($fellowContainer).hover(function () {
                (this).swiper.autoplay.stop();
            }, function () {
                (this).swiper.autoplay.start();
            });
        }
    };
};

var widgetMateSlider = function ($scope, $) {

    var $dataWrapper = $scope.find('.sa-mate-slider'),
        $primaryContainer = $dataWrapper.find('.sa-mate-primary.swiper'),
        $secondaryContainer = $dataWrapper.find('.sa-mate-secondary.swiper'),
        $primarySettings = $dataWrapper.data('primary-settings'),
        $secondarySettings = $dataWrapper.data('secondary-settings');

    if (!$dataWrapper.length) {
        return;
    }

    const Swiper = elementorFrontend.utils.swiper;
    initSwiper();
    async function initSwiper() {

        var secondary = await new Swiper($secondaryContainer, $secondarySettings);

        var primary = await new Swiper($primaryContainer, $primarySettings);

        primary.controller.control = secondary;
        secondary.controller.control = primary;

        if ($primarySettings.pauseOnHover) {
            $($fellowContainer).hover(function () {
                (this).swiper.autoplay.stop();
            }, function () {
                (this).swiper.autoplay.start();
            });
        }
    };
};

var widgetSlinkyMenu = function ($scope, $) {
    var $slinkyMenu = $scope.find('.sa-slinky-menu');
    var $settings = $slinkyMenu.data('settings');

    if (!$slinkyMenu.length) {
        return;
    }

    $($slinkyMenu).removeClass('sa-d-none');

    var options = {};
    options.resize = true;
    // options.linkTitle = true;
    if ($settings.speed) {
        options.speed = $settings.speed;
    }
    if ($settings.title) {
        options.title = true;
    }

    $($settings.id).slinky(options);

};
var widgetStellarSlider = function ($scope, $) {

    var $stellarSlider = $scope.find('.sa-stellar-slider'),
        $container     = $stellarSlider.find('.swiper'),
        $settings      = $stellarSlider.data('settings');

    if (!$stellarSlider.length) {
        return;
    }

    const Swiper = elementorFrontend.utils.swiper;
    initSwiper();
    async function initSwiper() {

        var slider = await new Swiper($container, $settings);

        if ($settings.pauseOnHover) {
            $($stellarSlider).hover(function () {
                (this).swiper.autoplay.stop();
            }, function () {
                (this).swiper.autoplay.start();
            });
        }
    };
};

var widgetAnimatedHeading = function ($scope, $) {

    var $animatedHeading = $scope.find('.sa-animated-heading');
    var $settings = $animatedHeading.data('settings');
    if (!$animatedHeading.length) {
        return;
    }

    skyAddonsObserver($scope[0], function () {
        var selector = $($animatedHeading).data('id');
        if ('typed' === $settings.style) {
            delete $settings.style;
            new Typed('#' + selector, $settings);
        } else {
            delete $settings.style;
            $('#' + selector).Morphext($settings);
        }
    }, {
        root: null, // Use the viewport as the root
        rootMargin: '0px', // No margin around the root
        threshold: 0.8 // 80% visibility (1 - 0.8)
    });

};

var widgetAudioPlayer = function ($scope, $) {
    var $audioPlayer = $scope.find('.sa-audio-player');
    var $settings = $audioPlayer.data('settings');

    if (!$audioPlayer.length) {
        return;
    }

    console.log($settings.id);
    
    const player = new Plyr($settings.id + '-player');
   
};

    var fnHanlders = {
        'sky-portion-effect.default': widgetPortionEffect,
        'sky-image-compare.default': widgetImageCompare,
        'sky-momentum-slider.default': widgetMomentumSlider,
        'sky-advanced-skill-bars.default': widgetAdvancedSkillBars,
        'sky-reading-progress.default': widgetReadingProgress,
        'sky-reading-progress.sky-skin-fancy-horizontal': readingProgressFancyHorizontal,
        'sky-reading-progress.sky-skin-fancy-vertical': readingProgressFancyVertical,
        'sky-reading-progress.sky-skin-scroll-top': readingProgressScrollTop,
        'sky-reading-progress.sky-skin-with-cursor': readingProgressWithCursor,
        'sky-advanced-accordion.default': widgetAdvancedAccordion,
        'sky-advanced-slider.default': widgetAdvancedSlider,
        'sky-number.default': widgetNumber,
        'sky-logo-carousel.default': widgetLogoCarousel,
        'sky-logo-grid.default': widgetLogoGrid,
        'sky-pdf-viewer.default': widgetPdfViewer,
        'sky-content-switcher.default': widgetContentSwitcher,
        'sky-glory-slider.default': widgetGlorySlider,
        'sky-table-of-contents.default': widgetTableOfContents,
        'sky-panel-slider.default': widgetPanelSlider,
        'sky-fellow-slider.default': widgetFellowSlider,
        'sky-mate-slider.default': widgetMateSlider,
        'sky-slinky-menu.default': widgetSlinkyMenu,
        'sky-stellar-slider.default': widgetStellarSlider,
        'sky-animated-heading.default': widgetAnimatedHeading,
        'sky-audio-player.default': widgetAudioPlayer,


        /**
         * Global Carousel
         */
        'sky-sapling-carousel.default': widgetGlobalCarousel,
        'sky-luster-carousel.default': widgetGlobalCarousel,
        'sky-mate-carousel.default': widgetGlobalCarousel,
        'sky-naive-carousel.default': widgetGlobalCarousel,
        'sky-ultra-carousel.default': widgetGlobalCarousel,
        'sky-generic-carousel.default': widgetGlobalCarousel,

        /**
         * pro widgets
         * They are here because of Global JS
         */
        'sky-review-carousel.default': widgetGlobalCarousel,
        'sky-testimonial-carousel.default': widgetGlobalCarousel,
        'sky-wc-category-carousel.default': widgetGlobalCarousel,

    };

    $window.on('elementor/frontend/init', function () {
        $.each(fnHanlders, function (widgetName, handlerFn) {
            elementorFrontend.hooks.addAction('frontend/element_ready/' + widgetName, handlerFn);
        });
    });


    }(jQuery, window.elementorFrontend));

;
(function ($) {
    var $window = $(window),
        debounce = function (func, wait, immediate) {
            // 'private' variable for instance
            // The returned function will be able to reference this due to closure.
            // Each call to the returned function will share this common timer.
            var timeout;

            // Calling debounce returns a new anonymous function
            return function () {
                // reference the context and args for the setTimeout function
                var context = this,
                    args = arguments;

                // Should the function be called now? If immediate is true
                //   and not already in a timeout then the answer is: Yes
                var callNow = immediate && !timeout;

                // This is the basic debounce behaviour where you can call this
                //   function several times, but it will only execute once
                //   [before or after imposing a delay].
                //   Each time the returned function is called, the timer starts over.
                clearTimeout(timeout);

                // Set the new timeout
                timeout = setTimeout(function () {

                    // Inside the timeout function, clear the timeout variable
                    // which will let the next execution run when in 'immediate' mode
                    timeout = null;

                    // Check if the function already ran with the immediate flag
                    if (!immediate) {
                        // Call the original function with apply
                        // apply lets you define the 'this' object as well as the arguments
                        //    (both captured before setTimeout)
                        func.apply(context, args);
                    }
                }, wait);

                // Immediate mode and no wait timer? Execute the function..
                if (callNow)
                    func.apply(context, args);
            };
        };
    $window.on('elementor/frontend/init', function () {
        var ModuleHandler = elementorModules.frontend.handlers.Base,
            FloatingEffects;

        FloatingEffects = ModuleHandler.extend({

            bindEvents: function () {
                this.run();
            },

            getDefaultSettings: function () {
                return {
                    direction: 'alternate',
                    easing: 'easeInOutSine',
                    loop: true
                };
            },

            settings: function (key) {
                return this.getElementSettings('sa_floating_ef_' + key);
            },

            onElementChange: debounce(function (prop) {
                if (prop.indexOf('sa_floating') !== -1) {
                    this.anime && this.anime.restart();
                    this.run();
                }
            }, 400),

            run: function () {
                var options = this.getDefaultSettings(),
                    element = this.findElement('.elementor-widget-container').get(0);

                options.targets = element;

                if (this.settings('enable') !== 'yes') {
                    return;
                }

                //                if (this.settings('translate_x.sizes.from').length !== 0 || this.settings('translate_x.sizes.to').length !== 0) {}

                if (this.settings('translate_toggle')) {
                    if (this.settings('translate_x.sizes.from').length !== 0 || this.settings('translate_x.sizes.to').length !== 0) {
                        options.translateX = {
                            value: [this.settings('translate_x.sizes.from') || 0, this.settings('translate_x.size') || this.settings('translate_x.sizes.to')],
                            duration: this.settings('translate_duration.size'),
                            delay: this.settings('translate_delay.size') || 0
                        };
                    }
                    if (this.settings('translate_y.sizes.from').length !== 0 || this.settings('translate_y.sizes.to').length !== 0) {
                        options.translateY = {
                            value: [this.settings('translate_y.sizes.from') || 0, this.settings('translate_y.size') || this.settings('translate_y.sizes.to')],
                            duration: this.settings('translate_duration.size'),
                            delay: this.settings('translate_delay.size') || 0
                        };
                    }
                }

                if (this.settings('rotate_toggle')) {
                    if (this.settings('rotate_x.sizes.from').length !== 0 || this.settings('rotate_x.sizes.to').length !== 0) {
                        options.rotateX = {
                            value: [this.settings('rotate_x.sizes.from') || 0, this.settings('rotate_x.size') || this.settings('rotate_x.sizes.to')],
                            duration: this.settings('rotate_duration.size'),
                            delay: this.settings('rotate_delay.size') || 0
                        };
                    }
                    if (this.settings('rotate_y.sizes.from').length !== 0 || this.settings('rotate_y.sizes.to').length !== 0) {
                        options.rotateY = {
                            value: [this.settings('rotate_y.sizes.from') || 0, this.settings('rotate_y.size') || this.settings('rotate_y.sizes.to')],
                            duration: this.settings('rotate_duration.size'),
                            delay: this.settings('rotate_delay.size') || 0
                        };
                    }
                    if (this.settings('rotate_z.sizes.from').length !== 0 || this.settings('rotate_z.sizes.to').length !== 0) {
                        options.rotateZ = {
                            value: [this.settings('rotate_z.sizes.from') || 0, this.settings('rotate_z.size') || this.settings('rotate_z.sizes.to')],
                            duration: this.settings('rotate_duration.size'),
                            delay: this.settings('rotate_delay.size') || 0
                        };
                    }
                }

                if (this.settings('scale_toggle')) {
                    if (this.settings('scale_x.sizes.from').length !== 0 || this.settings('scale_x.sizes.to').length !== 0) {
                        options.scaleX = {
                            value: [this.settings('scale_x.sizes.from') || 0, this.settings('scale_x.size') || this.settings('scale_x.sizes.to')],
                            duration: this.settings('scale_duration.size'),
                            delay: this.settings('scale_delay.size') || 0
                        };
                    }
                    if (this.settings('scale_y.sizes.from').length !== 0 || this.settings('scale_y.sizes.to').length !== 0) {
                        options.scaleY = {
                            value: [this.settings('scale_y.sizes.from') || 0, this.settings('scale_y.size') || this.settings('scale_y.sizes.to')],
                            duration: this.settings('scale_duration.size'),
                            delay: this.settings('scale_delay.size') || 0
                        };
                    }
                }

                if (this.settings('skew_toggle')) {
                    if (this.settings('skew_x.sizes.from').length !== 0 || this.settings('skew_x.sizes.to').length !== 0) {
                        options.skewX = {
                            value: [this.settings('skew_x.sizes.from') || 0, this.settings('skew_x.size') || this.settings('skew_x.sizes.to')],
                            duration: this.settings('skew_duration.size'),
                            delay: this.settings('skew_delay.size') || 0
                        };
                    }
                    if (this.settings('skew_y.sizes.from').length !== 0 || this.settings('skew_y.sizes.to').length !== 0) {
                        options.skewY = {
                            value: [this.settings('skew_y.sizes.from') || 0, this.settings('skew_y.size') || this.settings('skew_y.sizes.to')],
                            duration: this.settings('skew_duration.size'),
                            delay: this.settings('skew_delay.size') || 0
                        };
                    }
                }

                if (this.settings('easing')) {
                    options.easing = this.settings('easing');
                }

                if (
                    this.settings('translate_toggle') ||
                    this.settings('rotate_toggle') ||
                    this.settings('scale_toggle') ||
                    this.settings('skew_toggle')
                ) {
                    this.anime = window.anime && window.anime(options);
                }

            }
        });


        elementorFrontend.hooks.addAction('frontend/element_ready/widget', function ($scope) {
            elementorFrontend.elementsHandler.addHandler(FloatingEffects, {
                $element: $scope
            });
        });
    });

}(jQuery));
jQuery('body').on('click', '.sa-element-link', function () {
    var timeout,
        $element = jQuery(this),
        data = $element.data('sa-element-link'),
        id = 'sa-element-link-' + $element.data('id'),
        idSelector = '#' + id;

    if (jQuery(idSelector).length === 0) {
        var options = {
            href: data.url,
            target: data.is_external ? '_blank' : '_self',
            class: 'sa-d-none',
            id: id,
            rel: data.nofollow ? 'nofollow noreferer' : ''
        };

        jQuery('body').append(
            jQuery(document.createElement('a')).prop(options)
        );

        jQuery(idSelector)[0].click();

        timeout = setTimeout(function () {
            jQuery('body').find(idSelector).remove();
            clearTimeout(timeout);
        }, 1000);

    }

});
;
(function ($) {
    var $window = $(window),
        debounce = function (func, wait, immediate) {
            // 'private' variable for instance
            // The returned function will be able to reference this due to closure.
            // Each call to the returned function will share this common timer.
            var timeout;

            // Calling debounce returns a new anonymous function
            return function () {
                // reference the context and args for the setTimeout function
                var context = this,
                    args = arguments;

                // Should the function be called now? If immediate is true
                //   and not already in a timeout then the answer is: Yes
                var callNow = immediate && !timeout;

                // This is the basic debounce behaviour where you can call this
                //   function several times, but it will only execute once
                //   [before or after imposing a delay].
                //   Each time the returned function is called, the timer starts over.
                clearTimeout(timeout);

                // Set the new timeout
                timeout = setTimeout(function () {

                    // Inside the timeout function, clear the timeout variable
                    // which will let the next execution run when in 'immediate' mode
                    timeout = null;

                    // Check if the function already ran with the immediate flag
                    if (!immediate) {
                        // Call the original function with apply
                        // apply lets you define the 'this' object as well as the arguments
                        //    (both captured before setTimeout)
                        func.apply(context, args);
                    }
                }, wait);

                // Immediate mode and no wait timer? Execute the function..
                if (callNow)
                    func.apply(context, args);
            };
        };
    $window.on('elementor/frontend/init', function () {
        var ModuleHandler = elementorModules.frontend.handlers.Base,
            EqualHeight;

        EqualHeight = ModuleHandler.extend({

            isDisabledOnDevice: function () {
                var windowWidth = $window.outerWidth(),
                    tabletWidth = elementorFrontendConfig.breakpoints.lg,
                    mobileWidth = elementorFrontendConfig.breakpoints.md;

                if (this.getElementSettings('sa_eqh_disable_on_mobile') == 'yes' && windowWidth < mobileWidth) {
                    return true;
                }

                if (this.getElementSettings('sa_eqh_disable_on_tablet') == 'yes' && windowWidth >= mobileWidth && windowWidth < tabletWidth) {
                    return true;
                }
                return false;
            },

            bindEvents: function () {
                this.run();
                $window.on('resize orientationchange', debounce(this.run.bind(this), 100));
            },

            getDefaultSettings: function () {
                return {
                    byRow: true
                };
            },

            settings: function (key) {
                return this.getElementSettings('sa_eqh_' + key);
            },

            onElementChange: debounce(function (prop) {
                if (prop.indexOf('sa_eqh_') !== -1) {
                    // this.removeMatchHeight(true);
                    this.run();
                }
            }, 400),

            removeMatchHeight: function (el) {
                if (el) {
                    console.log(el);
                    $(el).matchHeight({
                        remove: true
                    });
                }
            },

            run: function () {
                var options = this.getDefaultSettings(),
                    elementID = this.getID(),
                    elementContainer = $('.elementor-element-' + elementID),
                    elementEql = 'sa-eqh-' + elementID,
                    element = '.sa-eqh-' + elementID;

                if (this.settings('enable') !== 'yes') {
                    return;
                }

                if (this.settings('apply_elements') == 'widgets') {
                    //Widgets > 1st Element
                    elementContainer.find('.elementor-widget-container').addClass(elementEql);
                } else if (this.settings('apply_elements') == 'widgets_1st') {
                    //Widgets > 1st Element
                    elementContainer.find('.elementor-widget-container > :nth-child(1)').addClass(elementEql);
                } else if (this.settings('apply_elements') == 'widgets_1st_2nd') {
                    //Widgets > 2nd Element
                    elementContainer.find('.elementor-widget-container > :nth-child(2)').addClass(elementEql);
                } else if (this.settings('apply_elements') == 'widgets_1st_3rd') {
                    //Widgets > 3rd Element
                    elementContainer.find('.elementor-widget-container > :nth-child(3)').addClass(elementEql);
                } else if (this.settings('apply_elements') == 'widgets_2nd') {
                    //Widgets > Child > 1st Element
                    elementContainer.find('.elementor-widget-container > :nth-child(1) > :nth-child(1)').addClass(elementEql);
                } else if (this.settings('apply_elements') == 'widgets_2nd_2nd') {
                    //Widgets > Child > 2nd Element
                    elementContainer.find('.elementor-widget-container > :nth-child(1) > :nth-child(2)').addClass(elementEql);
                } else if (this.settings('apply_elements') == 'widgets_3rd') {
                    //Widgets > Child > Child > 1st Element
                    elementContainer.find('.elementor-widget-container > :nth-child(1) > :nth-child(1) > :nth-child(1)').addClass(elementEql);
                } else {
                    //custom
                    if (this.settings('apply_elements_custom')) {
                        elementContainer.find(this.settings('apply_elements_custom')).addClass(elementEql);
                    }
                }

                // todo target
                // foreach diye 1st, 2nd, 3rd ante hobe for target
                // options.target = $('#test').find('.elementor-widget-container');
                // todo column

                if (this.settings('css_property') == 'min_height') {
                    options.property = 'min-height';
                }

                if (this.isDisabledOnDevice()) {
                    this.removeMatchHeight(element);
                } else {
                    $(element).matchHeight(options);
                }

            }
        });


        elementorFrontend.hooks.addAction('frontend/element_ready/section', function ($scope) {
            elementorFrontend.elementsHandler.addHandler(EqualHeight, {
                $element: $scope
            });
        });

        elementorFrontend.hooks.addAction('frontend/element_ready/container', function ($scope) {
            elementorFrontend.elementsHandler.addHandler(EqualHeight, {
                $element: $scope
            });
        });

    });

}(jQuery));
;
(function ($) {
    var $window = $(window),
        debounce = function (func, wait, immediate) {
            // 'private' variable for instance
            // The returned function will be able to reference this due to closure.
            // Each call to the returned function will share this common timer.
            var timeout;

            // Calling debounce returns a new anonymous function
            return function () {
                // reference the context and args for the setTimeout function
                var context = this,
                    args = arguments;

                // Should the function be called now? If immediate is true
                //   and not already in a timeout then the answer is: Yes
                var callNow = immediate && !timeout;

                // This is the basic debounce behaviour where you can call this
                //   function several times, but it will only execute once
                //   [before or after imposing a delay].
                //   Each time the returned function is called, the timer starts over.
                clearTimeout(timeout);

                // Set the new timeout
                timeout = setTimeout(function () {

                    // Inside the timeout function, clear the timeout variable
                    // which will let the next execution run when in 'immediate' mode
                    timeout = null;

                    // Check if the function already ran with the immediate flag
                    if (!immediate) {
                        // Call the original function with apply
                        // apply lets you define the 'this' object as well as the arguments
                        //    (both captured before setTimeout)
                        func.apply(context, args);
                    }
                }, wait);

                // Immediate mode and no wait timer? Execute the function..
                if (callNow)
                    func.apply(context, args);
            };
        };
    $window.on('elementor/frontend/init', function () {
        var ModuleHandler = elementorModules.frontend.handlers.Base,
            AnimatedGradientBg;

        AnimatedGradientBg = ModuleHandler.extend({

            bindEvents: function () {
                this.run();
            },

            getDefaultSettings: function () {
                return {
                    direction: 'left-right',
                    isPausedWhenNotInView: true,
                };
            },

            settings: function (key) {
                return this.getElementSettings('sa_agbg_' + key);
            },

            onElementChange: debounce(function (prop) {
                if (prop.indexOf('sa_agbg_') !== -1) {
                    if ($('#' + this.Granim).length) {
                        $('#' + this.Granim).remove();
                    }
                    this.run();
                }
            }, 400),

            run: function () {
                var options = this.getDefaultSettings(),
                    elementID = this.getID(),
                    elementContainer = $('.elementor-element-' + elementID),
                    element = 'sa-agbg-' + elementID;

                if (this.settings('enable') !== 'yes') {
                    return;
                }

                if ($(this.$element).hasClass('elementor-widget')) {
                    elementContainer = $('.elementor-element-' + elementID).find('.elementor-widget-container');
                    elementContainer.css({
                        'position': 'relative',
                        'overflow': 'hidden',
                    });
                }

                if ($(this.$element).hasClass('elementor-column')) {
                    elementContainer = $('.elementor-element-' + elementID).find('.elementor-column-wrap');
                    elementContainer.css({
                        // 'position' : 'relative',
                        'overflow': 'hidden',
                    });
                }

                elementContainer.prepend('<canvas id="' + element + '" class="sa-animated-gradient-bg sa-d-block sa-w-100 sa-h-100"></canvas>');

                $('.sa-animated-gradient-bg').css({
                    'position': 'absolute',
                    'top': 0,
                    'right': 0,
                    'bottom': 0,
                    'left': 0,
                    'pointer-events': 'none',
                });

                options.element = '#' + element;

                if (this.settings('direction')) {
                    options.direction = this.settings('direction');
                }

                let $color_list = this.settings('color_list');
                let gradients = [];

                $color_list.forEach(element => {
                    gradients.push([element.sa_agbg_start_color, element.sa_agbg_end_color]);
                });

                var transitionSpeed = 7000;

                if (typeof this.settings('transition_speed.size') !== "undefined" && this.settings('transition_speed.size')) {
                    transitionSpeed = this.settings('transition_speed.size');
                }

                options.states = {
                    'default-state': {
                        'gradients': gradients,
                        'transitionSpeed': transitionSpeed
                    }
                }

                var granimInstance = new Granim(options);

                this.Granim = element;
            }
        });


        elementorFrontend.hooks.addAction('frontend/element_ready/section', function ($scope) {
            elementorFrontend.elementsHandler.addHandler(AnimatedGradientBg, {
                $element: $scope
            });
        });

        elementorFrontend.hooks.addAction('frontend/element_ready/container', function ($scope) {
            elementorFrontend.elementsHandler.addHandler(AnimatedGradientBg, {
                $element: $scope
            });
        });

        elementorFrontend.hooks.addAction('frontend/element_ready/column', function ($scope) {
            elementorFrontend.elementsHandler.addHandler(AnimatedGradientBg, {
                $element: $scope
            });
        });

        elementorFrontend.hooks.addAction('frontend/element_ready/widget', function ($scope) {
            elementorFrontend.elementsHandler.addHandler(AnimatedGradientBg, {
                $element: $scope
            });
        });

    });

}(jQuery));
;
(function ($) {
    var $window = $(window),
        debounce = function (func, wait, immediate) {
            // 'private' variable for instance
            // The returned function will be able to reference this due to closure.
            // Each call to the returned function will share this common timer.
            var timeout;

            // Calling debounce returns a new anonymous function
            return function () {
                // reference the context and args for the setTimeout function
                var context = this,
                    args = arguments;

                // Should the function be called now? If immediate is true
                //   and not already in a timeout then the answer is: Yes
                var callNow = immediate && !timeout;

                // This is the basic debounce behaviour where you can call this
                //   function several times, but it will only execute once
                //   [before or after imposing a delay].
                //   Each time the returned function is called, the timer starts over.
                clearTimeout(timeout);

                // Set the new timeout
                timeout = setTimeout(function () {

                    // Inside the timeout function, clear the timeout variable
                    // which will let the next execution run when in 'immediate' mode
                    timeout = null;

                    // Check if the function already ran with the immediate flag
                    if (!immediate) {
                        // Call the original function with apply
                        // apply lets you define the 'this' object as well as the arguments
                        //    (both captured before setTimeout)
                        func.apply(context, args);
                    }
                }, wait);

                // Immediate mode and no wait timer? Execute the function..
                if (callNow)
                    func.apply(context, args);
            };
        };
    $window.on('elementor/frontend/init', function () {
        var ModuleHandler = elementorModules.frontend.handlers.Base,
            RipplesEffect;

        RipplesEffect = ModuleHandler.extend({

            bindEvents: function () {
                this.run();
            },

            getDefaultSettings: function () {
                return {
                    interactive: true,
                };
            },

            settings: function (key) {
                return this.getElementSettings('sa_rf_' + key);
            },

            onElementChange: debounce(function (prop) {
                if (prop.indexOf('sa_rf_') !== -1) {
                    $(this.RippleEl).ripples('destroy');
                    this.run();
                }
            }, 600),

            run: function () {
                var options = this.getDefaultSettings(),
                    elementID = this.getID(),
                    elementContainer = $('.elementor-element-' + elementID),
                    element = '.elementor-element-' + elementID;

                if (this.settings('enable') !== 'yes') {
                    return;
                }

                if ($(this.$element).hasClass('elementor-widget')) {
                    elementContainer = $('.elementor-element-' + elementID).find('.elementor-widget-container');
                    element = $('.elementor-element-' + elementID).find('.elementor-widget-container');
                    elementContainer.css({
                        'position': 'relative',
                    });
                }

                if ($(this.$element).hasClass('elementor-column')) {
                    elementContainer = $('.elementor-element-' + elementID).find('.elementor-column-wrap');
                    element = $('.elementor-element-' + elementID).find('.elementor-column-wrap'); // need to verify clearly
                    elementContainer.css({
                        'position': 'relative',
                    });
                }

                if (this.settings('drop_radius.size')) {
                    options.dropRadius = this.settings('drop_radius.size') || 20;
                }
                if (this.settings('perturbance.size')) {
                    options.perturbance = this.settings('perturbance.size') || 0.03;
                }
                if (this.settings('resolution')) {
                    options.resolution = this.settings('resolution') || 256;
                }

                options.id = 's';

                $(element).ripples(options);

                this.RippleEl = element;
            }
        });


        elementorFrontend.hooks.addAction('frontend/element_ready/section', function ($scope) {
            elementorFrontend.elementsHandler.addHandler(RipplesEffect, {
                $element: $scope
            });
        });

        elementorFrontend.hooks.addAction('frontend/element_ready/container', function ($scope) {
            elementorFrontend.elementsHandler.addHandler(RipplesEffect, {
                $element: $scope
            });
        });

        elementorFrontend.hooks.addAction('frontend/element_ready/column', function ($scope) {
            elementorFrontend.elementsHandler.addHandler(RipplesEffect, {
                $element: $scope
            });
        });

        elementorFrontend.hooks.addAction('frontend/element_ready/widget', function ($scope) {
            elementorFrontend.elementsHandler.addHandler(RipplesEffect, {
                $element: $scope
            });
        });

    });

}(jQuery));
;
(function ($) {
    var $window = $(window),
        debounce = function (func, wait, immediate) {
            // 'private' variable for instance
            // The returned function will be able to reference this due to closure.
            // Each call to the returned function will share this common timer.
            var timeout;

            // Calling debounce returns a new anonymous function
            return function () {
                // reference the context and args for the setTimeout function
                var context = this,
                    args = arguments;

                // Should the function be called now? If immediate is true
                //   and not already in a timeout then the answer is: Yes
                var callNow = immediate && !timeout;

                // This is the basic debounce behaviour where you can call this
                //   function several times, but it will only execute once
                //   [before or after imposing a delay].
                //   Each time the returned function is called, the timer starts over.
                clearTimeout(timeout);

                // Set the new timeout
                timeout = setTimeout(function () {

                    // Inside the timeout function, clear the timeout variable
                    // which will let the next execution run when in 'immediate' mode
                    timeout = null;

                    // Check if the function already ran with the immediate flag
                    if (!immediate) {
                        // Call the original function with apply
                        // apply lets you define the 'this' object as well as the arguments
                        //    (both captured before setTimeout)
                        func.apply(context, args);
                    }
                }, wait);

                // Immediate mode and no wait timer? Execute the function..
                if (callNow)
                    func.apply(context, args);
            };
        };
    $window.on('elementor/frontend/init', function () {
        var ModuleHandler = elementorModules.frontend.handlers.Base,
            RevealEffects;

        RevealEffects = ModuleHandler.extend({

            bindEvents: function () {
                this.anime && this.anime.restart();
                this.run();
            },

            getDefaultSettings: function () {
                return {
                    direction: 'lr',
                    easing: 'easeInOutQuint',
                    duration: 600,
                    bgColors: ['#111']
                };
            },

            settings: function (key) {
                return this.getElementSettings('sa_reveal_fx_' + key);
            },

            onElementChange: debounce(function (prop) {
                if (prop.indexOf('sa_reveal_fx') !== -1) {
                    this.anime && this.anime.restart();
                    // $(this.RevealFx).ripples('destroy');

                    this.run();
                }
            }, 400),

            run: function () {
                var options = this.getDefaultSettings(),
                    elementID = this.getID(),
                    element = this.findElement('.elementor-widget-container').get(0);

                if ($(this.element).hasClass('elementor-widget')) {
                    element = $('.elementor-element-' + elementID).find('.elementor-widget-container');
                }

                if (this.settings('enable') !== 'yes') {
                    return;
                }

                if (this.settings('direction')) {
                    options.direction = this.settings('direction');
                }
                if (this.settings('bg_colors')) {
                    options.bgColors = this.settings('bg_colors').split(/[ ,]+/);
                }
                if (this.settings('duration.size').length !== 0) {
                    options.duration = this.settings('duration.size');
                }
                if (this.settings('easing')) {
                    options.easing = this.settings('easing');
                }
                if (this.settings('cover_area')) {
                    options.coverArea = this.settings('cover_area');
                }
                if (this.settings('delay.size').length !== 0) {
                    options.delay = this.settings('delay.size');
                }

                options.onHalfway = function (contentEl, revealerEl) {
                    contentEl.style.opacity = 1;
                };

                let layers = this.settings('layers') ? this.settings('layers') : 1;
                let contentHidden = this.settings('content_show') ? false : true;


                /**
                 * Select Custom Elements
                 */
                if (this.settings('selector') && this.settings('selector').length !== 0) {
                    element = $(element).find(this.settings('selector'));
                }

                $(element).each(function (index, element) {
                    var revealerEffect = new RevealFx(this, {
                        layers: layers,
                        isContentHidden: contentHidden,
                        revealSettings: options
                    });
                    this.RevealFx = revealerEffect;

                    skyAddonsObserver(element, function () {
                        revealerEffect.reveal();
                    }, {
                        root: null, // Use the viewport as the root
                        rootMargin: '0px', // No margin around the root
                        threshold: 0.8 // 80% visibility (1 - 0.8)
                    });

                });


                

            }
        });

        elementorFrontend.hooks.addAction('frontend/element_ready/widget', function ($scope) {
            elementorFrontend.elementsHandler.addHandler(RevealEffects, {
                $element: $scope
            });
        });
    });

}(jQuery));
