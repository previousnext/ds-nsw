<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\Steps\Step;

use Pinto\Slots;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Nsw\Utility;

#[Slots\Attribute\RenameSlot(original: 'isEnabled', new: 'status')]
class Step extends CommonComponent\Steps\Step\Step implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

}
