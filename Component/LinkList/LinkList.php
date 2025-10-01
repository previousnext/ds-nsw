<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\LinkList;

use Pinto\Attribute\Asset;
use Pinto\Slots;
use PreviousNext\Ds\Common\Atom;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Asset\Css('link-list.css', preprocess: TRUE)]
#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
#[Scenarios([CommonComponent\LinkList\LinkListScenarios::class])]
class LinkList extends CommonComponent\LinkList\LinkList implements Utility\NswObjectInterface {
  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    // @fixme workaround scoping bug with `_class_handler.twig`
    $this->containerAttributes['fixme'] = 'fixme';

    return parent::build($build)
      ->set('items', \array_map(static function (Atom\Link\Link $link) {
        return $link();
      }, $this->toArray()));
  }

}
