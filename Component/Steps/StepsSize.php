<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\Steps;

use PreviousNext\Ds\Common\Component\Steps\StepsModifierInterface;
use PreviousNext\Ds\Common\Modifier\Mutex;

#[Mutex]
enum StepsSize implements StepsModifierInterface {

  case Small;
  case Medium;
  case Large;

  /**
   * Suffix for `nsw-steps--`.
   */
  public function modifierName(): string {
    return match ($this) {
      static::Small => 'small',
      static::Medium => 'medium',
      static::Large => 'large',
    };
  }

}
