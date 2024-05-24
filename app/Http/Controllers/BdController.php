<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Models\Productos;
use App\Models\ProductosFotos;
use Illuminate\Support\Str;

class BdController extends Controller
{
    public function bd_inicio()
    {
        return view('bd.home');
    }

    public function bd_categorias()
    {
        $datos = Categorias::orderBy('id', 'desc')->get();
        // dd($datos);
        return view('bd.categorias',compact('datos'));
    }

    public function bd_categorias_add()
    {
        return view('bd.categorias_add');
    }

    public function bd_categorias_add_post(Request $request)
    {
        $request->validate(
            [
                'nombre' =>'required|min:6'
            ],
            [
                'nombre.required'=>'El campo Nombre está vacío',
                'nombre.min'=>'El campo Nombre debe tener al menos 6 caracteres'
            ]
        );
        Categorias::create(
            [
                'nombre' => $request->input('nombre'),
                'slug' => Str::slug($request->input('nombre'), '-')
                
            ]
        );
        $request->session()->flash('css', 'success');
        $request->session()->flash('mensaje', "Se creó el registro exitosamente");
        return redirect()->route('bd_categorias_add');
    }

    public function bd_categorias_edit($id)
    {
        $categoria = Categorias::where(['id' => $id])->firstOrFail();
        return view('bd.categorias_edit', compact('categoria'));
    }

    public function bd_categorias_edit_post(Request $request, $id)
    {
        //Validacion
        $request->validate(
            [
                'nombre' =>'required|min:6'
            ],
            [
                'nombre.required'=>'El campo Nombre está vacío',
                'nombre.min'=>'El campo Nombre debe tener al menos 6 caracteres'
                ]
        );
        // Consulta BD
        $categoria = Categorias::where(['id' => $id])->firstOrFail();
        // Modificación BD
        $categoria->nombre = $request->input('nombre');
        $categoria->slug = Str::slug($request->input('nombre'), '-');
        // Guardar BD
        $categoria->save();
        //Mensaje flash
        $request->session()->flash('css', 'success');
        $request->session()->flash('mensaje', "Se editó el registro exitosamente");
        // Redireccionar
        return redirect()->route('bd_categorias_edit', ['id'=>$id]);
    }

    public function bd_categorias_delete(Request $request, $id)
    {
        if(Productos::where(['categorias_id' => $id])->count() == 0)
        {
            Categorias::where(['id'=>$id])->delete();
            $request->session()->flash('css','success');
            $request->session()->flash('mensaje', "Se eliminó el registro exitosamente");
            return redirect()->route('bd_categorias');
        } else
        {
            $request->session()->flash('css', 'danger');
            $request->session()->flash('mensaje', "No es posible eliminar la categoría porque tiene productos asociados");
            return redirect()->route('bd_categorias');
        }
    }

    public function bd_productos()
    {
        $datos = Productos::orderBy('id', 'desc')->get();
        return view('bd.productos',compact('datos'));
    }
    
    public function bd_productos_add()
    {
        $categorias=Categorias::get();
        return view('bd.productos_add', compact('categorias'));
    }

    public function bd_productos_add_post(Request $request)
    {
        $request->validate(
            [
                'nombre' => 'required|min:6',
                'precio' => 'required|numeric',
                'descripcion' => 'required'  
            ],
            [
                'nombre.required'=>'El campo Nombre está vacío',
                'nombre.min'=>'El campo Nombre debe tener al menos 6 caracteres',
                'precio.required'=>'El campo Precio está vacío',
                'precio.numeric'=>'El Precio ingresado no es válido',
                'descripcion.required'=>'El campo Descripción está vacío', 
            ]
        );
        Productos::create(
            [
                'nombre'=>$request->input('nombre'),
                'slug'=>Str::slug($request->input('nombre'), '-'),
                'precio'=>$request->input('precio'),
                'stock'=>$request->input('stock'),
                'descripcion'=>$request->input('descripcion'),
                'categorias_id'=>$request->input('categorias_id'),
                'fecha'=>date('Y-m-d')
            ]
        );
        $request->session()->flash('css', 'success');
        $request->session()->flash('mensaje', "Se creó el registro exitosamente");
        return redirect()->route('bd_productos_add');
    }

    public function bd_productos_edit($id)
    {
        $producto = Productos::where(['id' => $id])->firstOrFail();
        $categorias = Categorias::get();
        return view('bd.productos_edit', compact('producto', 'categorias'));
    }

