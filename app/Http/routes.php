<?php

get('/','home@index');
get('/home', array('middleware'=>['auth'],'uses'=>'home@main','as'=>'home'));

get('/reports',function(){
	return view('reports.reports')
		   ->with(array('title'=>'Reports'));
});

post('/reports', array('uses'=>'ReportsController@generateReports','as'=>'generatereports'));

get('/logout', array('uses'=>'SessionController@destroy','as'=>'logout'));
post('/changepassword', array('uses'=>'SessionController@change','as'=>'change'));
resource('sessions','SessionController',['only' => ['destroy','store']]);

get('publication/accession',array('middleware' => ['auth','authorize'],'uses'=>'PublicationController@getcontrolAccession','as'=>'getcontrolAccession'));
post('publication/accession',array('middleware' => ['auth','authorize'],'uses'=>'PublicationController@controlAccession','as'=>'controlAccession'));
patch('publication/accession',array('middleware' => ['auth','authorize'],'uses'=>'PublicationController@updateAccession','as'=>'updateAccession'));

get('/publication/add',array('middleware' => ['auth','authorize'],'uses'=>'PublicationController@getaddPublication'));
post('/publication/add',array('middleware' => ['auth','authorize'],'uses'=>'PublicationController@addPublication','as'=>'addPublication'));

get('/acquisition',array('middleware' => ['auth','authorize'],'uses'=>'AcquisitionController@getisbn'));
post('/acquisition',array('middleware' => ['auth','authorize'],'uses'=>'AcquisitionController@fetchisbn','as'=>'fetchisbn'));

get('/acquisition/add',array('middleware' => ['auth','authorize'],'uses'=>'AcquisitionController@getAcquisition'));
post('/acquisition/add',array('middleware' => ['auth','authorize'],'uses'=>'AcquisitionController@addAcquisition','as'=>'addAcquisition'));

get('/publication/update',array('middleware' => ['auth','authorize'],'uses'=>'PublicationController@getupdatePublication'));
post('/publication/update',array('middleware' => ['auth','authorize'],'uses'=>'PublicationController@updatePublication','as'=>'updatePublication'));
put('/publication/update',array('middleware' => ['auth','authorize'],'uses'=>'PublicationController@updatePub','as'=>'updatePub'));

get('/publication/issue',array('middleware' => ['auth','authorize'],'uses'=>'CirculationController@getissuePublication'));
get('/publication/issue/{id}',array('middleware' => ['auth','authorize'],'uses'=>'CirculationController@issue'));
post('/publication/issue',array('middleware' => ['auth','authorize'],'uses'=>'CirculationController@issuePublication','as'=>'issuePublication'));

get('/publication/return',array('middleware' => ['auth','authorize'],'uses'=>'CirculationController@getreturnPublication'));
post('/publication/return',array('middleware' => ['auth','authorize'],'uses'=>'CirculationController@returnPublication','as'=>'returnPublication'));
post('/return',array('middleware' => ['auth','authorize'],'uses'=>'CirculationController@returnedPublication','as'=>'returnedPublication'));

get('/reader/find',array('middleware' => ['auth','authorize'],'uses'=>'SessionController@getreader','as'=>'getreader'));
post('/reader/find',array('middleware' => ['auth','authorize'],'uses'=>'SessionController@findReader','as'=>'findreader'));

get('/reader/add',array('middleware' => ['auth','authorize'],'uses'=>'SessionController@getaddReader','as'=>'getaddreader'));
post('/reader/add',array('middleware' => ['auth','authorize'],'uses'=>'SessionController@addReader','as'=>'addReader'));

get('/reader/update',array('middleware' => ['auth','authorize'],'uses'=>'SessionController@getupdateReader','as'=>'getupdatereader'));
post('/reader/update',array('middleware' => ['auth','authorize'],'uses'=>'SessionController@updateReader','as'=>'updateReader'));
patch('/reader/update',array('middleware' => ['auth','authorize'],'uses'=>'SessionController@update','as'=>'update'));

get('/reader/migrate',array('middleware' => ['auth','authorize'],'uses'=>'SessionController@getmigrateReaders', 'as'=>'getmigrateReader'));
post('/reader/migrate',array('middleware' => ['auth','authorize'],'uses'=>'SessionController@migrateReaders', 'as'=>'migratereaders'));

get('/reader/resetpassword',array('middleware' => ['auth','authorize'],'uses'=>'SessionController@getResetPassword', 'as'=>'getResetPassword'));
post('/reader/resetpassword',array('middleware' => ['auth','authorize'],'uses'=>'SessionController@resetPassword', 'as'=>'resetPassword'));

get('/vendor/add',array('middleware' => ['auth','authorize'],'uses'=>'VendorController@getaddVendor','as'=>'getaddvendor'));
post('/vendor/add',array('middleware' => ['auth','authorize'],'uses'=>'VendorController@addVendor','as'=>'addVendor'));

get('/get/vendor',array('middleware' => ['auth','authorize'],'uses'=>'VendorController@returnvendor'));

get('/vendor/find',array('middleware' => ['auth','authorize'],'uses'=>'VendorController@getvendor','as'=>'getvendor'));
post('/vendor/find',array('middleware' => ['auth','authorize'],'uses'=>'VendorController@findVendor','as'=>'findvendor'));

get('/vendor/update',array('middleware' => ['auth','authorize'],'uses'=>'VendorController@getupdateVendor','as'=>'getVendor'));
post('/vendor/update',array('middleware' => ['auth','authorize'],'uses'=>'VendorController@updateVendor','as'=>'updatevendor'));
patch('/vendor/update',array('middleware' => ['auth','authorize'],'uses'=>'VendorController@updatevend','as'=>'updatevend'));

get('/search/{book}/query/{query}',array('uses'=>'SearchController@search','as'=>'search'));
get('/searchtitle',array('uses'=>'SearchController@searchTitle'));
get('/search/vendor',array('middleware' => ['auth','authorize'],'uses'=>'SearchController@vendor'));
get('/search/reader',array('middleware' => ['auth','authorize'],'uses'=>'SearchController@reader'));
get('/search/book/{value}',array('uses'=>'SearchController@searchBook'));

get('/pending/{id}',array('middleware' => ['auth','authorize'],'uses'=>'CirculationController@getPendingdetails'));

get('/get/accession',array('middleware' => ['auth','authorize'],'uses'=>'AcquisitionController@getAccession'));