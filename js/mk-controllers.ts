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

module MusikschuleKraft {
  var mkControllers:ng.IModule = angular.module('mkControllers', [ 'ngSanitize' ]);

  mkControllers.controller('MainController', ($scope:IMainScope, $anchorScroll:ng.IAnchorScrollService, $http:ng.IHttpService, $timeout:ng.ITimeoutService) => {
    $http.get('data/content/angebot.json')
      .success(data => {
        $scope.angebot = data;
      });

    $http.get('data/content/news.json')
      .success(data => {
        $scope.news = data;
        for (var i = 0; i < $scope.news.length; i++) {
          $scope.news[i].inhalt = TranslateContent($scope.news[i].inhalt, $scope.news[i].archiv);
        }
      });

    $scope.notNullOrEmpty = IsNotNullOrEmpty;

    $scope.$on('routeLoaded', (event, args) => {
      $scope.slug = args.slug;
      $scope.titlePostfix = args.slug ? ' - ' + CapitaliseFirstLetter(args.slug) : '';
      ApplyRendering();
      InitializeGoogleMaps();
      $('.carousel').carousel();
      $anchorScroll();
      $timeout(() => {
        if ($('#mk-menu-collapse').is(':visible') && $('#mk-main-menu').is(':visible')) {
          $('#mk-main-menu').collapse('hide');
        }
      }, 250);
    });
  });

  mkControllers.controller('ContactMailController', ($scope:IContactMailScope, $http:ng.IHttpService, $location:ng.ILocationService, $filter:ng.IFilterService, $route:ng.route.IRouteService) => {
    $scope.message = {};
    $scope.submitted = false;
    $scope.mailsent = false;
    $scope.error = false;

    $scope.sendContactMail = (isFormValid:boolean) => {
      $scope.submitted = true;
      if (isFormValid) {

        // success/error function(data, status, headers, config) { ... }
        $http.post('php/sendmail.php', $scope.message)
          .success(() => {
            $scope.mailsent = true;
            $scope.error = false;
          })
          .error(() => {
            $scope.error = true;
          });
      }
    };

    $scope.cancel = () => {
      $location.path('/kontakt');
    };

    $scope.reset = () => {
      $route.reload();
    };
  });

  mkControllers.controller('RouteController', ($scope:ng.IScope, $location:ng.ILocationService) => {
    var parts = $location.path().split('/');
    var slug = parts.length > 1 ? parts[1] : "";
    $scope.$emit('routeLoaded', { slug: slug });
  });
}