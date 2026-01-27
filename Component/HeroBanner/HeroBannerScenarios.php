<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\HeroBanner;

use Drupal\Core\Url;
use PreviousNext\Ds\Common\Atom as CommonAtom;
use PreviousNext\Ds\Common\Atom\Button\ButtonType;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\IdsTools\Scenario\Scenario;

final class HeroBannerScenarios {

  #[Scenario(viewPortWidth: 1000)]
  final public static function nswHeroBanner(): HeroBanner {
    /** @var HeroBanner $instance */
    $instance = CommonComponent\HeroBanner\HeroBanner::create(
      'Title!',
      'Subtitle!',
      image: CommonComponent\Media\Image\Image::createSample(600, 200),
    );
    $instance->modifiers[] = HeroBannerBackground::Dark;
    return $instance;
  }

  final public static function nswHeroBannerLinkList(): HeroBanner {
    $url = \Mockery::mock(Url::class);
    $url->expects('toString')->andReturn('http://example.com/');

    /** @var HeroBanner $instance */
    $instance = CommonComponent\HeroBanner\HeroBanner::create(
      'Hero Link List Title!',
      'Hero Link List Subtitle!',
      link: CommonAtom\Button\Button::create('Hero Banner Link!', href: $url->toString(), as: ButtonType::Link),
      links: CommonComponent\LinkList\LinkList::create(
        links: [
          CommonAtom\Link\Link::create('Front page!', $url),
          CommonAtom\Link\Link::create('Hero Link List item 2!', $url),
        ],
        title: CommonAtom\Heading\Heading::create('Popular links', CommonAtom\Heading\HeadingLevel::Six),
      ),
    );
    $instance->modifiers[] = HeroBannerBackground::Dark;
    return $instance;
  }

  /**
   * @phpstan-return \Generator<HeroBanner>
   */
  final public static function nswHeroBannerBackground(): \Generator {
    foreach (HeroBannerBackground::cases() as $background) {
      /** @var HeroBanner $instance */
      $instance = CommonComponent\HeroBanner\HeroBanner::create(
        title: 'Title!',
        // Button added since button classes vary by the banner background.
        link: CommonAtom\Button\Button::create('Hero Banner Link!', as: ButtonType::Link, href: '#'),
      );
      $instance->modifiers[] = $background;
      yield $background->name => $instance;
    }
  }

}
