@extends('layouts.default')

@section('content')
    <main class="flex-shrink-0 pt-5">
        <div class="container" style="max-width: 600px">
            @if (session('success'))
                <div class="alert alert-success">{{ session()->get('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <div class="mb-3 mt-1">Welcome {{ auth()->user()->name }}</div>
                <h6 class="border-bottom pb-2 mb-0">List of tasks</h6>
                @foreach ($tasks as $task)
                <div class="d-flex text-body-secondary pt-3">
                    <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
                    <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                      <div class="d-flex justify-content-between">
                        <strong class="text-gray-dark">{{ $task->title }} | {{ $task->deadline }}</strong>
                        <a href="{{ route('task.status.update', $task->id) }}" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"/></svg></a>
                        <a href="{{ route('task.delete', $task->id) }}" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg></a>
                      </div>
                      <span class="d-block">{{ $task->description }}</span>
                    </div>
                  </div>
                @endforeach
                <small class="d-block text-end mt-3">
                  {{ $tasks->links() }}
                </small>
              </div>
        </div>
    </main>
@endsection
