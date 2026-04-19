@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Payments</h3>
    <div>
        <a href="{{ route('reports.payments') }}" class="btn btn-secondary">View Report</a>
        <a href="{{ route('reports.payments.pdf') }}" class="btn btn-danger">Download PDF</a>
        <a href="{{ route('payments.create') }}" class="btn btn-primary">Add Payment</a>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Month Paid</th>
                    <th>Method</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment->student->full_name }}</td>
                        <td>₱{{ number_format($payment->amount, 2) }}</td>
                        <td>{{ $payment->payment_date }}</td>
                        <td>{{ $payment->month_paid_for }}</td>
                        <td>{{ $payment->payment_method }}</td>
                        <td>
                            <a href="{{ route('payments.edit', $payment) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('payments.destroy', $payment) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $payments->links() }}
    </div>
</div>
@endsection
