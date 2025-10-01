<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\Callout;

use Pinto\Attribute\Asset\Css;
use Pinto\Slots;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Css('callout.css', preprocess: TRUE)]
#[Slots\Attribute\RenameSlot(original: 'heading', new: 'title')]
#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
#[Scenarios([CommonComponent\Callout\CalloutScenarios::class])]
class Callout extends CommonComponent\Callout\Callout implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

}
