<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Lists;

use Pinto\Attribute\Definition;
use Pinto\Attribute\DependencyOn;
use Pinto\CanonicalProduct\Attribute\CanonicalProduct;
use Pinto\List\ObjectListInterface;
use PreviousNext\Ds\Common\Utility\TemplateDirectory;
use PreviousNext\Ds\Nsw\Component;

#[CanonicalProduct]
#[DependencyOn(NswGlobal::All)]
enum NswComponents implements ObjectListInterface {

  use NswListTrait {
    NswListTrait::dsDirectory as public originalDsDirectory;
  }

  #[Definition(Component\Accordion\Accordion::class)]
  case Accordion;

  #[Definition(Component\Accordion\AccordionItem\AccordionItem::class)]
  case AccordionItem;

  #[Definition(Component\Breadcrumb\Breadcrumb::class)]
  case Breadcrumb;

  #[Definition(Component\Callout\Callout::class)]
  case Callout;

  #[Definition(Component\Card\Card::class)]
  case Card;

  #[Definition(Component\Filters\Filters::class)]
  case Filters;

  #[Definition(Component\Filters\FilterItem\FilterItem::class)]
  case FilterItem;

  #[Definition(Component\HeroBanner\HeroBanner::class)]
  case HeroBanner;

  #[Definition(Component\LinkList\LinkList::class)]
  case LinkList;

  #[Definition(Component\ListItem\ListItem::class)]
  #[TemplateDirectory('Component/ListItem')]
  #[DependencyOn(NswLayouts::Section)]
  case ListItem;

  #[Definition(Component\Navigation\Navigation::class)]
  case Navigation;

  #[Definition(Component\Pagination\Pagination::class)]
  case Pagination;

  #[Definition(Component\Pagination\PaginationItem\PaginationItem::class)]
  case PaginationItem;

  #[Definition(Component\SocialLinks\SocialLinks::class)]
  case SocialLinks;

  #[Definition(Component\Tabs\Tabs::class)]
  case Tabs;

  #[Definition(Component\Tags\Tags::class)]
  case Tag;

  #[Definition(Component\Tabs\TabListItem\TabListItem::class)]
  case TabListItem;

  #[Definition(Component\Tabs\TabsItem\TabsItem::class)]
  case TabItem;

  private function dsDirectory(): string {
    if ($this === NswComponents::Tag) {
      return 'Component/Tag';
    }

    return $this->originalDsDirectory();
  }

}
