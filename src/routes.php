<?php



Route::group(array('prefix' => 'admin'), function()
{
    Route::get(     'customers/filter',                         array('as' => 'customers.filter',                        'uses' => '\Ixudra\Portfolio\Http\Controllers\CustomerController@filter'));
    Route::post(    'customers/filter',                         array('as' => 'customers.filter.process',                'uses' => '\Ixudra\Portfolio\Http\Controllers\CustomerController@filter'));
    Route::resource('customers', '\Ixudra\Portfolio\Http\Controllers\CustomerController');

    Route::get(     'projects/filter',                          array('as' => 'projects.filter',                        'uses' => '\Ixudra\Portfolio\Http\Controllers\ProjectController@filter'));
    Route::post(    'projects/filter',                          array('as' => 'projects.filter.process',                'uses' => '\Ixudra\Portfolio\Http\Controllers\ProjectController@filter'));
    Route::resource('projects', '\Ixudra\Portfolio\Http\Controllers\ProjectController');

    Route::get(     'projectTypes/filter',                      array('as' => 'projectTypes.filter',                    'uses' => '\Ixudra\Portfolio\Http\Controllers\ProjectTypeController@filter'));
    Route::post(    'projectTypes/filter',                      array('as' => 'projectTypes.filter.process',            'uses' => '\Ixudra\Portfolio\Http\Controllers\ProjectTypeController@filter'));
    Route::resource('projectTypes', '\Ixudra\Portfolio\Http\Controllers\ProjectTypeController');

    Route::get(     'addresses/filter',                         array('as' => 'addresses.filter',                       'uses' => '\Ixudra\Portfolio\Http\Controllers\AddressController@filter'));
    Route::post(    'addresses/filter',                         array('as' => 'addresses.filter.process',               'uses' => '\Ixudra\Portfolio\Http\Controllers\AddressController@filter'));
    Route::resource('addresses', '\Ixudra\Portfolio\Http\Controllers\AddressController');

    Route::get(     'people/filter',                            array('as' => 'people.filter',                          'uses' => '\Ixudra\Portfolio\Http\Controllers\PersonController@filter'));
    Route::post(    'people/filter',                            array('as' => 'people.filter.process',                  'uses' => '\Ixudra\Portfolio\Http\Controllers\PersonController@filter'));
    Route::resource('people', '\Ixudra\Portfolio\Http\Controllers\PersonController');
});

