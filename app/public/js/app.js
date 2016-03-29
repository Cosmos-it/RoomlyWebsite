/**
 * Created by Taban on 9/10/15.
 */

'use strict';

var roomly = angular.module('roomly', ['ui.router']);

// configure our routes
roomly.config(['$stateProvider', '$urlRouterProvider',
    function ($stateProvider, $urlRouterProvider) {

        $urlRouterProvider.otherwise('/register');
        $stateProvider
        // route for the about page
            .state('/about', {
                url: '/about',
                templateUrl: 'views/about.html',
                controller: 'AboutController'
            })


    }]);

roomly.run(function ($rootScope, $location, loginService) {
    var routespermission = ['/register'];  //route that require login
    $rootScope.$on('$routeChangeStart', function () {

        if (routespermission.indexOf($location.path()) != -1) {
            var connected = loginService.islogged();
            connected.then(function (msg) {
                if (!msg.data) $location.path('/login');
            });
        }
    });
});


















