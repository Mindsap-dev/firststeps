<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dialectic ESOP</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- JQWidgets CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@13.2.0/jqwidgets/styles/jqx.base.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- JQWidgets JS -->
    <script src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@13.2.0/jqwidgets/jqx-all.js"></script>
    <style>
        .multi-line-header {
            white-space: normal !important;
            text-align: center;
            line-height: 1.2;
            display: block;
            word-wrap: break-word;
        }
    </style>
    <style>
        .multi-line-header {
            white-space: normal !important;
            text-align: center;
            line-height: 1.2;
            display: block;
            word-wrap: break-word;
        }
    </style>
    <style>
        /* Reduce font size for grid cells */
        .jqx-grid-cell {
            font-size: 12px !important; /* Adjust as needed */
        }
    </style>
    <style>
        /* First Chart - Stock Price */
        .chart-container {
            width: 90%;
            height: 200px;
            max-height: 500px;
            margin: 0 auto;
        }

        /* Second Chart - Salary, ESOP, and 401k Growth */
        .chart-container-2 {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 700px !important;
            max-height: 900px;
            margin-top: -20px;
            padding-top: 0px;
        }
        /* 📌 Make jqxGrid Text & Labels Smaller */
        .jqx-grid-header {
            font-size: 12px !important; /* Header Text Smaller */
            text-align: center;
            font-weight: bold;
        }

        .jqx-grid-cell {
            font-size: 11px !important; /* Cell Text Smaller */
            white-space: normal !important;
            word-wrap: break-word !important;
        }

    </style>
</head>
<body>
<div class="container my-5">
    <div class="row">
        <!-- Card 1 -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fs-6">Dialectic Engineering</h5>
                    <!-- Top Half -->
                    <div class="row g-2">
                        <div class="col-6">
                            <label for="currentAge" class="form-label fs-7">Current Age</label>
                            <select id="currentAge" class="form-select form-select-sm">
                                <?php for ($i = 20; $i <= 70; $i++): ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="retirementAge" class="form-label fs-7">Expected Retirement Age</label>
                            <select id="retirementAge" class="form-select form-select-sm">
                                <?php for ($i = 50; $i <= 70; $i++): ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="currentSalary" class="form-label fs-7">Current Salary</label>
                            <select id="currentSalary" class="form-select form-select-sm">
                                <?php for ($i = 50000; $i <= 200000; $i += 5000): ?>
                                    <option value="<?= $i ?>"><?= number_format($i) ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <!-- Separator Line -->
                    <hr>
                    <!-- Bottom Half -->
                    <div class="row g-2">
                        <div class="col-6">
                            <label for="percent401k" class="form-label fs-7">401k Contribution</label>
                            <select id="percent401k" class="form-select form-select-sm">
                                <?php for ($i = 1; $i <= 20; $i++): ?>
                                    <option value="<?= $i ?>"><?= $i ?>%</option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="growth401k" class="form-label fs-7">401k % Growth (Projected)</label>
                            <select id="growth401k" class="form-select form-select-sm">
                                <?php for ($i = 4; $i <= 15; $i++): ?>
                                    <option value="<?= $i ?>"><?= $i ?>%</option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="esopShares" class="form-label fs-7"># of Current ESOP Shares</label>
                            <input type="number" id="esopShares" class="form-control form-control-sm" placeholder="Enter number of shares">
                        </div>
                        <div class="col-6">
                            <label for="esopStockPrice" class="form-label fs-7">Current Dialectic ESOP Stock Price</label>
                            <input type="text" id="esopStockPrice" class="form-control form-control-sm" value="64.25" readonly>
                        </div>
                        <div class="col-12">
                            <button id="calculateButton" class="btn btn-primary btn-sm w-100">Calculate</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Card 2 Placeholder -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <!-- Top Half -->
                    <div class="row g-2 justify-content-center">
                        <div class="col-12">
                            <label class="form-label fs-7 d-block">Estimated Balance at Retirement</label>
                            <div id="retirementBalance" class="placeholder bg-light border rounded p-1 text-center" style="font-size: 0.9rem; width: 80%; margin: 0 auto;">
                                -- Not Calculated --
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fs-7 d-block">Total Dialectic Contributions</label>
                            <div id="totalContributions" class="placeholder bg-light border rounded p-1 text-center" style="font-size: 0.9rem; width: 80%; margin: 0 auto;">
                                -- Not Calculated --
                            </div>
                        </div>
                    </div>
                    <!-- Separator Line -->
                    <hr>
                    <!-- Bottom Half -->
                    <div class="row g-2">
                        <div class="col-12">
                            <div class="chart-container" style="margin: 0 auto; width: 90%;">
                                <canvas id="stockPriceChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-4">
        <!-- Full Width Card with jqxGrid -->
        <div class="col-12">
            <div class="card bg-light border">
                <div class="card-body text-center p-2">
                    <p id="textDisplay" class="mb-0" style="font-size: 0.9rem;">This is a hypothetical model to illustrate the potential growth of this type of investment. Salary increases, profit sharing and match contributions, and growth assumptions are all for illustrative purposes only. This model does not imply or guarantee certain salary increases, retirement plan contributions, return on ESOP stock, or continuance of the plan. Investment returns can fluctuate significantly from year to year and can include loss years and loss of principal contributions. Past performance is not an indicator of future returns. </p>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Grid</h5>
                    <div id="jqxgrid"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Retirement Growth Chart</h5>
                    <div class="chart-container-2 d-flex justify-content-center">
                        <canvas id="retirementChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

    document.addEventListener("DOMContentLoaded", function () {
        let ctx = document.getElementById("stockPriceChart").getContext("2d");

        let stockPriceChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: ['2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023'],
                datasets: [{
                    label: 'ESOP Stock Price',
                    data: [0.87, 0.90, 2.97, 8.51, 12.06, 28.44, 62.91, 78.25, 64.25],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: true,
                    pointRadius: 5,
                    pointBackgroundColor: 'rgba(75, 192, 192, 1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: "Year"
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: "Stock Price ($)"
                        },
                        beginAtZero: false
                    }
                }
            }
        });
    });
