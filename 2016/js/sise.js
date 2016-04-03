$(document).ready(function () {
    //safe mailto
    $('a[href*="[at]"][href*="[dot]"]').each(function () {
        var email = $(this).attr('href').split('[at]').join('@').split('[dot]').join('.');
        $(this).attr('href', 'mailto:' + email.toLowerCase());
        if ($(this).text().length == 0) $(this).text(email);
    });
});

// Google Analytics
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-36607902-1']);
_gaq.push(['_setDomainName', 'si-se.ch']);
_gaq.push(['_trackPageview']);
(function () {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ga, s);
})();