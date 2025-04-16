$(document).ready(function () {

    var toggleSearchTarget = 'adp-siteHeader__search';

    $('#adp-js-searchToggle').on('click', function (e) {
        if ($('.' + toggleSearchTarget).hasClass(toggleSearchTarget + '--active')) {
            $(this).removeClass('adp-icon--fermer').addClass('adp-icon--search');
            $('.' + toggleSearchTarget).removeClass(toggleSearchTarget + '--active');
            $('body').removeClass('adp-body--noScroll');
        } else {
            $(this).removeClass('adp-icon--search').addClass('adp-icon--fermer');
            $('.' + toggleSearchTarget).addClass(toggleSearchTarget + '--active');
            $('body').addClass('adp-body--noScroll');
        }
    });
});