<?php

$router->post('/login', 'LoginController@login');
$router->post('/login/refresh', 'LoginController@refresh');
$router->post('/users', 'LoginController@create');




//
//$router->get('/doctors/{id}', 'DoctorController@getById');
//$router->post('/doctors', 'DoctorController@create');
//$router->put('/doctors/{id}', 'DoctorController@update');
//$router->delete('/doctors/{id}', 'DoctorController@delete');
//$router->get('/doctors','DoctorController@getAll');
//
//$router->get('/medicalUnits','MedicalUnitController@getAll');
//$router->get('/medicalUnits/{id}', 'MedicalUnitController@getById');
//$router->post('/medicalUnits', 'MedicalUnitController@create');
//$router->put('/medicalUnits/{id}', 'MedicalUnitController@update');
//$router->delete('/medicalUnits/{id}', 'MedicalUnitController@delete');
