<?php

declare(strict_types=1);

namespace Shayer\EduEssayPlugin\App;

use Exception;
use Shayer\EduEssayPlugin\Action\ActivateActionRegistrar;
use Shayer\EduEssayPlugin\Action\DeactivateActionRegistrar;
use Shayer\EduEssayPlugin\Common\Hooks\HookManager;
use Shayer\EduEssayPlugin\Common\Hooks\HookProvider;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Http
{
    /**
     * @param array $params
     *
     * @return void
     * @throws Exception
     */
    public function run(array $params): void
    {
        $containerBuilder = new ContainerBuilder();

        $loader = new YamlFileLoader($containerBuilder, $params['config.services.path']);
        $loader->load($params['config.services.file']);

        $containerBuilder->setParameter(
            'shayer_edu_essay.plugin_file_path',
            $params['plugin_file_path']
        );

        $containerBuilder->setParameter(
            'shayer_edu_essay.plugin_dir_path',
            $params['plugin_dir_path']
        );

	    $containerBuilder->setParameter(
		    'shayer_edu_essay.plugin_url',
		    $params['plugin_url']
	    );

        $containerBuilder->compile();

        // Registration hooks
        $this->registerHooks($containerBuilder);
        $this->registerActivateActionHooks($containerBuilder);
        $this->registerDeactivateActionHooks($containerBuilder);
    }

    /**
     * Register Hooks
     *
     * @param ContainerBuilder $containerBuilder
     * @return void
     * @throws Exception
     */
    public function registerHooks(ContainerBuilder $containerBuilder): void
    {
        /** @var HookManager $hookManager */
        $hookManager = $containerBuilder->get(HookManager::class);
        /** @var HookProvider $hookProvider */
        $hookProvider = $containerBuilder->get(HookProvider::class);

        foreach ($hookProvider->get() as $subscriber) {
            $hookManager->register($subscriber);
        }
    }

    /**
     * @param ContainerBuilder $containerBuilder
     * @return void
     * @throws Exception
     */
    public function registerActivateActionHooks(ContainerBuilder $containerBuilder): void
    {
        /** @var ActivateActionRegistrar $activateActionRegistrar */
        $activateActionRegistrar = $containerBuilder->get(ActivateActionRegistrar::class);
        $activateActionRegistrar->register();
    }

    /**
     * @param ContainerBuilder $containerBuilder
     * @return void
     * @throws Exception
     */
    public function registerDeactivateActionHooks(ContainerBuilder $containerBuilder): void
    {
        /** @var DeactivateActionRegistrar $deactivateActionRegistrar */
        $deactivateActionRegistrar = $containerBuilder->get(DeactivateActionRegistrar::class);
        $deactivateActionRegistrar->register();
    }
}
