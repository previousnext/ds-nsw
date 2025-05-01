<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Layout\Grid\GridItem;

use Pinto\Slots;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\Ds\Common\Layout as CommonLayout;

#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
class GridItem extends CommonLayout\Grid\GridItem\GridItem implements Utility\NswObjectInterface
{
  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build
  {
    // @todo handle modifiers...
    $modifiers = [];

    return parent::build($build)
      ->set('modifiers', \array_values($modifiers))
      ->set('as', $this->as->element())
    ;
  }
}
