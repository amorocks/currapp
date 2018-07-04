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
	Route::resource('topics', 'TopicController');
	Route::resource('courses', 'CourseController');

	Route::group(['prefix' => 'curriculum'], function(){
		Route::resource('qualifications', 'QualificationController', ['except' => ['show']]);
		Route::resource('qualifications.cohorts', 'CohortController', ['only' => ['index', 'create', 'store', 'show']]);
		Route::resource('qualifications.cohorts.assets', 'CohortAssetController', ['only' => ['index', 'show']]);
		Route::resource('qualifications.cohorts.terms', 'TermController', ['only' => ['index', 'show']]);
		Route::get('/qualifications/{qualification}/cohorts/{cohort}/topics', 'CohortController@edit_topics')->name('qualifications.cohorts.topics.edit');
		Route::post('/qualifications/{qualification}/cohorts/{cohort}/topics', 'CohortController@update_topics')->name('qualifications.cohorts.topics.update');
		Route::get('/qualifications/{qualification}/cohorts/{cohort}/terms/{term}/courses', 'TermController@courses')->name('qualifications.cohorts.terms.courses');
	});

	Route::group(['prefix' => 'settings'], function(){
		Route::resource('periodisations', 'PeriodisationController', ['excpet' => 'show']);
	});

	Route::get('/assets/{asset}', 'AssetController@show')->name('assets.show');
	Route::get('/assets/create/{type}/{assetable_type}/{assetable_id}', 'AssetController@create')->name('assets.create');
	Route::post('/assets/create/{type}/{assetable_type}/{assetable_id}', 'AssetController@store')->name('assets.store');

	//AJAX routes
	Route::post('/subscription/toggle/{cohort}', 'SubscriptionController@toggle');
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
