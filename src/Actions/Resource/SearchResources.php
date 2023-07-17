<?php


namespace Transave\ScolaCvManagement\Actions\Resource;


use Carbon\Carbon;
use Transave\ScolaCvManagement\Helpers\ResponseHelper;

class SearchResources
{
    use ResponseHelper;

    private $request;
    private $route;
    private $relationships = [];
    private $model;
    private $routeConfig = [];
    private $queryBuilder;
    private $searchParam;
    private $perPage = 10;
    private $startAt = '';
    private $endAt = '';
    private $resources = [];

    public function __construct(array $request)
    {
        $this->request = $request;
        $this->routeConfig = config('endpoints.routes');
    }

    public function execute()
    {
        try {
            return $this
                ->validateAndSetDefaults()
                ->setModel()
                ->setModelRelationship()
                ->searchTerms()
                ->filterWithTimeStamps()
                ->filterWithOrder()
                ->getResources()
                ->sendSuccess($this->resources, 'resource returned');
        }catch (\Exception $e) {
            return $this->sendServerError($e);
        }
    }

    private function setModel()
    {
        abort_if(!array_key_exists('model', $this->route), 401, 'model not configured');
        $this->model = $this->route['model'];
        $this->queryBuilder = $this->model::query();
        return $this;
    }

    private function searchTerms()
    {
        switch ($this->request['endpoint'])
        {
            case "qualifications":
            case "schools":
            case "faculties": {
                $this->queryBuilder->where('name', 'like', "%$this->searchParam%");
                break;
            }
            case "countries": {
                $this->queryBuilder->where('name', 'like', "%$this->searchParam%")
                    ->orWhere("code", "like", "%$this->searchParam%");
                break;
            }
            case "departments": {
                $search = $this->searchParam;
                $this->queryBuilder->where(function($q) use ($search) {
                    $q->where("name", "like", "%$search%")
                        ->orWhereHas("faculty", function ($q2) use ($search) {
                            $q2->where("name", "like", "%$search%");
                        });
                });
                break;
            }
            case "states": {
                $search = $this->searchParam;
                $this->queryBuilder->where('name', 'like', "%$search%")
                    ->orWhere("capital", "like", "%$search%")
                    ->orWhereHas("country", function ($q) use ($search) {
                        $q->where("name", "like", "%$search%");
                    });
                break;
            }
            case "lgs": {
                $search = $this->searchParam;
                $this->queryBuilder->where(function($q) use ($search) {
                    $q->where("name", "like", "%$search%")
                        ->orWhereHas("state", function ($q2) use ($search) {
                            $q2->where("name", "like", "%$search%");
                        });
                });
                break;
            }
            case "cvs": {
                $search = $this->searchParam;
                $this->queryBuilder->where(function($q) use ($search) {
                    $q->where("title", "like", "%$search%")
                        ->orWhereHas("user", function ($q2) use ($search) {
                            $q2->where("first_name", "like", "%$search%")
                                ->orWhere("last_name", "like", "%$search%")
                                ->orWhere("email", "like", "%$search%")
                                ->orWhere("phone", "like", "%$search%");
                        });
                });
                break;
            }
            case "achievements": {
                $search = $this->searchParam;
                $this->queryBuilder->where(function($q) use ($search) {
                    $q->where("title", "like", "%$search%")
                        ->orWhereHas("cv", function ($q2) use ($search) {
                            $q2->where("title", "like", "%$search%");
                        });
                });
                break;
            }
            case "work-experiences": {
                $search = $this->searchParam;
                $this->queryBuilder->where(function($q) use ($search) {
                    $q->where("company", "like", "%$search%")
                        ->orWhere("position", "like", "%$search%")
                        ->orWhere("responsibilities", "like", "%$search%")
                        ->orWhereHas("cv", function ($q2) use ($search) {
                            $q2->where("title", "like", "%$search%");
                        });
                });
                break;
            }
            case "educational-qualifications": {
                $search = $this->searchParam;
                $this->queryBuilder->where(function($q) use ($search) {
                    $q->where("institution", "like", "%$search%")
                        ->orWhereHas("qualification", function($q2) use ($search) {
                            $q3->where("name", "like", "%$search%");
                        })
                        ->orWhereHas("cv", function ($q3) use ($search) {
                            $q3->where("title", "like", "%$search%");
                        });
                });
                break;
            }
            case "specializations": {
                $search = $this->searchParam;
                $this->queryBuilder->where(function($q) use ($search) {
                    $q->where("name", "like", "%$search%")
                        ->orWhereHas("cv", function ($q2) use ($search) {
                            $q2->where("title", "like", "%$search%");
                        });
                });
                break;
            }
            case "trainings": {
                $search = $this->searchParam;
                $this->queryBuilder->where(function($q) use ($search) {
                    $q->where("institution", "like", "%$search%")
                        ->orWhere("certification", "like", "%$search%")
                        ->orWhereHas("cv", function ($q2) use ($search) {
                            $q2->where("title", "like", "%$search%");
                        });
                });
                break;
            }
            case "referees": {
                $search = $this->searchParam;
                $this->queryBuilder->where(function($q) use ($search) {
                    $q->where("name", "like", "%$search%")
                        ->orWhere("address", "like", "%$search%")
                        ->orWhere("place_of_work", "like", "%$search%")
                        ->orWhere("contact", "like", "%$search%")
                        ->orWhere("relationship", "like", "%$search%")
                        ->orWhereHas("cv", function ($q2) use ($search) {
                            $q2->where("title", "like", "%$search%");
                        });
                });
                break;
            }
            case "hobbies": {
                $search = $this->searchParam;
                $this->queryBuilder->where(function($q) use ($search) {
                    $q->where("name", "like", "%$search%")
                        ->orWhere("priority", "like", "%$search%")
                        ->orWhereHas("cv", function ($q2) use ($search) {
                            $q2->where("title", "like", "%$search%");
                        });
                });
                break;
            }
            default:
                return $this;
        }
        return $this;
    }

