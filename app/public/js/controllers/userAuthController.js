'use strict';

/**
 Author: Taban Cosmos

 */

/*  Login controller */


roomly.controller("userAuthentication", function ($scope, $http, $state) {

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

    $scope.signUpInfo = {
        firstName: undefined,
        lastName: undefined,
        email: undefined,
        password: undefined,
        confirmPassword: undefined,
        roomOwner: 0
    };

    /* Sign up */

    /**
     *=======================================================
     * validate user inputs before passing data to the server
     * The server will do another validation and send error
     * if the user is already registered or a some how the it
     * by pass the client side validation in case of hacking.
     *
     * display message to all the fields if they are empty.
     *
     *=======================================================
     */
    $scope.signUp = function () {
        var data = {

            firstName: $scope.signUpInfo.firstName,
            lastName: $scope.signUpInfo.lastName,
            email: $scope.signUpInfo.email,
            password: $scope.signUpInfo.password,
            confirmPassword: $scope.signUpInfo.confirmPassword,
            roomOwner: $scope.signUpInfo.roomOwner

        };

        if (data.firstName == undefined) {

        }

        /**=====================================================
         * Post information to the server
         *=====================================================*/
        $http.post("../Includes_PHP/API/userRegistration.api.php", data).success(function (response) {
            console.log(" Test " + response[0]);
            localStorage.setItem("uid", JSON.stringify(response));
            $state.go("/editProfile");

        }).error(function (error) {
            console.log(error);

        })

    }; //End of sign up




});
