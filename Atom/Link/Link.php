<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Atom\Link;

use Pinto\Slots;
use PreviousNext\Ds\Common\Atom as CommonAtoms;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
#[Scenarios(scenarios: [
  CommonAtoms\Link\LinkScenarios::class,
])]
class Link extends CommonAtoms\Link\Link implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

}
