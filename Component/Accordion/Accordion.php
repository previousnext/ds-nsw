<?php

declare(strict_types = 1);

namespace PreviousNext\Ds\Nsw\Component\Accordion;

use Pinto\Attribute\Asset;
use Pinto\Slots;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Nsw\Utility;

#[Asset\Css('accordion.css', preprocess: true)]
#[Asset\Js('accordion.entry.js', preprocess: true, attributes: ['type' => 'module'])]
#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
class Accordion extends CommonComponent\Accordion\Accordion implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    // @todo items.item.id  is unused by the twig
    // @todo items.item.open  is unused by the twig
    return $build
      // @todo title is unused by the twig
      ->set('title', NULL)
      ->set('toggleAll', TRUE)
      ->set('items', $this->map(fn (AccordionItem\AccordionItem $item): mixed => $item())->toArray())
      // @todo modifier  is unused by the twig
      ->set('modifier', NULL)
    ;
  }

}
