<?php

namespace Ck\WebBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Main implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function topMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root')
            ->setChildrenAttribute('class', 'nav navbar-nav')
        ;

        $menu->addChild('Products', array('route' => 'product_index'))
        ;

        $menu->addChild('Categories', array('route' => 'category_index'))
        ;

        $menu->addChild('Tax', array('route' => 'tax_index'))
        ;

        return $menu;
    }
}