<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Atom\Image;

use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Common\Component\Media\Image\ImageSource;
use PreviousNext\IdsTools\ImageGeneration\PicsumImageGenerator;
use PreviousNext\IdsTools\Scenario\Scenario;

final class ImageScenarios {

  #[Scenario(viewPortHeight: 500)]
  public static function imageScenario1(): CommonComponent\Media\Image\Image {
    $instance = CommonComponent\Media\Image\Image::createSample(300, 400);
    /** @var \PreviousNext\Ds\Common\Component\Media\Image\Image */
    return $instance;
  }

  public static function imageSrcSetScenarios(): CommonComponent\Media\Image\Image {
    $image1 = PicsumImageGenerator::createSample(500, 300);
    $srcset = \sprintf('%s, %s 2x', $image1, $image1);
    $source1 = ImageSource::create($srcset, '(width < 800px)', 'image/jpg');

    return CommonComponent\Media\Image\Image::create(
      source: $image1, altText: 'Alt text', width: 300, height: 500, sources: [$source1],
    );
  }

}