</script>
<script>
    // 🏗️ User Input Handling - Capture User Inputs When Calculate is Clicked
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("calculateButton").addEventListener("click", function () {
            console.log("🔹 Calculate button clicked!");

// 📥 Capture User Inputs
            let currentAge = parseInt(document.getElementById("currentAge").value) || 0;
            let expectedAge = parseInt(document.getElementById("retirementAge").value) || 0;
            let currentSalary = parseFloat(document.getElementById("currentSalary").value) || 0;
            let _401kContributions = parseFloat(document.getElementById("percent401k").value) || 0;
            let _401kGrowth = parseFloat(document.getElementById("growth401k").value) || 0;
            let esopShares = parseFloat(document.getElementById("esopShares").value) || 0;
            let esopStockPrice = 64.25; // Fixed stock price

// 🛑 Validate Inputs
            if (currentAge <= 0 || expectedAge <= 0 || currentAge >= expectedAge) {
                console.error("⚠️ Invalid Age Selection - Check Current and Expected Age Inputs.");
                alert("Please select valid age values.");
                return;
            }

// 📝 Store Inputs in Object (for easier debugging & passing to calculations)
            let userData = {
                currentAge,
                expectedAge,
                currentSalary,
                _401kContributions,
                _401kGrowth,
                esopShares,
                esopStockPrice
            };

// 📌 Log User Inputs for Debugging
            console.log("✅ User Inputs Captured:", userData);

// 🚀 Proceed to Calculations (Next Step)
            performCalculations(userData);
        });
    });
</script>
<script>
    // 🏗️ jqxGrid Setup - Define Grid Layout & Initialize It
    document.addEventListener("DOMContentLoaded", function () {
        console.log("🔹 Initializing jqxGrid...");

        // 📌 Define jqxGrid Data Source Structure
        let source = {
            localdata: [], // Empty initially, will be filled after calculations
            datatype: "array",
            datafields: [
                { name: "Age", type: "number" },
                { name: "ESOPBenefits", type: "string" },
                { name: "NonESOPBenefits", type: "string" },
                { name: "EmployerContributions", type: "string" },
                { name: "BenefitValueNonESOP", type: "string" }
            ]
        };

        let dataAdapter = new $.jqx.dataAdapter(source);

        // 📌 Initialize jqxGrid
        $("#jqxgrid").jqxGrid({
            width: "100%",
            autoheight: true,
            source: dataAdapter,
            theme: "base",
            rowsheight: 28,
            columnsheight: 45,
            sortable: false,
            enablehover: false,
            selectionmode: "none",
            columns: [
                { text: "Age", datafield: "Age", width: "3%", resizable: false },
                { text: "ESOP Benefits", datafield: "ESOPBenefits", width: "33%", resizable: false },
                { text: "Non-ESOP Benefits", datafield: "NonESOPBenefits", width: "28%", resizable: false },
                { text: "Employer Contributions", datafield: "EmployerContributions", width: "10%", resizable: false },
                { text: "Benefit Value Non-ESOP (401k Cumulative)", datafield: "BenefitValueNonESOP", width: "30%", resizable: false }
            ]
        });

        console.log("✅ jqxGrid Initialized Successfully.");
    });

