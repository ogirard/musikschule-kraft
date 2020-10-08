/**
 * Directives for MK app
 */

/// <reference path="../bower_components/DefinitelyTyped/jquery/jquery.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/angularjs/angular.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/angularjs/angular-route.d.ts" />
/// <reference path="../bower_components/DefinitelyTyped/bootstrap/bootstrap.d.ts" />
/// <reference path="mk-util.ts"/>
/// <reference path="mk-ui.ts"/>

module MusikschuleKraft {
  var mkDirectives = angular.module('mkDirectives', []);

  mkDirectives.directive('mkTest', () => ({
    restrict: 'A',
    link: (scope, elem, attrs) => {
      // TODO
    }
  }));
}