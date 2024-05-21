<?php

namespace App\Factories;

class QueryFactory
{
    public static function createFilteredQuery($className, $tennisAssociationId)
    {
        // Since all entities are going to be related to tennisAssociation, before make query, all of them should include tennis association filter.
        $query = $className::query();
        if(!empty($tennisAssociationId)){
            $query->where('tennis_association_id', $tennisAssociationId);
        }
        return $query;
    }
}