</script>
<script>
    let myChart; // Global variable to store chart instance

    $(document).ready(function () {
        $("#calculateButton").click(function () {
            console.log("Button clicked!");

            // Capture user input values
            let currentAge = parseInt($("#currentAge").val());
            let expectedAge = parseInt($("#retirementAge").val());
            let esopShares = parseFloat($("#esopShares").val()) || 0;
            let currentSalary = parseFloat($("#currentSalary").val()) || 0;
            let percent401k = parseFloat($("#percent401k").val()) || 0;
            let growth401k = parseFloat($("#growth401k").val()) || 0;
            let esopStockPrice = parseFloat($("#esopStockPrice").val()) || 64.25;

            if (isNaN(currentAge) || isNaN(expectedAge) || currentAge >= expectedAge) {
                alert("Please select valid age values.");
                return;
            }

            console.log("Captured Inputs:", {
                currentAge, expectedAge, esopShares, currentSalary, percent401k, growth401k, esopStockPrice
            });

            // Initialize variables
            let esopBenefit = esopShares * esopStockPrice;
            let previousYearESOP = 0;
            let cumulativeCompanyMatch = 0;
            let total401kCumulative = 0;
            let lastEmployerContributions = 0;
            let last401kCumulative = 0;
            let gridData = [];

            // Loop from current age to expected retirement age
            for (let age = currentAge; age <= expectedAge; age++) {
                // **Age Column**
                let ageValue = age;

                // **ESOP Benefits Column**
                let currentEsopShare = currentSalary * 0.06;

                let totalESOP;
                if (age === currentAge) {
                    totalESOP = esopBenefit + currentEsopShare;
                } else {
                    totalESOP = esopBenefit + currentEsopShare + previousYearESOP;
                }
                previousYearESOP = totalESOP;

                let formattedESOP = `${formatCurrency(esopBenefit)} (Shares Value) | ${formatCurrency(currentEsopShare)} (Year) | ${formatCurrency(totalESOP)} (Total)`;

                // **Non-ESOP Benefits Column**
                let employee401k = (percent401k / 100) * currentSalary;
                let companyMatch;

                if (percent401k <= 3) {
                    companyMatch = currentSalary * (percent401k / 100);
                } else if (percent401k <= 5) {
                    companyMatch = (currentSalary * 0.03) + (currentSalary * (percent401k - 3) * 0.005);
                } else {
                    companyMatch = (currentSalary * 0.03) + (currentSalary * 0.005 * 2);
                }

                let formattedNonESOP = `${formatCurrency(employee401k)} (Employee) | ${formatCurrency(companyMatch)} (Company Match)`;

                // **Employer Contributions Column**
                let totalEmployerContributions;
                if (age === currentAge) {
                    totalEmployerContributions = totalESOP + companyMatch;
                } else {
                    totalEmployerContributions = totalESOP + companyMatch + cumulativeCompanyMatch;
                }
                cumulativeCompanyMatch += companyMatch;
                lastEmployerContributions = totalEmployerContributions; // Store last value for Card 2

                let formattedEmployerContributions = formatCurrency(totalEmployerContributions);

                // **Benefit Value Non-ESOP (401k Cumulative) Column**
                let total401kGrowthTotal = employee401k + companyMatch; // Employee + Company Match

                if (age === currentAge) {
                    total401kCumulative = total401kGrowthTotal * (1 + (growth401k / 100));
                } else {
                    total401kCumulative = (total401kCumulative + total401kGrowthTotal) * (1 + (growth401k / 100));
                }

                last401kCumulative = total401kCumulative; // Store last value for Card 2

                let formatted401kContribution = formatCurrency(total401kGrowthTotal);
                let formatted401kCumulative = formatCurrency(total401kCumulative);
                let benefitValueNonESOP = `${formatted401kContribution} | -> ${growth401k}% Growth = ${formatted401kCumulative}`;


                // Push all data into the grid
                gridData.push({
                    Age: ageValue,
                    ESOPBenefits: formattedESOP,
                    NonESOPBenefits: formattedNonESOP,
                    EmployerContributions: formattedEmployerContributions,
                    BenefitValueNonESOP: benefitValueNonESOP
                });

                // Adjust values for the next year
                esopBenefit *= 1.06; // Increase ESOP stock value by 6% annually
                currentSalary *= 1.03; // Increase salary by 3% annually
            }

            // **Update jqxGrid with New Data**
            $("#jqxgrid").jqxGrid({
                source: new $.jqx.dataAdapter({ localdata: gridData, datatype: "array" })
            });

            // **Calculate and Update Card 2 Values**
            let estimatedBalanceAtRetirement = lastEmployerContributions + last401kCumulative;
            $("#retirementBalance").text(formatCurrency(estimatedBalanceAtRetirement));
            $("#totalContributions").text(formatCurrency(lastEmployerContributions));

            // 📊 Prepare data for Chart.js with proper yearly increases
            let salaryHistory = [];
            let employerContributionsHistory = [];
            let benefitValueNonEsopHistory = [];
            let ages = [];

            let runningSalary = currentSalary; // Start with user-selected salary
            let runningEmployerContributions = 0; // Start at zero
            let running401kCumulative = 0; // Start at zero

// Loop to collect yearly increasing values
            for (let age = currentAge; age <= expectedAge; age++) {
                ages.push(age); // Store age for X-axis
                salaryHistory.push(runningSalary); // Store the yearly increasing salary

                // Apply yearly 3% salary increase for the next year
                runningSalary *= 1.03;

                employerContributionsHistory.push(runningEmployerContributions); // Store yearly ESOP contribution
                benefitValueNonEsopHistory.push(running401kCumulative); // Store 401k yearly growth

                // Apply yearly increases for the next iteration
                runningSalary *= 1.03; // Assume a 3% salary increase per year
                runningEmployerContributions *= 1.06; // Assume a 6% ESOP growth per year
                running401kCumulative *= (1 + (growth401k / 100)); // Apply projected 401k growth
            }
// Log results for debugging
            console.log("✅ Salary History:", salaryHistory);
            console.log("✅ Ages for Chart:", ages);

// 🟢 Call Chart.js function to update the chart
            updateChart(salaryHistory, employerContributionsHistory, benefitValueNonEsopHistory, ages);

            console.log("Final ESOP Calculation Complete");
            console.log("Final Employer Contributions:", lastEmployerContributions);
            console.log("Final 401k Cumulative Growth:", last401kCumulative);
            console.log("Estimated Balance at Retirement:", estimatedBalanceAtRetirement);
        });
    });

    // **Helper function to format currency**
    function formatCurrency(value) {
        return "$" + parseFloat(value).toLocaleString("en-US", { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }
    // Function to Update Chart with correctly increasing values
    function updateChart(salaryHistory, employerContributionsHistory, benefitValueNonEsopHistory, ages) {
        let ctx = document.getElementById('retirementChart').getContext('2d');

        // Calculate Total Retirement (ESOP Growth + 401k Growth)
        let totalRetirementHistory = employerContributionsHistory.map((value, index) => {
            return value + benefitValueNonEsopHistory[index];
        });

        // Destroy previous chart instance if exists
        if (myChart) {
            myChart.destroy();
        }

        myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ages, // X-axis: Years
                datasets: [
                    {
                        label: "Salary Growth ($)",
                        data: salaryHistory.map(value => parseFloat(value.toFixed(2))),
                        backgroundColor: "rgba(54, 162, 235, 0.5)", // Blue Bars
                        borderColor: "rgba(54, 162, 235, 1)",
                        borderWidth: 1,
                        yAxisID: 'y-axis-retirement'
                    },
                    {
                        label: "ESOP Growth ($)",
                        data: employerContributionsHistory.map(value => parseFloat(value.toFixed(2))),
                        type: 'line',
                        borderColor: "rgba(75, 192, 192, 1)", // Green Line
                        backgroundColor: "rgba(75, 192, 192, 0.2)",
                        fill: false,
                        tension: 0.3,
                        yAxisID: 'y-axis-retirement'
                    },
                    {
                        label: "401k Growth ($)",
                        data: benefitValueNonEsopHistory.map(value => parseFloat(value.toFixed(2))),
                        type: 'line',
                        borderColor: "rgba(255, 99, 132, 1)", // Red Line
                        backgroundColor: "rgba(255, 99, 132, 0.2)",
                        fill: false,
                        tension: 0.3,
                        yAxisID: 'y-axis-retirement'
                    },
                    {
                        label: "Total Retirement ($)",
                        data: totalRetirementHistory.map(value => parseFloat(value.toFixed(2))),
                        type: 'line',
                        borderColor: "rgba(255, 165, 0, 1)", // Orange Line
                        backgroundColor: "rgba(255, 165, 0, 0.2)",
                        fill: false,
                        borderWidth: 3,
                        tension: 0.3,
                        yAxisID: 'y-axis-retirement'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: "Age",
                            font: { size: 14 }
                        }
                    },
                    'y-axis-retirement': {
                        type: 'linear',
                        position: 'left',
                        title: {
                            display: true,
                            text: "Retirement Balance ($)",
                            font: { size: 14 }
                        },
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    }

</script>


</body>