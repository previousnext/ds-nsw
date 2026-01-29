<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\Tabs;

use Pinto\Attribute\Asset;
use Pinto\Slots;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Asset\Css('tabs.css', preprocess: FALSE)]
#[Asset\Js('tabs.entry.js', preprocess: FALSE, attributes: ['type' => 'module'])]
#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
#[Scenarios([CommonComponent\Tabs\TabsScenarios::class])]
class Tabs extends CommonComponent\Tabs\Tabs implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

}
