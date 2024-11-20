<?php

declare(strict_types=1);

/**
 * @var string $name
 * @var string $label
 * @var array $columns
 * @var string $pathEndpoint
 * @var string $value
 */

?>

<div class="widget__essay widget__essay__repeater">
	<label for="<?= $name; ?>"><?= $label; ?></label>
	<component-essay-repeater
		data-columns="<?= htmlspecialchars(json_encode($columns)); ?>"
		data-name="<?= $name; ?>"
		data-endpoint="<?= $pathEndpoint; ?>"
	></component-essay-repeater>
</div>