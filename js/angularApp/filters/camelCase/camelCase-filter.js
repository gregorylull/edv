// filter function returns the camelCase of a string
// i.e. hello there
(function () {
  'use strict';
  angular.module('edv.filter', []).filter('camelCaseSpace',function () {

    var memoized = {};

    return function (string) {
      if (memoized[string]) { return memoized[string]; }
      return memoized[string] = string.trim().toLowerCase().split(' ').map(function (str, index) {
        if (index === 0) { return str; }
        else {
          return str[0].toUpperCase() + str.substring(1);
        }
      }).join('');
    };
  });
})();
//