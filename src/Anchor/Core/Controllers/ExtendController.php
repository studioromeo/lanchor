<?php

namespace Anchor\Core\Controllers;

use Controller;
use View;
use Input;
use Redirect;
use Anchor\Core\Models\Extend;

class ExtendController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $fields = Extend::all();

        return View::make('core::extend.fields.index', compact('fields'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('core::extend.fields.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $field = new Extend;
        $field->fill(Input::all());
        $field->save();

        return Redirect::route('admin.extend.fields.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $field = Extend::find($id);

        return View::make('core::extend.fields.edit', compact('field'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $field = Extend::find($id);

        $field->fill(Input::all());
        $field->save();

        return Redirect::route('admin.extend.fields.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Extend::destroy($id);
        return Redirect::route('admin.extend.fields.index');
    }

}
