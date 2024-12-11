<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class CrudController extends Controller
{
    public function index(){
        /**No usamos eloquent, usamos comandos sql */
        $datos=DB::select("select * from producto");
        //Enviamos los datos a la vista
        return view("welcome")->with("datos", $datos);
    }
    public function create(Request $request){
        try {
            $sql=DB::insert("insert into producto(id_producto, nombre, precio, cantidad) values (?,?,?,?)", [
                $request->txtCodigo,
                $request->txtNombre,
                $request->txtPrecio,
                $request->txtCantidad,
            ]);
            return back()->with("correcto","Producto registrado correctamente");
        } catch (\Throwable $th) {
            return back()->with("incorrecto","ERROR al regisrar el producto");
        }
    }

    public function update(Request $request){
        try {
            $sql=DB::update("update producto set nombre=?, precio=?, cantidad=? where id_producto=? ", [
                $request->txtNombre,
                $request->txtPrecio,
                $request->txtCantidad,
                $request->txtCodigo,
            ]);
            if($sql==0){
                return back()->with("nomodificado","No se ha realizado ningún cambio");
            }else{
                return back()->with("correcto","Producto registrado correctamente");
            }
        } catch (\Throwable $th) {
            return back()->with("incorrecto","ERROR al registrar el producto");
        }
    }
    public function delete($id){
        try {
            $sql=DB::delete("delete from producto where id_producto=$id");
            return back()->with("correcto","Producto eliminado correctamente");
        } catch (\Throwable $th) {
            return back()->with("incorrecto","ERROR al eliminar el producto");
        }
    }
}
