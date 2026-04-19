<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Payment Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Payment Report</h2>
    <p><strong>Total Income:</strong> ₱{{ number_format($totalIncome, 2) }}</p>
    <table>
        <thead>
            <tr>
                <th>Student</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Month Paid</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->student->full_name }}</td>
                    <td>₱{{ number_format($payment->amount, 2) }}</td>
                    <td>{{ $payment->payment_date }}</td>
                    <td>{{ $payment->month_paid_for }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
