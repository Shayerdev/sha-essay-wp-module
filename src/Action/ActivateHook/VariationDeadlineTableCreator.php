<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Action\ActivateHook;

use Shayer\EduEssayPlugin\Action\ActionHookInterface;
use Shayer\EduEssayPlugin\Common\Database\ConnectionInterface;

class VariationDeadlineTableCreator implements ActionHookInterface
{
	private const TABLE_NAME = 'shayer_essay_deadline_table_variation_by_count_page';

	public function __construct(
		private readonly ConnectionInterface $connection,
	) {
	}

	/**
	 * @return void
	 */
	public function run(): void
	{
		$this->connection->createTable($this->getCreateTableDdl());
	}

	/**
	 * @return string
	 */
	private function getCreateTableDdl(): string
	{
		return sprintf(
			"CREATE TABLE IF NOT EXISTS %s (
                id INT(11) UNSIGNED AUTO_INCREMENT,
                count_symbols INT(11) NOT NULL,
                count_days INT(11) NOT NULL,
                PRIMARY KEY (id)
            ) ENGINE=InnoDB;",
			$this->connection->getTableName(self::TABLE_NAME)
		);
	}
}
