<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Atom\ExternalVideo;

use Pinto\Slots;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Slots\Attribute\RenameSlot(original: 'source', new: 'src')]
#[Slots\Attribute\RenameSlot(original: 'containerAttributes', new: 'attributes')]
#[Scenarios([CommonComponent\Media\ExternalVideo\ExternalVideoScenarios::class])]
class ExternalVideo extends CommonComponent\Media\ExternalVideo\ExternalVideo implements Utility\NswObjectInterface {
  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    // @todo NSW template has `width` but common/shapes does not.
    // @todo NSW template has `height` but common/shapes does not.
    // @todo NSW template has `loading` but common/shapes does not.
    // @todo Common/shapes has `duration` but NSW template does not.
    return parent::build($build)
      ->set('source', $this->source);
  }

}
