<x-app-layout>
    <x-slot name="header">
        <h2 id="heading">Dashboard</h2>
    </x-slot>

    <x-slot name="filter">
        <form method="post" action="{{route('transactions.filter')}}">
            @csrf
        <input type="text" name="search" placeholder="Filter Your Transactions" id="filterInput" style="padding:3px 6px;"/>
        <label for="from_date" style="font-size:18px;">From Date:</label>
        <input type="date" name="from_date" id="from_date">

        <label for="to_date" style="font-size:18px;">To Date:</label>
        <input type="date" name="to_date" id="to_date">
        <button type="submit" id="filterButton">Filter</button>
        </form>
    </x-slot>
    <x-slot name="content">
    @if(session('success'))
        <div class="alert alert-success" style="color:black;" id="success-alert">{{ session('success') }}</div>
    @endif

    <div class="myTransactions">
    <h2 id="transactionHeading">Your Transactions</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Type</th>
                <th>Amount</th>
                <th>Category</th>
                <th>Date</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->type }}</td>
                    <td>{{ $transaction->amount }}</td>
                    <td>{{ $transaction->category }}</td>
                    <td>{{ $transaction->date }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td>
                        <button><a href="{{ route('transactions.edit', $transaction->id) }}" style="color:black; text-decoration:none; padding:0px 6px;">Edit</a></button>
                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="_method" value="delete"/>
                            <button type="submit" style="cursor:pointer;">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div>
{{$transactions->links()}}
</div>
</x-slot>
</x-app-layout>


<script>
    setTimeout(function() {
        let alert = document.getElementById('success-alert');
        if (alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 500);
        }
    }, 2000);
</script>