    private function filterWithTimeStamps()
    {
        if ($this->startAt!="null" || $this->endAt!="null" || $this->startAt!=null || $this->endAt!=null) {
            if (isset($this->startAt) && isset($this->endAt)) {
                $start = Carbon::parse($this->startAt);
                $end = Carbon::parse($this->endAt);
                $this->queryBuilder = $this->queryBuilder
                    ->whereBetween('created_at', [$start, $end]);
            }
        }
        return $this;
    }

    private function getResources()
    {
        if (isset($this->perPage)) {
            $this->resources = $this->queryBuilder->paginate($this->perPage);
        }else
            $this->resources = $this->queryBuilder->get();
        return $this;
    }

    private function filterWithOrder()
    {
        if (array_key_exists('order', $this->route)) {
            if (array_key_exists('column', $this->route['order']) && array_key_exists('pattern', $this->route['order'])) {
                $this->queryBuilder = $this->queryBuilder->orderBy($this->route['order']['column'], $this->route['order']['pattern']);
            }
        }else {
            $this->queryBuilder = $this->queryBuilder->orderBy('created_at', 'desc');
        }
        return $this;
    }

    private function setModelRelationship()
    {
        if (array_key_exists('relationships', $this->route) && count($this->route['relationships']) > 0) {
            $this->relationships = $this->route['relationships'];
            $this->queryBuilder = $this->queryBuilder->with($this->relationships);
        }
        return $this;
    }

    private function validateAndSetDefaults()
    {
        abort_if(!array_key_exists($this->request['endpoint'], $this->routeConfig), 401, 'endpoint not found');
        $this->route = $this->routeConfig[$this->request['endpoint']];
        $this->startAt = request()->query('start');
        $this->endAt = request()->query('end');
        $this->searchParam = request()->query("search");
        $this->perPage = request()->query("per_page");
        return $this;
    }

}