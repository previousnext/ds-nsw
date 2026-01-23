<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Atom\Icon;

use Pinto\Attribute\Asset\Css;
use Pinto\Attribute\Asset\ExternalCss;
use Pinto\Slots;
use PreviousNext\Ds\Common\Atom as CommonAtom;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

/**
 * Icon name ($icon) is https://fonts.google.com/icons?icon.set=Material+Icons.
 */
#[Css('icon.css', preprocess: TRUE)]
#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
#[Slots\Attribute\ModifySlots(add: [
  'size',
])]
#[Scenarios([IconScenarios::class])]
#[ExternalCss('//fonts.googleapis.com/icon?family=Material+Icons')]
class Icon extends CommonAtom\Icon\Icon implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    $size = NULL;

    $iconSizeEnum = $this->modifiers->getFirstInstanceOf(IconSize::class);
    if ($iconSizeEnum !== NULL) {
      $size = $iconSizeEnum->modifierName();
    }

    return $build
      ->set('modifiers', [])
      ->set('icon', $this->icon)
      ->set('text', $this->text)
      ->set('size', $size)
      ->set('alignmentType', NULL)
      ->set('containerAttributes', $this->containerAttributes);
  }

}
