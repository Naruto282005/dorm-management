@extends('layouts.app')

@section('content')
<h3 class="mb-3">Add Payment</h3>

<form action="{{ route('payments.store') }}" method="POST" class="card shadow-sm border-0 p-4">
    @csrf

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Student</label>
            <select name="student_id" class="form-select" required>
                <option value="">Select Student</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                        {{ $student->last_name }}, {{ $student->first_name }} - {{ $student->student_id_number }}
                    </option>
                @endforeach
            </select>
            @error('student_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount') }}" required>
            @error('amount')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-4">
            <label class="form-label">Payment Date</label>
            <input type="date" name="payment_date" class="form-control" value="{{ old('payment_date') }}" required>
            @error('payment_date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-4">
            <label class="form-label">Month Paid For</label>
            <input type="text" name="month_paid_for" class="form-control" placeholder="Example: April 2026" value="{{ old('month_paid_for') }}" required>
            @error('month_paid_for')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-4">
            <label class="form-label">Payment Method</label>
            <select name="payment_method" class="form-select" required>
                <option value="">Select Method</option>
                <option value="Cash" {{ old('payment_method') == 'Cash' ? 'selected' : '' }}>Cash</option>
                <option value="GCash" {{ old('payment_method') == 'GCash' ? 'selected' : '' }}>GCash</option>
                <option value="Bank Transfer" {{ old('payment_method') == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
            </select>
            @error('payment_method')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label">Reference Number</label>
            <input type="text" name="reference_number" class="form-control" value="{{ old('reference_number') }}">
            @error('reference_number')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-12">
            <label class="form-label">Remarks</label>
            <textarea name="remarks" rows="3" class="form-control">{{ old('remarks') }}</textarea>
            @error('remarks')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Save Payment</button>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection
