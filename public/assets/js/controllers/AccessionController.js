var calibrary = angular.module('calibrary');

calibrary.controller('AccessionController', function($scope,$http,config) {
  $scope.range = function(upto,start){
  		if(typeof(start) == undefined) start = 1;
  		return _.range(start,upto);
  	}
  $scope.generateNumbers = function(quantity){
    $scope.quantity = quantity;
    $http.get(config.baseUrl+'accession').then(
      function(response){
        if(response.data.data == null){
          $scope.accession = 1000;
          $scope.class = 2000;
        }
        else{
          $scope.accession = response.data.data.accession_no;
          $scope.class = response.data.data.class_no;
        }
      },
      function(response){
        console.log(response);
      }
    );
    $('#accessionModal').modal({show:true,backdrop:false});
  }
});
