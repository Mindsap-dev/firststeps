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
<div class="row mt-4">
    <!-- Full Width Card with Chart -->
    <div class="row mt-4">
        <!-- Full Width Card with Chart -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Graph</h5>
                    <div class="chart-container" style="margin: 0 auto; width: 90%;">
                        <canvas id="myChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function () {
        const currentSharePrice = 64.25; // Current share price used for calculations
        let data = []; // Data for the grid
        let chart; // Store the Chart.js instance

        const source = {
            localdata: data,
            datatype: "array",
            datafields: [
                { name: 'age', type: 'number' },
                { name: 'esopBenefits', type: 'string' },
                { name: 'nonEsopBenefits', type: 'string' },
                { name: 'esopValue', type: 'number' },
                { name: 'nonEsopValue', type: 'number' }
            ]
        };

        const dataAdapter = new $.jqx.dataAdapter(source);

        $("#jqxgrid").jqxGrid({
            width: '100%',
            height: 300,
            source: dataAdapter,
            columns: [
                { text: 'Age', datafield: 'age', width: '3%' },
                { text: 'ESOP Benefits', datafield: 'esopBenefits', width: '35%' },
                { text: 'Non ESOP Benefits', datafield: 'nonEsopBenefits', width: '30%' },
                {
                    text: '<div class="multi-line-header">Employer<br>Contributions</div>',
                    datafield: 'esopValue',
                    width: '10%'
                },
                {
                    text: '<div class="multi-line-header">Benefit Value Non-ESOP<br>(401K Cumulative)</div>',
                    datafield: 'nonEsopValue',
                    width: '30%'
                }
            ]
        });

        // Function to render the Chart.js graph
        function renderChart(labels, salaryData, esopCumulativeData, nonEsopCumulativeData) {
            const ctx = document.getElementById('myChart').getContext('2d');
            if (chart) {
                chart.destroy(); // Destroy previous chart if it exists
            }
            chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels, // x-axis labels (Ages)
                    datasets: [
                        {
                            label: 'Employee Salary',
                            data: salaryData,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            type: 'bar'
                        },
                        {
                            label: 'Benefit Value ESOP (Cumulative)',
                            data: esopCumulativeData,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            type: 'line',
                            fill: false
                        },
                        {
                            label: 'Benefit Value Non-ESOP (Cumulative)',
                            data: nonEsopCumulativeData,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            type: 'line',
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
        }

        // Data for the ESOP Stock Price graph
        const stockPriceData = {
            labels: ['2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023'],
            datasets: [{
                label: 'ESOP Stock Price',
                data: [0.87, 0.90, 2.97, 8.51, 12.06, 28.44, 62.91, 78.25, 64.25],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        // Options for the graph
        const stockPriceOptions = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        };

        // Function to render the graph
        function renderStockPriceChart() {
            const ctx = document.getElementById('stockPriceChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: stockPriceData,
                options: stockPriceOptions
            });
        }

        // Render the graph when the page is ready
        $(document).ready(function () {
            renderStockPriceChart();
        });
        // Handle the Calculate button click
        $("#calculateButton").click(function () {
            console.log("Calculate button clicked!");

            // Retrieve Input Values
            const currentAge = parseInt($("#currentAge").val());
            const retirementAge = parseInt($("#retirementAge").val());
            let currentSalary = parseFloat($("#currentSalary").val());
            const esopShares = parseInt($("#esopShares").val()) || 0;
            const percent401k = parseFloat($("#percent401k").val()) || 0;
            const growth401k = parseFloat($("#growth401k").val()) || 0;

            if (isNaN(currentAge) || isNaN(retirementAge) || isNaN(currentSalary)) {
                alert("Please select valid numbers for age, salary, and contributions.");
                return;
            }

            let sharesValue = esopShares * 64.25;
            let cumulativeBenefitEsop = 0;
            let cumulativeBenefitNonEsop = 0;


            const labels = [];
            const salaryData = [];
            const esopCumulativeData = [];
            const nonEsopCumulativeData = [];

            // Clear jqxGrid before populating
            console.log("Clearing jqxGrid...");
            $("#jqxgrid").jqxGrid('clear');

            let lastEsopValue = 0;  // Stores the last ESOP Value (Cumulative)
            let lastNonEsopWithGrowth = 0; // Stores the last 401k Growth Value

            for (let age = currentAge; age <= retirementAge; age++) {
                const yearlyBenefit = currentSalary * 0.06;
                const employeeContribution = (percent401k / 100) * currentSalary;

                let companyMatch = 0;
                if (percent401k <= 3) {
                    companyMatch = currentSalary * (percent401k / 100);
                } else if (percent401k <= 5) {
                    companyMatch = (currentSalary * 0.03) + (currentSalary * (percent401k - 3) * 0.005);
                } else if (percent401k > 5) {
                    companyMatch = (currentSalary * 0.03) + (currentSalary * 0.005 * 2);
                }

                const sharesValueAtAge = esopShares * currentSharePrice; // Calculate value of shares for the current year
                const totalBenefits = yearlyBenefit + sharesValueAtAge;  // Add to yearly ESOP benefits


                cumulativeBenefitEsop += totalBenefits + companyMatch;

                if (age === currentAge) {
                    cumulativeBenefitNonEsop = employeeContribution + companyMatch;
                } else {
                    cumulativeBenefitNonEsop += employeeContribution + companyMatch;
                }

                // **Apply Compound Growth to 401K Cumulative**
                let totalWithGrowth = cumulativeBenefitNonEsop * Math.pow(1 + (growth401k / 100), (retirementAge - currentAge));

                labels.push(age);
                salaryData.push(currentSalary);
                esopCumulativeData.push(cumulativeBenefitEsop);
                nonEsopCumulativeData.push(totalWithGrowth);

                console.log(`Age ${age}: ESOP ${cumulativeBenefitEsop}, Non-ESOP w/ Growth ${totalWithGrowth}`);

                const esopBenefitsDisplay = `$${sharesValue.toFixed(2)} (Shares Value), $${yearlyBenefit.toFixed(2)} (Year), Total: $${totalBenefits.toFixed(2)}`;
                const nonEsopBenefitsDisplay = `$${employeeContribution.toFixed(2)} (Employee), $${companyMatch.toFixed(2)} (Company Match)`;
                const nonEsopValueDisplay = `$${cumulativeBenefitNonEsop.toLocaleString('en-US', { minimumFractionDigits: 2 })} → ${growth401k}% Growth: $${totalWithGrowth.toLocaleString('en-US', { minimumFractionDigits: 2 })}`;

                data.push({
                    age: age,
                    esopBenefits: esopBenefitsDisplay,
                    nonEsopBenefits: nonEsopBenefitsDisplay,
                    esopValue: `$${cumulativeBenefitEsop.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`,
                    nonEsopValue: `$${cumulativeBenefitNonEsop.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })} → ${growth401k}% Growth: $${totalWithGrowth.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`
                });


                // Update the last recorded values at the final iteration
                lastEsopValue = cumulativeBenefitEsop;
                lastNonEsopWithGrowth = totalWithGrowth;

                currentSalary *= 1.03;
                sharesValue *= 1.06;
            }

            // ✅ **Calculate Correct Estimated Balance at Retirement**
            const estimatedBalanceRetirement = lastEsopValue + lastNonEsopWithGrowth;

            console.log("Final ESOP Value:", lastEsopValue);
            console.log("Final 401k Growth Value:", lastNonEsopWithGrowth);
            console.log("Final Estimated Balance:", estimatedBalanceRetirement);


            $("#retirementBalance").html(`<strong>$${estimatedBalanceRetirement.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</strong>`);

            // ✅ **Update Total Dialectic Contributions with final ESOP Cumulative Value**
            $("#totalContributions").html(`<strong>$${lastEsopValue.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</strong>`);

            // ✅ Update jqxGrid
            console.log("Updating jqxGrid with new data...");
            $("#jqxgrid").jqxGrid('source', new $.jqx.dataAdapter({ localdata: data, datatype: "array" }));

            // ✅ Render Chart
            console.log("Rendering chart...");
            renderChart(labels, salaryData, esopCumulativeData, nonEsopCumulativeData);

            console.log("Calculation completed successfully.");
        });

    });
</script>

</body>
</html>
