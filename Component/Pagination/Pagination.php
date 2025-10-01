<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\Pagination;

use Pinto\Attribute\Asset\Css;
use PreviousNext\Ds\Common\Component as CommonComponents;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Css('pagination.css', preprocess: TRUE)]
#[Scenarios([PaginationScenarios::class])]
class Pagination extends CommonComponents\Pagination\Pagination implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

}
