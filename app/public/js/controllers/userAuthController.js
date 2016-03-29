'use strict';

/**
 Author: Taban Cosmos

 */

/*  Login controller */

roomly.controller("userController", function ($scope, $http, $state) {

    //Login information
    $scope.loginInfo = {
        email: undefined,
        password: undefined
    };

    /* login */
    $scope.login = function () {
        var data = {
            email: $scope.loginInfo.email,
            password: $scope.loginInfo.password
        };

        if (data.email === undefined || data.password === undefined) {
            console.log("Check your password or email");
            $state.go("/login");

        } else {

            //Post information to the server
            $http.post("../includes/API/authentication.api.php", data).success(function (response) {
                console.log(" Test " + response);
                localStorage.setItem("token", JSON.stringify(response));
                if (response === "Error") {
                    $state.go("/login");

                } else {
                    $state.go("/main");
                }
            }).error(function (error) {
                console.log(error);
            });
        }
    };

    /* Log out function.
     Status: Not completed
     */
    $scope.logout = function () {
        var token = JSON.parse(localStorage['token']);
        var data = {
            token: token
        };
        $http.post("../includes/API/logout.api.php", data).success(function (response) {
            console.log(" Test " + response);
            localStorage.clear();
            $state.go("/login");

        }).error(function (error) {
            console.error(error);
        });
    };
});
