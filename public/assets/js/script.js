var calibrary = angular.module('calibrary', [],function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

calibrary.constant('config',{
        'baseUrl':'http://localhost:8000/',
    });
