<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Layout\Section;

use Pinto\Attribute\Asset\Css;
use Pinto\Slots;
use PreviousNext\Ds\Common\Atom;
use PreviousNext\Ds\Common\Layout as CommonLayouts;
use PreviousNext\Ds\Nsw\Utility;

#[Css('section.css', preprocess: TRUE)]
#[Slots\Attribute\RenameSlot(original: 'heading', new: 'title')]
#[Slots\Attribute\RenameSlot(original: 'isContainer', new: 'container')]
#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
class Section extends CommonLayouts\Section\Section implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    return $build
      // @todo Common/shapes has `background` but NSW template does not.
      ->set('background', NULL)
      // @todo Common/shapes has `container` but NSW template does not.
      ->set('isContainer', NULL)
      ->set('as', $this->as->element())
      ->set('heading', $this->heading?->heading)
      ->set('content', $this->content?->markup)
      ->set('link', $this->link instanceof Atom\Link\LinkWithLabel ? $this->link->markup() : $this->link?->url)
      // @todo do something with modifiers:
      ->set('modifiers', []);
  }

}
