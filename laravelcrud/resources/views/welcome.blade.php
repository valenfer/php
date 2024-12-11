<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/8ddfb2fdec.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <h1 class="text-center p-3">CRUD en Laravel</h1>
    @if (session("correcto"))
        <div class="alert alert-success">{{session("correcto")}}</div>
    @endif
    @if (session("incorrecto"))
        <div class="alert alert-danger">{{session("incorrecto")}}</div>
    @endif
    @if (session("nomodificado"))
        <div class="alert alert-warning">{{session("nomodificado")}}</div>
    @endif

    <!-- Confirmación de querer eliminar-->
    <script>
        var res=function(){
            var not=confirm("Estás seguro de que quieres eliminar?)");
            return not;
        }
    </script>
    <!-- Modal de añadir datos-->
    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('crud.create')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Código del producto</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtCodigo">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nombre del producto</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtNombre">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Precio del producto</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtPrecio">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Cantidad del producto</label>
                            <input type="tnumber" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtCantidad">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Añadir</button>
                        </div>
                    </form>
                </div> 
            </div>
        </div>
    </div>
    <div class="p-5 table-responsive">
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar"> Añadir producto</button>
    <table class="table table-stripped table-bordered table-hover">
        <thead class="bg-primary text-white">
          <tr>
            <th scope="col">CODIGO</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">PRECIO</th>
            <th scope="col">CANTIDAD</th>
            <th>ACCIONES</th>
          </tr>
        </thead>
        <tbody>
            @foreach($datos as $item)
            <tr>
                <th>{{$item->id_producto}}</th>
                <td>{{$item->nombre}}</td>
                <td>{{$item->precio}}</td>
                <td>{{$item->cantidad}}</td>
                <td>
                    <!--En el target añadimos el id para diferenciar un registro de otro, si no siempre extrae el mismo-->
                    <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar{{$item->id_producto}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="{{route("crud.delete", $item->id_producto)}}" onclick="return res()" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                </td>
               
                
                <!-- Modal de modificar datos-->
                <div class="modal fade" id="modalEditar{{$item->id_producto}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar datos del producto</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('crud.update')}}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Código del producto</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtCodigo" value="{{$item->id_producto}}" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nombre del producto</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtNombre" value="{{$item->nombre}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Precio del producto</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtPrecio" value="{{$item->precio}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Cantidad del producto</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtCantidad" value="{{$item->cantidad}}">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    </div>
                                </form>
                            </div> 
                        </div>
                    </div>
                </div>
            </tr>
            @endforeach
            
        </tbody>
      </table>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>