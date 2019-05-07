<?php
/**
 * Created by PhpStorm.
 * User: silva
 * Date: 16-Apr-19
 * Time: 10:49 PM
 */




$router->get('/doctors/{id}', 'DoctorController@getById');
$router->post('/doctors', 'DoctorController@create');
$router->put('/doctors/{id}', 'DoctorController@update');
$router->delete('/doctors/{id}', 'DoctorController@delete');
$router->get('/doctors','DoctorController@getAll');

$router->put('/doctorss', 'DoctorController@getByMedicalUnit');


$router->get('/medicalUnits','MedicalUnitController@getAll');
$router->get('/medicalUnits/{id}', 'MedicalUnitController@getById');
$router->post('/medicalUnits', 'MedicalUnitController@create');
$router->put('/medicalUnits/{id}', 'MedicalUnitController@update');
$router->delete('/medicalUnits/{id}', 'MedicalUnitController@delete');


$router->post('/userDetails', 'UserDetailsController@create');
