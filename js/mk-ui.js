/**
 * UI scripting
 */
/// <reference path="../bower_components/DefinitelyTyped/jquery/jquery.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/angularjs/angular.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/angularjs/angular-route.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/bootstrap/bootstrap.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/googlemaps/google.maps.d.ts" />
/// <reference path="mk-util.ts"/>
var MusikschuleKraft;
(function (MusikschuleKraft) {
    function ApplyRendering() {
        $('a').each(function (i, item) {
            var $item = $(item);
            $item.focus(function () { return $item.blur(); });
        });
    }
    MusikschuleKraft.ApplyRendering = ApplyRendering;
    function InitializeGoogleMaps() {
        var $map = $('#mk-map-canvas');
        if (!MusikschuleKraft.exists($map)) {
            // no map to initialize
            return;
        }
        var location = new google.maps.LatLng(47.126043, 7.240455);
        var center = new google.maps.LatLng(47.129392, 7.232952);
        var mapOptions = {
            zoom: 14,
            center: center
        };
        var map = new google.maps.Map($map[0], mapOptions);
        var marker = new google.maps.Marker({
            position: location,
            map: map,
            title: 'Musikschule Kraft'
        });
    }
    MusikschuleKraft.InitializeGoogleMaps = InitializeGoogleMaps;
})(MusikschuleKraft || (MusikschuleKraft = {}));
//# sourceMappingURL=mk-ui.js.map