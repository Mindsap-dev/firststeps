<script>

    $(document).ready(function () {
        $("#calculateButton").click(function () {
            console.log("Button clicked!");

            let currentAge = $("#currentAge").val();
            let expectedAge = $("#retirementAge").val();
            let currentSalary = $("#currentSalary").val();
            let _401kContributions = $("#percent401k").val();
            let _401kGrowth = $("#growth401k").val();
            let ESOPShares = $("#esopShares").val();
            let esopStockPrice = $("#esopStockPrice").val();

            console.log("ESOP Data:", { currentAge, expectedAge, esopShares, currentSalary, percent401k, growth401k, esopStockPrice });

            if (isNaN(currentAge) || isNaN(expectedAge) || currentAge >= expectedAge) {
                alert("Please select valid age values.");
                return;
            }
            console.log("Starting calculations...");

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

            for (let age = currentAge; age <= expectedAge; age++) {
                console.log("Processing age:", age);

                let currentShare = totalSalary * 0.06;
                let stockDifference = updatedStock - previousUpdatedStock;
                totalEsop += stockDifference + currentShare;
                previousUpdatedStock = updatedStock;

                let personal401k = totalSalary * (percent401k / 100);
                let companyMatch = (percent401k <= 3) ? (totalSalary * (percent401k / 100))
                    : (percent401k <= 5) ? ((totalSalary * 0.03) + (totalSalary * (percent401k - 3) * 0.005))
                        : ((totalSalary * 0.03) + (totalSalary * 0.005 * 2));

                let totalNonESOP401k = personal401k + companyMatch;
                cumulativeCompanyMatch += companyMatch;

                totalEmployerContributions = totalEsop + cumulativeCompanyMatch;
                totalNonEsopCumulative = (totalNonEsopCumulative + totalNonESOP401k) * (1 + growth401k / 100);

                gridData.push({
                    Age: age,
                    ESOPBenefits: `$${updatedStock.toFixed(2)} (Shares) | $${currentShare.toFixed(2)} (Year) | $${totalEsop.toFixed(2)} (Total)`,
                    NonESOPBenefits: `$${personal401k.toFixed(2)} (Employee) | $${companyMatch.toFixed(2)} (Company)`,
                    EmployerContributions: `$${totalEmployerContributions.toFixed(2)}`,
                    BenefitValueNonESOP: `$${totalNonESOP401k.toFixed(2)} → ${growth401k}% Growth: $${totalNonEsopCumulative.toFixed(2)}`
                });

                updatedStock *= 1.06;
                totalSalary *= 1.03;
            }
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
            console.log("Final Contributions:", totalEmployerContributions);
            console.log("Final Total ESOP:", totalEsop);
            console.log("Updating UI...");

            $("#retirementBalance").text("$" + totalEmployerContributions.toFixed(2));
            $("#totalContributions").text("$" + totalEmployerContributions.toFixed(2));

            $("#jqxgrid").jqxGrid({
                source: new $.jqx.dataAdapter({ localdata: gridData, datatype: "array" })
            });

            console.log("Calculation complete.");

            function formatCurrency(value) {
                return "$" + parseFloat(value).toLocaleString("en-US", { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            }

            {
                let currentAge = parseInt($("#currentAge").val());
                let expectedAge = parseInt($("#retirementAge").val());
                let esopShares = parseFloat($("#esopShares").val()) || 0;
                let currentSalary = parseFloat($("#currentSalary").val()) || 0;
                let percent401k = parseFloat($("#percent401k").val()) || 0;
                let growth401k = parseFloat($("#growth401k").val()) || 0;
                let esopStockPrice = parseFloat($("#esopStockPrice").val()) || 64.25; // Default stock price


                if (isNaN(currentAge) || isNaN(expectedAge) || currentAge >= expectedAge) {
                    alert("Please select valid age values.");
                    return;
                }
                let esopData = {
                    currentAge,
                    expectedAge,
                    currentSalary,
                    percent401k,
                    growth401k,
                    esopShares,
                    esopStockPrice
                };

                console.log("ESOP Data Captured:", esopData);

                // 📊 Initialize Calculation Variables
                let DialecticStock = 64.25;
                let updatedStock = esopShares * DialecticStock;
                let previousUpdatedStock = updatedStock;
                let totalSalary = currentSalary;
                let totalEsop = 0;
                let totalEmployerContributions = 0;
                let totalNonEsopCumulative = 0;
                let previousCompanyMatchTotal = 0;
                let cumulativeCompanyMatch = 0;
                let cumulativeEsopContributions = 0;

                let salaryHistory = [];
                let employerContributionsHistory = [];
                let benefitValueNonEsopHistory = [];
                let ages = [];

                totalSalary = currentSalary;
                updatedStock = esopShares * DialecticStock;
                previousUpdatedStock = updatedStock;
                totalEsop = updatedStock + (totalSalary * 0.06);
                let totalRetirementBalance = 0;

                let gridData = [];

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

                    // 💰 Calculate 401k Contributions & Company Match
                    let personal401k = totalSalary * (percent401k / 100);
                    let companyMatch;

                    personal401k = totalSalary * (percent401k / 100);


                    if (percent401k <= 3) {
                        companyMatch = totalSalary * (percent401k / 100);
                    } else if (percent401k <= 5) {
                        companyMatch = (totalSalary * 0.03) + (totalSalary * (percent401k - 3) * 0.005);
                    } else {
                        companyMatch = (totalSalary * 0.03) + (totalSalary * 0.005 * 2);
                    }


                    let totalNonESOP401k = personal401k + companyMatch;
                    cumulativeCompanyMatch += companyMatch;

                    // 🔢 Calculate Total Employer Contributions
                    if (age === currentAge) {
                        totalEmployerContributions = totalEsop + companyMatch;
                    } else {
                        totalEmployerContributions = totalEsop + cumulativeCompanyMatch;
                    }
                    employerContributionsHistory.push(totalEmployerContributions);

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
</script>

