/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~PEGASUS CUSTOM JS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

  // responsive-tables.js
	jQuery(document).ready(function($) {
		var switched = false;
		var updateTables = function() {
			if (($(window).width() < 767) && !switched ){
			  switched = true;
			  $("table.responsive").each(function(i, element) {
				splitTable($(element));
			  });
			  return true;
			}
			else if (switched && ($(window).width() > 767)) {
			  switched = false;
			  $("table.responsive").each(function(i, element) {
				unsplitTable($(element));
			  });
			}
		};

		$(window).load(updateTables);
		$(window).on("redraw",function(){switched=false;updateTables();}); // An event to listen for
		$(window).on("resize", updateTables);


		function splitTable(original) {
			original.wrap("<div class='table-wrapper' />");

			var copy = original.clone();
			copy.find("td:not(:first-child), th:not(:first-child)").css("display", "none");
			copy.removeClass("responsive");

			original.closest(".table-wrapper").append(copy);
			copy.wrap("<div class='pinned' />");
			original.wrap("<div class='scrollable' />");

			setCellHeights(original, copy);
		}

		function unsplitTable(original) {
			original.closest(".table-wrapper").find(".pinned").remove();
			original.unwrap();
			original.unwrap();
		}

		function setCellHeights(original, copy) {
			var tr = original.find('tr'),
				tr_copy = copy.find('tr'),
				heights = [];

			tr.each(function (index) {
			  var self = $(this),
				  tx = self.find('th, td');

			  tx.each(function () {
				var height = $(this).outerHeight(true);
				heights[index] = heights[index] || 0;
				if (height > heights[index]) heights[index] = height;
			  });

			});

			tr_copy.each(function (index) {
			  $(this).height(heights[index]);
			});
		}
	});

	jQuery(window).on('load resize', function ($) {
		if (jQuery(this).width() < 767) {
			jQuery('table tfoot').hide();
		} else {
			jQuery('table tfoot').show();
		}
	});



	jQuery(document).ready(function($) {

		//if($(window).width() >= 768){
			//initialize()
		//}//end if

		//$( window ).resize(function() {
			//if($(window).width() > 768){
				//initialize();
			//}

		//});
		
		

    jQuery( '.keegans-header-menu li a' ).removeAttr("data-toggle").removeAttr("data-bs-toggle");


	/*jQuery(window).load(function($) {
		// executes when complete page is fully loaded, including all frames, objects and images
		//alert("window is loaded");
		
		
		
		var $grid = jQuery('body.page-template-tpl_masonry .pegasus-logo-slider-wrapper').imagesLoaded( function($) {
			// init Masonry after all images have loaded
			$grid.masonry({
				// options...
				//columnWidth: 360,
				itemSelector: '.pegasus-logo-slider-container',
				gutter: 10
			});
		});
	});*/
	
	jQuery(window).load(function($) {
		// Executes when the complete page is fully loaded, including all frames, objects, and images
		
		var $element = jQuery('body.page-template-tpl_masonry');
		if ( $element.length ) {
			var $grid = jQuery('.pegasus-logo-slider-wrapper').imagesLoaded(function() {
				// Initialize Masonry after all images have loaded
				$grid.masonry({
					// options
					itemSelector: '.pegasus-logo-slider-container',
					gutter: 10
				});
			});
		}
		

		// Function to refresh Masonry
		function refreshMasonry() {
			if ($grid) {
				$grid.masonry('layout');
			}
		}

		// Detect changes in .mainbar or #header using MutationObserver
		var observerConfig = { childList: true, subtree: true, attributes: true };

		var observerCallback = function(mutationsList) {
			for (let mutation of mutationsList) {
				// Check if the mutation affects .mainbar or #header
				if (mutation.target.matches('.mainbar, #header')) {
					refreshMasonry();
				}
			}
		};

		var mainbar = document.querySelector('.mainbar');
		var header = document.querySelector('#header');
		if (mainbar || header) {
			var observer = new MutationObserver(observerCallback);
			if (mainbar) observer.observe(mainbar, observerConfig);
			if (header) observer.observe(header, observerConfig);
		}

		// Optional: Manually trigger Masonry refresh when needed
		jQuery('.mainbar, #header').on('customChange', function() {
			refreshMasonry();
		});
	});


	var $dotElement = jQuery('#dotnav');
	if ( $dotElement.length ) {
		var scrollSpy = new bootstrap.ScrollSpy(document.body, {
		  target: '#dotnav'
		});
	}
    // Sidebar section nav: spy the whole sidebar widget so the active
    // highlight works regardless of the assigned menu's id/name.
    var pgSidebarTarget = document.querySelector('#header .nav-sidebar-widget')
        ? '#header .nav-sidebar-widget'
        : ( document.querySelector('#menu-main-nav-2') ? '#menu-main-nav-2' : null );
    if ( pgSidebarTarget ) {
      var scrollSpy2 = new bootstrap.ScrollSpy(document.body, {
        target: pgSidebarTarget
      });
    }


    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl, {
        placement: 'left',
      })
    });

    // Copy-to-clipboard buttons on the .ph-terminal cards.
    // Uses the async Clipboard API when available (secure contexts) and falls
    // back to execCommand('copy') for insecure origins like http://*.test.
    function pgCopyToClipboard(text) {
      if (navigator.clipboard && window.isSecureContext) {
        return navigator.clipboard.writeText(text);
      }
      return new Promise(function (resolve, reject) {
        var ta = document.createElement('textarea');
        ta.value = text;
        ta.setAttribute('readonly', '');
        ta.style.position = 'absolute';
        ta.style.left = '-9999px';
        document.body.appendChild(ta);
        ta.select();
        try {
          document.execCommand('copy') ? resolve() : reject();
        } catch (err) {
          reject(err);
        } finally {
          document.body.removeChild(ta);
        }
      });
    }

    document.querySelectorAll('.ph-copy').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var terminal = btn.closest('.ph-terminal');
        var cmd = terminal ? terminal.querySelector('.ph-terminal-cmd') : null;
        var text = cmd ? cmd.textContent.trim() : '';
        if (!text) { return; }

        var label = btn.querySelector('.ph-copy-label');
        var original = label ? label.textContent : '';

        pgCopyToClipboard(text).then(function () {
          btn.classList.add('is-copied');
          if (label) { label.textContent = 'Copied!'; }
        }).catch(function () {
          if (label) { label.textContent = 'Press Ctrl+C'; }
        }).then(function () {
          if (btn._pgCopyTimer) { clearTimeout(btn._pgCopyTimer); }
          btn._pgCopyTimer = setTimeout(function () {
            btn.classList.remove('is-copied');
            if (label) { label.textContent = original || 'Copy'; }
          }, 1600);
        });
      });
    });

    // HTTPS / SSH toggle on any .ph-terminal whose command is a GitHub `git clone`.
    // The two protocol forms are derived from each other, so no stored data is
    // needed. Toggling rewrites the command text; the copy button then copies
    // whichever protocol is currently active.
    function pgGitToHttps(cmd) { return cmd.replace(/git@github\.com:/g, 'https://github.com/'); }
    function pgGitToSsh(cmd) { return cmd.replace(/https:\/\/github\.com\//g, 'git@github.com:'); }
    function pgIsGithubClone(cmd) {
      return /git\s+clone/.test(cmd) && /(https:\/\/github\.com\/|git@github\.com:)/.test(cmd);
    }

    document.querySelectorAll('.ph-terminal').forEach(function (terminal) {
      var cmdEl = terminal.querySelector('.ph-terminal-cmd');
      var bar = terminal.querySelector('.ph-terminal-bar');
      if (!cmdEl || !bar) { return; }

      var original = cmdEl.textContent.trim();
      if (!pgIsGithubClone(original)) { return; }

      var httpsCmd = pgGitToHttps(original);
      var sshCmd = pgGitToSsh(original);
      var startProto = /git@github\.com:/.test(original) ? 'ssh' : 'https';

      var toggle = document.createElement('div');
      toggle.className = 'ph-proto';
      toggle.setAttribute('role', 'group');
      toggle.setAttribute('aria-label', 'Clone protocol');

      var btnHttps = document.createElement('button');
      btnHttps.type = 'button';
      btnHttps.className = 'ph-proto-btn';
      btnHttps.textContent = 'HTTPS';

      var btnSsh = document.createElement('button');
      btnSsh.type = 'button';
      btnSsh.className = 'ph-proto-btn';
      btnSsh.textContent = 'SSH';

      toggle.appendChild(btnHttps);
      toggle.appendChild(btnSsh);

      function setProto(proto) {
        var isSsh = proto === 'ssh';
        cmdEl.textContent = isSsh ? sshCmd : httpsCmd;
        btnHttps.classList.toggle('is-active', !isSsh);
        btnSsh.classList.toggle('is-active', isSsh);
        btnHttps.setAttribute('aria-pressed', String(!isSsh));
        btnSsh.setAttribute('aria-pressed', String(isSsh));
      }
      btnHttps.addEventListener('click', function () { setProto('https'); });
      btnSsh.addEventListener('click', function () { setProto('ssh'); });

      // Place the toggle just before the copy button (both sit on the right).
      var copyBtn = bar.querySelector('.ph-copy');
      if (copyBtn) { bar.insertBefore(toggle, copyBtn); } else { bar.appendChild(toggle); }

      setProto(startProto);
    });

    // Sidebar CTA (Home / Demo buttons + Documentation link): clone the
    // <template> into the sidebar widget so it sits at the bottom of the nav.
    var pgCtaTpl = document.getElementById('pg-sidebar-cta-tpl');
    var pgSidebarWidget = document.querySelector('#header .nav-sidebar-widget') || document.querySelector('#header');
    if ( pgCtaTpl && pgSidebarWidget && ! pgSidebarWidget.querySelector('.pg-sidebar-cta') ) {
      pgSidebarWidget.appendChild(pgCtaTpl.content.cloneNode(true));
    }

    // Scroll progress bar (demo page only — the element exists only there).
    var pdScrollBar = document.getElementById('pd-scroll-bar');
    if ( pdScrollBar ) {
      var pdUpdateScrollBar = function () {
        var scrolled = window.scrollY || document.documentElement.scrollTop;
        var total    = document.documentElement.scrollHeight - window.innerHeight;
        pdScrollBar.style.width = ( total > 0 ? ( scrolled / total ) * 100 : 0 ).toFixed(2) + '%';
      };
      window.addEventListener('scroll', pdUpdateScrollBar, { passive: true });
      window.addEventListener('resize', pdUpdateScrollBar, { passive: true });
      pdUpdateScrollBar();
    }

		// $(function () {
		//   $('[data-toggle="tooltip"]').tooltip();
		// });



	}); //end document ready function


	// jQuery(document).ready(function($) {
	// 	// executes when HTML-Document is loaded and DOM is ready
	// 	//alert("document is ready");
	// });


	jQuery(window).on('load', function($) {
		// executes when complete page is fully loaded, including all frames, objects and images
		//alert("window is loaded");
	});
