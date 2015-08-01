// navbar
/*
About Us, Services, Our Process, Case Studies, Contact Us

Our Process
Proven Results in College Admission Rates
College Admission Experts
Strength of a Team
Personalized Approach

*/
angular.module('edv-navbar', [])
.directive('edvNavbar', function () {
  return {
    restrict: "A",
    scope : {},
    controller: function ($scope) {
      var links = [
        'About Us',
        'Services',
        'Our Process',
        'Case Studies',
        'Contact Us'
      ];

      $scope.placeholder = "http://placehold.it/100x100";

      $scope.links = [];
      $scope.order = {};
      links.forEach(function (el, index) {
        $scope.links.push({
          title: el,
          order: index
        });

        $scope.order[el] = index;
      });

      $scope.links[$scope.order['Our Process']].sub = [
        "Proven Results in College Admission Rates",
        "College Admission Experts",
        "Strength of a Team",
        "Personalized Approach"
      ];
    },
    templateUrl: edvContent.ngPath + "/component/navbar/navbar-directive.html"
  };
});
