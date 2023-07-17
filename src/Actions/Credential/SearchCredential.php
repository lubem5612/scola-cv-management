<?php


namespace Transave\ScolaCvManagement\Actions\Credential;


use Transave\ScolaCvManagement\Helpers\ResponseHelper;
use Transave\ScolaCvManagement\Helpers\SearchHelper;

class SearchCredential
{
    use SearchHelper, ResponseHelper;

    private function searchTerms()
    {
        $search = $this->searchParam;
        $this->queryBuilder->where(function($query) use($search) {
            $query->where('slug', "like", "%$search%")
                ->orWhereHas('cv', function ($query2) use ($search) {
                    $query2->where('title', 'like', "%$search%");
                });
        });
        return $this;
    }
}