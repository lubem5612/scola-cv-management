<?php
namespace Transave\ScolaCvManagement\Actions\Specialization;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\SearchHelper;

class SearchSpecialization
{
    use SearchHelper, ResponseHelper;

    private function searchTerms()
    {
        $search = $this->searchParam;
        $this->queryBuilder
            ->where('description', "like", "%$search%")
            ->orwhere('name', "like", "%$search%")
            ->orWhereHas('cv', function ($query2) use ($search) {
                $query2->where('title', 'like', "%$search%");
            });

        return $this;
    }
}