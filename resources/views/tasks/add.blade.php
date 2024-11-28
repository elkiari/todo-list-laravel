@extends('layouts.default')

@section('content')
    <div class="d-flex align-items-center mb-5">
        <div class="container card shadow-sm" style="max-width:600px; margin-top:100px">
            <div class="fs-3 fw-bold text-center mt-4">Add new task</div>
            <form class="p-3" method="POST" action="{{ route('task.add.post') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input name="title" type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Deadline</label>
                    <input type="datetime-local" name="deadline" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session()->get('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <button class="btn btn-success" type="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection
