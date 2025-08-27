<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Atom\Icon;

use PreviousNext\Ds\Common\Atom\Icon\IconModifierInterface;
use PreviousNext\Ds\Common\Modifier\Mutex;

#[Mutex]
enum IconSize implements IconModifierInterface {

  case Small;
  case Medium;
  case Large;
  case ExtraLarge;

  public function modifierName(): string {
    return match ($this) {
      static::Small => 'sm',
      static::Medium => 'md',
      static::Large => 'lg',
      static::ExtraLarge => 'xl',
    };
  }

}
