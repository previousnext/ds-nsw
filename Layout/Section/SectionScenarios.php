<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Layout\Section;

use Drupal\Core\Render\Markup;
use Drupal\Core\Url;
use PreviousNext\Ds\Common\Atom;
use PreviousNext\Ds\Common\Layout;

final class SectionScenarios {

  final public static function sectionBackgrounds(): \Generator {
    $url = \Mockery::mock(Url::class);
    $url->expects('toString')->andReturn('http://example.com/');

    foreach (SectionBackground::cases() as $sectionBackground) {
      $instance = Layout\Section\Section::create(
        heading: 'Section title',
        as: Layout\Section\SectionType::Section,
      );
      $instance[] = Atom\Html\Html::create(Markup::create('<div>Section <strong>contents</strong></div>'));
      $instance->modifiers[] = $sectionBackground;
      yield $sectionBackground->name => $instance;
    }
  }

  /**
   * @phpstan-return \Generator<Section>
   */
  final public static function sectionLinkPosition(): \Generator {
    $url = \Mockery::mock(Url::class);
    $url->expects('toString')->andReturn('http://example.com/');

    foreach (LinkPosition::cases() as $linkPosition) {
      /** @var \PreviousNext\Ds\Nsw\Layout\Section\Section $instance */
      $instance = Layout\Section\Section::create(
        as: Layout\Section\SectionType::Section,
        heading: 'Section title',
        link: Atom\Link\Link::create('Section link', $url),
      );
      $instance[] = Atom\Html\Html::create(Markup::create('<div>Section <strong>contents</strong></div>'));
      $instance->modifiers[] = $linkPosition;
      yield $linkPosition->name => $instance;
    }
  }

}
