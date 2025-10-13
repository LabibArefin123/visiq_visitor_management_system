@extends('adminlte::page')

@section('title', 'View Visitor Company Details')

@section('content')
    <div class="container">
        <h2>Visitor Details</h2>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>{{ $companyVisitor->name }}</h5>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $companyVisitor->contact_person }}</p>
                <p><strong>Company Name:</strong> {{ $companyVisitor->company_name ?? 'N/A' }}</p>
                <p><strong>Phone:</strong> {{ $companyVisitor->phone }}</p>
                <p><strong>Purpose:</strong> {{ $companyVisitor->purpose }}</p>
                <p><strong>Visit Date:</strong> {{ \Carbon\Carbon::parse($companyVisitor->visit_date)->format('Y-m-d') }}</p>
                <p><strong>Date of Birth:</strong> {{ $companyVisitor->date_of_birth ? \Carbon\Carbon::parse($companyVisitor->date_of_birth)->format('Y-m-d') : 'N/A' }}</p>
                <p><strong>Age:</strong>
                    @if ($companyVisitor->date_of_birth)
                        {{ \Carbon\Carbon::parse($companyVisitor->date_of_birth)->age }}
                    @else
                        N/A
                    @endif
                </p>
                <p><strong>National ID:</strong> {{ $companyVisitor->national_id ?? 'N/A' }}</p>
                <p><strong>Gender:</strong> {{ $companyVisitor->gender ?? 'N/A' }}</p>
                <p><strong>Visitor Type:</strong> {{ $companyVisitor->visitor_type ?? 'Single' }}</p>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('visitor_company.edit', $companyVisitor->id) }}" class="btn btn-primary">Edit</a>
                <a href="{{ route('visitor_group_member.index', $companyVisitor->id) }}" class="btn btn-info">View Members</a>
                <a href="{{ route('visitor_company.pdf', $companyVisitor->id) }}" class="btn btn-danger">Download PDF</a>
                <a href="{{ route('visitor_company.word', $companyVisitor->id) }}" class="btn btn-success">Download Word</a>
                <a href="{{ route('visitor_company') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
