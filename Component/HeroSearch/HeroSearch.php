<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\HeroSearch;

use Pinto\Attribute\Asset;
use Pinto\Slots;
use PreviousNext\Ds\Common\Atom as CommonAtom;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Common\Component\HeroSearch\HeroSearchModifierInterface;
use PreviousNext\Ds\Common\Modifier;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Asset\Css('hero-search.css', preprocess: TRUE)]
#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
#[Slots\Attribute\RenameSlot(original: 'links', new: 'linkList')]
#[Scenarios([
  CommonComponent\HeroSearch\HeroSearchScenarios::class,
  HeroSearchScenarios::class,
])]
class HeroSearch extends CommonComponent\HeroSearch\HeroSearch implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    // @fixme workaround scoping bug with `_class_handler.twig`
    $this->containerAttributes['fixme'] = 'fixme';

    // Image wrapper needs a hero specific class.
    $this->image?->containerAttributes->addClass(['nsw-section--image-html']);

    return $build
      ->set('title', $this->title)
      ->set('subtitle', $this->subtitle)
      ->set('image', $this->image)
      ->set('search', $this->search)
      ->set('links', \array_map(static fn (CommonAtom\Link\Link $link) => ($link)(), $this->links?->toArray() ?? []))
      ->set('modifiers', new Modifier\ModifierBag(HeroSearchModifierInterface::class))
      ->set('containerAttributes', $this->containerAttributes);
  }

}
