<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\Steps;

use PreviousNext\Ds\Common\Component\Steps\StepsModifierInterface;
use PreviousNext\Ds\Common\Modifier\Mutex;

#[Mutex]
enum StepsBackground implements StepsModifierInterface {

  case Accent;
  case Dark;
  case Light;
  case Supplementary;

  /**
   * Suffix for `nsw-steps--`.
   */
  public function modifierName(): string {
    return match ($this) {
      static::Accent => 'accent',
      static::Dark => 'dark',
      static::Light => 'light',
      static::Supplementary => 'supplementary',
    };
  }

}
