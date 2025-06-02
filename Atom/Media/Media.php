<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Atom\Media;

use Pinto\Attribute\Asset;
use Pinto\Slots;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Common\Component\Media\ExternalVideo\ExternalVideo;
use PreviousNext\Ds\Nsw\Atom\Image\Image;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Slots\Attribute\RenameSlot(original: 'media', new: 'item')]
#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
#[Asset\Css('media.css', preprocess: TRUE)]
#[Scenarios([CommonComponent\Media\MediaScenarios::class])]
class Media extends CommonComponent\Media\Media implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    return $build
      ->set('mediaType', match (TRUE) {
        $this->media instanceof Image => 'image',
        $this->media instanceof ExternalVideo => 'video',
        default => throw new \LogicException(\sprintf('Unhandled media of type: %s', $this->media::class)),
      });
  }

}
