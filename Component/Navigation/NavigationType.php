<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\Navigation;

use PreviousNext\Ds\Common\Modifier\Mutex;

#[Mutex]
enum NavigationType {

  case Default;
  case Mega;

  public function typeName(): string {
    return match ($this) {
      // 'Default' value is never used.
      static::Default => '__defaultUnusedValue',
      static::Mega => 'mega',
    };
  }

}
