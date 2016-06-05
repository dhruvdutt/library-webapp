<?php

get('/','home@index');
get('/home', array('middleware'=>['auth'],'uses'=>'home@main','as'=>'home'));

get('/reports',array('middleware'=>['auth','authorize'],function(){
	return view('reports.reports')
		   ->with(array('title'=>'Reports','message'=>'Reports'));
}));
post('/reports', array('middleware'=>['auth','authorize'],'uses'=>'ReportsController@generateReports','as'=>'generatereports'));

get('/developers',function(){
	return view('developers')
		   ->with(array('title'=>'Developers'));
});

Route::resource('sessions','SessionController',['only' => ['destroy','store']]);
get('/logout', array('uses'=>'SessionController@destroy','as'=>'logout'));

Route::group(['prefix'=>'cataloging'],function(){
	get('/publication/find',array('middleware' => ['auth','authorize'],'uses'=>'PublicationController@getFindPublication'));
	post('/publication/details',array('middleware' => ['auth','authorize'],'uses'=>'PublicationController@findPublication','as'=>'findpublication'));
	get('/publication/add',array('middleware' => ['auth','authorize'],'uses'=>'PublicationController@getaddPublication'));
	post('/publication/add',array('middleware' => ['auth','authorize'],'uses'=>'PublicationController@addPublication','as'=>'addPublication'));
	get('/publication/update/{isbn}',array('middleware' => ['auth','authorize'],'uses'=>'PublicationController@getUpdatePublication'));
	put('/publication/update',array('middleware' => ['auth','authorize'],'uses'=>'PublicationController@updatePublication','as'=>'updatePublication'));
	get('/serial/find',array('middleware' => ['auth','authorize'],'uses'=>'SerialController@getFindSerial'));
	post('/serial/find',array('middleware' => ['auth','authorize'],'uses'=>'SerialController@findSerial','as'=>'findserial'));
	get('/serial/add',array('middleware' => ['auth','authorize'],'uses'=>'SerialController@getAddSerial'));
	post('/serial/add',array('middleware' => ['auth','authorize'],'uses'=>'SerialController@addSerial','as'=>'addSerial'));
	get('/serial/update/{serialno}',array('middleware' => ['auth','authorize'],'uses'=>'SerialController@getUpdateSerial'));
	put('/serial/update',array('middleware' => ['auth','authorize'],'uses'=>'SerialController@updateSerial','as'=>'updateSerial'));
});

Route::group(['prefix'=>'circulation'],function(){
	get('/issue/{id}',array('middleware' => ['auth','authorize'],'uses'=>'CirculationController@getPendingdetails'));
	post('/issue',array('middleware' => ['auth','authorize'],'uses'=>'CirculationController@issuePublication','as'=>'issuePublication'));
	put('/return',array('middleware' => ['auth','authorize'],'uses'=>'CirculationController@returnPublication','as'=>'returnPublication'));
	get('/publication/{accession_no}',array('middleware' => ['auth','authorize'],'uses'=>'CirculationController@getPublicationInfo'));
});

Route::group(['prefix'=>'acquisition'],function(){
	get('/publication',array('middleware' => ['auth','authorize'],'uses'=>'AcquisitionController@getisbn'));
	post('/publication',array('middleware' => ['auth','authorize'],'uses'=>'AcquisitionController@fetchisbn','as'=>'fetchisbn'));
	get('/publication/add',array('middleware' => ['auth','authorize'],'uses'=>'AcquisitionController@getAcquisition'));
	post('/publication/add',array('middleware' => ['auth','authorize'],'uses'=>'AcquisitionController@addAcquisition','as'=>'addAcquisition'));
	get('/serial',array('middleware' => ['auth','authorize'],'uses'=>'AcquisitionSerialController@getserialno'));
	post('/serial',array('middleware' => ['auth','authorize'],'uses'=>'AcquisitionSerialController@fetchserialno','as'=>'fetchserialno'));
	get('/serial/add',array('middleware' => ['auth','authorize'],'uses'=>'AcquisitionSerialController@getSerialAcquisition'));
	post('/serial/add',array('middleware' => ['auth','authorize'],'uses'=>'AcquisitionSerialController@addSerialAcquisition','as'=>'addSerialAcquisition'));
	});

