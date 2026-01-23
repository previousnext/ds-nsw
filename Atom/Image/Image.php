<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Atom\Image;

use Pinto\Slots;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Common\Component\Media\Image\ImageSource;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Slots\Attribute\RenameSlot(original: 'source', new: 'src')]
#[Slots\Attribute\RenameSlot(original: 'altText', new: 'alt')]
#[Slots\Attribute\RenameSlot(original: 'loadingType', new: 'loading')]
#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
#[Scenarios([ImageScenarios::class])]
class Image extends CommonComponent\Media\Image\Image implements Utility\NswObjectInterface {
  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    // @todo imageAttributes is unused.
    // OK: containerAttributes is on <picture>.
    return parent::build($build)
      ->set('source', $this->source)
      ->set('altText', $this->altText)
      ->set('width', $this->width)
      ->set('height', $this->height)
      ->set('loadingType', \strtolower($this->loadingType->name))
      ->set('sources', \array_map(static function (ImageSource $source): array {
        // @todo
        return ['srcset' => $source->srcset, 'type' => $source->type, 'media' => $source->media];
      }, $this->sources));
  }

}
