@extends('adminlte::page')

@section('title', 'Visitor Feedback')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Visitor Feedback</h3>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover text-nowrap" id="dataTables">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Visitor Name</th>
                            <th>Feedback</th>
                            <th>Rating</th>
                            <th>Submitted At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($feedbacks as $feedback)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($feedback->visitor)
                                        <a href="{{ route('visitors.show', $feedback->visitor->id) }}"
                                            class="normal-link d-inline-block px-2 py-1 rounded text-decoration-none fw-semibold">
                                            {{ $feedback->visitor->name }}
                                        </a>
                                    @elseif ($feedback->pendingVisitor)
                                        <a href="{{ route('pending_visitors.show', $feedback->pendingVisitor->id) }}"
                                            class="normal-link d-inline-block px-2 py-1 rounded text-decoration-none fw-semibold">
                                            {{ $feedback->pendingVisitor->name ?? 'Pending Visitor' }}
                                        </a>
                                    @else
                                        <span class="text-muted">Unknown</span>
                                    @endif
                                </td>

                                <td>{{ $feedback->feedback_text }}</td>
                                <td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="fas fa-star{{ $i <= $feedback->rating ? ' text-warning' : '-o text-muted' }}"></i>
                                    @endfor
                                </td>
                                <td>{{ \Carbon\Carbon::parse($feedback->submitted_at)->format('d F, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No feedback available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
