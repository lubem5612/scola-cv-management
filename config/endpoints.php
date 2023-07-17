<?php
return [
    'routes' => [
        'faculties' => [
            'model' => \Transave\ScolaCvManagement\Http\Models\Faculty::class,
            'table' => 'faculties',
            'rules' => [
                'store' => [
                    'name' => 'required|string|max:100|unique:faculties,name',
                ],
                'update' => [
                    'name' => 'sometimes|required|string|max:100',
                ]
            ],
            'order' => [
                'column' => 'created_at',
                'pattern' => 'DESC',
            ],
            'relationships' => [],
        ],
        'departments' => [
            'model' => \Transave\ScolaCvManagement\Http\Models\Department::class,
            'table' => 'departments',
            'rules' => [
                'store' => [
                    'name' => 'required|string|max:100|unique:departments,name',
                    'faculty_id' => 'required|exists:faculties,id',
                ],
                'update' => [
                    'name' => 'sometimes|required|string|max:100',
                    'faculty_id' => 'sometimes|required|exists:faculties,id',
                ]
            ],
            'order' => [
                'column' => 'created_at',
                'pattern' => 'DESC',
            ],
            'relationships' => [],
        ],
        'schools' => [
            'model' => \Transave\ScolaCvManagement\Http\Models\School::class,
            'table' => 'schools',
            'rules' => [
                'store' => [
                    'name' => 'required|string|max:255|unique:schools,name',
                ],
                'update' => [
                    'name' => 'sometimes|required|string|max:255',
                ]
            ],
            'order' => [
                'column' => 'created_at',
                'pattern' => 'DESC',
            ],
            'relationships' => [],
        ],
        'qualifications' => [
            'model' => \Transave\ScolaCvManagement\Http\Models\Qualification::class,
            'table' => 'qualifications',
            'rules' => [
                'store' => [
                    'name' => 'required|string|max:100|unique:qualifications,name',
                ],
                'update' => [
                    'name' => 'sometimes|required|string|max:100',
                ]
            ],
            'order' => [
                'column' => 'created_at',
                'pattern' => 'DESC',
            ],
            'relationships' => [],
        ],
        'countries' => [
            'model' => \Transave\ScolaCvManagement\Http\Models\Country::class,
            'table' => 'countries',
            'rules' => [
                'store' => [
                    'name' => 'required|string|max:150|unique:countries,name',
                    'code' => 'sometimes|required|string|max:10',
                ],
                'update' => [
                    'name' => 'sometimes|required|string|max:150',
                    'code' => 'sometimes|required|string|max:10',
                ]
            ],
            'order' => [
                'column' => 'created_at',
                'pattern' => 'DESC',
            ],
            'relationships' => [],
        ],
        'states' => [
            'model' => \Transave\ScolaCvManagement\Http\Models\State::class,
            'table' => 'states',
            'rules' => [
                'store' => [
                    'name' => 'required|string|max:150|unique:states,name',
                    'capital' => 'sometimes|required|string|max:80',
                    'country_id' => 'sometimes|required|exists:countries,id',
                ],
                'update' => [
                    'name' => 'sometimes|required|string|max:150|unique:states,name',
                    'capital' => 'sometimes|required|string|max:80',
                    'country_id' => 'sometimes|required|exists:countries,id',
                ]
            ],
            'order' => [
                'column' => 'created_at',
                'pattern' => 'DESC',
            ],
            'relationships' => ['country'],
        ],
        'lgs' => [
            'model' => \Transave\ScolaCvManagement\Http\Models\Lg::class,
            'table' => 'lgs',
            'rules' => [
                'store' => [
                    'name' => 'required|string|max:150|unique:states,name',
                    'state_id' => 'sometimes|required|exists:states,id',
                ],
                'update' => [
                    'name' => 'sometimes|required|string|max:150|unique:states,name',
                    'state_id' => 'sometimes|required|exists:states,id',
                ]
            ],
            'order' => [
                'column' => 'created_at',
                'pattern' => 'DESC',
            ],
            'relationships' => ['state'],
        ],
        'cvs' => [
            'model' => \Transave\ScolaCvManagement\Http\Models\CV::class,
            'table' => 'cvs',
            'rules' => [
                'store' => [
                    'title' => 'required|string|max:250',
                    'user_id' => 'required|exists:users,id',
                ],
                'update' => [
                    'title' => 'sometimes|required|string|max:250',
                    'user_id' => 'sometimes|required|exists:users,id',
                ]
            ],
            'order' => [
                'column' => 'created_at',
                'pattern' => 'DESC',
            ],
            'relationships' => ['user'],
        ],
        'achievements' => [
            'model' => \Transave\ScolaCvManagement\Http\Models\Achievement::class,
            'table' => 'achievements',
            'rules' => [
                'store' => [
                    'title' => 'required|string|max:250',
                    'cv_id' => 'required|exists:cvs,id',
                    'description' => 'sometimes|string',
                    'date_achieved' => 'nullable|date',
                ],
                'update' => [
                    'title' => 'sometimes|required|string|max:250',
                    'cv_id' => 'sometimes|required|exists:cvs,id',
                    'description' => 'sometimes|string',
                    'date_achieved' => 'nullable|date',
                ]
            ],
            'order' => [
                'column' => 'created_at',
                'pattern' => 'DESC',
            ],
            'relationships' => ['cv'],
        ],
        'work-experiences' => [
            'model' => \Transave\ScolaCvManagement\Http\Models\WorkExperience::class,
            'table' => 'work_experiences',
            'rules' => [
                'store' => [
                    'company' => 'required|string|max:250',
                    'position' => 'required|string|max:250',
                    'cv_id' => 'required|exists:cvs,id',
                    'responsibilities' => 'sometimes|string',
                    'start_date' => 'nullable|date',
                    'end_date' => 'nullable|date',
                ],
                'update' => [
                    'company' => 'sometimes|required|string|max:250',
                    'position' => 'sometimes|required|string|max:250',
                    'cv_id' => 'sometimes|required|exists:cvs,id',
                    'responsibilities' => 'sometimes|string',
                    'start_date' => 'nullable|date',
                    'end_date' => 'nullable|date',
                ]
            ],
            'order' => [
                'column' => 'created_at',
                'pattern' => 'DESC',
            ],
            'relationships' => ['cv'],
        ],
        'educational-qualifications' => [
            'model' => \Transave\ScolaCvManagement\Http\Models\EducationalQualification::class,
            'table' => 'educational_qualifications',
            'rules' => [
                'store' => [
                    'cv_id' => 'required|exists:cvs,id',
                    'qualification_id' => 'required|exists:qualifications,id',
                    'country_id' => 'sometimes|required|exists:countries,id',
                    'institution' => 'required|string|max:250',
                    'description' => 'sometimes|string',
                    'start_date' => 'nullable|date',
                    'end_date' => 'nullable|date',
                ],
                'update' => [
                    'cv_id' => 'sometimes|required|exists:cvs,id',
                    'qualification_id' => 'sometimes|required|exists:qualifications,id',
                    'country_id' => 'sometimes|required|exists:countries,id',
                    'institution' => 'sometimes|required|string|max:250',
                    'description' => 'sometimes|string',
                    'start_date' => 'nullable|date',
                    'end_date' => 'nullable|date',
                ]
            ],
            'order' => [
                'column' => 'created_at',
                'pattern' => 'DESC',
            ],
            'relationships' => ['cv', 'qualification', 'country'],
        ],
        'specializations' => [
            'model' => \Transave\ScolaCvManagement\Http\Models\Specialization::class,
            'table' => 'specializations',
            'rules' => [
                'store' => [
                    'name' => 'required|string|max:250',
                    'cv_id' => 'required|exists:cvs,id',
                    'description' => 'sometimes|string',
                ],
                'update' => [
                    'name' => 'sometimes|required|string|max:250',
                    'cv_id' => 'sometimes|required|exists:cvs,id',
                    'description' => 'sometimes|string',
                ]
            ],
            'order' => [
                'column' => 'created_at',
                'pattern' => 'DESC',
            ],
            'relationships' => ['cv'],
        ],
        'trainings' => [
            'model' => \Transave\ScolaCvManagement\Http\Models\Training::class,
            'table' => 'trainings',
            'rules' => [
                'store' => [
                    'cv_id' => 'required|exists:cvs,id',
                    'certificate' => 'required|string',
                    'country_id' => 'sometimes|required|exists:countries,id',
                    'institution' => 'required|string|max:250',
                    'description' => 'sometimes|string',
                    'start_date' => 'nullable|date',
                    'end_date' => 'nullable|date',
                ],
                'update' => [
                    'cv_id' => 'sometimes|required|exists:cvs,id',
                    'certificate' => 'sometimes|required|string',
                    'country_id' => 'sometimes|required|exists:countries,id',
                    'institution' => 'sometimes|required|string|max:250',
                    'description' => 'sometimes|string',
                    'start_date' => 'nullable|date',
                    'end_date' => 'nullable|date',
                ]
            ],
            'order' => [
                'column' => 'created_at',
                'pattern' => 'DESC',
            ],
            'relationships' => ['cv'],
        ],
        'referees' => [
            'model' => \Transave\ScolaCvManagement\Http\Models\Referee::class,
            'table' => 'referees',
            'rules' => [
                'store' => [
                    'cv_id' => 'required|exists:cvs,id',
                    'name' => 'required|string|max:250',
                    'address' => 'required|string|max:255',
                    'place_of_work' => 'required|string|max:255',
                    'contact' => 'required|string|max:20',
                    'relationship' => 'required|string|max:255',
                ],
                'update' => [
                    'cv_id' => 'sometimes|required|exists:cvs,id',
                    'name' => 'sometimes|required|string|max:250',
                    'address' => 'sometimes|required|string|max:255',
                    'place_of_work' => 'sometimes|required|string|max:255',
                    'contact' => 'sometimes|required|string|max:20',
                    'relationship' => 'sometimes|required|string|max:255',
                ]
            ],
            'order' => [
                'column' => 'created_at',
                'pattern' => 'DESC',
            ],
            'relationships' => ['cv'],
        ],
        'hobbies' => [
            'model' => \Transave\ScolaCvManagement\Http\Models\Hobby::class,
            'table' => 'hobbies',
            'rules' => [
                'store' => [
                    'cv_id' => 'required|exists:cvs,id',
                    'name' => 'required|string|max:250',
                    'priority' => 'sometimes|required|string|max:10',
                ],
                'update' => [
                    'cv_id' => 'sometimes|required|exists:cvs,id',
                    'name' => 'sometimes|required|string|max:250',
                    'priority' => 'sometimes|required|string|max:10',
                ]
            ],
            'order' => [
                'column' => 'created_at',
                'pattern' => 'DESC',
            ],
            'relationships' => ['cv'],
        ],
    ]
];