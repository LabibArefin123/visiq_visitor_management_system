@extends('adminlte::page')

@section('title', 'Edit Visitor Details')

@section('content')
    <div class="container">
        <h2>Edit Visitor Details</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('visitor_company.update', $companyVisitor->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="contact_person" class="form-control"
                            value="{{ old('name', $companyVisitor->contact_person) }}" required autocomplete="off">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control"
                            value="{{ old('phone', $companyVisitor->phone) }}" required autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="purpose">Purpose</label>
                        <input type="text" name="purpose" id="purpose" class="form-control"
                            value="{{ old('purpose', $companyVisitor->purpose) }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="visitor_type">Visitor Type</label>
                        <select name="visitor_type" id="visitor_type" class="form-control">
                            <option value="single" {{ old('visitor_type', $companyVisitor->visitor_type) === 'single' ? 'selected' : '' }}>Single</option>
                            <option value="group" {{ old('visitor_type', $companyVisitor->visitor_type) === 'group' ? 'selected' : '' }}>Group</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="company_name">Company Name</label>
                        <input type="text" name="company_name" id="company_name" class="form-control"
                            value="{{ old('company_name', $companyVisitor->company_name) }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="visit_date">Visit Date</label>
                        <input type="date" name="visit_date" id="visit_date" class="form-control"
                            value="{{ old('visit_date', $companyVisitor->visit_date) }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control"
                            value="{{ old('date_of_birth', $companyVisitor->date_of_birth) }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="national_id">National ID</label>
                        <input type="text" name="national_id" id="national_id" class="form-control"
                            value="{{ old('national_id', $companyVisitor->national_id) }}">
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success">Update Visitor</button>
                <a href="{{ route('visitor_company') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
