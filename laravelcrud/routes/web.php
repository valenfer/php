<?php
use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CrudController::class,"index"])->name("crud.index");
//Ruta para añadir nuevo producto
Route::post('/registrar-producto', [CrudController::class,"create"])->name("crud.create");
//Ruta para modificar producto
Route::post('/modificar-producto', [CrudController::class,"update"])->name("crud.update");
//Ruta para eliminar producto, tenemor que recoger por la url la variable del id, por url es de tipo get
Route::get('/eliminar-producto-{id}', [CrudController::class,"delete"])->name("crud.delete");
