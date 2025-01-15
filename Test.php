<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary and Benefits Calculator</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 100%;
            table-layout: auto;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
            word-wrap: break-word;
            white-space: normal;
            font-size: 0.9em;
        }
    </style>
</head>

<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Salary and Benefits Growth Calculator</h1>

    <!-- Bootstrap 2-Column Grid -->
    <div class="row g-3 h-100 align-items-stretch">
        <!-- Left Column: Input Form -->
        <div class="col-lg-6 col-md-12 d-flex">
            <form method="POST" action="" class="p-4 border rounded shadow w-100">
                <div class="mb-3">
                    <label for="salary" class="form-label">Enter your current salary:</label>
                    <input type="number" id="salary" name="salary" class="form-control" required step="0.01">
                </div>
                <div class="mb-3">
                    <label for="year" class="form-label">Select a start year:</label>
                    <select id="year" name="year" class="form-select">
                        <?php
                        for ($i = 2025; $i <= date('Y') + 10; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="num_years" class="form-label">Number of years to generate:</label>
                    <input type="number" id="num_years" name="num_years" class="form-control" value="10" min="1" required>
                </div>
                <div class="mb-3">
                    <label for="non_esop_percent" class="form-label">Select Non ESOP Percentage (401k):</label>
                    <select id="non_esop_percent" name="non_esop_percent" class="form-select">
                        <?php
                        for ($i = 2; $i <= 15; $i++) {
                            echo "<option value='$i'>$i%</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="esop_shares" class="form-label"># of Current ESOP Shares:</label>
                    <input type="number" id="esop_shares" name="esop_shares" class="form-control" step="1" min="0">
                </div>
                <button type="submit" class="btn btn-primary w-100">Calculate</button>
            </form>
        </div>

        <!-- Right Column: Display Results -->
        <div class="col-lg-6 col-md-12 d-flex">
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                <div class="p-4 border rounded shadow bg-light w-100">
                    <h3 class="text-center mb-4">Your Input Selections</h3>
                    <p><strong>Salary:</strong> $<?php echo number_format($_POST['salary'], 2); ?></p>
                    <p><strong>Start Year:</strong> <?php echo htmlspecialchars($_POST['year']); ?></p>
                    <p><strong>Number of Years:</strong> <?php echo htmlspecialchars($_POST['num_years']); ?></p>
                    <p><strong>Non-ESOP Percentage:</strong> <?php echo htmlspecialchars($_POST['non_esop_percent']); ?>%</p>
                    <p><strong>Current ESOP Shares:</strong> <?php echo htmlspecialchars($_POST['esop_shares']); ?></p>
                </div>
            <?php else: ?>
                <div class="p-4 border rounded shadow bg-light w-100 text-center">
                    <p>Please fill out the form to calculate your results.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>



<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Existing Chart.js code here
</script>

</body>

</html>

<?php

// Functions to calculate ESOP and Non-ESOP benefits
function calculateEsop($salary, &$currentShareValue, $esopShares, $year, $isFirstYear) {
    if ($isFirstYear) {
        // Calculate the initial value of the shares
        $currentShareValue = $esopShares * 64.25; // Initial share price
    } else {
        // Increase the share value by 6% each subsequent year
        $currentShareValue *= 1.06;
    }

    // Yearly ESOP contribution (7% of salary)
    $yearlyEsop = $salary * 0.07;

    // Combined ESOP value for the year
    $combinedValue = $currentShareValue + $yearlyEsop;

    return [
        'display' => "$" . number_format($currentShareValue, 2) . " (Shares Value), $" . number_format($yearlyEsop, 2) . " (Year), Total: $" . number_format($combinedValue, 2),
        'combinedValue' => $combinedValue,
    ];
}

function calculateNonEsop($salary, $employeeContributionPercent) {
    $matchablePercent = min(0.03, $employeeContributionPercent); // Company matches up to 3%
    if ($employeeContributionPercent >= 0.04) $matchablePercent += 0.005;
    if ($employeeContributionPercent >= 0.05) $matchablePercent += 0.005;

    $employeeContribution = $salary * $employeeContributionPercent;
    $companyMatch = $salary * $matchablePercent;

    return [
        'display' => "$" . number_format($employeeContribution, 2) . " (Employee), $" . number_format($companyMatch, 2) . " (Company Match)",
        'total' => $companyMatch,
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form data
    $salary = (float)$_POST['salary'];
    $currentYear = (int)$_POST['year'];
    $numYears = (int)$_POST['num_years'];
    $employeeContributionPercent = (int)$_POST['non_esop_percent'] / 100;
    $esopShares = (int)($_POST['esop_shares'] ?? 0);

    $salaryData = [];
    $cumulativeBenefitData = [];
    $esopTotals = [];
    $nonEsopTotals = [];
    $cumulativeNonEsopValue = 0; // Initialize cumulative Non-ESOP value

    echo "<h2>Salary and Benefits Growth from Year $currentYear</h2>";
    echo "<table>
        <tr>
            <th class='year'>Year</th>
            <th class='esop-benefits'>ESOP Benefits</th>
            <th class='non-esop-benefits'>Non ESOP Benefits</th>
            <th class='total-benefits'>Benefit Value ESOP (Cumulative)</th>
            <th class='non-esop-cumulative'>Benefit Value Non-ESOP (Cumulative)</th>
        </tr>";

    $cumulativeBenefitValue = 0;
    $currentShareValue = 0; // Initialize share value for first year calculation
    $cumulativeEsopBenefitValue = 0; // Initialize cumulative ESOP benefit value for the first year

    for ($i = 0; $i < $numYears; $i++) {
        $year = $currentYear + $i;
        $isFirstYear = ($i === 0);

        // Calculate ESOP
        $esopData = calculateEsop($salary, $currentShareValue, $esopShares, $year, $isFirstYear);

        // Calculate Non-ESOP
        $nonEsopData = calculateNonEsop($salary, $employeeContributionPercent);

        // Update cumulative Non-ESOP value
        $cumulativeNonEsopValue += $nonEsopData['total'];

        // Calculate Benefit Value ESOP (Cumulative)
        $esopColumnTotal = $esopData['combinedValue']; // Total from the ESOP Benefits column
        $cumulativeEsopBenefitValue = $esopColumnTotal + $cumulativeNonEsopValue; // Add Non-ESOP cumulative value

        // Data for chart
        $salaryData[] = $salary;
        $cumulativeBenefitData[] = $cumulativeEsopBenefitValue; // Updated cumulative ESOP data
        $esopTotals[] = $esopData['combinedValue']; // Yearly ESOP Benefits
        $nonEsopTotals[] = $nonEsopData['total']; // Yearly Non-ESOP company match

        // Display row
        echo "<tr>
        <td class='year'>$year</td>
        <td class='esop-benefits'>{$esopData['display']}</td>
        <td class='non-esop-benefits'>{$nonEsopData['display']}</td>
        <td class='total-benefits'>$" . number_format($cumulativeEsopBenefitValue, 2) . "</td>
        <td class='non-esop-cumulative'>$" . number_format($cumulativeNonEsopValue, 2) . "</td>
    </tr>";

        // Increment salary
        $salary *= 1.03; // 3% salary increase
    }



    echo "</table>";
}
?>




<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div style="width: 80%; margin: 20px auto;">
    <canvas id="salaryBenefitChart"></canvas>
</div>
<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <script>
        const labels = <?php echo json_encode(range($currentYear, $currentYear + $numYears - 1)); ?>;
        const salaryData = <?php echo json_encode($salaryData ?? []); ?>;
        const yearlyEsopTotals = <?php echo json_encode(array_map(function($item) {
            return number_format($item, 2, '.', ''); // Format yearly ESOP totals for display
        }, $esopTotals ?? [])); ?>;
        const cumulativeNonEsopData = <?php echo json_encode(array_reduce(
            $nonEsopTotals ?? [],
            function ($carry, $item) {
                $carry[] = ($carry[count($carry) - 1] ?? 0) + $item;
                return $carry;
            },
            []
        )); ?>;
        const cumulativeBenefitsData = <?php echo json_encode($cumulativeBenefitData ?? []); ?>;

        const ctx = document.getElementById('salaryBenefitChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar', // Overall chart type
            data: {
                labels: labels,
                datasets: [
                    {
                        type: 'bar', // Bar chart for Salary
                        label: 'Salary Projected 3% Annually',
                        data: salaryData,
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    // {
                    //     type: 'line', // Line chart for Yearly ESOP Benefits
                    //     label: 'Yearly ESOP Benefits',
                    //     data: yearlyEsopTotals,
                    //     backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    //     borderColor: 'rgba(255, 99, 132, 1)',
                    //     fill: false,
                    //     tension: 0.1
                    // },
                    {
                        type: 'line', // Line chart for Cumulative Non-ESOP Benefits
                        label: 'Cumulative Non-ESOP Benefits',
                        data: cumulativeNonEsopData,
                        backgroundColor: 'rgba(255, 206, 86, 0.6)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        fill: false,
                        tension: 0.1
                    },
                    {
                        type: 'line', // Line chart for Cumulative Benefits (ESOP)
                        label: 'Cumulative Benefits (ESOP)',
                        data: cumulativeBenefitsData,
                        backgroundColor: 'rgba(153, 102, 255, 0.6)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        fill: false,
                        tension: 0.1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': $' + parseFloat(tooltipItem.raw).toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Year'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Amount ($)'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


<?php endif; ?>
