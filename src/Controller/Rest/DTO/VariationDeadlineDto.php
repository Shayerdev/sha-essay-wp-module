<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Controller\Rest\DTO;

class VariationDeadlineDto
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
	 * @return float|int
	 */
	public function getCountSymbols(): float|int
	{
		return (int) $this->data['count_symbols'];
	}

	/**
	 * @return float|int
	 */
	public function getCountDays(): float|int
	{
		return (int) $this->data['count_days'];
	}

	/**
	 * @return array
	 */
	public function getData(): array
	{
		return $this->data;
	}
}
