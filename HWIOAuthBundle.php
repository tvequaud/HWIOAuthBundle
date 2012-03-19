<?php

/*
 * This file is part of the HWIOAuthBundle package.
 *
 * (c) Hardware.Info <opensource@hardware.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HWI\Bundle\OAuthBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle,
    Symfony\Component\DependencyInjection\ContainerBuilder;

use HWI\Bundle\OAuthBundle\DependencyInjection\HWIOAuthExtension,
    HWI\Bundle\OAuthBundle\DependencyInjection\Security\Factory\OAuthFactory,
    HWI\Bundle\OAuthBundle\Security\Core\UserProvider\EntityFactory;

/**
 * HWIOAuthBundle
 *
 * @author Geoffrey Bachelet <geoffrey.bachelet@gmail.com>
 * @author Alexander <geoffrey.bachelet@gmail.com>
 */
class HWIOAuthBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new OAuthFactory());
    }

    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        // return the right extension instead of "auto-registering" it. Now the
        // alias can be hwi_oauth instead of hwi_o_auth..
        if (null === $this->extension) {
            return new HWIOAuthExtension;
        }

        return $this->extension;
    }
}