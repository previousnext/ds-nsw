<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\Tabs\TabListItem;

use Drupal\Core\Template\Attribute;
use Pinto\Slots;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Nsw\Utility;

#[Slots\Attribute\ModifySlots(add: [
  new Slots\Slot('active'),
  // @todo move to common
  new Slots\Slot('attributes'),
])]
class TabListItem extends CommonComponent\Tabs\TabListItem\TabListItem implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  public bool $active;

  protected function build(Slots\Build $build): Slots\Build {
    return parent::build($build)
      ->set('active', $this->active)
      ->set('attributes', new Attribute());
  }

}
