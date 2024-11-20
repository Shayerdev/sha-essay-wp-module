<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Controller\Rest\DTO;

class ProductCategoryDto
{
	/**
	 * Construct.
	 *
	 * @param array $data
	 */
	public function __construct(
		private readonly array $data
	) {
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return (string) $this->data['category_name'];
	}

	/**
	 * @return array
	 */
	public function getData(): array
	{
		return $this->data;
	}
}
