<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Layout\Section;

use Pinto\Attribute\Asset\Css;
use Pinto\Slots;
use PreviousNext\Ds\Common\Layout as CommonLayouts;
use PreviousNext\Ds\Nsw\Utility;

#[Css('section.css', preprocess: TRUE)]
#[Slots\Attribute\RenameSlot(original: 'heading', new: 'title')]
#[Slots\Attribute\RenameSlot(original: 'isContainer', new: 'container')]
#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
class Section extends CommonLayouts\Section\Section implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    $content = $this->map(static function (CommonLayouts\Section\SectionItem $item): mixed {
      return \is_callable($item->content) ? ($item->content)() : $item->content;
    })->toArray();

    return $build
      // @todo Common/shapes has `background` but NSW template does not.
      ->set('background', NULL)
      // @todo Common/shapes has `container` but NSW template does not.
      ->set('isContainer', NULL)
      ->set('as', $this->as->element())
      ->set('heading', $this->heading)
      ->set('content', $content)
      ->set('link', $this->link)
      // @todo do something with modifiers:
      ->set('modifiers', []);
  }

}
