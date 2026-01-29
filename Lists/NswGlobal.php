<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Lists;

use Pinto\Attribute\Asset\Css;
use Pinto\CanonicalProduct\Attribute\CanonicalProduct;
use Pinto\List\ObjectListInterface;

#[CanonicalProduct]
enum NswGlobal implements ObjectListInterface {

  use NswListTrait;

  #[Css('base.css', preprocess: TRUE)]
  #[Css('icon.css', preprocess: TRUE)]
  #[Css('button.css', preprocess: TRUE)]
  #[Css('link.css', preprocess: TRUE)]
  #[Css('form.css', preprocess: TRUE)]
  #[Css('media.css', preprocess: TRUE)]
  case Global;

}
