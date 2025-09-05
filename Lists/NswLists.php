<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Lists;

final class NswLists {

  /**
   * @var array<class-string<\Pinto\List\ObjectListInterface>>
   */
  public const Lists = [
    NswAtoms::class,
    NswComponents::class,
    NswGlobal::class,
    NswLayouts::class,
  ];

}
