<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Component\Steps;

use Drupal\Core\Render\Markup;
use PreviousNext\Ds\Common\Atom;
use PreviousNext\Ds\Common\Component\Steps\Step;
use PreviousNext\IdsTools\Scenario\Scenario;

final class StepsScenarios {

  /**
   * @phpstan-return \Generator<Steps>
   */
  #[Scenario(viewPortWidth: 800, viewPortHeight: 600)]
  public static function backgroundModifiers(): \Generator {
    foreach (StepsBackground::cases() as $background) {
      /** @var \PreviousNext\Ds\Nsw\Component\Steps\Steps $instance */
      $instance = \PreviousNext\Ds\Common\Component\Steps\Steps::create();
      $instance[] = Step\Step::create(Atom\Html\Html::create(Markup::create('Step 1 contents')));
      $instance[] = $step2 = Step\Step::create(Atom\Html\Html::create(Markup::create('Step 2 contents')));
      $instance[] = Step\Step::create(Atom\Html\Html::create(Markup::create('Step 3 contents')));
      $instance[] = $step4 = Step\Step::create(Atom\Html\Html::create(Markup::create('Step 4 contents')));
      $instance[] = Step\Step::create(Atom\Html\Html::create(Markup::create('Step 5 contents')));
      $instance->setActiveRange(to: $step4, from: $step2);
      $instance->hasTextCounters = TRUE;
      $instance->hasBackgroundFill = TRUE;
      $instance->modifiers[] = $background;
      yield \sprintf('nsw-bg-modifier-%s', $background->name) => $instance;
    }
  }

  /**
   * @phpstan-return \Generator<Steps>
   */
  #[Scenario(viewPortWidth: 800, viewPortHeight: 600)]
  public static function sizeModifiers(): \Generator {
    foreach (StepsSize::cases() as $size) {
      // https://designsystem.nsw.gov.au/components/steps/index.html has heading size recommendations.
      $h = match ($size) {
        StepsSize::Small => 'h4',
        StepsSize::Medium => 'h3',
        StepsSize::Large => 'h2',
      };

      /** @var \PreviousNext\Ds\Nsw\Component\Steps\Steps $instance */
      $instance = \PreviousNext\Ds\Common\Component\Steps\Steps::create();
      $instance[] = Atom\Html\Html::create(Markup::create(\sprintf("<%s>Heading %s!</%s><p>Step 1 contents</p>", $h, $h, $h)));
      $instance[] = Atom\Html\Html::create(Markup::create(\sprintf("<%s>Heading %s!</%s><p>Step 2 contents</p>", $h, $h, $h)));
      $instance[] = Atom\Html\Html::create(Markup::create(\sprintf("<%s>Heading %s!</%s><p>Step 3 contents</p>", $h, $h, $h)));
      $instance->modifiers[] = $size;
      yield \sprintf('nsw-size-modifier-%s', $size->name) => $instance;
    }
  }

}
