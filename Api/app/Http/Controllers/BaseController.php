<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $modelClass;

    public function __construct($modelClass)
    {
        $this->modelClass = $modelClass;
    }

    public function destroy(string $id)
    {
        return  $this->modelClass::destroy($id);
    }

    public function show(string $id)
    {
        return  $this->modelClass::find($id);
    }

    public function update(Request $request, string $id)
    {
        $record =  $this->modelClass::find($id);
        $record->update($request->all());
        return $record;
    }

}
