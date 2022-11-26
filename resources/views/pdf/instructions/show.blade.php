<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Instruction Detail</title>

    <style>
        * {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI",
                Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue",
                sans-serif;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .title {
            font-weight: 400;
        }

        .remark {
            padding: 0 5px;
            border: 1px solid black;
        }

        table {
            width: 100%;
        }

        table td {
            vertical-align: baseline;
        }

        .table,
        .table th,
        .table td {
            vertical-align: middle;
            padding: 0 5px;
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table>thead th {
            white-space: nowrap;
        }

        h4 {
            margin-bottom: 2px;
        }

        .job-detail {
            padding: 0 5px;
            border: 1px solid black;
        }

        .job-detail>p {
            margin: 0;
        }

        .item>p {
            margin: 0;
        }

        .item>h4 {
            margin-top: 0.5rem;
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    @if ($instruction->type === 'LI')
        <h1 class="text-center title">LOGISTICS INSTRUCTION</h1>
    @else
        <h1 class="text-center title">SERVICES INSTRUCTION</h1>
    @endif

    <table>
        <tr>
            <td>
                <div class="item">
                    <h4>{{ $instruction->type == 'LI' ? 'LI' : 'SI' }} No</h4>
                    <p>{{ $instruction->no ?? '-' }}</p>
                </div>
                <div class="item">
                    <h4>Issued To</h4>
                    <p>{{ $instruction->assigned_vendor ?? '-' }}</p>
                </div>
                <div class="item">
                    <h4>Vendor Address</h4>
                    <p>{{ $instruction->vendor_address ?? '-' }}</p>
                </div>
                <div class="item">
                    <h4>Attention Of</h4>
                    <p>{{ $instruction->attention_of ?? '-' }}</p>
                </div>
                <div class="item">
                    <h4>Vendor Quotation</h4>
                    <p>{{ $instruction->quotation_no ?? '-' }}</p>
                </div>
                <div class="item">
                    <h4>Invoice To</h4>
                    <p>{{ $instruction->invoice_to ?? '-' }}</p>
                </div>
            </td>
            <td>
                <div class="item">
                    <h4>Customer</h4>
                    <p>{{ $instruction->customer ?? '-' }}</p>
                </div>
                <div class="item">
                    <h4>Customer PO No.</h4>
                    <p>{{ $instruction->customer_po_no ?? '-' }}</p>
                </div>
                <div class="item">
                    <h4>Date of Issue</h4>
                    <p>{{ $instruction->created_at->format('d/m/y') ?? '-' }}</p>
                </div>
                <div class="item">
                    <h4>Delivery Date</h4>
                    <p>-</p>
                </div>
                <div class="item">
                    <h4>Issued By</h4>
                    <p>-</p>
                </div>
            </td>
        </tr>
    </table>

    <h4 class="remark">Remark</h4>

    <h4>Cost Detail</h4>
    <table class="table">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Description</th>
                <th rowspan="2">Charge To</th>
                <th rowspan="2">Qty</th>
                <th rowspan="2">UOM</th>
                <th rowspan="2">Unit Price</th>
                <th rowspan="2">Disc %</th>
                <th rowspan="2">VAT %</th>
                <th colspan="2">USD</th>
            </tr>
            <tr>
                <th>VAT</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
            @php
                $total = 0;
            @endphp
            @foreach ($instruction->costs as $cost)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $cost['description'] }}</td>
                    <td>{{ $cost['charge_to'] }}</td>
                    <td class="text-end">{{ $cost['qty'] }}</td>
                    <td>{{ $cost['uom'] }}</td>
                    <td class="text-end">{{ number_format($cost['unit_price'], 2, '.', '') }}</td>
                    <td class="text-end">{{ $cost['discount'] }}</td>
                    <td class="text-end">{{ $cost['vat'] }}</td>
                    <td class="text-end">45.00</td>
                    <td class="text-end">{{ number_format($cost['total'], 2, '.', '') }}</td>
                </tr>
                @php
                    $total += $cost['total'];
                @endphp
            @endforeach
            <tr class="text-end">
                <td colspan="8">Total Amount Payable</td>
                <td>45.00</td>
                <td>{{ number_format($total, 2, '.', '') }}</td>
            </tr>
        </tbody>
    </table>

    <h4>Job Detail</h4>
    <div class="job-detail">
        <p>Transportation: By=Amarit & Associates Co Ltd</p>
        <p>Documentation: Provision Of Inspection Report=Yes</p>
    </div>
</body>

</html>
