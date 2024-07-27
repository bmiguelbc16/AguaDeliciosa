<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy {
  use HandlesAuthorization;

  /**
   * Determine whether the user can view any employees.
   *
   * @param  \App\Models\User  $user
   * @return mixed
   */
  public function viewAny(User $user) {
    return $this->isAdmin($user);
  }

  /**
   * Determine whether the user can view the employee.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Employee  $employee
   * @return mixed
   */
  public function view(User $user, Employee $employee) {
    return $this->isAdmin($user);
  }

  /**
   * Determine whether the user can create employees.
   *
   * @param  \App\Models\User  $user
   * @return mixed
   */
  public function create(User $user) {
    return $this->isAdmin($user);
  }

  /**
   * Determine whether the user can update the employee.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Employee  $employee
   * @return mixed
   */
  public function update(User $user, Employee $employee) {
    return $this->isAdmin($user);
  }

  /**
   * Determine whether the user can delete the employee.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Employee  $employee
   * @return mixed
   */
  public function delete(User $user, Employee $employee) {
    return $this->isAdmin($user);
  }

  /**
   * Determine whether the user can restore the employee.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Employee  $employee
   * @return mixed
   */
  public function restore(User $user, Employee $employee) {
    return $this->isAdmin($user);
  }

  /**
   * Determine whether the user can permanently delete the employee.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Employee  $employee
   * @return mixed
   */
  public function forceDelete(User $user, Employee $employee) {
    return $this->isAdmin($user);
  }

  /**
   * Check if the user is an admin.
   *
   * @param  \App\Models\User  $user
   * @return bool
   */
  protected function isAdmin(User $user) {
    return $user->hasRole('Admin');
  }

  public function __construct() {
    //
  }
}
