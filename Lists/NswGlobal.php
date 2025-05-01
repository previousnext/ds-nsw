<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Lists;

use Drupal\pinto\List\StreamWrapperAssetInterface;
use Pinto\Attribute\Asset;
use Pinto\Attribute\DependencyOn;
use Pinto\CanonicalProduct\Attribute\CanonicalProduct;
use Pinto\List\ObjectListInterface;
use PreviousNext\Ds\Nsw\Component;

#[CanonicalProduct]
enum NswGlobal implements ObjectListInterface, StreamWrapperAssetInterface {

  use NswListTrait;

  #[DependencyOn(self::Base)]
  #[DependencyOn(self::Icon)]
  case All;

  #[Asset\Css('base.css', preprocess: true)]
  case Base;

  #[Asset\Css('icon.css', preprocess: true)]
  case Icon;

}
