<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/myStyle.css')}}">
</head>
<body>
<nav class="myNavbar">
    <div class="navbar">
        <div class="logo">
            <a href="/">Expense Tracker</a>
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('transactions.create') }}" class="account-link">Add New Transaction</a></li>
            <li><a href="{{ route('dashboard') }}">My Transactions</a></li>
            <li><a href="{{ route('transactions.chart') }}">Reports and Graphs</a></li>
            <li class="dropdown">
                <a href="#" class="account-link">Account</a>
                <div class="dropdown-content">
                    <form method="post" action="/logout" style="display:none;" id="logout">
                        @csrf
                    </form>
                    <a href="#" onclick="document.getElementById('logout').submit(); return false;">Logout</a>
                    <form method="post" action="{{route('profile.destroy')}}" style="display:none;" id="deleteUser">
                        @csrf
                        <input type="hidden" name="_method" value="delete"/>
                    </form>
                    <a href="#" onclick="document.getElementById('deleteUser').submit(); return false;">Delete Account</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
</body>
</html> 