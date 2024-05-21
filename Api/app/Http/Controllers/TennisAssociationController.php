<?php

namespace App\Http\Controllers;

use App\Http\Services\TennisAssociationService;
use App\Models\Helpers\BaseSearchObject;
use App\Models\TennisAssociation;
use Illuminate\Http\Request;

class TennisAssociationController extends BaseController
{
    protected $tennisAssociationService;
    public function __construct(TennisAssociationService $tennisAssociationService)
    {
        parent::__construct(TennisAssociation::class);
        $this->middleware('auth:api');
        $this->tennisAssociationService = $tennisAssociationService;
    }
    /**
     * Display a listing of the resource.
     */
    public function find(Request $request)
    {
        return $this->tennisAssociationService->findTennisAssociationByParameters(BaseSearchObject::fromRequest($request));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $fields = $request->validate([
            'name' => 'required',
            'country' => 'required',
            'region' => 'required',
        ]);
        return TennisAssociation::create($fields);
    }
}
