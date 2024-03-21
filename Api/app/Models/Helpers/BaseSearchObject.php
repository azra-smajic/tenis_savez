<?php
namespace App\Models\Helpers;
class BaseSearchObject
{
    protected $pageSize;
    protected $pageNumber;

    public function __construct($pageSize = 15, $pageNumber = 1)
    {
        $this->pageSize = $pageSize;
        $this->pageNumber = $pageNumber;
    }

    public function getPageSize()
    {
        return $this->pageSize;
    }

    public function getPageNumber()
    {
        return $this->pageNumber;
    }

    public static function fromRequest($request)
    {
        return new self(
            $request->input('pageSize', 15),
            $request->input('pageNumber', 1)
        );
    }
}