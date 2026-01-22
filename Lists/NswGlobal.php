<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Lists;

use Pinto\Attribute\Asset;
use Pinto\Attribute\DependencyOn;
use Pinto\CanonicalProduct\Attribute\CanonicalProduct;
use Pinto\List\ObjectListInterface;

#[CanonicalProduct]
enum NswGlobal implements ObjectListInterface {

  use NswListTrait;

  #[DependencyOn(self::Base)]
  #[DependencyOn(self::Icon)]
  case All;

  #[Asset\Css('base.css', preprocess: TRUE)]
  case Base;

  #[Asset\Css('icon.css', preprocess: TRUE)]
  case Icon;

}
