<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Atom\Button;

use Pinto\Slots;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Common\Component\Button\ButtonType;
use PreviousNext\Ds\Nsw\Utility;

#[Slots\Attribute\RenameSlot('link', 'href')]
class Button extends CommonComponent\Button\Button implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    {
    $as = \strtolower(match ($this->as) {
      // Define all cases so we are notified by PHPStan if a new one is added
      // upstream.
      ButtonType::Button, ButtonType::Input, ButtonType::Link => $this->as->name,
    });

    return parent::build($build)
      ->set('title', $this->title)
      ->set('link', $this->link?->url->toString())
      ->set('as', $as);
    }
  }

}
