<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice {{ $invoice->invoice_number ?? '' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 14px;
            color: #1e293b;
            line-height: 1.5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
        }

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            font-weight: bold;
            color: #0f172a;
        }

        .header p {
            color: #64748b;
            font-size: 13px;
            margin-top: 4px;
        }

        .status-row {
            margin-bottom: 20px;
        }

        .status-label {
            font-weight: 600;
            color: #0f172a;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-paid {
            background: #d1fae5;
            color: #047857;
        }

        .status-draft {
            background: #f1f5f9;
            color: #475569;
        }

        .status-overdue {
            background: #fee2e2;
            color: #b91c1c;
        }

        .status-pending {
            background: #fef3c7;
            color: #b45309;
        }

        /* Use tables for ALL layout */
        .layout-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .layout-table td {
            vertical-align: top;
            padding: 0;
            width: 50%;
        }

        .layout-table td.right {
            padding-left: 20px;
        }

        .info-box {
            padding: 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }

        .info-box h3 {
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .info-box .name {
            font-weight: 700;
            color: #0f172a;
            font-size: 15px;
        }

        .info-box .detail {
            color: #64748b;
            font-size: 13px;
            margin-top: 4px;
        }

        /* Line items table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .items-table th {
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            padding: 12px;
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
        }

        .items-table td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
        }

        .items-table .text-center {
            text-align: center;
        }

        .items-table .text-right {
            text-align: right;
        }

        .items-table .font-bold {
            font-weight: 700;
        }

        /* Totals - use a nested table */
        .totals-wrapper {
            width: 100%;
            margin-bottom: 30px;
        }

        .totals-wrapper td {
            text-align: right;
        }

        .totals-box {
            display: inline-block;
            width: 300px;
            padding: 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #f8fafc;
            text-align: left;
        }

        .totals-row {
            margin-bottom: 8px;
            font-size: 13px;
        }

        .totals-row:after {
            content: "";
            display: table;
            clear: both;
        }

        .totals-row .label {
            float: left;
            color: #64748b;
        }

        .totals-row .value {
            float: right;
            font-weight: 500;
            color: #0f172a;
        }

        .totals-row.total {
            border-top: 1px solid #cbd5e1;
            padding-top: 12px;
            margin-top: 12px;
        }

        .totals-row.total .value {
            font-size: 18px;
            font-weight: 700;
            color: #2563eb;
        }

        .notes {
            padding: 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #f8fafc;
            margin-bottom: 30px;
        }

        .notes h3 {
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .notes p {
            color: #64748b;
            font-size: 13px;
        }

        .footer {
            border-top: 1px solid #e2e8f0;
            padding-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
        }

        .footer a {
            color: #2563eb;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        {!! $slot !!}
    </div>
</body>

</html>
