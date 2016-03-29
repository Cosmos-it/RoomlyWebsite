/**
 *=======================================================
 * Created by Taban on 9/26/15.
 */

/**======================================================
 * Login controller
 *======================================================*/

'use strict';

roomly.controller("LoginController", function ($scope, $http, $state) {

    /** User login data */
    $scope.loginInfo = {
        email: undefined,
        password: undefined
    };

    /** User sign up data */

    $scope.signUpInfo = {
        firstName: undefined,
        lastName: undefined,
        email: undefined,
        password: undefined,
        confirmPassword: undefined,
        roomOwner: 0
    };

    /** Login  function */

    $scope.login = function () {

        var data = {
            email: $scope.loginInfo.email,
            password: $scope.loginInfo.password
        };

        /*** Validate user information to not to be empty. Same test in the backend as well.  */

        if (data.email === undefined && data.password === undefined) {
            console.log("Check your password or email");
            $scope.error = "Check your password or email, 4 tries";
            $state.go("/login");

        } else {

            /** Post information to the server */

            $http.post("../Includes_PHP/API/authentication.api.php", data).success(function (response) {
                console.log(" Test " + response);
                localStorage.setItem("uid", JSON.stringify(response));
                if (response === "Error") {
                    $state.go("/login");

                } else {
                    $state.go("/browseAllroommates");
                }
            }).error(function (error) {
                console.log(error);
            });
        }
    };

    /* Sign up */
    $scope.signUp = function () {
        var data = {

            firstName: $scope.signUpInfo.firstName,
            lastName: $scope.signUpInfo.lastName,
            email: $scope.signUpInfo.email,
            password: $scope.signUpInfo.password,
            confirmPassword: $scope.signUpInfo.confirmPassword,
            roomOwner: $scope.signUpInfo.roomOwner

        };

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
    };

    /**=========================================================
     * Work in progress
     * 1. The user should be able to login and
     * then after logging out the user information should be updated
     *==========================================================*/
    $scope.logout = function () {
        var token = JSON.parse(localStorage['uid']);
        var data = {
            token: token
        };
        $http.post("../Includes_PHP/API/logout.api.php", data).success(function (response) {
            console.log(" Test " + response);
            localStorage.clear();
            $state.go("/login");

        }).error(function (error) {
            console.error(error);
            $scope.messsage = error;
        });
    };
});