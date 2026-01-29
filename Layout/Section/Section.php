<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Layout\Section;

use Pinto\Attribute\Asset\Css;
use Pinto\Slots;
use PreviousNext\Ds\Common\Atom\Html\Html;
use PreviousNext\Ds\Common\Layout as CommonLayouts;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Css('section.css', preprocess: TRUE)]
#[Slots\Attribute\RenameSlot(original: 'heading', new: 'title')]
#[Slots\Attribute\RenameSlot(original: 'isContainer', new: 'container')]
#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
#[Slots\Attribute\ModifySlots(add: [
  new Slots\Slot('linkBefore'),
])]
#[Scenarios([
  CommonLayouts\Section\SectionScenarios::class,
  SectionScenarios::class,
])]
class Section extends CommonLayouts\Section\Section implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    $content = $this->map(static function (CommonLayouts\Section\SectionItem $item): mixed {
      return Html::createFromCollection([$item->content]);
    })->toArray();

    $linkIsBefore = ($this->modifiers->getFirstInstanceOf(LinkPosition::class) ?? LinkPosition::BeforeContent) === LinkPosition::BeforeContent;
    if ($linkIsBefore) {
      $this->heading?->containerAttributes->addClass('nsw-section-title');
    }

    return $build
      ->set('background', $this->modifiers->getFirstInstanceOf(SectionBackground::class)?->modifierName())
      ->set('isContainer', $this->isContainer)
      ->set('as', $this->as->element())
      ->set('heading', $this->heading)
      ->set('content', Html::createFromCollection($content))
      ->set('link', $this->link)
      ->set('linkBefore', $linkIsBefore)
      ->set('modifiers', []);
  }

}
