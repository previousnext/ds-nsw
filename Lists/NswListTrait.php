<?php

declare(strict_types=1);

namespace PreviousNext\Ds\Nsw\Lists;

use Pinto\Attribute\Definition;
use PreviousNext\Ds\Common\List\ListTrait;
use PreviousNext\Ds\Nsw\Utility\Twig;
use function Safe\realpath;

trait NswListTrait
{
  use ListTrait;

  final public function cssDirectory(): string {
    return $this->nswAssetDir();
  }

  final public function jsDirectory(): string {
    return $this->nswAssetDir();
  }

  public function templateDirectory(): string
  {
    // Template directory relative to /data/ids/interchangeable-ds/components/design-system
    // See \Drupal\pnx_ds_nsw\Hook\Hooks::systemInfoAlter().
    return sprintf('@%s/%s', Twig::Namespace, $this->dsDirectory());
  }

  final public function templateName(): string
  {
    // Cap names to hyphen between, then remove leading hyphen.
    return \strtolower(ltrim(\preg_replace_callback('/[A-Z]/', function ($matches) {
      return '-' . $matches[0];
    }, $this->name) ?? '', '-'));
  }

  private function nswAssetDir(): string
  {
    $pathFromDrupalRoot = realpath(sprintf('%s/../ids/interchangeable-ds/assets', \DRUPAL_ROOT));
    $definition = ((new \ReflectionEnumUnitCase($this::class, $this->name))->getAttributes(Definition::class)[0] ?? null)?->newInstance();
    if (null === $definition) {
      return $pathFromDrupalRoot;
    }

    return $pathFromDrupalRoot;
  }

  private function dsDirectory(): string
  {
    $enum = $this;

    $categoryDirectory = match (\get_class($this)) {
      NswAtoms::class => 'Atom',
      NswLayouts::class => 'Layout',
      NswComponents::class => 'Component',
      default => throw new \LogicException('Unhandled ' . static::class),
    };

    if (\str_ends_with($this->name, 'Item')) {
      // If the enum name ends with 'Item', just get the non-prefixed 'Item'-less enum.
      // E.g `AccordionItem` resolves to `Accordion`.
      /** @var static $enum */
      $enum = $this::{\substr($this->name, 0, strlen('Item') * -1)};
    }

    return $categoryDirectory . '/' . $enum->name;
  }
}
