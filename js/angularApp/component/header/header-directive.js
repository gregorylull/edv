// 
(function (window) {
'use strict';
angular.module('edv-header', ['edv-logo'])
.directive('edvHeader', function () {
  console.log('edv-header: first line');
  return {
    restrict: "A",
    templateUrl: edvContent.ngPath + "/component/header/header-directive.html"
  };
});

})(window);