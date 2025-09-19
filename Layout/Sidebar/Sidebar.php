<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Layout\Sidebar;

use Pinto\Slots;
use PreviousNext\Ds\Common\Layout as CommonLayouts;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Slots\Attribute\RenameSlot(original: 'sidebar', new: 'sidebarContent')]
#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
#[Slots\Attribute\RenameSlot(original: 'sidebarPosition', new: 'before')]
#[Scenarios([CommonLayouts\Sidebar\SidebarScenarios::class])]
class Sidebar extends CommonLayouts\Sidebar\Sidebar implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    return parent::build($build)
      ->set('contentAttributes', $this->contentAttributes)
      ->set('sidebarAttributes', $this->sidebarAttributes);
  }

}
