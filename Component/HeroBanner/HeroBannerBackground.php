<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\HeroBanner;

use PreviousNext\Ds\Common\Component\HeroBanner\HeroBannerModifierInterface;
use PreviousNext\Ds\Common\Modifier\Mutex;

#[Mutex]
enum HeroBannerBackground implements HeroBannerModifierInterface {
  case Dark;
  case White;

  public function modifierName(): string {
    return match ($this) {
      static::Dark => 'dark',
            static::White => 'white',
    };
  }

}
