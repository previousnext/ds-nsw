<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Layout\Header;

use Pinto\Attribute\Asset\Css;
use Pinto\Slots;
use PreviousNext\Ds\Common\Atom as CommonAtoms;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Common\Layout as CommonLayouts;
use PreviousNext\Ds\Common\Layout\Header\HeaderSlots;
use PreviousNext\Ds\Nsw\Component\Navigation\NavigationType;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Css('header.css', preprocess: TRUE)]
#[Scenarios([
  HeaderScenarios::class,
])]
#[Slots\Attribute\ModifySlots(add: [
  new Slots\Slot('attributes'),
])]
class Header extends CommonLayouts\Header\Header implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  public NavigationType $navigationType;

  protected function build(Slots\Build $build): Slots\Build {
    /** @var \PreviousNext\Ds\Nsw\Component\Navigation\Navigation $navigation */
    $navigation = CommonComponent\Navigation\Navigation::create('id', 'Navigation');
    $navigation->navigationType = $this->navigationType ?? NavigationType::Default;
    foreach ($this->menu as $menu) {
      $navigation[] = $menu;
    }

    return $build
      ->set('attributes', $this->containerAttributes)
      ->set(HeaderSlots::logo, [($this->logo)()])
      ->set(HeaderSlots::title, $this->title)
      ->set(HeaderSlots::description, $this->description)
      ->set(HeaderSlots::search, $this->hasSearch ? CommonComponent\SearchForm\SearchForm::create('/search-for-common') : NULL)
      ->set(HeaderSlots::navigation, $navigation)
      ->set(HeaderSlots::controls, $this->controls->count() > 0 ? CommonAtoms\Html\Html::createFromCollection($this->controls->map(static fn (CommonAtoms\Button\Button $button): mixed => $button())->toArray()) : NULL);
  }

}
