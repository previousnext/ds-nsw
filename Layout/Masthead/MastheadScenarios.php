<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Layout\Masthead;

use Drupal\Core\Render\Markup;
use Drupal\Core\Url;
use PreviousNext\Ds\Common\Atom;
use PreviousNext\Ds\Common\Component\LinkList\LinkList;
use PreviousNext\Ds\Common\Layout as CommonLayouts;

final class MastheadScenarios {

  /**
   * @phpstan-return \Generator<\PreviousNext\Ds\Common\Layout\Masthead\Masthead>
   */
  final public static function masthead(): \Generator {
    $url = \Mockery::mock(Url::class);

    $url->expects('toString')->andReturn('#');
    $skipLinks = LinkList::create([]);
    $skipLinks[] = Atom\Link\Link::create(title: 'Skip to navigation', url: $url);
    $skipLinks[] = Atom\Link\Link::create('Skip to content', $url);

    $url->expects('toString')->andReturn('https://example.com');
    $links = LinkList::create([]);
    $links[] = Atom\Link\Link::create(title: 'First link', url: $url);
    $links[] = Atom\Link\Link::create('Second link', $url);

    $instance = CommonLayouts\Masthead\Masthead::create(
      Atom\Html\Html::create(Markup::create(<<<MARKUP
        Welcome to the <strong>Jungle</strong> 🎸
        MARKUP)),
      $links,
      $skipLinks,
    );
    $instance->containerAttributes['foo'] = 'bar';
    $instance->containerAttributes['class'][] = 'hello';

    foreach (MastheadBackground::cases() as $background) {
      $i = clone $instance;
      $i->modifiers[] = $background;
      yield \sprintf('nsw-skip--%s', $background->name) => $i;
    }
    return $instance;
  }

}
