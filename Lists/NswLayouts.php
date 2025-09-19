<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Lists;

use Pinto\Attribute\Definition;
use Pinto\Attribute\DependencyOn;
use Pinto\CanonicalProduct\Attribute\CanonicalProduct;
use Pinto\List\ObjectListInterface;
use PreviousNext\Ds\Nsw\Layout;

#[CanonicalProduct]
#[DependencyOn(NswGlobal::All)]
enum NswLayouts implements ObjectListInterface {

  use NswListTrait;

  #[Definition(Layout\Footer\Footer::class)]
  case Footer;

  #[Definition(Layout\Grid\Grid::class)]
  case Grid;

  #[Definition(Layout\Grid\GridItem\GridItem::class)]
  case GridItem;

  #[Definition(Layout\Section\Section::class)]
  case Section;

  #[Definition(Layout\Sidebar\Sidebar::class)]
  case Sidebar;

  #[Definition(Layout\Masthead\Masthead::class)]
  case Masthead;

}
