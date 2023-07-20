<?php
namespace Transave\ScolaCvManagement\Actions\WorkExperience;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\SearchHelper;

class SearchWorkExperience
{
    use SearchHelper, ResponseHelper;

    private function searchTerms()
    {
        $search = $this->searchParam;
        $this->queryBuilder
            ->where('position', "like", "%$search%")
            ->orwhere('company', "like", "%$search%")
            ->orwhere('start_date', "like", "%$search%")
            ->orwhere('end_date', "like", "%$search%")
            ->orWhereHas('cv', function ($query2) use ($search) {
                $query2->where('title', 'like', "%$search%");
            });
        return $this;
    }
}