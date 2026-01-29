<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\SideNavigation;

use Pinto\Attribute\Asset\Css;
use Pinto\Slots;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Css('side-navigation.css', preprocess: FALSE)]
#[Slots\Attribute\RenameSlot(original: 'parentLink', new: 'parent')]
#[Slots\Attribute\RenameSlot(original: 'menuTrees', new: 'items')]
#[Scenarios([CommonComponent\SideNavigation\SideNavigationScenarios::class])]
class SideNavigation extends CommonComponent\SideNavigation\SideNavigation implements Utility\NswObjectInterface {
  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    return parent::build($build)
      ->set('id', $this->id)
      ->set('title', $this->title)
      ->set('menuTrees', $this->toArray())
      ->set('parentLink', $this->parentLink);
  }

}
