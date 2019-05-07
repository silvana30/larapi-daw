<?php

namespace Api\Users;

use Infrastructure\Events\EventServiceProvider;
use Api\Users\Events\UserWasCreated;
use Api\Users\Events\UserWasDeleted;
use Api\Users\Events\UserWasUpdated;

class MedicalUnitServiceProvider extends EventServiceProvider
{
    protected $listen = [
        DoctorWasCreated::class => [
            // listeners for when a Doctor is created
        ],
        DoctorWasDeleted::class => [
            // listeners for when a Doctor is deleted
        ],
        DoctorWasUpdated::class => [
            // listeners for when a Doctor is updated
        ]
    ];
}
