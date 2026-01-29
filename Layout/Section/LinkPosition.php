<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Layout\Section;

use PreviousNext\Ds\Common\Layout\Section\SectionModifierInterface;
use PreviousNext\Ds\Common\Modifier\Mutex;

#[Mutex]
enum LinkPosition implements SectionModifierInterface {

  /*
   * Places the section link in a `<div>` with the section title, before section content.
   */
  case BeforeContent;

  /*
   * Places the section link in a `<p>` after section content.
   */
  case AfterContent;

}
