$(function($) {
    // IntitContent();
    $window = $(window);
    $window.resize(function(evt) {
        var ratio;
        $rzObj = $("#wrapper, #popup-social-home");
        _wh = $window.height();
        _ww = $window.width();
        ratio = _wh/1000;
        if(_ww/_wh > 2000/1000) {
            ratio = _ww/2000;
        }
        $rzObj.css({
            "transform": "scale(" + ratio + ", " + ratio + ")"
        });
    }).resize();
    $window.load(function(evt) {
        var ratio;
        $rzObj = $("#wrapper, #popup-social-home");
        _wh = $window.height();
        _ww = $window.width();
        ratio = _wh/1000;
        if(_ww/_wh > 2000/1000) {
            ratio = _ww/2000;
        }
        $rzObj.css({
            "transform": "scale(" + ratio + ", " + ratio + ")"
        });
    }).resize();
});
