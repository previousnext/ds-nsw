<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\Pagination\PaginationItem;

use Pinto\Slots;
use PreviousNext\Ds\Common\Component as CommonComponents;
use PreviousNext\Ds\Nsw\Utility;

class PaginationItem extends CommonComponents\Pagination\PaginationItem\PaginationItem implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    if ($this->link !== NULL) {
      $this->link->current = $this->isEnabled;
    }

    return parent::build($build);
  }

}
