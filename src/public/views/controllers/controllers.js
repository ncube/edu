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