<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Layout\Grid\GridItem;

use Pinto\Slots;
use PreviousNext\Ds\Common\Layout as CommonLayout;
use PreviousNext\Ds\Nsw\Utility;

#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
#[Slots\Attribute\RenameSlot(original: 'content', new: 'item')]
class GridItem extends CommonLayout\Grid\GridItem\GridItem implements Utility\NswObjectInterface {
  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    // @fixme, remove when nswds also has a template update for grid-item.
    $item = $this->first();
    return parent::build($build)
      ->set('content', \is_callable($item) ? ($item)() : $item)
      // @todo handle modifiers...
      ->set('modifiers', [])
      ->set('as', $this->as->element());
  }

}
