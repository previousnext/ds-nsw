<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\Filters;

use Drupal\Core\Template\Attribute;
use Pinto\Attribute\Asset;
use Pinto\Attribute\ObjectType;
use Pinto\Slots;
use PreviousNext\Ds\Common\Atom as CommonAtoms;
use PreviousNext\Ds\Common\Modifier;
use PreviousNext\Ds\Common\Utility as CommonUtility;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;
use Ramsey\Collection\AbstractCollection;
use Ramsey\Collection\Collection;
use Ramsey\Collection\CollectionInterface;

/**
 * @extends \Ramsey\Collection\AbstractCollection<FilterItem\FilterItem>
 */
#[Asset\Css('filters.css', preprocess: TRUE)]
#[Asset\Css('filters2.css', preprocess: TRUE)]
#[Asset\Js('filters.entry.js', preprocess: TRUE, attributes: ['type' => 'module'])]
#[Scenarios([FiltersScenarios::class])]
#[ObjectType\Slots(slots: [
  'action',
  'actions',
  'attributes',
  'collapsible',
  'counter',
  'direction',
  'instant',
  'items',
  'sticky',
  'title',
])]
class Filters extends AbstractCollection implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;
  use CommonUtility\ObjectTrait;

  /**
   * @phpstan-param string $actionUrl
   *   https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/form#action.
   * @phpstan-param \Ramsey\Collection\CollectionInterface<\PreviousNext\Ds\Common\Atom\Button\Button> $actions
   * @phpstan-param \PreviousNext\Ds\Common\Modifier\ModifierBag<FiltersModifierInterface> $modifiers
   */
  private function __construct(
    public string $actionUrl,
    public string $title,
    public ?bool $showCounter,
    public CollectionInterface $actions,
    public ?bool $isCollapsible,
    public ?bool $isInstant,
    public ?bool $isSticky,
    public Attribute $containerAttributes,
    public Modifier\ModifierBag $modifiers,
  ) {
    parent::__construct();
  }

  public function getType(): string {
    return '\\PreviousNext\\Ds\\Nsw\\Component\\Filters\\FilterItem\\FilterItem';
  }

  /**
   * @phpstan-param iterable<CommonAtoms\Button\Button> $actions
   */
  public static function create(
    string $actionUrl,
    string $title,
    ?bool $showCounter = NULL,
    iterable $actions = [],
    ?bool $isCollapsible = NULL,
    ?bool $isInstant = NULL,
    ?bool $isSticky = NULL,
  ): static {
    return static::factoryCreate(
      actionUrl: $actionUrl,
      title: $title,
      showCounter: $showCounter,
      actions: new Collection(CommonAtoms\Button\Button::class, \iterator_to_array($actions)),
      isCollapsible: $isCollapsible,
      isInstant: $isInstant,
      isSticky: $isSticky,
      containerAttributes: new Attribute(),
      modifiers: new Modifier\ModifierBag(FiltersModifierInterface::class),
    );
  }

  protected function build(Slots\Build $build): Slots\Build {
    return $build
      ->set('action', $this->actionUrl)
      ->set('actions', $this->actions->map(static fn (CommonAtoms\Button\Button $button): mixed => $button())->toArray())
      ->set('attributes', $this->containerAttributes)
      ->set('collapsible', $this->isCollapsible)
      ->set('counter', $this->showCounter)
      ->set('direction', (NULL !== ($directionModifier = $this->modifiers->getFirstInstanceOf(Direction::class))) ? $directionModifier->modifierName() : NULL)
      ->set('instant', $this->isInstant)
      ->set('items', $this->map(static fn (FilterItem\FilterItem $item): mixed => $item())->toArray())
      ->set('sticky', $this->isSticky)
      ->set('title', $this->title);
  }

  /**
   * @phpstan-param mixed $value
   */
  public function offsetSet(mixed $offset, mixed $value): void {
    if (!$value instanceof FilterItem\FilterItem) {
      $item = $value;
      // Wrap everything in a FilterItem:
      $value = FilterItem\FilterItem::create();
      $value[] = $item;
    }

    parent::offsetSet($offset, $value);
  }

}
