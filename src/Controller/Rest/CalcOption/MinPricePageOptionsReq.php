<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Controller\Rest\CalcOption;

use Exception;
use Shayer\EduEssayPlugin\Controller\Rest\RestHandleInterface;
use Shayer\EduEssayPlugin\Service\CalcOption\MinPricePageService;
use WP_REST_Request;
use WP_REST_Response;
use WP_Error;

class MinPricePageOptionsReq implements RestHandleInterface
{
    public function __construct(
        private readonly MinPricePageService $minPricePageService
    ) {
    }

    public function handle(WP_REST_Request $request): WP_REST_Response|WP_Error
    {
        $body = $request->get_json_params();

        try {
            $this->minPricePageService->updateValue($body);
            return new WP_REST_Response([
                'result' => "Min price for page has been success appended",
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
