<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\Filters;

use PreviousNext\Ds\Common\Modifier\Mutex;

#[Mutex]
enum Direction implements FiltersModifierInterface {

  case Right;
  case Down;

  public function modifierName(): string {
    return match ($this) {
      static::Right => 'right',
      static::Down => 'down',
    };
  }

}
