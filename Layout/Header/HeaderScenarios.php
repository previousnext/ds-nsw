<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Layout\Header;

use Drupal\Core\Url;
use PreviousNext\Ds\Common\Atom as CommonAtoms;
use PreviousNext\Ds\Common\Component as CommonComponents;
use PreviousNext\Ds\Common\Layout as CommonLayouts;
use PreviousNext\Ds\Common\Vo\MenuTree\MenuTree;
use PreviousNext\Ds\Nsw\Component\Navigation\NavigationType;
use PreviousNext\IdsTools\Scenario\Scenario;

final class HeaderScenarios {

  #[Scenario(viewPortHeight: 600, viewPortWidth: 1200)]
  final public static function standard(): Header {
    $url = \Mockery::mock(Url::class);
    $url->expects('toString')->andReturn('http://example.com/');

    /** @var Header $header */
    $header = CommonLayouts\Header\Header::create(
      logo: CommonAtoms\LinkedImage\LinkedImage::create(
        CommonComponents\Media\Image\Image::createSample(120, 49),
        CommonAtoms\Link\Link::create('LinkedImageText!', $url),
      ),
    );

    $header->containerAttributes['hello'] = 'world';
    $header->containerAttributes['class'][] = 'foo';

    return $header;
  }

  #[Scenario(viewPortHeight: 600, viewPortWidth: 1200)]
  final public static function search(): mixed {
    $url = \Mockery::mock(Url::class);
    $url->expects('toString')->andReturn('http://example.com/');

    /** @var Header $header */
    $header = CommonLayouts\Header\Header::create(
      logo: CommonAtoms\LinkedImage\LinkedImage::create(
        CommonComponents\Media\Image\Image::createSample(120, 49),
        CommonAtoms\Link\Link::create('LinkedImageText!', $url),
      ),
      hasSearch: TRUE,
    );

    return $header;
  }

  #[Scenario(viewPortHeight: 600, viewPortWidth: 1200)]
  final public static function withTitle(): Header {
    $url = \Mockery::mock(Url::class);
    $url->expects('toString')->andReturn('http://example.com/');

    /** @var Header $header */
    $header = CommonLayouts\Header\Header::create(
      logo: CommonAtoms\LinkedImage\LinkedImage::create(
        CommonComponents\Media\Image\Image::createSample(120, 49),
        CommonAtoms\Link\Link::create('LinkedImageText!', $url),
      ),
      title: 'Site name!',
      description: 'Site slogan!',
    );

    return $header;
  }

  #[Scenario(viewPortHeight: 600, viewPortWidth: 1200)]
  final public static function controls(): Header {
    $url = \Mockery::mock(Url::class);
    $url->expects('toString')->andReturn('http://example.com/');

    $icon = CommonAtoms\Icon\Icon::create('account_circle');

    /** @var Header $header */
    $header = CommonLayouts\Header\Header::create(
      logo: CommonAtoms\LinkedImage\LinkedImage::create(
        CommonComponents\Media\Image\Image::createSample(120, 49),
        CommonAtoms\Link\Link::create('LinkedImageText!', $url),
      ),
      controls: [
        CommonAtoms\Button\Button::create(
          title: 'Login',
          as: CommonAtoms\Button\ButtonType::Button,
          iconStart: $icon,
        ),
      ],
    );

    return $header;
  }

  #[Scenario(viewPortHeight: 600, viewPortWidth: 1200)]
  final public static function navigation(): Header {
    $url = \Mockery::mock(Url::class);
    $url->expects('toString')->andReturn('http://example.com/');

    // Level 1:
    $menu = [];
    $menu[] = MenuTree::create(CommonAtoms\Link\Link::create('Link A', $url));
    $menu[] = MenuTree::create(CommonAtoms\Link\Link::create('Link B', $url));
    $menu[] = MenuTree::create(CommonAtoms\Link\Link::create('Link C', $url));

    /** @var Header $header */
    $header = CommonLayouts\Header\Header::create(
      logo: CommonAtoms\LinkedImage\LinkedImage::create(
        CommonComponents\Media\Image\Image::createSample(120, 49),
        CommonAtoms\Link\Link::create('LinkedImageText!', $url),
      ),
      menu: $menu,
    );

    return $header;
  }

  #[Scenario(viewPortHeight: 600, viewPortWidth: 1200)]
  final public static function megaNav(): Header {
    $url = \Mockery::mock(Url::class);
    $url->expects('toString')->andReturn('http://example.com/');

    // Level 1:
    $menu = [];
    $menu[] = MenuTree::create(CommonAtoms\Link\Link::create('News', $url));
    // Try Url::fromUserInput('#x')) if necessary.
    $menu[] = $treeA = MenuTree::create(CommonAtoms\Link\Link::create('About us', $url));
    $menu[] = MenuTree::create(CommonAtoms\Link\Link::create('Resources', $url));

    // Level 2:
    $treeA[] = $treeA1 = MenuTree::create(CommonAtoms\Link\Link::create('Link A1', $url));
    $treeA[] = MenuTree::create(CommonAtoms\Link\Link::create('Link A2', $url));
    $treeA[] = MenuTree::create(CommonAtoms\Link\Link::create('Link A3', $url));

    // Level 3.
    $treeA1[] = MenuTree::create(CommonAtoms\Link\Link::create('Link A1a', $url));

    /** @var Header $header */
    $header = CommonLayouts\Header\Header::create(
      logo: CommonAtoms\LinkedImage\LinkedImage::create(
        CommonComponents\Media\Image\Image::createSample(120, 49),
        CommonAtoms\Link\Link::create('LinkedImageText!', $url),
      ),
      menu: $menu,
    );
    $header->navigationType = NavigationType::Mega;

    return $header;
  }

}
