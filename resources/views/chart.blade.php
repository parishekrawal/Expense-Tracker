<x-app-layout>
    <x-slot name="header">
        <h2 id="heading">Reports and Graphs</h2>
    </x-slot>

    <x-slot name="content">
    <div class="container">
        <h1 style="margin-left:15px;">Monthly Income and Expense Chart : </h1>

    <div class="chart">
        <canvas id="monthlyTransactionChart" width="400" height="400"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('monthlyTransactionChart').getContext('2d');
        const monthlyTransactionChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [
                    {
                        label: 'Income',
                        data: [{{ implode(',', $incomeData) }}],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        fill: false
                    },
                    {
                        label: 'Expense',
                        data: [{{ implode(',', $expenseData) }}],
                        borderColor: 'rgba(255, 99, 132, 1)',
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    </x-slot>
</x-app-layout>
