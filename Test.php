<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary and Benefits Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
            table-layout: fixed;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
            word-wrap: break-word;
            white-space: nowrap;
            font-size: 0.9em; /* Reduced font size */
        }
        th.year, td.year {
            width: 5%;
        }
        th.salary, td.salary {
            width: 7%;
        }
        th.esop-benefits, td.esop-benefits {
            width: 20%;
        }
        th.non-esop-benefits, td.non-esop-benefits {
            width: 30%;
        }
        th.total-benefits, td.total-benefits {
            width: 18%;
        }
    </style>
</head>
<body>
<h1>Salary and Benefits Growth Calculator</h1>
<form method="POST" action="">
    <label for="salary">Enter your current salary:</label>
    <input type="number" id="salary" name="salary" required step="0.01">
    <br><br>
    <label for="year">Select a start year:</label>
    <select id="year" name="year">
        <?php
        for ($i = 2024; $i <= date('Y') + 10; $i++) {
            echo "<option value='$i'>$i</option>";
        }
        ?>
    </select>
    <br><br>
    <label for="num_years">Number of years to generate:</label>
    <input type="number" id="num_years" name="num_years" value="10" min="1" required>
    <br><br>
    <label for="non_esop_percent">Select Non ESOP Percentage (401k):</label>
    <select id="non_esop_percent" name="non_esop_percent">
        <?php
        for ($i = 2; $i <= 15; $i++) {
            echo "<option value='$i'>$i%</option>";
        }
        ?>
    </select>
    <br><br>
    <button type="submit">Calculate</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['salary']) && isset($_POST['year']) && isset($_POST['num_years']) && isset($_POST['non_esop_percent'])) {
    $salary = (float)$_POST['salary'];
    $currentYear = (int)$_POST['year'];
    $numYears = (int)$_POST['num_years'];
    $employeeContributionPercent = (int)$_POST['non_esop_percent'] / 100;
    $cumulativeNonEsop = 0;
    $cumulativeEsop = 0;
    $cumulativeBenefitValue = 0;

    // Display results in a grid
    echo "<h2>Salary and Benefits Growth from Year $currentYear</h2>";
    echo "<table>";
    echo "<tr>
                <th class='year'>Year</th>
                <th class='salary'>Salary</th>
                <th class='esop-benefits'>ESOP Benefits</th>
                <th class='non-esop-benefits'>Non ESOP Benefits</th>
                <th class='total-benefits'>Benefit Value (Cumulative)</th>
              </tr>";

    for ($i = 0; $i < $numYears; $i++) {
        $year = $currentYear + $i;

        // Calculate ESOP benefits
        if ($i == 0) {
            $currentEsop = $salary * 0.06; // 6% of the salary for the first year
            $cumulativeEsop = $currentEsop; // Set cumulative ESOP to the first year's amount
            $esopDisplay = number_format($currentEsop, 2) . " (Year)"; // Only yearly value for the first row
        } else {
            $currentEsop = $salary * 0.06; // 6% of the current year's salary
            $cumulativeEsop += $currentEsop; // Add current year's ESOP to cumulative
            $esopDisplay = number_format($currentEsop, 2) . " (Year), " . number_format($cumulativeEsop, 2) . " (Total)"; // Show both yearly and total for subsequent rows
        }

        // Calculate Non ESOP Benefits
        $companyMatch = 0;

        if ($employeeContributionPercent > 0) {
            // Company matches up to 3%
            $matchablePercent = min(0.03, $employeeContributionPercent);
            $companyMatch += $matchablePercent;

            // Additional 0.5% match for contributions at 4% and 5%
            if ($employeeContributionPercent >= 0.04) {
                $companyMatch += 0.005; // Match 0.5% for 4%
            }
            if ($employeeContributionPercent >= 0.05) {
                $companyMatch += 0.005; // Match additional 0.5% for 5%
            }
        }

        $employeeContribution = $salary * $employeeContributionPercent; // Employee's contribution
        $currentNonEsopBenefits = $salary * $companyMatch; // Current year's company match
        $cumulativeNonEsop += $currentNonEsopBenefits; // Update cumulative amount
        $nonEsopDisplay = number_format($employeeContribution, 2) . " (Employee), " . number_format($currentNonEsopBenefits, 2) . " (Company), " . number_format($cumulativeNonEsop, 2) . " (Total)"; // Show all components

        // Calculate Benefit Value (Cumulative)
        $currentBenefitValue = $currentEsop + $currentNonEsopBenefits; // Current year's ESOP + company match
        $cumulativeBenefitValue += $currentBenefitValue; // Update cumulative total
        $benefitValueDisplay = number_format($currentBenefitValue, 2) . " (Year), " . number_format($cumulativeBenefitValue, 2) . " (Total)";

        echo "<tr>";
        echo "<td class='year'>$year</td>";
        echo "<td class='salary'>" . number_format($salary, 2) . "</td>";
        echo "<td class='esop-benefits'>$esopDisplay</td>";
        echo "<td class='non-esop-benefits'>$nonEsopDisplay</td>";
        echo "<td class='total-benefits'>$benefitValueDisplay</td>";
        echo "</tr>";

        $salary *= 1.03; // Increase salary by 3% each year
    }

    echo "</table>";
}
?>
</body>
</html>
