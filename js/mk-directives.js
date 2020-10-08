/**
 * Directives for MK app
 */
/// <reference path="../bower_components/DefinitelyTyped/jquery/jquery.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/angularjs/angular.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/angularjs/angular-route.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/bootstrap/bootstrap.d.ts" />
/// <reference path="mk-util.ts"/>
/// <reference path="mk-ui.ts"/>
var MusikschuleKraft;
(function (MusikschuleKraft) {
    var mkDirectives = angular.module('mkDirectives', []);
    mkDirectives.directive('mkTest', function () { return ({
        restrict: 'A',
        link: function (scope, elem, attrs) {
            // TODO
        }
    }); });
})(MusikschuleKraft || (MusikschuleKraft = {}));
//# sourceMappingURL=mk-directives.js.map