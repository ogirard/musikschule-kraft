/**
 * Controllers for MK app
 */
/// <reference path="../bower_components/DefinitelyTyped/jquery/jquery.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/angularjs/angular.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/angularjs/angular-route.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/bootstrap/bootstrap.d.ts" />
/// <reference path="mk-definitions.d.ts"/>
/// <reference path="mk-util.ts"/>
/// <reference path="mk-ui.ts"/>
var MusikschuleKraft;
(function (MusikschuleKraft) {
    var mkControllers = angular.module('mkControllers', ['ngSanitize']);
    mkControllers.controller('MainController', function ($scope, $anchorScroll, $http, $timeout) {
        $http.get('data/content/angebot.json')
            .success(function (data) {
            $scope.angebot = data;
        });
        $http.get('data/content/news.json')
            .success(function (data) {
            $scope.news = data;
            for (var i = 0; i < $scope.news.length; i++) {
                $scope.news[i].inhalt = MusikschuleKraft.TranslateContent($scope.news[i].inhalt, $scope.news[i].archiv);
            }
        });
        $scope.notNullOrEmpty = MusikschuleKraft.IsNotNullOrEmpty;
        $scope.$on('routeLoaded', function (event, args) {
            $scope.slug = args.slug;
            $scope.titlePostfix = args.slug ? ' - ' + MusikschuleKraft.CapitaliseFirstLetter(args.slug) : '';
            MusikschuleKraft.ApplyRendering();
            MusikschuleKraft.InitializeGoogleMaps();
            $('.carousel').carousel();
            $anchorScroll();
            $timeout(function () {
                if ($('#mk-menu-collapse').is(':visible') && $('#mk-main-menu').is(':visible')) {
                    $('#mk-main-menu').collapse('hide');
                }
            }, 250);
        });
    });
    mkControllers.controller('ContactMailController', function ($scope, $http, $location, $filter, $route) {
        $scope.message = {};
        $scope.submitted = false;
        $scope.mailsent = false;
        $scope.error = false;
        $scope.sendContactMail = function (isFormValid) {
            $scope.submitted = true;
            if (isFormValid) {
                // success/error function(data, status, headers, config) { ... }
                $http.post('php/sendmail.php', $scope.message)
                    .success(function () {
                    $scope.mailsent = true;
                    $scope.error = false;
                })
                    .error(function () {
                    $scope.error = true;
                });
            }
        };
        $scope.cancel = function () {
            $location.path('/kontakt');
        };
        $scope.reset = function () {
            $route.reload();
        };
    });
    mkControllers.controller('RouteController', function ($scope, $location) {
        var parts = $location.path().split('/');
        var slug = parts.length > 1 ? parts[1] : "";
        $scope.$emit('routeLoaded', { slug: slug });
    });
})(MusikschuleKraft || (MusikschuleKraft = {}));
//# sourceMappingURL=mk-controllers.js.map