@extends('adminlte::page')

@section('title', 'View Group Member')

@section('content')
<div class="container">
    <h2>Group Member Details</h2>
    <p><strong>Group ID:</strong> {{ $member->gid }}</p>
    <p><strong>Name:</strong> {{ $member->name }}</p>
    <p><strong>Email:</strong> {{ $member->email }}</p>
    <p><strong>Phone:</strong> {{ $member->phone }}</p>
    <p><strong>Purpose:</strong> {{ $member->purpose }}</p>
    <p><strong>Added On:</strong> {{ $member->created_at->format('Y-m-d') }}</p>
    <a href="{{ route('visitor_group_member.index', $member->visitor_id) }}" class="btn btn-primary">Back to Member List</a>
</div>
    
@endsection
