'use strict';

/**
 Author: Taban Cosmos

 */

/*  Login controller */


roomly.controller("userAuthentication", function ($scope, $http, $state) {

    /**
     *==================================================
     * Validate user inputs
     *==================================================*/

    var errors = {
        firstName: "First name required",
        lastName: "Last name required",
        email: "Valid emil required",
        password: "Password is required"
    };


    /* Grab the data from the user */
    $scope.loginInfo = {
        email: undefined,
        password: undefined
    };

    if ($scope.firstName == undefined) $scope.firstnameERROR = errors.firstName;
    if ($scope.lastName == undefined) $scope.lastnameERROR = errors.lastName;

    $scope.login = function () {
        $scope.message = $scope.loginInfo.email;
        var data = {
            email: $scope.loginInfo.email,
            password: $scope.loginInfo.password
        };


        console.log(data.email + data.password);

        if (data.email === undefined || data.password === undefined) {
            console.log("Check your password or email");
            $state.go("/login");

        } else {
            //Post information to the server
            $http.post("../includes/API/authentication.api.php", data).success(function (response) {
                console.log(" Test " + response);
                localStorage.setItem("token", JSON.stringify(response));
                if (response === "Error") {
                    $state.go("/authsignup");
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
            $state.go("/authsignup");

        }).error(function (error) {
            console.error(error);
        });
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

    /* Grab data from the user input */
    $scope.signUpInfo = {
        firstName: undefined,
        lastName: undefined,
        email: undefined,
        password: undefined,
        confirmPassword: undefined,
        roomOwner: 0
    };


    $scope.signUp = function () {

        var data = {

            firstName: $scope.signUpInfo.firstname,
            lastName: $scope.signUpInfo.lastname,
            email: $scope.signUpInfo.email,
            password: $scope.signUpInfo.password,
            confirmPassword: $scope.signUpInfo.confirmPassword,
            roomOwner: $scope.signUpInfo.roomOwner
        };

        console.log(data.firstName + " " + data.lastName + " " +
            data.email + " " + data.roomOwner)


        if (data.firstName == undefined) {
            $scope.firstnameERROR = "field cannot be empty"
        }
        if (data.lastName == undefined) {
            $scope.lastnameERROR = "field cannot be empty";
        }

        if (data.email == undefined) {
            $scope.emailERROR = "field cannot be empty";
        }

        if (data.password == undefined) {
            $scope.passwordError = "field cannot be empty";
        }
        /**=====================================================
         * Post information to the server
         *=====================================================*/
        $http.post("../Includes_PHP/API/userRegistration.api.php", data).success(function (response) {

            localStorage.setItem("uid", JSON.stringify(response));
            $state.go("/main");

        }).error(function (error) {
            console.log(error);

        })


    }; //End of sign up


});