    public function bd_productos_edit_post(Request $request, $id)
    {
        $request->validate(
            [
                'nombre' => 'required|min:6',
                'precio' => 'required|numeric',
                'descripcion' => 'required'  
            ],
            [
                'nombre.required'=>'El campo Nombre está vacío',
                'nombre.min'=>'El campo Nombre debe tener al menos 6 caracteres',
                'precio.required'=>'El campo Precio está vacío',
                'precio.numeric'=>'El Precio ingresado no es válido',
                'descripcion.required'=>'El campo Descripción está vacío', 
            ]
        );
        $producto = Productos::where(['id' => $id])->firstOrFail();
        $producto->nombre=$request->input('nombre');
        $producto->slug=Str::slug($request->input('nombre'), '-');
        $producto->categorias_id=$request->input('categorias_id');
        $producto->precio=$request->input('precio');
        $producto->stock=$request->input('stock');
        $producto->descripcion=$request->input('descripcion');
        $producto->save();
        $request->session()->flash('css', 'success');
        $request->session()->flash('mensaje', "Se editó el registro exitosamente");
        return redirect()->route('bd_productos_edit', ['id'=>$id]);
    }

    public function bd_productos_delete(Request $request, $id)
    {
        $producto = Productos::where(['id' => $id])->firstOrFail();
        if(ProductosFotos::where(['productos_id' => $id])->count() == 0)
        {
            Productos::where(['id'=>$id])->delete();
            $request->session()->flash('css','success');
            $request->session()->flash('mensaje', "Se eliminó el registro exitosamente");
            return redirect()->route('bd_productos');
        } else
        {
            $request->session()->flash('css', 'danger');
            $request->session()->flash('mensaje', "No es posible eliminar la categoría porque tiene productos asociados");
            return redirect()->route('bd_productos');
        }
    }
    
    public function bd_productos_categorias($id)
    {
        
        $categoria = Categorias::where(['id' => $id])->firstOrFail();
        $datos = Productos::where(['categorias_id'=>$id])->orderBy('id', 'desc')->get();
        return view('bd.productos_categorias',compact('datos', 'categoria'));
    }
    
    public function bd_productos_fotos($id)
    {        
        $producto = Productos::where(['id' => $id])->firstOrFail();
        $fotos = ProductosFotos::where(['productos_id'=>$id])->orderBy('id', 'desc')->get();
        return view('bd.productos_fotos',compact('fotos', 'producto'));
    }

    public function bd_productos_fotos_post(Request $request, $id)
    {
        $producto = Productos::where(['id'=>$id])->firstOrFail();
        $request->validate(
            [
                'foto' => 'required|mimes:jpg,png,jpeg|max:2048' 
            ],
            [
                'foto.required'=>'El campo foto está vacío',
                'foto.mimes'=>'El campo foto debe ser JPG|PNG|JPEG'
            ]
        );
        
        switch($_FILES['foto']['type'])
        {
            case 'image/jpg':
                $archivo=time().'.jpg';
                break;
            case 'image/png':
                $archivo=time().'.png';
                break;
            case 'image/jpeg':
                $archivo=time().'.jpeg';
                break;
        }
        copy($_FILES['foto']['tmp_name'], 'uploads/productos/'.$archivo);
        ProductosFotos::create
        (
            [
                'productos_id'=>$id,
                'nombre'=>$archivo
            ]
        );
        $request->session()->flash('css', 'success');
        $request->session()->flash('mensaje', "Se creó el registro exitosamente");
        return redirect()->route('bd_productos_fotos', ['id'=>$id]);  
    }

    public function bd_productos_fotos_delete(Request $request, $producto_id, $foto_id)
    {
        $producto = Productos::where(['id'=>$producto_id])->firstOrFail();
        $foto = ProductosFotos::where(['id'=>$foto_id])->firstOrFail();
        unlink("../public/uploads/productos/".$foto->nombre);
        ProductosFotos::where(['id'=>$foto_id])->delete();
        $request->session()->flash('css', 'success');
        $request->session()->flash('mensaje', "Se eliminó el registro exitosamente");
        return redirect()->route('bd_productos_fotos', ['id'=>$producto_id]);
    }

    public function bd_productos_paginacion()
    {
        $datos = Productos::orderBy('id', 'desc')->paginate(env('PAGINACION'),);
        return view('bd.paginacion',compact('datos'));
    }

    public function bd_productos_buscador()
    {
        if(isset($_GET['b']))
        {
            $b=$_GET['b'];
            #select * from productos where nombre like '%$b%'
            $datos = Productos::where('nombre', 'like', '%'.$_GET['b'].'%')->orderBy('id', 'desc')->get();
        }else
        {
            $b='';
            $datos = Productos::orderBy('id', 'desc')->get();
        }
        
        return view('bd.buscador', compact('datos', 'b'));
    }
}