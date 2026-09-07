<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\SocialLinks;

use Pinto\Attribute\Asset;
use Pinto\Slots;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Common\Component\SocialLinks\SocialLink\SocialLink;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Asset\Css('social-links.css', preprocess: FALSE)]
#[Scenarios([
  CommonComponent\SocialLinks\SocialLinksScenarios::class,
])]
class SocialLinks extends CommonComponent\SocialLinks\SocialLinks implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  protected function build(Slots\Build $build): Slots\Build {
    return parent::build($build)
      ->set('items', $this->map(static fn (SocialLink $item): mixed => $item())->toArray());
  }

}
