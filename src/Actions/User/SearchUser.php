<?php


namespace Transave\ScolaCvManagement\Actions\User;


use Transave\ScolaCvManagement\Helpers\SearchHelper;

class SearchUser
{
    use SearchHelper;

    private function searchTerms()
    {
        $search = $this->searchParam;
        $this->queryBuilder->where(function($query) use($search) {
            $query->where('first_name', "like", "%$search%")
                ->orWhere('last_name', "like", "%$search%")
                ->orWhere('email', "like", "%$search%")
                ->orWhere('phone', "like", "%$search%")
                ->orWhere('user_type', "like", "%$search%")
                ->orWhere('marital_status', "like", "%$search%")
                ->orWhere('gender', "like", "%$search%")
                ->orWhere('residential_address', "like", "%$search%")
                ->orWhere('permanent_address', "like", "%$search%")
                ->orWhere('status', "like", "%$search%")
                ->orWhereHas('school', function ($query2) use ($search) {
                    $query2->where('name', 'like', "%$search%");
                })
                ->orWhereHas('department', function ($query3) use ($search) {
                    $query3->where('name', 'like', "%$search%")
                        ->orWhereHas('faculty', function ($query4) use ($search) {
                            $query4->where('name', 'like', "%$search%");
                        });
                })
                ->orWhereHas('qualification', function($query5) use ($search) {
                    $query5->where('name', 'like', "%$search%");
                })
                ->orWhereHas('origin', function($query6) use ($search) {
                    $query6->where('name', 'like', "%$search%")
                        ->orWhere('code', 'like', "%$search%");
                })
                ->orWhereHas('residence', function($query7) use ($search) {
                    $query7->where('name', 'like', "%$search%")
                        ->orWhere('code', 'like', "%$search%");;
                })
                ->orWhereHas('lgOfOrigin', function ($query8) use ($search) {
                    $query8->where('name', 'like', "%$search%")
                        ->orWhereHas('state', function ($query9) use ($search) {
                            $query9->where('name', 'like', "%$search%")
                                ->orWhere('capital', 'like', "%$search%");
                        });
                })
                ->orWhereHas('lgOfResidence', function ($query10) use ($search) {
                    $query10->where('name', 'like', "%$search%")
                        ->orWhereHas('state', function ($query11) use ($search) {
                            $query11->where('name', 'like', "%$search%")
                                ->orWhere('capital', 'like', "%$search%");
                        });
                });
        });
        return $this;
    }
}