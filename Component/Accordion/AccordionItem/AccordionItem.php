<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\Accordion\AccordionItem;

use Pinto\Slots;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\Ds\Common\Component as CommonComponent;

class AccordionItem extends CommonComponent\Accordion\AccordionItem\AccordionItem implements Utility\NswObjectInterface
{
  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build
  {
    return parent::build($build);
  }
}
