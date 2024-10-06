<x-app-layout>
    <x-slot name="header">
        <h2 id="heading">Add New Transaction</h2>
    </x-slot>

    <x-slot name="content">
        <div class="myForm">
        <form action="{{ route('transactions.store')}}" method="post">
            @csrf
            <div class="formDiv">
                <label for="type" class="transactionType">Transaction Type</label>
                <select name="type" id="type" required>
                    <option value="income">Income</option>
                    <option value="expense">Expense</option>
                </select>
            </div>

            <div class="formDiv">
                <label for="amount">Amount</label>
                <input type="number" name="amount" required>
            </div>

            <div class="formDiv">
                <label for="category">Category</label>
                <input type="text" name="category" required>
            </div>
            
            <div class="formDiv">
                <label for="date">Date</label>
                <input type="date" name="date" required>
            </div>

            <div class="formDiv">
                <label for="description">Description (optional)</label>
                <textarea name="description"></textarea>
            </div>

            <button type="submit" id="addButton">Add Transaction</button>
        </form>
        </div>
    </x-slot>
</x-app-layout>