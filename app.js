// 
(function (window) {
'use strict';

  angular.module("edvApp", [
    'ngRoute',
    'edv-header',
    'edv-navbar'
  ])
  .config(['$routeProvider', function ($routeProvider) {
    var componentPath = edvContent.ngPath + "component/";
    console.log('route provider executed', componentPath);
    $routeProvider
      .otherwise({
        redirctTo: '/'
      });
  }]);

})(window);
