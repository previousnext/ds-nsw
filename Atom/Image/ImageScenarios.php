<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Atom\Image;

use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\IdsTools\Scenario\Scenario;

final class ImageScenarios {

  #[Scenario(viewPortHeight: 500)]
  public static function imageScenario1(): CommonComponent\Media\Image\Image {
    $instance = CommonComponent\Media\Image\Image::createSample(300, 400);
    /** @var \PreviousNext\Ds\Common\Component\Media\Image\Image */
    return $instance;
  }

}
