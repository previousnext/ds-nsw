<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\Card;

use Drupal\Core\Render\Markup;
use Drupal\Core\Url;
use PreviousNext\Ds\Common\Atom as CommonAtom;
use PreviousNext\Ds\Common\Atom\Icon\Icon;
use PreviousNext\Ds\Common\Atom\Link\Link;
use PreviousNext\Ds\Common\Component as CommonComponent;

final class CardScenarios {

  public static function card(): Card {
    $url = \Mockery::mock(Url::class);
    $url->expects('toString')->andReturn('http://example.com/');

    /** @var Card $instance */
    $instance = CommonComponent\Card\Card::create(
      image: $image = CommonComponent\Media\Image\Image::createSample(300, 400),
      links: CommonComponent\LinkList\LinkList::create([
        CommonAtom\Link\Link::create(title: '', url: $url),
      ]),
      date: new \DateTimeImmutable('1st January 2001'),
      link: CommonAtom\Link\Link::create('Card Link!', $url),
      // @todo replace with real modifiers
      modifiers: [CommonComponent\Card\CommonCardModifiers::Modifier1],
    );

    $image->imageAttributes['test'] = 'image-attr';
    $image->containerAttributes['test'] = 'container-attr';

    return $instance;
  }

  public static function cardPlus(): Card {
    $url = \Mockery::mock(Url::class);
    $url->expects('toString')->andReturn('http://example.com/');

    /** @var Card $instance */
    $instance = CommonComponent\Card\Card::create(
      image: CommonComponent\Media\Image\Image::createSample(300, 400),
      links: CommonComponent\LinkList\LinkList::create([
        Link::create(title: '', url: $url),
      ]),
      date: new \DateTimeImmutable('1st January 2001'),
      icon: Icon::create(icon: 'Foo'),
      tags: new CommonAtom\Tag\Tags([
        CommonAtom\Tag\Tag::create('Foo'),
        CommonAtom\Tag\Tag::create('Foo'),
        CommonAtom\Tag\Tag::create('Foo'),
      ]),
      heading: CommonAtom\Heading\Heading::create('A Heading!!!'),
      content: CommonAtom\Html\Html::create(Markup::create('<strong>Hello</strong> World!')),
      link: CommonAtom\Link\Link::create(title: '', url: $url),
    // ?iterable $modifiers
    );

    return $instance;
  }

}
