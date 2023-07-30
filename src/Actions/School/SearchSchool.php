<?php
namespace Transave\ScolaCvManagement\Actions\School;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\SearchHelper;

class SearchSchool
{
    use SearchHelper, ResponseHelper;

    private function searchTerms()
    {
        $search = $this->searchParam;
        $this->queryBuilder->where('name', "like", "%$search%");
        return $this;
    }
}