Route::group(['prefix'=>'reader'],function(){
	get('/add',array('middleware' => ['auth','authorize'],'uses'=>'SessionController@getaddReader'));
	post('/add',array('middleware' => ['auth','authorize'],'uses'=>'SessionController@addReader','as'=>'addReader'));
	get('/find',array('middleware' => ['auth','authorize'],'uses'=>'SessionController@getFindReader'));
	post('/details',array('middleware' => ['auth','authorize'],'uses'=>'SessionController@findReader','as'=>'findreader'));
	get('/update/{id}',array('middleware' => ['auth','authorize'],'uses'=>'SessionController@getupdateReader','as'=>'getUpdateReader'));
	put('/update',array('middleware' => ['auth','authorize'],'uses'=>'SessionController@updateReader','as'=>'updateReader','as'=>'updatereader'));
	get('/resetpassword/{id}',array('middleware' => ['auth','authorize'],'uses'=>'SessionController@resetPassword'));
	post('/changepassword',array('middleware' => ['auth','authorize'],'uses'=>'SessionController@changePassword','as'=>'change'));
});

Route::group(['prefix'=>'vendor'],function(){
	get('/add',array('middleware' => ['auth','authorize'],'uses'=>'VendorController@getaddVendor'));
	post('/add',array('middleware' => ['auth','authorize'],'uses'=>'VendorController@addVendor','as'=>'addVendor'));
	get('/find',array('middleware' => ['auth','authorize'],'uses'=>'VendorController@getvendor','as'=>'getvendor'));
	post('/find',array('middleware' => ['auth','authorize'],'uses'=>'VendorController@findVendor','as'=>'findvendor'));
	get('/update/{id}',array('middleware' => ['auth','authorize'],'uses'=>'VendorController@getupdateVendor','as'=>'getVendor'));
	put('/update',array('middleware' => ['auth','authorize'],'uses'=>'VendorController@updateVendor','as'=>'updatevendor'));
	get('/get',array('middleware' => ['auth','authorize'],'uses'=>'VendorController@returnvendor'));
});

Route::group(['prefix'=>'restrict'],function(){
    get('/issue',['middleware' => ['auth','authorize'],'uses'=>'IssueRestrictionController@getrestrictionData']);
    post('/issue',['middleware' => ['auth','authorize'],'uses'=>'IssueRestrictionController@restrictIssue']);
    put('/issue/{year}',['middleware' => ['auth','authorize'],'uses'=>'IssueRestrictionController@updateRestriction']);
});

post('/fine/collect',array('middleware' => ['auth','authorize'],'uses'=>'IssueRestrictionController@collectFine'));

get('/migrate/{year}',array('middleware' => ['auth','authorize'],'uses'=>'SessionController@getmigrateReaders', 'as'=>'getmigrateReader'));
post('/migrate',array('middleware' => ['auth','authorize'],'uses'=>'SessionController@migrateReaders', 'as'=>'migratereaders'));

get('/accession',array('middleware' => ['auth','authorize'],'uses'=>'PublicationController@getAccession'));
get('/publication/accession',array('middleware' => ['auth','authorize'],'uses'=>'PublicationController@getcontrolAccession','as'=>'getcontrolAccession'));
post('/publication/accession',array('middleware' => ['auth','authorize'],'uses'=>'PublicationController@controlAccession','as'=>'controlAccession'));
patch('/publication/accession',array('middleware' => ['auth','authorize'],'uses'=>'PublicationController@updateAccession','as'=>'updateAccession'));

get('/search/{book}/query/{query}',array('uses'=>'SearchController@search','as'=>'search'));
get('/search/publication',array('middleware' => ['auth','authorize'],'uses'=>'SearchController@searchPublication'));
get('/search/serial',array('middleware' => ['auth','authorize'],'uses'=>'SearchController@searchSerial'));
get('/search/vendor',array('middleware' => ['auth','authorize'],'uses'=>'SearchController@vendor'));
get('/search/reader',array('middleware' => ['auth','authorize'],'uses'=>'SearchController@reader'));
get('/search/book/{value}/query/{query}',array('uses'=>'SearchController@searchBook'));

get('/old/records/{year_enrolled}/{year}',array('middleware' => ['auth','authorize'],'uses'=>'OldRecordsController@getOldRecords'));

get('/me', array('middleware' => ['auth','authorize'],'uses'=>'SessionController@profile'));
