<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\HeroBanner;

use Drupal\Core\Url;
use PreviousNext\Ds\Common\Atom as CommonAtom;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\IdsTools\Scenario\Scenario;

final class HeroBannerScenarios {

  #[Scenario(viewPortWidth: 1000)]
  final public static function nswHeroBanner(): HeroBanner {
    $url = \Mockery::mock(Url::class);
    $url->expects('toString')->andReturn('http://example.com/');

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
      link: CommonAtom\Link\Link::create('Hero Banner Link!', $url),
      links: CommonComponent\LinkList\LinkList::create([
        CommonAtom\Link\Link::create(title: '', url: $url),
        CommonAtom\Link\Link::create('Front page!', $url),
        CommonAtom\Link\Link::create('Hero Link List item 2!', $url),
      ]),
    );
    $instance->modifiers[] = HeroBannerBackground::Dark;
    return $instance;
  }

}
