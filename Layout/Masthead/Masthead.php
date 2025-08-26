<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Layout\Masthead;

use Pinto\Attribute\Asset\Css;
use Pinto\Slots;
use PreviousNext\Ds\Common\Layout as CommonLayout;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

/**
 * @see https://designsystem.nsw.gov.au/components/masthead/index.html
 */
#[Css('masthead.css', preprocess: TRUE)]
#[Scenarios([
  CommonLayout\Masthead\MastheadScenarios::class,
  MastheadScenarios::class,
])]
#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
class Masthead extends CommonLayout\Masthead\Masthead implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    return parent::build($build)
      ->set('background', ($this->modifiers->getFirstInstanceOf(CommonLayout\Masthead\MastheadModifierInterface::class) ?? MastheadBackground::Dark)->background());
  }

}
