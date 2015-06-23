(function () {
///
angular.module('edv-header', [])
.directive('edvHeader', function () {
  console.log('inside directive function');
  return {
    restrict: "A",
    templateUrl: edvContent.ngPath + "/component/header/header-directive.html",
  };
});

})();
