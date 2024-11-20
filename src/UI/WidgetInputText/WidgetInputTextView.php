<?php

declare(strict_types=1);

/**
 * @var string $name;
 * @var string $label
 * @var string $pathEndpoint
 * @var int|float $value
 */

?>

<div class="widget__essay widget__essay__input widget__input_text">
    <label for="<?= $name; ?>"><?= $label; ?></label>
    <component-essay-text-option
            data-name="<?= $name; ?>"
            data-value="<?= $value ?? ''?>"
            data-endpoint="<?= $pathEndpoint; ?>"
    ></component-essay-text-option>
</div>
