var homeControllers = angular.module('indexControllers', []);

homeControllers.controller('main', ['$scope', function($scope) {

    $scope.keyController = function(key) {
        function reset() {
            $("#search-area").hide();
            $("#notif-div").hide();
            $("#notif-msg-div").hide();
            $("#search-input").blur();
        }

        if (key.which == 27) reset()

    }

    $scope.template = [];

    $scope.template.header = '/public/views/templates/header.html'

}]);

homeControllers.controller('header', ['$scope', '$http', function($scope, $http) {

    $scope.toggleSideMenu = function() {
        $("#side-menu").toggle();
        $("#side-menu").toggleClass('hidden-sm-down');
    }

    $http.get('/ajax/data').then(function(response) {
        data = response.data
        $scope.header = data;
        $scope.user = data.user;
    }, function() {
        console.log('Failed to get data');
    });

    $scope.hideSearchResults = function() {
        $("#search-area").hide();
    }

    $scope.template.search = '/public/views/templates/search.html'

}]);

homeControllers.controller('questionsList', ['$scope', '$http', function($scope, $http) {

    $http.get('/ajax/data').then(function(response) {
        $scope.questions = response.data.questions;
    });

}]);

homeControllers.controller('groupsList', ['$scope', '$http', function($scope, $http) {

    $http.get('/ajax/data').then(function(response) {
        $scope.groups = response.data.groups;
    }, function() {
        console.log('Failed to get data');
    });

}]);

homeControllers.controller('group', ['$scope', '$http', '$httpParamSerializerJQLike', function($scope, $http, $httpParamSerializerJQLike) {

    $scope.joinGroup = function() {
        var data = {}
        data.token = token
        data.id = url_array[1]
        $http({
                url: '/ajax/group/join',
                method: 'POST',
                data: $httpParamSerializerJQLike(data),
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            })
            .then(function(response) {
                    if(response.data.success) {
                        $scope.requested = true;
                    }
                },
                function(response) {
                    console.log('Request Failed: ' + response)
                });
    }

    $scope.accept = function(user_id) {
        var data = {}
        data.token = token
        data.id = url_array[1]
        data.user_id = user_id
        $http({
                url: '/ajax/group/accept',
                method: 'POST',
                data: $httpParamSerializerJQLike(data),
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            })
            .then(function(response) {
                    console.log(response.data);
                },
                function(response) {
                    console.log('Request Failed: ' + response)
                });
        console.log("Accept " + user_id);
    }

    $scope.reject = function(user_id) {
        var data = {}
        data.token = token
        data.id = url_array[1]
        data.user_id = user_id
        $http({
                url: '/ajax/group/reject',
                method: 'POST',
                data: $httpParamSerializerJQLike(data),
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            })
            .then(function(response) {
                    console.log(response.data);
                },
                function(response) {
                    console.log('Request Failed: ' + response)
                });
        console.log("Reject " + user_id)
    }

}]);

homeControllers.controller('profile', ['$scope', '$http', '$httpParamSerializerJQLike', function($scope, $http, $httpParamSerializerJQLike) {

    username = url_array[1]

    data = {}
    data.username = username
    data.token = token

    $http({
            url: '/ajax/profile/data',
            method: 'POST',
            data: $httpParamSerializerJQLike(data),
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        })
        .then(function(response) {
                $scope.userData = response.data
                $scope.following = response.data.following
                $scope.default = response.data.default
            },
            function(response) {
                console.log('Request Failed: ' + response)
            });



    $scope.follow = function() {
        var data = {}
        data.token = token
        data.username = url_array[1]

        $http({
                url: '/ajax/profile/follow',
                method: 'POST',
                data: $httpParamSerializerJQLike(data),
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            })
            .then(function(response) {
                    $scope.following = true
                },
                function(response) {
                    console.log('Request Failed: ' + response)
                });
    }

    $scope.unfollow = function() {
        var data = {}
        data.token = token
        data.username = url_array[1]
        $http({
                url: '/ajax/profile/unfollow',
                method: 'POST',
                data: $httpParamSerializerJQLike(data),
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            })
            .then(function(response) {
                    $scope.following = false
                },
                function(response) {
                    console.log('Request Failed: ' + response)
                });
    }

}]);