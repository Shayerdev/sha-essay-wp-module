<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Common\Registrar;

use Shayer\EduEssayPlugin\Common\Hooks\ActionHookSubscriberInterface;
use Shayer\EduEssayPlugin\Controller\Rest\RestArgsInterface;
use Shayer\EduEssayPlugin\Controller\Rest\RestHandleInterface;

class RestApiRegistrar implements ActionHookSubscriberInterface
{
    public function __construct(
        private readonly string $routeNamespace,
        private readonly string $route,
        private readonly string $method,
        private readonly RestHandleInterface $callback,
        private readonly RestArgsInterface $args,
    ) {
    }

    public static function getActions(): array
    {
        return [
            'rest_api_init' => ['register', 20],
        ];
    }

    public function register(): void
    {
        register_rest_route($this->routeNamespace, $this->route, [
            'methods' => $this->method,
            'callback' => [$this->callback, 'handle'],
            'args' => $this->args->validate()
//            'permission_callback' => function () {
//                return current_user_can( 'edit_others_posts' );
//            }
        ]);
    }
}
