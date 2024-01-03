<?php

namespace App\Enums;

enum CategoryStatus:string {
    case DEPRECATED = "deprecated";
    case ACTIVE = "active";
}