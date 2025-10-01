<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\Filters;

use Drupal\Core\Render\Markup;
use PreviousNext\Ds\Common;
use PreviousNext\Ds\Common\Atom\Button\ButtonStyle;
use PreviousNext\Ds\Nsw\Component\Filters\FilterItem\FilterItem;
use PreviousNext\IdsTools\Scenario\Scenario;

final class FiltersScenarios {

  final public static function filters(): Filters {
    /** @var Filters $instance */
    $instance = Filters::create(
      actionUrl: 'http://example.com/test',
      title: 'Hello world',
      showCounter: TRUE,
      actions: [
        $submit = Common\Atom\Button\Button::create(
          title: 'Submit!',
          as: Common\Atom\Button\ButtonType::Input,
        ),
        $reset = Common\Atom\Button\Button::create(
          title: 'Reset!',
          as: Common\Atom\Button\ButtonType::Reset,
        ),
      ],
    );

    $submit->modifiers[] = ButtonStyle::Dark;
    $reset->modifiers[] = ButtonStyle::Destructive;

    $instance->containerAttributes['hello'] = 'world';
    $instance->containerAttributes['class'][] = 'foo';
    $instance->containerAttributes['name'] = 'world';

    $instance[] = Common\Atom\Html\Html::create(Markup::create('<strong>Item</strong> One!'));
    $instance[] = $filterItem = Common\Atom\Html\Html::create(Markup::create('<strong>Item</strong> Two!'));

    // Add something that is *resettable* by the reset button.
    $filterItem[] = Common\Atom\Html\Html::create(Markup::create('<input type="text" />'));

    $instance[] = $filterItem = FilterItem::create(title: 'Foo bar');
    $filterItem->title = 'Item three group';
    $filterItem->isCollapsible = TRUE;
    $filterItem[] = Common\Atom\Html\Html::create(Markup::create('<strong>Item</strong> Three!'));
    $filterItem[] = Common\Atom\Html\Html::create(Markup::create('<strong>Item</strong> Four!'));
    $filterItem[] = Common\Atom\Html\Html::create(Markup::create('<strong>Item</strong> Five!'));

    return $instance;
  }

  final public static function shownItems(): Filters {
    /** @var Filters $instance */
    $instance = Filters::create(
      actionUrl: 'http://example.com/test',
      title: 'Hello world',
    );

    $instance[] = $filterItem = FilterItem::create(title: 'Foo bar');
    $filterItem->title = 'Item three group';
    $filterItem[] = Common\Atom\Html\Html::create(Markup::create('<strong>Item</strong> One!'));
    $filterItem[] = $item2 = Common\Atom\Html\Html::create(Markup::create('<strong>Item</strong> Two!'));
    $filterItem[] = Common\Atom\Html\Html::create(Markup::create('<strong>Item</strong> Three!'));

    $filterItem->collapseAfter($item2);

    return $instance;
  }

  /**
   * When `collapsible=true` filters are replaced by a button on small viewports (default: <=992px) which:
   * - Direction=right: slide out pane from the right side.
   * - Direction=down: shows the items in normal layout, but not visible on load.
   *
   * @phpstan-return \Generator<Filters>
   */
  #[Scenario(viewPortHeight: 800, viewPortWidth: 800)]
  final public static function directions(): \Generator {
    foreach (Direction::cases() as $direction) {
      /** @var Filters $instance */
      $instance = Filters::create(
        actionUrl: 'http://example.com/test',
        title: 'Hello world',
        isCollapsible: TRUE,
      );

      $instance->modifiers[] = $direction;

      $instance[] = Common\Atom\Html\Html::create(Markup::create('<strong>Item</strong> One!'));
      $instance[] = Common\Atom\Html\Html::create(Markup::create('<strong>Item</strong> Two!'));
      $instance[] = $filterItem = FilterItem::create(title: 'Foo bar');
      // @fixme Something strange happens which makes the label invisible on small viewports.
      $filterItem->title = 'Item three group';
      $filterItem->isCollapsible = TRUE;
      $filterItem[] = Common\Atom\Html\Html::create(Markup::create('<strong>Item</strong> Three!'));
      yield \sprintf('direction-%s', $direction->modifierName()) => $instance;
    }
  }

}
