@extends('adminlte::page')

@section('title', 'Add Visitor Company')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                @if (session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: "{{ session('success') }}",
                            timer: 3000,
                            showConfirmButton: false
                        });
                    </script>
                @endif

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Add New Visitor Company
                    </div>

                    <div class="card-body">
                        <form action="{{ route('visitor_company.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="name">Visitor Name</label>
                                <input type="text" name="contact_person" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="company_name">Company Name</label>
                                <input type="text" name="company_name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="purpose">Visit Purpose</label>
                                <input type="text" name="purpose" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="visit_date">Visit Date</label>
                                <input type="date" name="visit_date" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="national_id">National ID</label>
                                <input type="text" name="national_id" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="visitor_type">Visitor Type</label>
                                <select name="visitor_type" class="form-control">
                                    <option value="group">Group</option>
                                    <option value="single">Single</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{ route('visitor_company') }}" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop
