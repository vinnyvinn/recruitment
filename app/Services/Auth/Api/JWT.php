<?php

namespace Boaz\Services\Auth\Api;

class JWT extends \Tymon\JWTAuth\JWT
{
    use ExtendsJwtValidation;
}
