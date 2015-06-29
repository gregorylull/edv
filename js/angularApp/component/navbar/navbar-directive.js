angular.module('edv-navbar', [])
.directive('edvNavbar', function () {
  return {
    restrict: "A",
    templateUrl: edvContent.ngPath + "/component/navbar/navbar-directive.html"
  };
});
