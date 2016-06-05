var calibrary = angular.module('calibrary');

calibrary.controller('OldRecordsController', function($scope,$http,config) {
  $scope.getOldRecords = function(old){
    window.location.href = '/old/records/'+old.year_enrolled+'/'+old.year;
  }
});
