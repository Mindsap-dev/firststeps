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

        $(document).ready(function () {
            $("#calculateButton").click(function () {

                let currentAge = $("#currentAge").val();
                let expectedAge = $("#retirementAge").val();
                let currentSalary = $("#currentSalary").val();
                let _401kContributions = $("#percent401k").val();
                let _401kGrowth = $("#growth401k").val();
                let ESOPShares = $("#esopShares").val();
                let esopStockPrice = $("#esopStockPrice").val();


                let esopData = {
                    currentAge: parseInt(currentAge),
                    expectedAge: parseInt(expectedAge),
                    currentSalary: parseFloat(currentSalary),
                    _401kContributions: parseInt(_401kContributions),
                    _401kGrowth: parseFloat(_401kGrowth),
                    ESOPShares: parseInt(ESOPShares),
                    esopStockPrice: parseFloat(esopStockPrice)
                };


                console.log("ESOP Data Captured:", esopData);


            });
        });
    </script>
    <style>

        .jqx-grid-header {
            white-space: normal !important;
            word-wrap: break-word !important;
            text-align: center !important;
            font-size: 12px;
        }
    </style>

    <style>

        .jqx-grid-header {
            white-space: normal !important;
            word-wrap: break-word !important;
            text-align: center !important;
            font-size: 12px; /* Adjust font size for better fit */
        }


        .jqx-grid-cell {
            white-space: normal !important;
            word-wrap: break-word !important;
        }
    </style>

