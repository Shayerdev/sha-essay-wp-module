<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Controller\Rest\Category;

use Exception;
use Shayer\EduEssayPlugin\Controller\Rest\DTO\ProductCategoryDto;
use Shayer\EduEssayPlugin\Controller\Rest\RestHandleInterface;
use Shayer\EduEssayPlugin\Service\ProductCategory\ProductCategoryService;
use WP_REST_Request;
use WP_REST_Response;
use WP_Error;

class ProductCategoryGetReq implements RestHandleInterface
{
	/**
	 * @param ProductCategoryService $productCategoryService
	 */
	public function __construct(
		private readonly ProductCategoryService $productCategoryService,
	) {
	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response|WP_Error
	 */
	public function handle(WP_REST_Request $request): WP_REST_Response|WP_Error
	{
		try {
			$result = $this->productCategoryService->getList();

			return new WP_REST_Response([
				'result' => "Product categories, has been success getting",
				'data' => $result,
				'success' => true,
			], 200);
		} catch (Exception $exception) {
			return new WP_Error(
				'some_error',
				$exception->getMessage(),
				['status' => $exception->getCode()]
			);
		}
	}
}
