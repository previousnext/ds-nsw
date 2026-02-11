<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\Accordion;

use Pinto\Attribute\Asset;
use Pinto\Slots;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Common\Component\Accordion\AccordionScenarios;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Asset\Css('accordion.css', preprocess: FALSE)]
#[Asset\Js('accordion.entry.js', preprocess: FALSE, attributes: ['type' => 'module'])]
#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
#[Scenarios([AccordionScenarios::class])]
class Accordion extends CommonComponent\Accordion\Accordion implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    return $build
      ->set('title', $this->title)
      ->set('toggleAll', TRUE)
      ->set('items', $this->map(static fn (CommonComponent\Accordion\AccordionItem\AccordionItem $item): mixed => $item())->toArray())
      // Modifier is unused by the twig.
      ->set('modifier', NULL);
  }

}
