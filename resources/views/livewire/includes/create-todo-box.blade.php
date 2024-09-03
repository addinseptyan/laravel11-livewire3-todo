<div class="container content py-6 mx-auto">
  <div class="mx-auto">
    <div id="create-form" class="hover:shadow p-6 bg-white border-indigo-500 border-t-8">
      <div class="flex ">
        <h2 class="font-semibold text-lg text-gray-800 mb-5">Create New Todo</h2>
      </div>
      <div>
        <form>
          <div class="mb-6">
            <label for="name"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
              Todo </label>
            <input wire:model="name" type="text" id="name" placeholder="Todo.."
              class="bg-gray-100  text-gray-900 text-sm block w-full p-2.5 border-black border-2 shadow-[2px_2px_0px_rgba(0,0,0,1)] rounded focus:outline-none focus:shadow-none focus:translate-x-0.5 focus:translate-y-0.5 transition">
            @error('name')
              <span class="text-red-500 text-xs mt-3 block ">{{ $message }}</span>
            @enderror

          </div>
          <button wire:click.prevent="create" type="submit"
            class="px-4 py-2 bg-indigo-500 border-black border-2 text-white font-semibold rounded shadow-[2px_2px_0px_rgba(0,0,0,1)] hover:bg-indigo-600 active:shadow-none active:translate-x-0.5 active:translate-y-0.5 transition">Create
            +</button>
          @if (session('success'))
            <span class="text-green-500 text-xs">{{ session('success') }}</span>
          @endif

        </form>
      </div>
    </div>
  </div>
</div>
