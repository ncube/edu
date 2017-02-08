var homeControllers = angular.module('indexControllers', []);

homeControllers.controller('main', ['$scope', function($scope, $http) {

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
        $("#side-menu").toggleClass('hidden-sm-down display-flex');
    }

    $http.get('/ajax/data').success(function(data) {
        $scope.header = data;
        $scope.user = data.user;
    });

    $scope.hideSearchResults = function() {
        $("#search-area").hide();
    }

    $scope.template.search = '/public/views/templates/search.html'

}]);

homeControllers.controller('questionsList', ['$scope', '$http', function($scope, $http) {

    $http.get('/ajax/data').success(function(data) {
        $scope.questions = data.questions;
    });

}]);

homeControllers.controller('groupsList', ['$scope', '$http', function($scope, $http) {

    $http.get('/ajax/data').success(function(data) {
        $scope.groups = data.groups;
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
                    console.log(response.data);
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