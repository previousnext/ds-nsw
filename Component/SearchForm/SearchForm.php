<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\SearchForm;

use Pinto\Slots;
use PreviousNext\Ds\Common\Atom as CommonAtoms;
use PreviousNext\Ds\Common\Atom\Button\ButtonType;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;
use Twig\Markup;

#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
#[Slots\Attribute\RenameSlot(original: 'actionUrl', new: 'action')]
#[Scenarios([CommonComponent\SearchForm\SearchFormScenarios::class])]
class SearchForm extends CommonComponent\SearchForm\SearchForm implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    $icon = CommonAtoms\Icon\Icon::create('search');
    $icon->containerAttributes['class'][] = 'nsw-material-icons';

    $button = CommonAtoms\Button\Button::create(
      'Search',
      ButtonType::Submit,
      iconOnly: TRUE,
      iconStart: $icon,
    );
    $button->modifiers[] = CommonAtoms\Button\ButtonStyle::Dark;

    $build = $build
      ->set('input', 'Foo')
      ->set('button', $button)
      ->set('containerAttributes', $this->containerAttributes)
      ->set('actionUrl', $this->actionUrl)
      ->set('input', new Markup(<<<HTML
        <input class="nsw-form__input"
          id="search-keyword"
          name="{$this->name}"
          type="text"
          autocomplete="off"
          aria-label="Search by keywords"
          placeholder="Keywords..."
        />
        HTML, 'utf8'));
    return $build;
  }

}
