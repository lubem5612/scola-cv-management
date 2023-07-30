<?php
namespace Transave\ScolaCvManagement\Actions\Publication;

use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\SearchHelper;

class SearchPublication
{
    use SearchHelper;

    private function searchTerms()
    {
        $search = $this->searchParam;
        $this->queryBuilder
            ->where('short_description', "like", "%$search%")
            ->orwhere('link', "like", "%$search%")
            ->orWhereHas('cv', function ($query2) use ($search) {
                $query2->where('title', 'like', "%$search%");
            });

    return $this;
    }
}