var calibrary = angular.module('calibrary');

calibrary.controller('CirculationController', function($scope,$http,config) {

  $scope.issuePublication = function(reader){
    $http.post(config.baseUrl+'circulation/issue',reader).then(
      function(response){
        if(response.data.status.code == 200){
          window.location.href = '/circulation/issue/'+reader.readerid;
        }
      },
      function(response){
        $scope.flash_message = response.data.status.message;
      }
    )
  }

  $scope.returnPublication = function(circulation){
    $http.put(config.baseUrl+'circulation/return',circulation).then(
      function(response){
        if(response.data.status.code == 200){
          window.location.href = '/circulation/issue/'+circulation.readerid;
        }
      },
      function(data){
        $scope.flash_message = data.status.message;
      }
    )
  }

  $scope.getPublicationInfo = function(accession_no){
    $http.get(config.baseUrl+'circulation/publication/'+accession_no).then(
      function(response){
        $scope.isbn = response.data.data[0].isbn;
        $scope.title = response.data.data[0].title;
        $scope.author = response.data.data[0].author;
      },
      function(response){
        console.log(response);
      }
    )

  }
});
