<?php

namespace App\View\Components\Form;

class InputSwitch extends InputGroupComponent {
  use Traits\OldValueSupportTrait;

  /**
   * The Bootstrap Switch plugin configuration parameters. Array with
   * 'key => value' pairs, where the key should be an existing configuration
   * property of the plugin.
   *
   * @var array
   */
  public $config;

  public $checked;

  /**
   * Create a new component instance.
   * Note this component requires the 'Bootstrap Switch' plugin.
   *
   * @return void
   */
  public function __construct(
    $name,
    $id = null,
    $label = null,
    $igroupSize = null,
    $labelClass = null,
    $fgroupClass = null,
    $igroupClass = null,
    $disableFeedback = null,
    $errorKey = null,
    $config = [],
    $checked = null,
    $enableOldSupport = null,
  ) {
    parent::__construct(
      $name,
      $id,
      $label,
      $igroupSize,
      $labelClass,
      $fgroupClass,
      $igroupClass,
      $disableFeedback,
      $errorKey,
      $checked,
    );

    $this->config = is_array($config) ? $config : [];
    $this->checked = $checked;
    $this->enableOldSupport = isset($enableOldSupport);
  }

  /**
   * Make the class attribute for the "input-group" element. Note we overwrite
   * the method of the parent class.
   *
   * @return string
   */
  public function makeInputGroupClass() {
    $classes = ['form-check form-switch mb-2'];

    if (isset($this->size) && in_array($this->size, ['sm', 'lg'])) {
      $classes[] = "input-group-{$this->size}";
    }

    if ($this->isInvalid()) {
      $classes[] = 'adminlte-invalid-iswgroup';
    }

    if (isset($this->igroupClass)) {
      $classes[] = $this->igroupClass;
    }

    return implode(' ', $classes);
  }

  /**
   * Make the class attribute for the input group item. Note we overwrite
   * the method of the parent class.
   *
   * @return string
   */
  public function makeItemClass() {
    $classes = ['form-check-input'];

    if ($this->isInvalid()) {
      $classes[] = 'is-invalid';
    }

    return implode(' ', $classes);
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render() {
    return view('components.form.input-switch');
  }
}
