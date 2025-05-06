<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\HeroBanner;

use Pinto\Attribute\Asset;
use Pinto\Slots;
use PreviousNext\Ds\Common\Atom;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Nsw\Utility;

#[Asset\Css('hero-banner.css', preprocess: TRUE)]
#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
#[Slots\Attribute\ModifySlots(add: [
  // @todo add bool type after https://github.com/dpi/pinto/issues/39
  new Slots\Slot('links_title'),
])]
class HeroBanner extends CommonComponent\HeroBanner\HeroBanner implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    // @fixme workaround scoping bug with `_class_handler.twig`
    $this->containerAttributes['fixme'] = 'fixme';

    // Image wrapper needs a hero specific class.
    $this->image?->containerAttributes->addClass(['nsw-hero-banner__image']);

    // phpcs:disable Drupal.Commenting.InlineComment.SpacingBefore
    // phpcs:disable Drupal.Files.LineLength.TooLong
    // When the link is a link with label, add classes to the wrapper:
    // @todo FIX
    // if ($this->link instanceof Atom\Link\LinkWithLabel) {
    //   $this->link->aAttributes->addClass(['nsw-hero-banner__button']);
    //   match ($this->modifiers->getFirstInstanceOf(HeroBannerBackground::class)) {
    //     // Intentionally do not mix HeroBannerBackground::modifierName() in with
    //     // button classes.
    //     HeroBannerBackground::Dark => $this->link->aAttributes->addClass(['nsw-button--dark']),
    //     HeroBannerBackground::White => $this->link->aAttributes->addClass(['nsw-button--white']),
    //     default => NULL,
    //   };
    // }
    return $build
      ->set('title', $this->title)
      ->set('subtitle', $this->subtitle)
      ->set('link', $this->link)
      ->set('image', $this->image)
      ->set('links_title', TRUE)
      ->set('links', \array_map(fn (Atom\Link\Link $link) => ($this->link)(), $this->links?->toArray() ?? []))
      ->set('modifiers', $this->modifiers->getInstancesOf(HeroBannerBackground::class)->map(
        static fn (HeroBannerBackground $modifier): string => $modifier->modifierName(),
      )->toArray())
      ->set('containerAttributes', $this->containerAttributes);
  }

}
