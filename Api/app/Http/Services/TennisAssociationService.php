<?php

namespace App\Http\Services;

use App\Models\TennisAssociation;

class TennisAssociationService
{
    public function findTennisAssociationByParameters($searchObj)
    {
        $query = TennisAssociation::query();
        if(!empty($searchObj->getSearchPhrase())){
            $query->where('name','like','%'.$searchObj->getSearchPhrase().'%')
                ->orWhere('region','like','%'.$searchObj->getSearchPhrase().'%')
                ->orWhere('country','like','%'.$searchObj->getSearchPhrase().'%');
        }
        return $query->paginate(
            $searchObj->getPageSize(),
            ['*'],
            'page',
            $searchObj->getPageNumber());
    }
}
