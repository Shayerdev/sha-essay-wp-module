<?php

/**
 * Copyright © Pronko Consulting Ltd. All rights reserved.
 */

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\Common\Database;

interface ConnectionInterface
{
    /**
     * @return string
     */
    public function getTablePrefix(): string;

    /**
     * Returns table name with prefix
     *
     * @param string $tableName
     * @return string
     */
    public function getTableName(string $tableName): string;

    /**
     * @param string $tableName
     * @return bool
     */
    public function isTableExists(string $tableName): bool;

    /**
     * Creates table if not the table does not exist
     *
     * @param string $ddl
     * @return bool|string
     */
    public function createTable(string $ddl): bool|string;

    /**
     * @param string $tableName
     * @param array $values
     * @param array|string $format
     * @return int
     */
    public function insert(string $tableName, array $values, array|string $format = []): int;

    /**
     * Update Row
     *
     * @param string $tableName
     * @param array $value
     * @param array $where
     * @param array|null $format
     * @return bool|int|null
     */
    public function update(string $tableName, array $value, array $where, ?array $format = null): bool|int|null;

    /**
     * Delete table
     *
     * @param string $tableName
     * @return bool
     */
    public function dropTable(string $tableName): bool;

    /**
     * @param string $tableName
     * @return void
     */
    public function truncate(string $tableName): void;

    /**
     * @param string $sql
     * @return void
     */
    public function query(string $sql): void;

    /**
     * @param string $sql
     * @param array $bind
     * @return string|null
     */
    public function fetchAggregate(string $sql, array $bind = []): ?string;

    /**
     * @param string $sql
     * @param array $bind
     * @return array|null
     */
    public function fetchAssoc(string $sql, array $bind = []): ?array;

    /**
     * @param string $sql
     * @param array $bind
     * @return array|null
     */
    public function fetchOne(string $sql, array $bind = []): ?array;

    /**
     * Deletes record(s) from a table
     *
     * @param string $tableName
     * @param array $where
     * @return void
     */
    public function delete(string $tableName, array $where = []): void;

    /**
     * Start Transaction
     *
     * @return void
     */
    public function start(): void;

    /**
     * Commit transaction
     *
     * @return void
     */
    public function commit(): void;

    /**
     * Rollback transaction
     *
     * @return void
     */
    public function rollback(): void;

    /**
     * Prepares a query string with a $bind array
     *
     * @param string $query
     * @param array $bind
     * @return string
     */
    public function prepare(string $query, array $bind): string;
}
