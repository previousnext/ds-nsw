<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Atom\Button;

use Drupal\Core\Template\Attribute;
use Pinto\Attribute\Asset\Css;
use Pinto\Slots;
use PreviousNext\Ds\Common\Atom as CommonAtom;
use PreviousNext\Ds\Common\Atom\Button\ButtonType;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Css('button.css', preprocess: TRUE)]
#[Scenarios([CommonAtom\Button\ButtonScenarios::class])]
#[Css('button.css')]
#[Slots\Attribute\ModifySlots(add: [
  'attributes',
])]
class Button extends CommonAtom\Button\Button implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  public Attribute $containerAttributes;

  protected function build(Slots\Build $build): Slots\Build {
    {
    $as = \strtolower(match ($this->as) {
      // Define all cases so we are notified by PHPStan if a new one is added
      // upstream.
      ButtonType::Button, ButtonType::Input, ButtonType::Link, ButtonType::Submit => $this->as->name,
    });

    if (NULL !== ($buttonStyle = $this->modifiers->getFirstInstanceOf(CommonAtom\Button\ButtonStyle::class))) {
      $this->containerAttributes->addClass('nsw-button--' . match ($buttonStyle) {
        // Suffixes for 'nsw-button--' in button.html.twig.
        CommonAtom\Button\ButtonStyle::Dark => 'dark',
        CommonAtom\Button\ButtonStyle::Destructive => 'danger',
        CommonAtom\Button\ButtonStyle::Light => 'light',
        CommonAtom\Button\ButtonStyle::Outline => 'dark-outline',
        CommonAtom\Button\ButtonStyle::White => 'white',
      });
    }

    if (NULL !== ($buttonLayout = $this->modifiers->getFirstInstanceOf(CommonAtom\Button\ButtonLayout::class))) {
      $this->containerAttributes->addClass('nsw-button--' . match ($buttonLayout) {
        // Suffixes for 'mx-button--' in button.twig.
        // @todo This doesnt seem to be working or present on https://designsystem.nsw.gov.au/components/button/index.html ?
        CommonAtom\Button\ButtonLayout::FullWidth => 'full-width',
      });
    }

    return parent::build($build)
      // NSW's _class_handler.twig mishandles enums.
      ->set('attributes', $this->containerAttributes)
      ->set('modifiers', [])
      ->set('title', $this->title)
      ->set('href', $this->href)
      ->set('as', $as);
    }
  }

  /**
   * @phpstan-param mixed ...$args
   */
  protected static function constructInstance(...$args): static {
    $instance = parent::constructInstance(...$args);

    $instance->containerAttributes = new Attribute();

    return $instance;
  }

}
