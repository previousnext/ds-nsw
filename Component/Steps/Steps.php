<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\Steps;

use Pinto\Attribute\Asset;
use Pinto\Slots;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Asset\Css('steps.css', preprocess: FALSE)]
#[Slots\Attribute\RenameSlot(original: 'hasBackgroundFill', new: 'fill')]
#[Slots\Attribute\RenameSlot(original: 'hasTextCounters', new: 'counters')]
#[Scenarios([
  CommonComponent\Steps\StepsScenarios::class,
  StepsScenarios::class,
])]
class Steps extends CommonComponent\Steps\Steps implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    $modifiers = [];
    $stepsBackground = $this->modifiers->getFirstInstanceOf(StepsBackground::class);
    if ($stepsBackground !== NULL) {
      $modifiers[] = $stepsBackground->modifierName();
    }

    $stepsSize = $this->modifiers->getFirstInstanceOf(StepsSize::class);
    if ($stepsSize !== NULL) {
      $modifiers[] = $stepsSize->modifierName();
    }

    return parent::build($build)
      ->set('modifiers', $modifiers);
  }

}
