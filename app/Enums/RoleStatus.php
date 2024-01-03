<?php

namespace App\Enums;

enum RoleStatus:string {
    case DEPRECATED = 'deprecated';
    case ACTIVE = 'active';
}