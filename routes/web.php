<?php



Route::get('/', function () {
	if (Auth::check()){
        return Redirect::to('/home');   
        }
    return view('auth.login');
});

Auth::routes();

Route::resource('user','UserController');

Route::resource('category','CategoryController');
Route::get('/categoryGetAll', 'CategoryController@categoryGetAll')->name('category.categoryGetAll');
Route::get('/subcategoryGetAll/{category}', 'CategoryController@subcategoryGetAll')->name('category.subcategoryGetAll');
Route::resource('tool','ToolController');

								//PETICIONES

Route::resource('petition','PetitionController');
Route::get('/aprobadas', 'PetitionController@aprobadas')->name('petition.aprobadas');
Route::get('/vencidas', 'PetitionController@vencidas')->name('petition.vencidas');
Route::post('/aprobar/{petition}', 'PetitionController@aprobar')->name('petition.aprobar');
Route::post('/aprobartodo/{petition}', 'PetitionController@aprobartodo')->name('petition.aprobartodo');
Route::post('/devolver/{petition}', 'PetitionController@devolver')->name('petition.devolver');
Route::post('/finalizar/{petition}', 'PetitionController@finalizar')->name('petition.finalizar');
Route::post('/comentar/{petition}', 'PetitionController@comentar')->name('petition.comentar');
Route::post('/comentar2/{petition}', 'PetitionController@comentar2')->name('petition.comentar2');
Route::post('/rechazar/{petition}', 'PetitionController@rechazar')->name('petition.rechazar');
Route::get('/mispeticiones', 'PetitionController@mispeticiones')->name('petition.mispeticiones');
Route::get('/finalizadas', 'PetitionController@finalizadas')->name('petition.finalizadas');
Route::get('/revisar', 'PetitionController@revisar')->name('petition.revisar');
Route::get('/rechazadas', 'PetitionController@rechazadas')->name('petition.rechazadas');
Route::get('petition/update/{Petition}/{tool_id?}/{cantidad?}', 'PetitionController@update_cant')->name('tool-cant');
Route::get('petition/updatedev/{Petition}/{tool_id?}/{cantidaddev?}', 'PetitionController@update_devuelta')->name('tool-dev');
Route::get('petition/descargar/{Petition}', 'PetitionController@pdf')->name('petition.pdf');
Route::post('/pedirele/{petition}', 'PetitionController@pedirele')->name('petition.pedirele');


Route::get('tool/{tool}/form_solicitar', 'ToolController@form_solicitar')->name('tool.form_solicitar');
Route::post('tool/guardar_solicitud', 'ToolController@guardar_solicitud')->name('tool.guardar_solicitud');



Route::get('solicitados', 'ToolController@solicitados')->name('tool.solicitados');
Route::get('solicitados/{tool}/observacion/{id}', 'ToolController@observacion')->name('tool.observacion');
Route::put('guardar_observacion', 'ToolController@guardar_observacion')->name('tool.guardar_observacion');
Route::post('entregar', 'ToolController@entregar')->name('tool.entregar');

Route::get('logout','UserController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('solicitudes', 'ToolController@solicitudes')->name('tool.solicitudes');
Route::get('/solicitudes/aprobadas', 'ToolController@aprobadas')->name('tool.aprobadas');

Route::post('aprobar', 'ToolController@aprobar')->name('tool.aprobar');
Route::post('rechazar', 'ToolController@rechazar')->name('tool.rechazar');
Route::post('finalizar', 'ToolController@finalizar')->name('tool.finalizar');
Route::resource('category/{category}/subcategory','SubcategoryController');

Route::get('getsubcategories/{id}', 'CategoryController@getSubcategories');

Route::get('fechaelemento/{fecha}', 'PetitionToolController@prueba');

//cart
Route::bind('tool', function ($id) {
        return App\Tool::where('id', $id)->first();
    });

Route::get('cart/show', 'CartController@show')->name('cart-show');
Route::get('cart/add/{tool}', 'CartController@add')->name('cart-add');
Route::get('cart/delete/{tool}', 'CartController@delete')->name('cart-delete');
Route::get('cart/trash', 'CartController@trash')->name('cart-trash');
Route::get('cart/update/{tool}/{cantidad?}', 'CartController@update')->name('cart-update');

Route::post('category/deleteAll','CategoryController@deleteAll');
Route::post('category/{category}/subcategory/deleteAll','SubcategoryController@deleteAll');
Route::post('user/deleteAll','UserController@deleteAll');
Route::post('tool/deleteAll','ToolController@deleteAll');
