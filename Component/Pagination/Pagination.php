<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\Pagination;

use Pinto\Attribute\Asset\Css;
use Pinto\Slots;
use PreviousNext\Ds\Common\Component as CommonComponents;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Css('pagination.css', preprocess: FALSE)]
#[Scenarios([PaginationScenarios::class])]
class Pagination extends CommonComponents\Pagination\Pagination implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    return $build
      ->set('pages', $this->map(static fn (CommonComponents\Pagination\PaginationItem\PaginationItem $item): mixed => $item())->toArray());
  }

}
