<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Lists;

use Pinto\Attribute\Definition;
use Pinto\Attribute\DependencyOn;
use Pinto\CanonicalProduct\Attribute\CanonicalProduct;
use Pinto\List\ObjectListInterface;
use PreviousNext\Ds\Nsw\Atom;

#[CanonicalProduct]
#[DependencyOn(NswGlobal::Global)]
enum NswAtoms implements ObjectListInterface {

  use NswListTrait;

  #[Definition(Atom\Button\Button::class)]
  case Button;

  #[Definition(Atom\Heading\Heading::class)]
  case Heading;

  #[Definition(Atom\Icon\Icon::class)]
  case Icon;

  #[Definition(Atom\Image\Image::class)]
  case Image;

  #[Definition(Atom\Link\Link::class)]
  #[DependencyOn(self::Icon)]
  case Link;

  #[Definition(Atom\LinkedImage\LinkedImage::class)]
  case LinkedImage;

  #[Definition(Atom\Media\Media::class)]
  case Media;

  #[Definition(Atom\ExternalVideo\ExternalVideo::class)]
  case Video;

}
