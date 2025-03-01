<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;
use Symfony\Component\Security\Core\Security;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function handle(Request $request, AccessDeniedException $accessDeniedException): ?Response
    {
        // Return a response with an error message instead of redirecting
        return new Response('Access Denied: You do not have the required permissions.', Response::HTTP_FORBIDDEN);
    }
} 