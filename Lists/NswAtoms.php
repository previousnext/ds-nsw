<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Lists;

use Drupal\pinto\List\StreamWrapperAssetInterface;
use Pinto\Attribute\Definition;
use Pinto\Attribute\DependencyOn;
use Pinto\CanonicalProduct\Attribute\CanonicalProduct;
use Pinto\List\ObjectListInterface;
use PreviousNext\Ds\Nsw\Atom;

#[CanonicalProduct]
#[DependencyOn(NswGlobal::All)]
enum NswAtoms implements ObjectListInterface, StreamWrapperAssetInterface {

  use NswListTrait;

  #[Definition(Atom\Button\Button::class)]
  case Button;

  #[Definition(Atom\Image\Image::class)]
  case Image;

  #[Definition(Atom\Media\Media::class)]
  case Media;

  #[Definition(Atom\ExternalVideo\ExternalVideo::class)]
  case Video;

}
