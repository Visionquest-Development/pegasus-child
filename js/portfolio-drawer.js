/**
 * Portfolio Tool Drawer — only loaded on page ID 131
 * Includes: jQuery.cookie, MixItUp init, drawer open/close, drawer-text positioning
 */

/* ---------- jQuery.cookie plugin ---------- */
jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') {
        options = options || {};
        if (value === null) { value = ''; options.expires = -1; }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else { date = options.expires; }
            expires = '; expires=' + date.toUTCString();
        }
        var path   = options.path   ? '; path='   + (options.path)   : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure'  : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else {
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};

/* ---------- Drawer-text dynamic positioning ---------- */
function positionDrawerText() {
    var drawer = document.querySelector('.avia_styleswitcher');
    var text   = document.getElementById('drawer-text');
    if (!drawer || !text) return;

    var drawerH = drawer.offsetHeight;
    var textH   = text.offsetHeight; // ~20px

    // width = drawer height so the rotated element spans the full panel height
    text.style.width = drawerH + 'px';
    // center vertically: CSS top places the unrotated box midpoint at drawerH/2
    text.style.top   = (drawerH / 2 - textH / 2) + 'px';
    // right: negative value extends the element to the right;
    // this aligns the visual right edge with the drawer's right edge
    text.style.right = (textH / 2 - drawerH / 2) + 'px';
}

jQuery(function ($) {

    /* ---------- MixItUp + checkbox filter ---------- */

    var checkboxFilter = {
        $filters: null,
        $reset: null,
        groups: [],
        outputArray: [],
        outputString: '',

        init: function () {
            var self = this;
            self.$filters   = $('#Filters');
            self.$reset     = $('#Reset');
            self.$container = $('#Container');

            self.$filters.find('fieldset').each(function () {
                self.groups.push({
                    $inputs: $(this).find('input'),
                    active: [],
                    tracker: false
                });
            });
            self.bindHandlers();
        },

        bindHandlers: function () {
            var self = this;
            self.$filters.on('change', function () { self.parseFilters(); });
            self.$reset.on('click', function (e) {
                e.preventDefault();
                self.$filters[0].reset();
                self.parseFilters();
            });
        },

        parseFilters: function () {
            var self = this;
            for (var i = 0, group; group = self.groups[i]; i++) {
                group.active = [];
                group.$inputs.each(function () {
                    $(this).is(':checked') && group.active.push(this.value);
                });
                group.active.length && (group.tracker = 0);
            }
            self.concatenate();
        },

        concatenate: function () {
            var self    = this,
                cache   = '',
                crawled = false,
                checkTrackers = function () {
                    var done = 0;
                    for (var i = 0, group; group = self.groups[i]; i++) {
                        (group.tracker === false) && done++;
                    }
                    return (done < self.groups.length);
                },
                crawl = function () {
                    for (var i = 0, group; group = self.groups[i]; i++) {
                        group.active[group.tracker] && (cache += group.active[group.tracker]);
                        if (i === self.groups.length - 1) {
                            self.outputArray.push(cache);
                            cache = '';
                            updateTrackers();
                        }
                    }
                },
                updateTrackers = function () {
                    for (var i = self.groups.length - 1; i > -1; i--) {
                        var group = self.groups[i];
                        if (group.active[group.tracker + 1]) {
                            group.tracker++;
                            break;
                        } else if (i > 0) {
                            group.tracker && (group.tracker = 0);
                        } else {
                            crawled = true;
                        }
                    }
                };

            self.outputArray = [];
            do { crawl(); } while (!crawled && checkTrackers());

            self.outputString = self.outputArray.join();
            !self.outputString.length && (self.outputString = 'all');

            if (self.$container.mixItUp('isLoaded')) {
                self.$container.mixItUp('filter', self.outputString);
            }
        }
    };

    $(function () {
        checkboxFilter.init();

        $('#Container').mixItUp({
            animation: {
                easing: 'cubic-bezier(0.86, 0, 0.07, 1)',
                duration: 600
            },
            selectors: {
                target: '.mix',
                filter: '.filter',
                sort:   '.sort'
            },
            layout: { containerClass: 'master-container' },
            callbacks: {
                onMixStart: function (state) { state.$targets.addClass('being-mixed'); },
                onMixEnd:   function (state) { state.$targets.removeClass('being-mixed'); }
            }
        });

        $('#filter-select').on('change', function () {
            $('#Container').mixItUp('filter', this.value);
        });
        $('#sort-select').on('change', function () {
            $('#Container').mixItUp('sort', this.value);
        });
        $('.multimix-button').on('click', function () {
            $('#Container').mixItUp('multiMix', { filter: 'all', sort: 'title:asc' });
        });
    });

    /* ---------- Drawer open/close with cookie memory ---------- */
    jQuery.noConflict();

    jQuery(document).ready(function ($) {
        var target = jQuery('.avia_styleswitcher');

        if (jQuery.cookie('avia_display_switch') === 'display_switch_false') {
            target.removeClass('display_switch').addClass('display_switch_false');
        } else if (jQuery.cookie('avia_display_switch') === 'display_switch') {
            target.removeClass('display_switch_false').addClass('display_switch');
        }

        jQuery('.avia_styleswitcher .openclose').on('click', function () {
            var $drawer    = jQuery(this).parent('.avia_styleswitcher');
            var isRight    = $drawer.is('.switcher_right');
            var closedPos  = isRight ? { right: '-320' } : { left: '-320' };
            var openPos    = isRight ? { right: '-75'  } : { left: '-75'  };

            if ($drawer.is('.display_switch')) {
                $drawer.animate(closedPos, function () {
                    $drawer.removeClass('display_switch').addClass('display_switch_false');
                    positionDrawerText();
                });
                jQuery.cookie('avia_display_switch', 'display_switch_false', { expires: 7, path: '/' });
            } else {
                $drawer.animate(openPos, function () {
                    $drawer.removeClass('display_switch_false').addClass('display_switch');
                    positionDrawerText();
                });
                jQuery.cookie('avia_display_switch', 'display_switch', { expires: 7, path: '/' });
            }
        });

        if (typeof jQuery.cookie('avia_display_switch') !== 'string') {
            setTimeout(function () {
                jQuery('.avia_styleswitcher .openclose').trigger('click');
            }, 1000);
        }

        // Initial position + reposition on resize
        positionDrawerText();
        window.addEventListener('resize', positionDrawerText);
    });
});
