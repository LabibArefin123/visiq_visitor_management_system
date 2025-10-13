@extends('adminlte::page')

@section('title', 'Edit Visitor')

@section('content')
<div class="container">
    <h2>Edit Visitor</h2>

    <form action="{{ route('checkout.update', $checkout->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $checkout->name }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $checkout->phone }}" required>
        </div>

        <div class="form-group">
            <label for="purpose">Purpose</label>
            <textarea class="form-control" id="purpose" name="purpose" required>{{ $checkout->purpose }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@stop

