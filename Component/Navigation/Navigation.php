<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\Navigation;

use Pinto\Attribute\Asset;
use Pinto\Slots;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Mixtape\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Asset\Css('navigation.css', preprocess: TRUE)]
#[Slots\Attribute\RenameSlot(original: 'menuTrees', new: 'items')]
#[Scenarios([CommonComponent\Navigation\NavigationScenarios::class])]
#[Slots\Attribute\RenameSlot(original: 'navigationType', new: 'type')]
class Navigation extends CommonComponent\Navigation\Navigation implements Utility\MixtapeObjectInterface {

  use Utility\ObjectTrait;

}