<script>
    $(document).ready(function () {
        let DialecticStock = 64.25; // Stock price variable
        let updatedStock = 0; // First ESOP calculation (Shares Value)
        let previousUpdatedStock = 0; // Previous year's stock value
        let currentShare = 0; // Second ESOP calculation (Salary * 0.06)
        let totalSalary = 0; // Salary that increases by 3% per year
        let totalEsop = 0; // Third ESOP calculation (Cumulative ESOP Total)
        let personal401k = 0; // Employee 401k contribution (Salary * 401k%)
        let companyMatch = 0; // Employer 401k match
        let totalNonESOP401k = 0; // Employee + Employer 401k contribution
        let totalContribution = 0; // Employer Contributions (Company Match + totalEsop)
        let totalNonEsopCumulative = 0; // Cumulative Non-ESOP 401k value

        let source = {
            localdata: [],
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

        $("#jqxgrid").jqxGrid({
            width: "100%",
            autoheight: true,
            source: dataAdapter,
            theme: "base",
            rowsheight: 30,
            columnsheight: 50,
            sortable: false,
            enablehover: false,
            selectionmode: "none",
            columns: [
                { text: "Age", datafield: "Age", width: "3%", resizable: false },
                {
                    text: "ESOP Benefits",
                    datafield: "ESOPBenefits",
                    width: "35%",
                    resizable: false
                },
                {
                    text: "Non ESOP Benefits",
                    datafield: "NonESOPBenefits",
                    width: "30%",
                    resizable: false
                },
                {
                    text: "Employer Contributions",
                    datafield: "EmployerContributions",
                    width: "12%",
                    resizable: false
                },
                {
                    text: "Benefit Value Non-ESOP (401k Cumulative)",
                    datafield: "BenefitValueNonESOP",
                    width: "30%",
                    resizable: false
                }
            ]
        });


        function formatCurrency(value) {
            return "$" + parseFloat(value).toLocaleString("en-US", { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }


        $("#calculateButton").click(function () {
            let currentAge = parseInt($("#currentAge").val());
            let expectedAge = parseInt($("#retirementAge").val());
            let esopShares = parseFloat($("#esopShares").val()) || 0;
            let currentSalary = parseFloat($("#currentSalary").val()) || 0;
            let percent401k = parseFloat($("#percent401k").val()) || 0;
            let growth401k = parseFloat($("#growth401k").val()) || 0;

            if (isNaN(currentAge) || isNaN(expectedAge) || currentAge >= expectedAge) {
                alert("Please select valid age values.");
                return;
            }


            totalSalary = currentSalary;
            updatedStock = esopShares * DialecticStock;
            previousUpdatedStock = updatedStock;
            totalEsop = updatedStock + (totalSalary * 0.06);
            let totalRetirementBalance = 0;

            let gridData = [];

            for (let age = currentAge; age <= expectedAge; age++) {
                let currentShare = totalSalary * 0.06;

                if (age === currentAge) {

                    totalEsop = updatedStock + currentShare;
                } else {

                    let stockDifference = updatedStock - previousUpdatedStock;


                    totalEsop = totalEsop + stockDifference + currentShare;
                }


                previousUpdatedStock = updatedStock;


                personal401k = totalSalary * (percent401k / 100);


                if (percent401k <= 3) {
                    companyMatch = totalSalary * (percent401k / 100);
                } else if (percent401k <= 5) {
                    companyMatch = (totalSalary * 0.03) + (totalSalary * (percent401k - 3) * 0.005);
                } else {
                    companyMatch = (totalSalary * 0.03) + (totalSalary * 0.005 * 2);
                }


                totalNonESOP401k = personal401k + companyMatch;


                if (age === currentAge) {
                    totalContribution = companyMatch + totalEsop;
                } else {
                    totalContribution = totalContribution + companyMatch + totalEsop;
                }


                if (age === currentAge) {
                    totalNonEsopCumulative = totalNonESOP401k * (1 + growth401k / 100);
                } else {
                    totalNonEsopCumulative = (totalNonEsopCumulative + totalNonESOP401k) * (1 + growth401k / 100);
                }


                totalRetirementBalance = totalContribution + totalNonEsopCumulative;

                gridData.push({
                    Age: age,
                    ESOPBenefits: `${formatCurrency(updatedStock)} (Shares Value) | ${formatCurrency(currentShare)} (Year) | ${formatCurrency(totalEsop)} (Total)`,
                    NonESOPBenefits: `${formatCurrency(personal401k)} (Employee) | ${formatCurrency(companyMatch)} (Company Match)`,
                    EmployerContributions: `${formatCurrency(totalContribution)}`,
                    BenefitValueNonESOP: `${formatCurrency(totalNonESOP401k)} | -> ${growth401k}% Growth ${formatCurrency(totalNonEsopCumulative)}`
                });


                updatedStock *= 1.06;


                totalSalary *= 1.03;
            }


            $("#retirementBalance").text(formatCurrency(totalRetirementBalance));



            $("#totalContributions").text(formatCurrency(totalContribution));

            $("#jqxgrid").jqxGrid({ source: new $.jqx.dataAdapter({ localdata: gridData, datatype: "array" }) });

            console.log("Final ESOP Calculation Complete");
            console.log("Final Retirement Balance: ", totalRetirementBalance);
            console.log("Final Total Dialectic Contributions: ", totalContribution);

        });
    });
</script>


<!-- Add Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">Retirement Growth Chart</h5>
                <div class="chart-container-2 d-flex justify-content-center">
                    <canvas id="myChart2"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


    <div class="chart-container">
        <canvas id="myChart" style="height: 600px !important; max-height: 800px;"></canvas>
    </div>

<script>
    let myChart2;

    function updateChart2(salaryHistory, employerContributionsHistory, benefitValueNonEsopHistory, ages) {
        let ctx = document.getElementById('myChart2').getContext('2d');

        // Calculate Total Retirement (ESOP Growth + 401k Growth)
        let totalRetirementHistory = employerContributionsHistory.map((value, index) => {
            return value + benefitValueNonEsopHistory[index];
        });

        // Destroy previous chart instance if exists
        if (myChart2) {
            myChart2.destroy();
        }

        myChart2 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ages,
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
                        ticks: { callback: function(value) { return '$' + value.toLocaleString(); } }
                    }
                }
            }
        });
    }


    $("#calculateButton").click(function () {
        let currentAge = parseInt($("#currentAge").val());
        let expectedAge = parseInt($("#retirementAge").val());
        let esopShares = parseFloat($("#esopShares").val()) || 0;
        let currentSalary = parseFloat($("#currentSalary").val()) || 0;
        let percent401k = parseFloat($("#percent401k").val()) || 0;
        let growth401k = parseFloat($("#growth401k").val()) || 0;

        if (isNaN(currentAge) || isNaN(expectedAge) || currentAge >= expectedAge) {
            alert("Please select valid age values.");
            return;
        }

        let DialecticStock = 64.25;
        let updatedStock = esopShares * DialecticStock;
        let previousUpdatedStock = updatedStock;
        let totalSalary = currentSalary;
        let totalEsop = 0;
        let totalEmployerContributions = 0;
        let totalNonEsopCumulative = 0;

        let salaryHistory = [];
        let employerContributionsHistory = [];
        let benefitValueNonEsopHistory = [];
        let ages = [];

        for (let age = currentAge; age <= expectedAge; age++) {
            ages.push(age);
            salaryHistory.push(totalSalary);

            let currentShare = totalSalary * 0.06;

            if (age === currentAge) {
                totalEsop = updatedStock + currentShare;
            } else {
                let stockDifference = updatedStock - previousUpdatedStock;
                totalEsop = totalEsop + stockDifference + currentShare;
            }

            previousUpdatedStock = updatedStock;

            let personal401k = totalSalary * (percent401k / 100);

            let companyMatch;
            if (percent401k <= 3) {
                companyMatch = totalSalary * (percent401k / 100);
            } else if (percent401k <= 5) {
                companyMatch = (totalSalary * 0.03) + (totalSalary * (percent401k - 3) * 0.005);
            } else {
                companyMatch = (totalSalary * 0.03) + (totalSalary * 0.005 * 2);
            }

            let totalNonESOP401k = personal401k + companyMatch;

            if (age === currentAge) {
                totalEmployerContributions = companyMatch + totalEsop;
            } else {
                totalEmployerContributions = totalEmployerContributions + companyMatch + totalEsop;
            }
            employerContributionsHistory.push(totalEmployerContributions);

            if (age === currentAge) {
                totalNonEsopCumulative = totalNonESOP401k * (1 + growth401k / 100);
            } else {
                totalNonEsopCumulative = (totalNonEsopCumulative + totalNonESOP401k) * (1 + growth401k / 100);
            }
            benefitValueNonEsopHistory.push(totalNonEsopCumulative);

            updatedStock *= 1.06;
            totalSalary *= 1.03;
        }

        updateChart2(salaryHistory, employerContributionsHistory, benefitValueNonEsopHistory, ages);
    });
</script>


</body>
