/**
 * Directives for MK app
 */

module MusikschuleKraft {
  var mkDirectives = angular.module('mkDirectives', []);

  mkDirectives.directive('mkTest', () => ({
    restrict: 'A',
    link: (scope, elem, attrs) => {
      // TODO
    }
  }));
}