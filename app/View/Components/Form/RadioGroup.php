<?php

namespace App\View\Components\Form;
use Illuminate\View\Component;
use App\Helpers\UtilsHelper;

use Illuminate\Support\Arr;

class RadioGroup extends Component {
  use Traits\OldValueSupportTrait;
  /**
   * Holds an instance of the Laravel errors bag. This will be mainly used to
   * detect when the input group has associated errors.
   *
   * @var \Illuminate\Support\MessageBag;
   */
  protected $errorsBag;

  /**
   * The visible label (text) for the button.
   *
   * @var string
   */
  public $label;

  /**
   * The id attribute for the underlying input group item. The input group
   * item may be an "input", a "select", a "textarea", etc.
   *
   * @var string
   */
  public $id;

  /**
   * The visible label (text) for the button.
   *
   * @var string
   */
  public $name;

  /**
   * The list of options as 'key => value' pairs.
   *
   * @var array
   */
  public $options;

  /**
   * The list of selected option keys.
   *
   * @var array
   */
  public $selected;

  /**
   * Indicates if the invalid feedback is disabled for the input group.
   *
   * @var bool
   */
  public $disableFeedback;

  /**
   * The lookup key to use when searching for validation errors. The lookup
   * key is automatically generated from the name property. This provides a
   * way to overwrite that value.
   *
   * @var string
   */
  public $errorKey;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct(
    $name,
    $id = null,
    $label = null,
    $options = [],
    $enableOldSupport = null,
    $disableFeedback = null,
    $errorKey = null,
    $selected = null,
  ) {
    $this->id = $id ?? $name;
    $this->name = $name;
    $this->label = UtilsHelper::applyHtmlEntityDecoder($label);
    $this->options = is_array($options) ? $options : [];
    $this->enableOldSupport = isset($enableOldSupport);
    $this->disableFeedback = $disableFeedback;
    $this->selected = $selected;

    // Setup the lookup key for validation errors.

    $this->errorKey = $errorKey ?? $this->makeErrorKey();

    // Initialize the internal errors bag holder variable.

    $this->errorsBag = null;
  }

  /**
   * Check if there are validation errors in the session related to the
   * error key.
   *
   * @return bool
   */
  public function isInvalid() {
    // Get the errors bag from session. The errors bag will be an instance
    // of the Illuminate\Support\MessageBag class. First we will check if
    // the errors bag is available within this instance, otherwise we will
    // try to get it from the session.

    $errors = $this->errorsBag ?? session()->get('errors');

    // Check if the invalid feedback is enabled and there exists an error
    // related to the configured error key.

    return !isset($this->disableFeedback) && !empty($errors) && $errors->has($this->errorKey);
  }

  /**
   * Setup the errors bag internally.
   *
   * @param  \Illuminate\Support\MessageBag  $errorsBag
   * @return void
   */
  public function setErrorsBag($errorsBag) {
    $this->errorsBag = $errorsBag;
  }

  /**
   * Make the error key that will be used to search for validation errors.
   * The error key is generated from the 'name' property.
   * Examples:
   * $name = 'files[]'         => $errorKey = 'files'.
   * $name = 'person[2][name]' => $errorKey = 'person.2.name'.
   *
   * @return string
   */
  protected function makeErrorKey() {
    $errKey = preg_replace('@\[\]$@', '', $this->name);

    return preg_replace('@\[([^]]+)\]@', '.$1', $errKey);
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render() {
    return view('components.form.radio-group');
  }
}
