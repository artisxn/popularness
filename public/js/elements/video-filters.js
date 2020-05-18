var VideosListing = {
    startDate: null,
    endDate: null,
    currentRequest: null,
    loaderEl: null,
    url: "",
    loaderHtml: '<div class="loading"><h2>Loading... <i class="fa fa-spinner"></i></h2></div>',
    loading: function (state) {
        if (state) {
            jQuery('#primary .videos-container').css('opacity', '0.2');
            VideosListing.loaderEl = jQuery(VideosListing.loaderHtml);
            VideosListing.loaderEl.appendTo('#primary');
        } else {
            if (VideosListing.loaderEl)
                VideosListing.loaderEl.fadeOut('slow');
        }
    },
    refresh: function () {

        jQuery('#primary *').css('cursor', 'wait');

        var urlParams = {};

        VideosListing.loading(true);
        //console.log(VideosListing.loading(true));


        if (VideosListing.currentRequest != null)
            VideosListing.currentRequest.abort();

        // Date filter URL part
        var dateEl = jQuery('.filter-date a.selected').parent().find('input');
        var dateLiEl = jQuery('.filter-date a.selected').parent();

        if (dateLiEl.hasClass('filter-day')) {

            var date = jQuery(dateEl).datepicker('getDate');
            urlParams.date = date.getTime();

        } else if (dateLiEl.hasClass('filter-week')) {

            urlParams.startDate = VideosListing.startDate.getTime();
            urlParams.endDate = VideosListing.endDate.getTime();

        } else if (dateLiEl.hasClass('filter-month')) {

            var date = jQuery(dateEl).data('dateSelected');
            urlParams.month = date.getTime();

        } else if (dateLiEl.hasClass('filter-year')) {

            var date = jQuery(dateEl).data('dateSelected');
            urlParams.year = date.getTime();

        }

        if (!VideosListing.currentPage || VideosListing.currentPage <= 0)
            VideosListing.currentPage = 1;

        urlParams.page = VideosListing.currentPage;

        // Genre filter URL part
        var genres = '';
        var stop = false;
        jQuery('.filter-videos li .chkboxlist:checked').each(function () {
            
            
            var genre = jQuery(this);
          
            genres += (genres == '' ? '' : ',') + genre.val();
        });
        
        if (genres != '')
            urlParams.genres = genres;

        // Charts filter URL part
        var charts = '';
        stop = false;
        jQuery('.filter-charts li a.selected').each(function () {
            var chart = jQuery(this);
            if (stop || chart.data('id') == 'all') {
                stop = true;
                chart = null;
                return;
            }
            charts += (charts == '' ? '' : ',') + chart.data('id');
        });
        if (charts != '')
            urlParams.charts = charts;

        // Artist filter URL part
        var artists = '';
        jQuery('.filter-artist .letters a.selected').each(function () {
            var letter = jQuery(this);
            artists += (artists == '' ? '' : ',') + letter.data('id');
        });
        if (artists != '')
            urlParams.artists = artists;

       VideosListing.currentRequset = jQuery.get(VideosListing.url, urlParams, function (data) {

            jQuery('#primary *').css('cursor', 'default');
            jQuery('#primary').html(data);

            VideosListing.loading(false);
            VideosListing.currentPage = 1;
            VideosListing.currentRequest = null;

            //$('.thumb').webuiPopover({trigger:'hover'});
        });
    }

};

VideosFilters = {
    reset: function () {
        jQuery('.filter-cal input').parent().find('a').removeClass('selected');
        jQuery('.filter-cal.filter-day a').html('Today');
        jQuery('.filter-cal.filter-week a').html('Week');
        jQuery('.filter-cal.filter-month a').html('Month');
        jQuery('.filter-cal.filter-year a').html('Year');
    }
}

jQuery(function () {

    // =====================
    jQuery('#primary').on('click', '.pagination span a', function (event) {

        event.preventDefault();

        VideosListing.currentPage = jQuery(this).html();

        VideosListing.refresh();

        return false;
    });

    // =====================


jQuery('.filter.filter-videos .chkboxlist').on('click', function (event) {

        VideosListing.refresh();

    });
jQuery('.filter.filter-charts li a, .filter.filter-artist a').on('click', function (event) {
        event.preventDefault();

        var el = jQuery(this);
        if (el.data('id') == 'all') {
            el.parent().parent().find('a').each(function () {
                var element = jQuery(this);
                if (element.data('id') != 'all')
                    jQuery(this).removeClass('selected');
            });
        } else {
            el.parent().parent().find('a[data-id=all]').removeClass('selected');
        }

        if (el.hasClass('selected')) {
            el.removeClass('selected');
        } else {
            el.addClass('selected');
        }

        VideosListing.refresh();

        return false;
    });
});
