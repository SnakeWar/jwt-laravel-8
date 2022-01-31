<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * @var Todo
     */
    private $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TodoResource::collection($this->todo->orderBy('created_at', 'desc')->paginate(5));
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
    public function store(TodoRequest $request)
    {
        $dataForm = $request->all();
        $created = $this->todo->create($dataForm);
        if($created)
        {
            return response($created, 200)
                ->header('Content-Type', 'application/json');
        }else
        {
            return response($created, 204)
                ->header('Content-Type', 'application/json');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->todo->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TodoRequest $request, $id)
    {
        $dataForm = $request->all();
        $update = $this->todo->findOrFail($id);

        if($update->update($dataForm))
        {
            return response($update, 200)
                ->header('Content-Type', 'application/json');
        }else
        {
            return response($update, 204)
                ->header('Content-Type', 'application/json');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = $this->todo->findOrFail($id);
        if($todo->destroy($id))
        {
            return response($todo, 200)
                ->header('Content-Type', 'application/json');
        }else
        {
            return response($todo, 204)
//                ->header('Content-Type', 'text/plain');
                            ->header('Content-Type', 'application/json');
        }
    }
}
