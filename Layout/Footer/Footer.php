<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Layout\Footer;

use Pinto\Attribute\Asset\Css;
use Pinto\Slots;
use PreviousNext\Ds\Common\Component as CommonComponents;
use PreviousNext\Ds\Common\Layout as CommonLayouts;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Css('footer.css', preprocess: TRUE)]
#[Scenarios([CommonLayouts\Footer\FooterScenarios::class])]
#[Slots\Attribute\ModifySlots(add: [
  'background',
])]
#[Slots\Attribute\RenameSlot(original: 'description', new: 'aoc')]
#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
class Footer extends CommonLayouts\Footer\Footer implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    $navigation = CommonComponents\Navigation\Navigation::create('id', 'Navigation');
    foreach ($this->menu as $menu) {
      $navigation[] = $menu;
    }

    $logos = \iterator_to_array($this->logos);

    return parent::build($build)
      ->set('navigation', $navigation)
      ->set('background', ($this->modifiers->getFirstInstanceOf(FooterBackground::class) ?? FooterBackground::Dark)->background())
      ->set('containerAttributes', $this->containerAttributes)
      ->set('logo', \array_shift($logos))
      ->set('socials', $this->socialLinks)
      ->set('modifiers', $this->modifiers)
      ->set('description', $this->description)
      ->set('copyright', $this->copyright);
  }

}
