<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Controller\Rest\ProductType;

use Exception;
use Shayer\EduEssayPlugin\Controller\Rest\DTO\ProductTypeDto;
use Shayer\EduEssayPlugin\Controller\Rest\RestHandleInterface;
use Shayer\EduEssayPlugin\Service\ProductType\ProductTypeService;
use WP_REST_Request;
use WP_REST_Response;
use WP_Error;

class ProductTypeGetReq implements RestHandleInterface
{
	/**
	 * Construct.
	 *
	 * @param ProductTypeService $productTypeService
	 */
	public function __construct(
		private readonly ProductTypeService $productTypeService,
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
			$result = $this->productTypeService->getList();

			return new WP_REST_Response([
				'result' => "Product Type(s), has been success getting",
				'data' => $result,
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

	/**
	 * @return ProductTypeDto[]
	 */
	private function convertToDtoArray($data): array
	{
		$result = [];

		foreach ($data as $item) {
			$result[] = new ProductTypeDto($item);
		}

		return $result;
	}
}
