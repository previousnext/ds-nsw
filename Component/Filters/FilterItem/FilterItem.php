<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\Filters\FilterItem;

use Drupal\Core\Template\Attribute;
use Pinto\Attribute\ObjectType;
use Pinto\Slots;
use PreviousNext\Ds\Common\Utility as CommonUtility;
use PreviousNext\Ds\Nsw\Utility;
use Ramsey\Collection\AbstractCollection;

/**
 * @extends \Ramsey\Collection\AbstractCollection<mixed>
 */
#[ObjectType\Slots(slots: [
  'fields',
  'shownItems',
  'collapsible',
])]
class FilterItem extends AbstractCollection implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;
  use CommonUtility\ObjectTrait;

  private function __construct(
    public ?string $title,
    public ?bool $isCollapsible,
    protected mixed $collapseAfter,
    public Attribute $containerAttributes,
  ) {
    parent::__construct();
  }

  public function getType(): string {
    return 'mixed';
  }

  public static function create(
    ?string $title = NULL,
    ?bool $isCollapsible = NULL,
  ): static {
    return static::factoryCreate(
      title: $title,
      isCollapsible: $isCollapsible,
      collapseAfter: NULL,
      containerAttributes: new Attribute(),
    );
  }

  /**
   * @phpstan-return $this
   */
  public function collapseAfter(mixed $item): static {
    foreach ($this as $i) {
      if ($i === $item) {
        $this->collapseAfter = \is_object($item) ? \WeakReference::create($item) : $item;

        break;
      }
    }

    return $this;
  }

  protected function build(Slots\Build $build): Slots\Build {
    $content = $this->map(static function (mixed $item): mixed {
      return \is_callable($item) ? ($item)() : $item;
    })->toArray();

    $collapseAfterNthItem = NULL;
    if ($this->collapseAfter !== NULL) {
      $collapseAfter = $this->collapseAfter instanceof \WeakReference ? $this->collapseAfter->get() : $this->collapseAfter;
      $n = 0;
      foreach ($this as $i) {
        $n++;
        if ($i === $collapseAfter) {
          $collapseAfterNthItem = $n;
          break;
        }
      }
    }

    return $build
      ->set('collapsible', $this->isCollapsible === TRUE ? ['title' => $this->title] : NULL)
      ->set('shownItems', $collapseAfterNthItem)
      ->set('fields', $content);
  }

}
