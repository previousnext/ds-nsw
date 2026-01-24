<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\HeroSearch;

use Drupal\Core\Url;
use PreviousNext\Ds\Common\Atom;
use PreviousNext\Ds\Common\Component as CommonComponents;
use PreviousNext\Ds\Common\Component\HeroSearch\HeroSearch;

class HeroSearchScenarios {

  final public static function nswHeroSearchWithLinkAndImage(): HeroSearch {
    $url = \Mockery::mock(Url::class);
    $url->expects('toString')->andReturn('http://example.com/');

    return HeroSearch::create(
      title: 'Hero Link List Title!',
      subtitle: 'Hero Link List Subtitle!',
      image: CommonComponents\Media\Image\Image::createSample(600, 200),
      links: CommonComponents\LinkList\LinkList::create([
        Atom\Link\Link::create(title: 'A link', url: $url),
        Atom\Link\Link::create('Front page!', $url),
        Atom\Link\Link::create('Hero Link List item 2!', $url),
      ]),
      search: CommonComponents\SearchForm\SearchForm::create(actionUrl: 'https://example.com/search'),
    );
  }

}
