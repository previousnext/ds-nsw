<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\SocialLinks;

use Pinto\Attribute\Asset;
use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Nsw\Utility;
use PreviousNext\IdsTools\Scenario\Scenarios;

#[Asset\Css('social-links.css', preprocess: TRUE)]
#[Scenarios([
  CommonComponent\SocialLinks\SocialLinksScenarios::class,
])]
class SocialLinks extends CommonComponent\SocialLinks\SocialLinks implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

}
