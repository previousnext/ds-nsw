<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\Tabs\TabsItem;

use PreviousNext\Ds\Common\Component as CommonComponent;
use PreviousNext\Ds\Nsw\Utility;

class TabsItem extends CommonComponent\Tabs\TabItem\TabItem implements Utility\NswObjectInterface {

  use Utility\ObjectTrait;

  public bool $active;

}
