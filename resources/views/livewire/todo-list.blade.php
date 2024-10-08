<div>
  @if (session('error'))
    <div
      class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
      role="alert">
      <span class="font-medium">Error!</span> {{ session('error') }}
    </div>
  @endif

  @include('livewire.includes.create-todo-box')

  @include('livewire.includes.search-box')

  <div id="todos-list">
    @foreach ($todos as $todo)
      @include('livewire.includes.todo-card')
    @endforeach

    <div class="my-2">
      <!-- Pagination goes here -->
      {{ $todos->links('vendor.livewire.tailwind') }}
    </div>
  </div>
</div>
