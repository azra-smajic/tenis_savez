<?php
namespace App\Models\Helpers;
class BaseSearchObject
{
    protected $pageSize;
    protected $pageNumber;
    protected $searchPhrase;
    protected $tennisAssociationId;

    public function __construct($pageSize = 15, $pageNumber = 1, $searchPhrase = "", $tennisAssociationId = null)
    {
        $this->pageSize = $pageSize;
        $this->pageNumber = $pageNumber;
        $this->searchPhrase = $searchPhrase;
        $this->tennisAssociationId = $tennisAssociationId;
    }

    public function getPageSize()
    {
        return $this->pageSize;
    }

    public function getPageNumber()
    {
        return $this->pageNumber;
    }

    public function getSearchPhrase()
    {
        return $this->searchPhrase;
    }

    public function getTennisAssociationId()
    {
        return $this->tennisAssociationId;
    }

    public static function fromRequest($request)
    {
        return new self(
            $request->input('pageSize', 15),
            $request->input('pageNumber', 1),
            $request->input('searchPhrase', ""),
            $request->input('tennisAssociationId', null)
        );
    }
}
