<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quote Excel</title>

</head>
<body>

<table>
    <thead>
    <tr>
        <th style="width: 200%"><b>Invoice Id</b></th>
        <th style="width: 200%"><b>Client Name</b></th>
        <th style="width: 300%"><b>Client Email</b></th>
        <th style="width: 150%"><b>Invoice Date</b></th>
        <th style="width: 170%"><b>Amount</b></th>
        <th style="width: 150%"><b>Due Date</b></th>
        <th style="width: 150%"><b>Status</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($quotes as $quote)
        <tr>
            <td>{{ $quote->quote_id }}</td>
            <td>{{ $quote->client->user->FullName }}</td>
            <td>{{ $quote->client->user->email }}</td>
            <td>{{ $quote->quote_date }}</td>
            <td>{{ $quote->final_amount }}</td>
            <td>{{ $quote->due_date }}</td>
            @if($quote->status == \App\Models\Quote::DRAFT)
                <td> Draft</td>
            @elseif($quote->status == \App\Models\Quote::CONVERTED)
                <td> Converted</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
