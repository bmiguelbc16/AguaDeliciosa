<x-tool.modal id="onFormModal" title='Crear Roles' static-backdrop>
  <form id="roleForm" method="POST">
    @csrf
    <input type="hidden" id="formMethod" name="_method" value="POST">
    <div class="mb-3">
      <x-form.input name="name" label="Nombre" placeholder="Nombre" />
    </div>
    <div class="mb-3">
      <x-form.input name="description" label="Descripción" placeholder="Descripción" />
    </div>
    <div class="mb-3">
      <x-form.input-switch name="active">
        <x-slot name="appendSlot">
          <label class="form-check-label" for="active">Activo</label>
        </x-slot>
      </x-form.input-switch>
    </div>
  </form>

  <x-slot name="footerSlot">
    <x-form.button theme="secondary" label="Cancelar" data-bs-dismiss="modal" />
    <x-form.button theme="primary" id="onSaveClose" theme="success" label="Guardar" />
  </x-slot>
</x-tool.modal>
