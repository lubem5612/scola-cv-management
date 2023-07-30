<?php
namespace Transave\ScolaCvManagement\Actions\Referees;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\SearchHelper;

class SearchReferees
{
    use SearchHelper, ResponseHelper;

    private function searchTerms()
    {
        $search = $this->searchParam;
        $this->queryBuilder
            ->where('name', "like", "%$search%")
            ->orwhere('place_of_work', "like", "%$search%")
            ->orwhere('contact', "like", "%$search%")
            ->orWhereHas('cv', function ($query2) use ($search) {
                $query2->where('title', 'like', "%$search%");
            });
        return $this;
    }
}