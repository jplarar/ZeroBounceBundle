<?php

namespace Jplarar\ZeroBounceBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use InvalidArgumentException;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class JplararZeroBounceExtension extends Extension
{

    /**
     * {@inheritDoc}
     * @param array $configs
     * @param ContainerBuilder $container
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $parameters = [
            'zero_bounce_api_key'
        ];

        foreach ($parameters as $parameter) {
            if (!isset($config[$parameter])) {
                throw new InvalidArgumentException('The option "jplarar_zero_bounce.'.$parameter.'" must be set.');
            }
            $container->setParameter('jplarar_zero_bounce.'.$parameter, $config[$parameter]);
        }
    }

    /**
     * {@inheritdoc}
     * @version 0.0.1
     * @since 0.0.1
     */
    public function getAlias()
    {
        return 'jplarar_zero_bounce';
    }
}
