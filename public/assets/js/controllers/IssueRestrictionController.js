var calibrary = angular.module('calibrary');

calibrary.controller('IssueRestrictionController', function($scope,$http,config) {
  $scope.restrictions = {};
  $scope.getRestrictions = function(){
    $scope.restrictions = {};
    $http.get(config.baseUrl+'restrict/issue').success(
      function(response){
        $scope.restrictions = response.data;
      }
    ).error(
      function(data){
        console.log(data);
      }
    )
  }
  $scope.updateRestriction = function(year,restrict){
    $http.put(config.baseUrl+'restrict/issue/'+year,restrict).success(
      function(response){
        if(response.status.code == 200){
          $('#issueRestrictionModal').toggle();
          $scope.edit_restriction = false;
          $scope.getRestrictions();
        }
      }
    ).error(
      function(data){
        $scope.responseMessage = data.status.message;
      }
    )
  }
  $scope.collectFine = function(reader){
    console.log(reader);
    $http.post(config.baseUrl+'fine/collect/',reader).success(
      function(response){
        if(response.status.code == 200){
          $('#collectFineModal').toggle();
        }
      }
    ).error(
      function(data){
        console.log(data);
        $scope.responseMessage = data.status.message;
      }
    )
  }
});
