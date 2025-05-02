<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Layout\Grid;

use Pinto\Attribute\Asset;
use Pinto\Slots;
use PreviousNext\Ds\Common\Layout as CommonLayout;
use PreviousNext\Ds\Common\Modifier\ModifierClassInterface;
use PreviousNext\Ds\Nsw\Utility;

#[Asset\Css('grid.css', preprocess: TRUE)]
#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
class Grid extends CommonLayout\Grid\Grid implements Utility\NswObjectInterface {
  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    // @fixme workaround scoping bug with `_class_handler.twig`
    $this->containerAttributes['fixme'] = 'fixme';

    foreach ($this->modifiers as $modifier) {
      if ($modifier instanceof ModifierClassInterface) {
        // Attribute guarantees 'class' offset exists.
        $this->containerAttributes['class'][] = $modifier->className();
      }
    }

    return parent::build($build)
      ->set('as', $this->as->element())
      // NSW `modifiers` may only contain values from
      // GridColumnSizeModifier::classPart().
      ->set('modifiers', $this->modifiers->getInstancesOf(GridColumnSizeModifier::class)->map(
        static fn (GridColumnSizeModifier $modifier): string => $modifier->classPart(),
      ));
  }

}
