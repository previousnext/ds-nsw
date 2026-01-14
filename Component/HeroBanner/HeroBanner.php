<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\HeroBanner;

use Pinto\Attribute\Asset;
use Pinto\Slots;
use PreviousNext\Ds\Common\Atom as CommonAtom;
use PreviousNext\Ds\Common\Atom\Html\Html;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Asset\Css('hero-banner.css', preprocess: TRUE)]
#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
#[Slots\Attribute\ModifySlots(add: [
  // @todo add bool type after https://github.com/dpi/pinto/issues/39
  new Slots\Slot('links_title'),
])]
#[Scenarios([
  CommonComponent\HeroBanner\HeroBannerScenarios::class,
  HeroBannerScenarios::class,
])]
class HeroBanner extends CommonComponent\HeroBanner\HeroBanner implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    // @fixme workaround scoping bug with `_class_handler.twig`
    $this->containerAttributes['fixme'] = 'fixme';

    // Image wrapper needs a hero specific class.
    $this->image?->containerAttributes->addClass(['nsw-hero-banner__image']);

    $modifiers = [];
    foreach ($this->modifiers->getInstancesOf(HeroBannerBackground::class) as $background) {
      $modifiers[] = $background->modifierName();
    }

    // When link is a button, automatically add background modifiers depending on the main banner background.
    if ($this->link instanceof CommonAtom\Button\Button) {
      $this->link->containerAttributes->addClass(['nsw-hero-banner__button']);

      // Don't override ButtonStyle if one already exists.
      if (FALSE === $this->link->modifiers->hasInstanceOf(CommonAtom\Button\ButtonStyle::class)) {
        match ($this->modifiers->getFirstInstanceOf(HeroBannerBackground::class)) {
          // Intentionally do not mix HeroBannerBackground::modifierName() in with
          // button classes.
          HeroBannerBackground::Dark => $this->link->modifiers->add(CommonAtom\Button\ButtonStyle::White),
          HeroBannerBackground::White, HeroBannerBackground::Light, HeroBannerBackground::OffWhite => $this->link->modifiers->add(CommonAtom\Button\ButtonStyle::Dark),
          default => NULL,
        };
      }
    }

    return $build
      ->set('title', $this->title)
      ->set('content', Html::createFromCollection($this))
      ->set('subtitle', $this->subtitle)
      ->set('link', $this->link)
      ->set('image', $this->image)
      ->set('links_title', TRUE)
      ->set('highlight', $this->highlight)
      ->set('links', \array_map(static fn (CommonAtom\Link\Link $link) => ($link)(), $this->links?->toArray() ?? []))
      ->set('modifiers', $modifiers)
      ->set('containerAttributes', $this->containerAttributes);
  }

}
