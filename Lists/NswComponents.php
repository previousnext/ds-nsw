<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Lists;

use Pinto\Attribute\Definition;
use Pinto\Attribute\DependencyOn;
use Pinto\CanonicalProduct\Attribute\CanonicalProduct;
use Pinto\List\ObjectListInterface;
use PreviousNext\Ds\Nsw\Component;

#[CanonicalProduct]
#[DependencyOn(NswGlobal::All)]
enum NswComponents implements ObjectListInterface {

  use NswListTrait;

  #[Definition(Component\Accordion\Accordion::class)]
  case Accordion;

  #[Definition(Component\Accordion\AccordionItem\AccordionItem::class)]
  case AccordionItem;

  #[Definition(Component\Card\Card::class)]
  case Card;

  #[Definition(Component\HeroBanner\HeroBanner::class)]
  case HeroBanner;

}
