<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\Accordion\AccordionItem;

use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Nsw\Utility;

/**
 * @todo item.id  is unused by the twig
 */
class AccordionItem extends CommonComponent\Accordion\AccordionItem\AccordionItem implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

}
