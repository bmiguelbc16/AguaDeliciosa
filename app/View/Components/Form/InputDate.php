<?php

namespace App\View\Components\Form;

class InputDate extends InputGroupComponent {
  use Traits\OldValueSupportTrait;

  /**
   * The Tempus Dominus plugin configuration parameters. Array with
   * 'key => value' pairs, where the key should be an existing configuration
   * property of the plugin.
   *
   * @var array
   */
  public $config;

  /**
   * The default set of buttons for the Tempus Dominus plugin configuration.
   *
   * @var array
   */
  protected $buttons = [
    'showClose' => true,
  ];

  /**
   * Create a new component instance.
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
    );

    $this->enableOldSupport = isset($enableOldSupport);
    $this->config = is_array($config) ? $config : [];
  }

  /**
   * Make the class attribute for the "input-group" element.
   *
   * @return string
   */
  public function makeInputGroupClass() {
    $classes = ['input-group', 'flatpickr'];

    if ($this->isInvalid()) {
      $classes[] = 'form-invalid-igroup';
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
    $classes = ['form-control', 'flatpickr-input'];

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
    return view('components.form.input-date');
  }
}
