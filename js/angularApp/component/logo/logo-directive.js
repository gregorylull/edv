// to retrieve the logo, either the whole logo, or the words only or image
(function (window) {
  'use strict';
  angular.module('edv-logo', [])
  .directive('edvLogo', [function () {
    return {
      restrict: 'A',
      scope: {
        'logoType' : '@edvLogo'
      },
      controller: function ($scope) {
        var logo = {};
        logo.style = $scope.logoType;

        switch ($scope.logoType) {
          case 'all':
            logo.alt = "EdVentures Logo, picture and words";
            logo.source = "http://localhost:1337/wp-content/uploads/2015/07/logoWithWords.png";
            break;
          
          case 'words':
            logo.alt = "EdVentures Logo, words only";
            break;

          case 'picture':
            logo.alt = "EdVentures Logo, picture only";
            break;
          default:
            logo.alt = "EdVentures Logo";
            break;
        }

        $scope.logo = logo;
      },
      templateUrl: edvContent.ngPath + "/component/logo/logo-directive.html",
      replace: true
    };
  }]);
})(window);