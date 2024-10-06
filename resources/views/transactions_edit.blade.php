<x-app-layout>
    <x-slot name="header">
    <h2 id="heading">Edit Transaction</h2>
    </x-slot>

    <x-slot name="content">
    <div class=myForm>
        <form action="{{route('transactions.update',$transaction->id)}}" method="post">
            @csrf
            <input type="hidden" name="_method" value="put"/>
            <div class="formDiv">
                <label for="type">Transaction Type</label>
                <select name="type" id="type" required>
                    <option value="income" {{$transaction->type=='income'?'selected':''}}>Income</option>
                    <option value="expense" {{$transaction->type=='expense'?'selected':''}}>Expense</option>
                </select>
            </div>
            <div class="formDiv">
                <label for="amount">Amount</label>
                <input type="number" name="amount" value="{{$transaction->amount}}" required/>
            </div>
            <div class="formDiv">
                <label for="category">Category</label>
                <input type="text" name="category" value="{{$transaction->category}}" required/>
            </div>
            <div class="formDiv">
                <label for="date">Date</label>
                <input type="date" name="date" value="{{$transaction->date}}" required/>
            <div class="formDiv">
                <label for="description">Description (optional)</label>
                <textarea name="description">{{$transaction->description}}</textarea>
            </div>
            <button type="submit" id="addButton">Update Transaction</button>
        </form>
    </x-slot>
</x-app-layout>