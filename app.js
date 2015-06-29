'use strict';
(function (window) {

  angular.module("edvApp", [
    'ngRoute',
    'edv-header',
    'edv-navbar'
  ])
  .config(['$routeProvider', function ($routeProvider) {
    var componentPath = edvContent.ngPath + "component/";
    console.log('route provider executed', componentPath);
    $routeProvider
      .when('/test1', {
        templateUrl: componentPath + 'test1.html'
      })
      .when('/test2', {
        templateUrl: componentPath + 'test2.html'
      })
      .when('/test3', {
        templateUrl: componentPath + 'test3.html'
      })
      .otherwise({
        redirctTo: '/'
      });
  }]);

})(window);
