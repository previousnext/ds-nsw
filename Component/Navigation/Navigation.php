<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\Navigation;

use Pinto\Attribute\Asset;
use Pinto\Slots;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Asset\Css('navigation.css', preprocess: TRUE)]
#[Asset\Css('main-nav.css', preprocess: TRUE)]
#[Slots\Attribute\RenameSlot(original: 'menuTrees', new: 'items')]
#[Scenarios([CommonComponent\Navigation\NavigationScenarios::class])]
#[Slots\Attribute\ModifySlots(add: [
  // Cant use 'type' directly as Drupal uses #type, which causes our object to be both a theme and a type. The '#type' is nulled then set in a preprocessor.
  'type',
  '__twigTypeVar',
])]
class Navigation extends CommonComponent\Navigation\Navigation implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  public NavigationType $navigationType;

  protected function build(Slots\Build $build): Slots\Build {
    // Mega nav doesn't seem to be working. Is this due to 'enty' typo?
    return parent::build($build)
      // Cant pass this as '#type' is reserved in Drupal.
      ->set('type', NULL)
      ->set('__twigTypeVar', ($this->navigationType ?? NavigationType::Default)->typeName());
  }

}
