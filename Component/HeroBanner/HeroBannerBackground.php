<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\HeroBanner;

use PreviousNext\Ds\Common\Component\HeroBanner\HeroBannerModifierInterface;
use PreviousNext\Ds\Common\Modifier\Mutex;

#[Mutex]
enum HeroBannerBackground implements HeroBannerModifierInterface {

  case Dark;
  case Light;
  case White;
  case OffWhite;

  /**
   * Suffix for `nsw-hero-banner--`.
   */
  public function modifierName(): string {
    return match ($this) {
      static::Dark => 'dark',
      static::Light => 'light',
      static::White => 'white',
      static::OffWhite => 'off-white',
    };
  }

}
