<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\MenuItem;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('app.menu.goals', ['uri' => '#']);
        $menu->addChild('app.menu.roles', ['uri' => '#']);
        $menu->addChild('app.menu.kudos', ['uri' => '#']);
        $visualizationItem = $menu->addChild('app.menu.visualization', ['uri' => '#']);
        $visualizationItem->addChild('app.menu.visualization.organizationChart', ['uri' => '#']);
        $visualizationItem->addChild('app.menu.visualization.botleneck', ['uri' => '#']);
        $visualizationItem->addChild('app.menu.visualization.blooming', ['uri' => '#']);
        $this->makeItDropdown($visualizationItem);
        $menu->addChild('app.menu.meeting', ['uri' => '#']);
        $menu->setChildrenAttribute('class', 'nav');

        // menu items
        /** @var MenuItem $child */
        foreach ($menu as $child) {
            $child->setLinkAttribute('class', $child->getLinkAttribute('class'). ' nav-link p-2')
                ->setAttribute('class', $child->getAttribute('class').' nav-item');
        }

        return $menu;
    }

    private function makeItDropdown(MenuItem $item)
    {
        $item->setAttribute('class', 'dropdown');
        $item->setLinkAttributes([
            'class' => 'nav-link dropdown-toggle',
            'data-toggle' => 'dropdown',
            'role' => 'button'
        ]);
        $item->setChildrenAttributes([
            'class' => 'dropdown-menu dropdown-menu-right'
        ]);

        foreach ($item as $child) {
            $child->setLinkAttribute('class', 'dropdown-item');
        }
    }
}