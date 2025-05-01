<?php

declare(strict_types = 1);

namespace PreviousNext\Ds\Nsw\Component\Card;

use Pinto\Attribute\Asset;
use Pinto\Slots;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\Ds\Common\Atom\Link\LinkWithLabel;
use PreviousNext\Ds\Common\Component as CommonComponent;

#[Slots\Attribute\RenameSlot(original: 'heading', new: 'title')]
#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
#[Asset\Css('card.css', preprocess: true)]
class Card extends CommonComponent\Card\Card implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    // @fixme workaround scoping bug with `_class_handler.twig`
    $this->containerAttributes['fixme'] = 'fixme';

    return parent::build($build)
      ->set('modifiers', [])
      ->set('image', $this->image)
      ->set('links', $this->links)
      ->set('heading', $this->heading?->heading)
      ->set('content', $this->content?->markup)
      ->set('link', $this->link instanceof LinkWithLabel ? $this->link->markup() : $this->link?->url)
      ->set('tags', \implode(' ', \array_map(static function ($tag) {
        return $tag->title;
      }, $this->tags->toArray())))
      // @todo template is a bit whack with this.
      ->set('date', $this->date?->format('j F Y'))
      ->set('icon', '🐴')
    ;
  }

}
