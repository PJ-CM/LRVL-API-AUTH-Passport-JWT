<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $valores_tipo = 'post';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($accion = null)
    {
        //devolviendo a una vista 'mostrar' que está dentro de una subcarpeta 'posts'
        //es decir, posts.mostrar
        //(físicamente, está en: resources/views/posts/mostrar.blade.php)

        //SIN Paginación :: sacando todos los registros seguidos en la misma página
        ////$valores = Post::all();
        //CON Paginación :: sacando X registros en cada página
        //      => Orden ASC
        ////$valores = Post::paginate(5);
        //      => Orden DESC
        $valores = Post::orderBy('id', 'desc')->paginate(5);

        $users_lista = User::all();

        //Devolviendo info a la vista correspondiente
        //----------------------------------------------------------
        return view('posts.mostrar')->with([
            'vista_tipo' => 'listado',
            'vista_tit' => 'Listado',
            'valores_tipo' => $this->valores_tipo,
            'valores' => $valores,
            'valoresTOT' => count($valores),
            'accion' => $accion,
            'users_lista' => $users_lista,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Estableciendo reglas de validación
        $reglas = [
            'titulo' => 'required|string|max:255',
            'texto' => 'required|string|max:500',
            'user_id' => 'required|not_in:0',
            'activo' => 'required|in:0,1',
        ];
        //Validando petición
        $request->validate($reglas);

        //Insertando nuevo registro y recuperando el ID
        //------------------------------------------------
        $dato = Post::create($request->all());
        if(empty($dato->id)) {
            //Log::error('Failed to insert row into database.');
            dd('ERROR al insertar en la tabla ['.$this->valores_tipo.'s'.'] de la base de datos. ['. $dato->id.']');
        } else {
            //dd('Inserto efectuado. ['. $dato->id.']');

            //Redirigiendo al Listado
            //==========================================
            //  -> Redirigiendo hacia nombre de Ruta
            ////return redirect()->route('posts_lista');
            $accion = 'insertar_'.$dato->id;
            return redirect()->route('posts_lista', ['accion' => $accion]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    ////public function show(Post $post)
    public function show($id)
    {
        $_arr_detalle = [];
        $_arr_detalle['vista_tipo'] = 'detalle';
        $_arr_detalle['vista_tit'] = 'Detalle';
        $_arr_detalle['valores_tipo'] = $this->valores_tipo;

        $valor = Post::findOrFail($id);
        $_arr_detalle['valor'] = $valor;

        $users_lista = User::orderBy('name')->get();
        $_arr_detalle['users_lista'] = $users_lista;

        return view('posts.mostrar')->with($_arr_detalle);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    ////public function edit(Post $post)
    public function edit($id)
    {
        //
    }

    /**
     * Editing the field of an specified register.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    ////public function edit(Post $post)
    public function edit_campo($id, $campo, $valor)
    {
        Post::where('id', $id)
                ->update([
                    $campo => $valor,
                ]);
        //$accion = 'editar_'.$id;
        //return redirect()->route('posts_lista', ['accion' => $accion]);
        return redirect()->route('posts_lista');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //Estableciendo reglas de validación
        $reglas = [
            'titulo' => 'required|string|max:255',
            'texto' => 'required|string|max:500',
            'user_id' => 'required|not_in:0',
            'activo' => 'required|in:0,1',
        ];
        //Validando petición
        $request->validate($reglas);

        //Operación masiva contando con los campos especificados en el $fillable del modelo
        Post::where('id', $request->id)
                ->update($request->except('_token'));

        $accion = 'editar_' . $request->id;
        return redirect()->route('posts_lista', ['accion' => $accion]);
    }

    /**
     * Editing the field of an specified register.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    ////public function update_campo(Post $post)
    public function update_campo($id, $campo, $valor)
    {
        Post::where('id', $id)
                ->update([
                    $campo => $valor,
                ]);
        //$accion = 'editar_'.$id;
        //return redirect()->route('posts_lista', ['accion' => $accion]);
        return redirect()->route('posts_lista');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    ////public function destroy(Post $post)
    public function destroy($id)
    {
        Post::where('id', $id)->delete();

        //Redirigiendo al Listado
        //==========================================
        //¡¡Así NO!!
        //$this->lista();
        //----------------------------
        //  -> Redirigiendo hacia método de Controlador
        ////return redirect()->action('PostController@lista');
        //----------------------------
        //  -> Redirigiendo hacia nombre de Ruta
        ////$accion = [
        ////    'tipo' => 'borrar',
        ////    'id' => $id,
        ////];
        $accion = 'borrar_'.$id;
        return redirect()->route('posts_lista', ['accion' => $accion]);
    }
}
