var leaderboardApp = angular.module('leaderboardApp', []);

leaderboardApp.controller('LeaderboardCtrl', function ($scope, $http, $timeout) {

    $scope.newParticipant = '';

    (function tick() {
        $http({
            method: 'GET',
            url: 'http://localhost:8000/leaderboard'
        }).success(function(data){
            $scope.participants = data;
            if (!$scope.selectedParticipant) {
                $scope.selectedParticipant = $scope.participants[0];
            }
            $timeout(tick, 5000);
        }).error(function(data, status){
            alert('There has been an error');
            $timeout(tick, 000);
        });
    })();

    $scope.selectParticipant = function(participant) {
        $scope.selectedParticipant = participant;
    }

    $scope.addPoints = function(points) {
        $http({
            method: 'GET',
            url: 'http://localhost:8000/addPointsToParticipant/' + $scope.selectedParticipant.id + '/' + points
        }).success(function(data){
            $scope.participants = data;
        }).error(function(data, status){
            alert('There has been an error');
        });
    }

    $scope.addParticipant = function() {
        $http({
            method: 'GET',
            url: 'http://localhost:8000/addParticipant/' + $scope.newParticipant
        }).success(function(data){
            $scope.participants = data;
        }).error(function(data, status){
            alert('There has been an error');
        });
    }

});