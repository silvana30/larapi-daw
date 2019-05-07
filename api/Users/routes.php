<?php

$router->get('/users', 'UserController@getAll');
$router->get('/users/{id}', 'UserController@getById');
//$router->post('/users', 'UserController@create');
$router->put('/users/{id}', 'UserController@update');
$router->delete('/users/{id}', 'UserController@delete');

//$router->get('/doctors','DoctorController@getAll');
//$router->get('/doctors/{id}', 'DoctorController@getById');
//$router->post('/doctors', 'DoctorController@create');
//$router->put('/doctors/{id}', 'DoctorController@update');
//$router->delete('/doctors/{id}', 'DoctorController@delete');
//
//
//$router->get('/medicalUnits','MedicalUnitController@getAll');
//$router->get('/medicalUnits/{id}', 'MedicalUnitController@getById');
//$router->post('/medicalUnits', 'MedicalUnitController@create');
//$router->put('/medicalUnits/{id}', 'MedicalUnitController@update');
//$router->delete('/medicalUnits/{id}', 'MedicalUnitController@delete');

$router->get('/userDetails','UserDetailsController@getAll');
$router->put('/userDetails', 'UserDetailsController@getById');
//$router->post('/userDetails', 'UserDetailsController@create');
$router->post('/userDetailsUpdate', 'UserDetailsController@update');
$router->delete('/userDetails/{id}', 'UserDetailsController@delete');
$router->get('/loggedUser','UserController@getLoggedUser');
$router->put('/upload','UserDetailsController@uploadPic');




$router->get('/comments','CommentsController@getAll');
$router->get('/comments/{id}', 'CommentsController@getById');
$router->post('/comments', 'CommentsController@create');
$router->put('/comments/{id}', 'CommentsController@update');
$router->delete('/comments/{id}', 'CommentsController@delete');