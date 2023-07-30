<?php


namespace Transave\ScolaCvManagement\Actions\Gallery;


use Transave\ScolaCvManagement\Helpers\SearchHelper;

class SearchGallery
{
    use SearchHelper;

    private function searchTerms()
    {
        $search = $this->searchParam;
        $this->queryBuilder->where('slug', "like", "%$search%")
            ->orWhere('extension', "like", "%$search%")
            ->orWhereHas('cv', function ($query2) use ($search) {
                $query2->where('title', 'like', "%$search%");
            });

        return $this;
    }
}