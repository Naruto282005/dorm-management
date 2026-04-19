@extends('layouts.app')

@section('content')
<h3 class="mb-3">Edit Payment</h3>

<form action="{{ route('payments.update', $payment) }}" method="POST" class="card shadow-sm border-0 p-4">
    @csrf
    @method('PUT')

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Student</label>
            <select name="student_id" class="form-select" required>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ old('student_id', $payment->student_id) == $student->id ? 'selected' : '' }}>
                        {{ $student->last_name }}, {{ $student->first_name }} - {{ $student->student_id_number }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount', $payment->amount) }}" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Payment Date</label>
            <input type="date" name="payment_date" class="form-control" value="{{ old('payment_date', $payment->payment_date) }}" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Month Paid For</label>
            <input type="text" name="month_paid_for" class="form-control" value="{{ old('month_paid_for', $payment->month_paid_for) }}" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Payment Method</label>
            <select name="payment_method" class="form-select" required>
                <option value="Cash" {{ old('payment_method', $payment->payment_method) == 'Cash' ? 'selected' : '' }}>Cash</option>
                <option value="GCash" {{ old('payment_method', $payment->payment_method) == 'GCash' ? 'selected' : '' }}>GCash</option>
                <option value="Bank Transfer" {{ old('payment_method', $payment->payment_method) == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Reference Number</label>
            <input type="text" name="reference_number" class="form-control" value="{{ old('reference_number', $payment->reference_number) }}">
        </div>

        <div class="col-md-12">
            <label class="form-label">Remarks</label>
            <textarea name="remarks" rows="3" class="form-control">{{ old('remarks', $payment->remarks) }}</textarea>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Update Payment</button>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection
