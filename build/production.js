angular.module("edvApp", ['edv-header-directive']);

angular.module('edv-header-directive', [])
.directive('edvHeader', function () {
  console.log('inside directive function');
  return {
    restrict: "A",
    templateUrl: edvThemeLocal.ngPath + "/component/header/header-directive.html",
  };
});
 