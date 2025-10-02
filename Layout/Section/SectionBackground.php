<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Layout\Section;

use PreviousNext\Ds\Common\Layout\Section\SectionModifierInterface;
use PreviousNext\Ds\Common\Modifier\Mutex;

#[Mutex]
enum SectionBackground implements SectionModifierInterface {

  case BrandDark;
  case BrandLight;
  case BrandSupplementary;
  case Black;
  case White;
  case OffWhite;
  case Grey01;
  case Grey02;
  case Grey03;
  case Grey04;

  /**
   * Suffix for `nsw-section--`.
   *
   * See section.twig.
   */
  public function modifierName(): string {
    return match ($this) {
      static::BrandDark => 'brand-dark',
      static::BrandLight => 'brand-light',
      static::BrandSupplementary => 'brand-supplementary',
      static::Black => 'black',
      static::White => 'white',
      static::OffWhite => 'off-white',
      static::Grey01 => 'grey-01',
      static::Grey02 => 'grey-02',
      static::Grey03 => 'grey-03',
      static::Grey04 => 'grey-04',
    };
  }

}
