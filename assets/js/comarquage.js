/* Kienso - jQuery for co-marquage */

jQuery(function($) {
    $(document).ready(function () {
        
        // Create Map
        var maps = [];
        var createMap = function (map_div) {

            if( typeof L === 'undefined') return;

            // Define map style
            var CartoDB_Voyager = L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                minZoom: 1,
                maxZoom: 19
            });

            var map_id = map_div.attr('id');
            var leafletMap = null;
            var marker = null;

            // Get map infos
            var org_mark = [ parseFloat( map_div.attr('data-co-gmaps-lat') ), parseFloat( map_div.attr('data-co-gmaps-lon') ) ];

            // Create map
            leafletMap = L.map(map_id, {
                scrollWheelZoom: false
            }).setView(org_mark, 15);

            // Add marker to the map
            marker = L.marker(org_mark).addTo(leafletMap);
            leafletMap.addLayer(CartoDB_Voyager);

            // Save map object in array
            maps[map_id] = leafletMap;
        }

        // Init maps on document load
        $(".co-org-maps").each(function() {
            map_div = $(this);
            createMap(map_div);
        });

        // Resize Maps
        var resizeMaps = function (el) {

            el.each(function () {

                var map_div = $(this);

                // Wait animate end
                setTimeout(function(map_div){

                    var map_id = map_div.attr('id');

                    // Destroy the Map
                    maps[map_id].remove();
                    maps[map_id] = null; // Clear the array

                    // Create the Map
                    createMap(map_div);

                }, 300, map_div);
            });
        }

        /* TABS */
        $('#comarquage [data-co-action="tab"]').click(function(event) {

            // Change tab
            $(this).closest('.tabs').find('> .nav-tabs > li').removeClass('active');
            $(this).addClass('active');

            // Change content
            $(this).closest('.tabs').find('> .tab-content > .tab-pane').removeClass('active');
            var target = $(this).attr('data-co-target');
            $(target).addClass('active');

            resizeMaps($(target).find('.co-org-maps'));
        });

        /* SLIDES / COLLAPSE */
        $('#comarquage [data-co-action="slide"]').click(function(event) {
            $(this).toggleClass('active');
            var target = $(this).attr('data-co-target');
            $(target).slideToggle('200');
        });

        $('#comarquage [data-co-action="slideall-up"]').click(function(event) {
            var target = $(this).attr('data-co-target');
            $(target + ' .co-btn-slide').removeClass('active');
            $(target + ' .fiche-item-content').slideUp('200');

            $(target + ' .co-btn[data-co-action="slide"]').removeClass('active');
            $(target + ' .co-collapse').addClass('co-hide').slideUp('200');
        });

        $('#comarquage [data-co-action="slideall-down"]').click(function(event) {

            var target = $(this).attr('data-co-target');
            $(target + ' .co-btn-slide').addClass('active');
            $(target + ' .fiche-item-content').slideDown('200');

            $(target + ' .co-btn[data-co-action="slide"]').addClass('active');
            $(target + ' .co-collapse').removeClass('co-hide').slideDown('200');

            resizeMaps( $(this).closest('#comarquage').find('.co-org-maps') );

        });

        $('#comarquage [data-co-action="slide-bloccas-radio"]').click(function(event) {
            var $el = $(this),
            $thisChoice = $el.closest('.choice-tree-choice'),
            $thisChoiceList = $el.closest('.choice-tree-choice-list');

            $thisChoice.toggleClass('choice-active');
            $thisChoiceList.children('.choice-tree-choice').not($thisChoice).toggleClass('choice-hide');

            $el.toggleClass('active');
            var target = $el.attr('data-co-target');
            $(target).slideToggle('200');

            //choice-tree-choice
            resizeMaps( $(this).closest('.choice-tree-choice').find('.co-org-maps') );
        });

        /* Organismes */
        $('#comarquage [data-co-action="slide-org"]').click(function(event) {
            $(this).toggleClass('active');
            var target = $(this).attr('data-co-target');
            $(target).slideToggle('200');
            if ( $(this).hasClass('active') ) resizeMaps($(this).closest('.fiche-item').find('.co-org-maps'));
        });

    });
});
