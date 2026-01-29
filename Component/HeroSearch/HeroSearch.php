<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\HeroSearch;

use Pinto\Attribute\Asset;
use Pinto\Slots;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Asset\Css('hero-search.css', preprocess: FALSE)]
#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
#[Slots\Attribute\RenameSlot(original: 'links', new: 'linkList')]
#[Scenarios([
  CommonComponent\HeroSearch\HeroSearchScenarios::class,
])]
class HeroSearch extends CommonComponent\HeroSearch\HeroSearch implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    // @fixme workaround scoping bug with `_class_handler.twig`
    $this->containerAttributes['fixme'] = 'fixme';

    // Always remove link headings.
    if (NULL !== $this->links) {
      $this->links->title = NULL;
    }

    return $build
      ->set('title', $this->title)
      // Not currently used by NSWDS.
      ->set('content', NULL)
      ->set('subtitle', $this->subtitle)
      ->set('image', $this->image)
      ->set('search', $this->searchForm)
      ->set('links', $this->links)
      ->set('modifiers', [])
      ->set('containerAttributes', $this->containerAttributes);
  }

}
