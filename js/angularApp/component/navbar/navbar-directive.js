// navbar
/*
About Us, Services, Our Process, Case Studies, Contact Us

Our Process
Proven Results in College Admission Rates
College Admission Experts
Strength of a Team
Personalized Approach

CSS only dropdown menu and css:hover?

OR angular mouse bind on enter?

CSS seems like it would be more...lean? But more complicated as well?

But since this is an angular SPA, it would be easier to do "selected" highlighting later on.

- we have tabs
- we have panes/subsection
  + panes contain links to subsections

All subsection content (txt, links, imgs) are preloaded and not lazily.
- On mouseenter, pane is displayed
- On mouse leave, pane is hidden again
- Check URL to highlight?

*/

(function () {
  'use strict';

  var dataController = function ($scope) {
    var placeholder = "http://placehold.it/125x125";
    this.isATest = 'test test';
    this.isAnotherTest = {hello: true};

    var links = [
      'About Us',
      'Services',
      'Our Process',
      'Case Studies',
      'Contact Us'
    ];

    var pics = links.map(function (name) {
      return placeholder + "?" + "text=" + name[0].toUpperCase();
    });

    var navbar = $scope.navbar = this.navbar = {};
    this.links = [];
    this.order = {};
    links.forEach(function (el, index) {
      this.links.push({
        title: el,
        order: index,
        navHover: false,
        placeholder: pics[index]
      });

      console.log('placeholder: ', this.links[index].placeholder);
      this.order[el] = index;
    }, this);

    this.links[this.order['Our Process']].sub = [
      "Proven Results in College Admission Rates",
      "College Admission Experts",
      "Strength of a Team",
      "Personalized Approach"
    ];

    $scope.navbar.links = this.links;
    $scope.links = this.links;
    $scope.order = this.order;
    $scope.honey = ['a', 'ab', 'abc', 'abcd', 'abcde'];


    navbar.sayHello = function (name) { name = name || 'greg'; console.log('hello',name); }

    navbar.showLinks = function (linkObj) {
      linkObj.navHover = true;
    };

    navbar.hideLinks = function (linkObj) {
      linkObj.navHover = false;
    };
  }

  angular.module('edv-navbar', ['edv.filter'])
  .directive('edvNavbar', function ($timeout) {
    return {
      restrict: "A",
      scope : {},
      templateUrl: edvContent.ngPath + "/component/navbar/navbar-directive.html",
      controller: dataController,
      link: function (scope, element, attr) {

      } // end link function
    }; // end directive definition object 
  }) // end edv-navbar directive

  // 
  .directive('edvNavbarSubsection', function () {
    return {
      restrict: "A",
      require: '^edvNavbar',
      scope: false,
      controllerAs: 'myTest',
      link: function (scope, element, attrs, edvNavbarCtrl) {
        // var subsection = scope.subsection = {};
        // subsection.placeholder = edvNavbarCtrl.placeholder;
      } // end link
    } // end DDO
  }); // end edv-navbar-subsection directive

})();
