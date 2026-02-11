<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Atom\Heading;

use Pinto\Slots;
use PreviousNext\Ds\Common\Atom as CommonAtom;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[
  Slots\Attribute\RenameSlot(original: 'level', new: 'as'),
  Slots\Attribute\RenameSlot(original: 'heading', new: 'title'),
  Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes'),
  Slots\Attribute\ModifySlots(add: [
    'modifiers',
  ]),
  Scenarios([
    CommonAtom\Heading\HeadingScenarios::class,
    HeadingScenarios::class,
  ]),
]
class Heading extends CommonAtom\Heading\Heading implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  /**
   * @phpstan-return $this
   */
  public function visuallyAs(CommonAtom\Heading\HeadingLevel $headingLevel): static {
    $this->modifiers[] = HeadingVisualSize::fromHeadingLevel($headingLevel);

    return $this;
  }

  protected function build(Slots\Build $build): Slots\Build {
    $modifiers = [];

    if ($this->isExcluded) {
      $this->containerAttributes->addClass('is-excluded');
    }

    if ($this->isVisuallyHidden) {
      $this->containerAttributes->addClass('sr-only');
    }

    if (NULL !== ($headingVisualSize = $this->modifiers->getFirstInstanceOf(HeadingVisualSize::class))) {
      $modifiers[] = $headingVisualSize->asModifier();
    }

    return parent::build($build)
      ->set('modifiers', $modifiers);
  }

}
