<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function(){

	Route::get('/', 'DashboardController@show')->name('home');
	Route::resource('courses', 'CourseController');
	Route::get('courses/{course}/editions/{edition}', 'CourseController@show_edition')->name('courses.show.edition');
	Route::patch('editions/{edition}', 'EditionController@update')->name('editions.update');

	Route::group(['prefix' => 'curriculum'], function(){
		Route::resource('qualifications', 'QualificationController', ['except' => ['show']]);
		Route::resource('qualifications.cohorts', 'CohortController', ['only' => ['index', 'create', 'store', 'show']]);
		Route::resource('qualifications.cohorts.assets', 'CohortAssetController', ['only' => ['index', 'show']]);
		Route::resource('qualifications.cohorts.terms', 'TermController', ['only' => ['create', 'store']]);
		Route::get('/qualifications/{qualification}/cohorts/{cohort}/terms/{term}/courses', 'TermController@courses')->name('qualifications.cohorts.terms.courses');
	});

	Route::group(['prefix' => 'now'], function(){
		Route::get('qualifications', 'NowController@index')->name('now.index');
		Route::get('qualifications/{qualification}', 'NowController@show')->name('now.show');
		Route::get('qualifications/{qualification}/{schoolyear}', 'NowController@show_year')->name('now.show.schoolyear');
		Route::get('qualifications/{qualification}/{schoolyear}/hours', 'NowController@show_hours')->name('now.show.hours');
	});

	Route::group(['prefix' => 'settings'], function(){
		Route::resource('types', 'TypeController', ['except' => 'show']);
		Route::resource('periodisations', 'PeriodisationController', ['except' => 'show']);
	});

	Route::get('/assets/{asset}', 'AssetController@show')->name('assets.show');
	Route::get('/assets/create/{type}/{assetable_type}/{assetable_id}', 'AssetController@create')->name('assets.create');
	Route::post('/assets/create/{type}/{assetable_type}/{assetable_id}', 'AssetController@store')->name('assets.store');

	//AJAX routes
	Route::post('/curriculum/toggle/term/{term}/course/{course}', 'TermController@toggle_course');

});


//AMOlogin routes
Route::get('/login', function(){
	return redirect('/amoclient/redirect');
})->name('login');	

Route::get('/amoclient/ready', function(){
	return redirect()->route('home');
});

Route::get('/logout', function(){
	return redirect('/amoclient/logout');;
})->name('logout');
