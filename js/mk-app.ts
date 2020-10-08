/**
 * Main type script for www.musikschule-kraft.ch
 */

/// <reference path="../bower_components/DefinitelyTyped/jquery/jquery.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/angularjs/angular.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/angularjs/angular-route.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/googlemaps/google.maps.d.ts" />
/// <reference path="mk-util.ts"/>
/// <reference path="mk-ui.ts"/>

module MusikschuleKraft {
  export function Start():void {
    ApplyRendering();
    InitializeGoogleMaps();
  }

  var mkApp = angular.module('mkApp', [
    'ngRoute',
    'mkControllers',
    'mkDirectives'
  ]);
  
  mkApp.config(['$routeProvider', ($routeProvider:ng.route.IRouteProvider) => {
    $routeProvider
      .when('/', { templateUrl: 'partials/welcome.part.html', controller: 'RouteController' })
      .when('/kontakt', { templateUrl: 'partials/kontakt.part.html', controller: 'RouteController' })
      .when('/kontakt/formular', { templateUrl: 'partials/kontaktformular.part.html', controller: 'RouteController' })
      .when('/aktuell', { templateUrl: 'partials/aktuell.part.html', controller: 'RouteController' })
      .when('/aktuell/konzert/2018', { templateUrl: 'partials/konzert2018.part.html', controller: 'RouteController' })
      .when('/aktuell/konzert/2016', { templateUrl: 'partials/konzert2016.part.html', controller: 'RouteController' })
      .when('/aktuell/konzert/archiv', { templateUrl: 'partials/konzertarchiv.part.html', controller: 'RouteController' })
      .when('/aktuell/konzert/2004', { templateUrl: 'partials/konzertold.part.php?y=2004&h=930', controller: 'RouteController' })
      .when('/aktuell/konzert/2006', { templateUrl: 'partials/konzertold.part.php?y=2006&h=6200', controller: 'RouteController' })
      .when('/aktuell/konzert/2008', { templateUrl: 'partials/konzertold.part.php?y=2008&h=3250', controller: 'RouteController' })
      .when('/aktuell/konzert/2011', { templateUrl: 'partials/konzertold.part.php?y=2011&h=13300', controller: 'RouteController' })
      .when('/aktuell/konzert/2013', { templateUrl: 'partials/konzert2013.part.html', controller: 'RouteController' })
      .when('/angebot', { templateUrl: 'partials/angebot.part.html', controller: 'RouteController' })
      .when('/musikschule', { templateUrl: 'partials/musikschule.part.html', controller: 'RouteController' })
      .when('/unterricht', { templateUrl: 'partials/unterricht.part.html', controller: 'RouteController' })
      .when('/tipps', { templateUrl: 'partials/tipps.part.html', controller: 'RouteController' })
      .otherwise({ redirectTo: '/' });
  }]);
}

// jQuery ready
$(MusikschuleKraft.Start);


