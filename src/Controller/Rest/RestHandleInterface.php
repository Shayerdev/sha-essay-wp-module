<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Controller\Rest;

use WP_Error;
use WP_REST_Request;
use WP_REST_Response;

interface RestHandleInterface {
    public function handle(WP_REST_Request $request): WP_REST_Response|WP_Error;
}
