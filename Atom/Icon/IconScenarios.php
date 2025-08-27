<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Atom\Icon;

use PreviousNext\Ds\Common\Atom as CommonAtoms;

final class IconScenarios {

  final public static function nswIcon(): Icon {
    // 'favorite' is a heart icon.
    /** @var Icon */
    return CommonAtoms\Icon\Icon::create(icon: 'favorite');
  }

  /**
   * @phpstan-return \Generator<\PreviousNext\Ds\Nsw\Atom\Icon\Icon>
   */
  final public static function sizes(): \Generator {
    foreach (IconSize::cases() as $size) {
      /** @var \PreviousNext\Ds\Nsw\Atom\Icon\Icon $instance */
      $instance = CommonAtoms\Icon\Icon::create(icon: 'rocket');
      $instance->modifiers[] = $size;
      yield \sprintf('nsw-icon-size-%s', $size->name) => $instance;
    }
  }

}
