<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Controller\Rest\CalcOption;

use Exception;
use Shayer\EduEssayPlugin\Controller\Rest\RestHandleInterface;
use Shayer\EduEssayPlugin\Service\CalcOption\MinCountPageService;
use WP_REST_Request;
use WP_REST_Response;
use WP_Error;

class MinCountPageOptionReq implements RestHandleInterface
{
    public function __construct(
        private readonly MinCountPageService $minCountPageService
    ) {
    }

    public function handle(WP_REST_Request $request): WP_REST_Response|WP_Error
    {
        $body = $request->get_json_params();

        try {
            $this->minCountPageService->updateValue((int) $body['value']);
            return new WP_REST_Response([
                'result' => "Min count page by {$body['value']}, has been success appended",
                'success' => true,
            ], 201);
        } catch (Exception $exception) {
            return new WP_Error(
                'some_error',
                $exception->getMessage(),
                ['status' => $exception->getCode()]
            );
        }
    }
}
